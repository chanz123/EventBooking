<?php

namespace Vendor\EventBooking\Test\Unit\Model;

use PHPUnit\Framework\TestCase;
use Vendor\EventBooking\Api\EventRepositoryInterface;
use Vendor\EventBooking\Model\EventRepository;
use Magento\Framework\TestFramework\Unit\Helper\ObjectManager;
use Magento\Framework\Exception\LocalizedException;
use Vendor\EventBooking\Model\Event;
use Vendor\EventBooking\Model\Attendee;

class EventRepositoryTest extends TestCase
{
    private $eventRepository;
    private $eventFactory;
    private $attendeeFactory;
    
    protected function setUp(): void
    {
        $objectManager = new ObjectManager($this);
        $this->eventFactory = $this->createMock(\Vendor\EventBooking\Model\EventFactory::class);
        $this->attendeeFactory = $this->createMock(\Vendor\EventBooking\Model\AttendeeFactory::class);
        
        $this->eventRepository = new EventRepository(
            $this->eventFactory,
            $this->attendeeFactory
        );
    }

    public function testCreateEvent()
    {
        $eventData = [
            'name' => 'Sample Event',
            'description' => 'Event description',
            'date' => '2025-06-15 10:00:00',
            'location' => 'USA',
            'capacity' => 100
        ];
        
        $event = $this->createMock(Event::class);
        $this->eventFactory->method('create')->willReturn($event);
        
        $this->eventFactory->expects($this->once())->method('create');
        $event->expects($this->once())->method('setData')->with($eventData);
        
        $this->eventRepository->createEvent($eventData);
    }

    public function testBookEventSuccessfully()
    {
        $attendeeData = [
            'full_name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'phone_number' => '1234567890',
            'address' => 'New York, USA'
        ];
        
        $attendee = $this->createMock(Attendee::class);
        $this->attendeeFactory->method('create')->willReturn($attendee);
        
        $attendee->expects($this->once())->method('setData')->with($attendeeData);
        
        $this->attendeeFactory->expects($this->once())->method('create');
        
        $response = $this->eventRepository->bookEvent(1, $attendeeData);
        $this->assertTrue($response);
    }

    public function testBookingEventWithOverCapacity()
    {
        $attendeeData = [
            'full_name' => 'Jane Doe',
            'email' => 'jane.doe@example.com',
            'phone_number' => '9876543210',
            'address' => 'Los Angeles, USA'
        ];

        $this->expectException(LocalizedException::class);
        $this->eventRepository->bookEvent(1, $attendeeData);
    }
}
