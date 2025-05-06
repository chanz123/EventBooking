<?php
namespace Vendor\EventBooking\Api;

/**
 * Interface BookingServiceInterface
 */
interface BookingServiceInterface
{
    /**
     * Book an event for a new attendee.
     *
     * @param int $eventId
     * @param string $name
     * @param string $email
     * @param string $phone
     * @return string Success message or booking ID.
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function bookEvent(int $eventId, string $name, string $email, string $phone): string;
}
