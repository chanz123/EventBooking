<?php

namespace Vendor\EventBooking\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Model\ResourceModel\Db\Context;

class Booking extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('eventbooking_booking', 'booking_id');
    }

    public function exists(int $eventId, int $attendeeId): bool
    {
        $connection = $this->getConnection();
        $bind = ['event_id' => $eventId, 'attendee_id' => $attendeeId];
        $select = $connection->select()
            ->from(['main_table' => $this->getMainTable()], ['booking_id'])
            ->where('main_table.event_id = :event_id')
            ->where('main_table.attendee_id = :attendee_id')
            ->limit(1);
        return (bool)$connection->fetchOne($select, $bind);
    }

    public function countBookingsForEvent(int $eventId): int
    {
        $connection = $this->getConnection();
        $bind = ['event_id' => $eventId];
        $select = $connection->select()
            ->from(['main_table' => $this->getMainTable()], [new \Zend_Db_Expr('COUNT(*)')])
            ->where('main_table.event_id = :event_id');
        return (int)$connection->fetchOne($select, $bind);
    }
}
