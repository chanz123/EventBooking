<?php
namespace Vendor\EventBooking\Model;

use Vendor\EventBooking\Api\BookingServiceInterface;
use Vendor\EventBooking\Model\ResourceModel\Event as EventResource;
use Vendor\EventBooking\Model\ResourceModel\Booking as BookingResource;
use Vendor\EventBooking\Model\ResourceModel\Attendee as AttendeeResource;
use Vendor\EventBooking\Model\EventFactory;
use Vendor\EventBooking\Model\AttendeeFactory;
use Vendor\EventBooking\Model\BookingFactory;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\DB\TransactionFactory;

class BookingService implements BookingServiceInterface
{
    protected $eventResource;
    protected $bookingResource;
    protected $attendeeResource;
    protected $eventFactory;
    protected $attendeeFactory;
    protected $bookingFactory;
    protected $transactionFactory;

    public function __construct(
        EventResource $eventResource,
        BookingResource $bookingResource,
        AttendeeResource $attendeeResource,
        EventFactory $eventFactory,
        AttendeeFactory $attendeeFactory,
        BookingFactory $bookingFactory,
        TransactionFactory $transactionFactory
    ) {
        $this->eventResource = $eventResource;
        $this->bookingResource = $bookingResource;
        $this->attendeeResource = $attendeeResource;
        $this->eventFactory = $eventFactory;
        $this->attendeeFactory = $attendeeFactory;
        $this->bookingFactory = $bookingFactory;
        $this->transactionFactory = $transactionFactory;
    }

    public function bookEvent(int $eventId, string $name, string $email, string $phone): string
    {
        // Load event
        $event = $this->eventFactory->create();
        $this->eventResource->load($event, $eventId);

        if (!$event->getId()) {
            throw new LocalizedException(__('Event not found.'));
        }

        // Check event capacity
        $currentBookings = $this->bookingResource->countBookingsForEvent($eventId);
        if ($currentBookings >= $event->getCapacity()) {
            throw new LocalizedException(__('Event is fully booked.'));
        }

        // Check if attendee exists
        $attendee = $this->attendeeFactory->create();
        $this->attendeeResource->loadByEmail($attendee, $email);

        if (!$attendee->getId()) {
            // Create new attendee
            $attendee->setName($name)
                     ->setEmail($email)
                     ->setPhone($phone);
            $this->attendeeResource->save($attendee);
        }

        // Check for duplicate booking
        if ($this->bookingResource->exists($eventId, $attendee->getId())) {
            throw new LocalizedException(__('Attendee is already booked for this event.'));
        }

        // Create booking
        $booking = $this->bookingFactory->create();
        $booking->setEventId($eventId)
                ->setAttendeeId($attendee->getId())
                ->setCreatedAt(date('Y-m-d H:i:s'));

        $this->bookingResource->save($booking);

        return __('Booking successful for %1.', $attendee->getName());
    }
}
