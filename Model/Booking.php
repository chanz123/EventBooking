<?php

namespace Vendor\EventBooking\Model;

use Magento\Framework\Model\AbstractModel;

class Booking extends AbstractModel
{
    protected function _construct()
    {
        $this->_init(\Vendor\EventBooking\Model\ResourceModel\Booking::class);
    }

    public function getEventId()
    {
        return $this->getData('event_id');
    }

    public function setEventId($eventId)
    {
        return $this->setData('event_id', $eventId);
    }

    public function getAttendeeId()
    {
        return $this->getData('attendee_id');
    }

    public function setAttendeeId($attendeeId)
    {
        return $this->setData('attendee_id', $attendeeId);
    }

    public function getCreatedAt()
    {
        return $this->getData('created_at');
    }

    public function setCreatedAt($createdAt)
    {
        return $this->setData('created_at', $createdAt);
    }
}
