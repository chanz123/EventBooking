<?php

namespace Vendor\EventBooking\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Magento\Framework\Model\AbstractModel;

class Attendee extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('eventbooking_attendee', 'id');
    }

    public function loadByEmail(\Vendor\EventBooking\Model\Attendee $attendee, string $email)
    {
        $this->load($attendee, $email, 'email');
    }
}
