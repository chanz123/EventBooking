<?php
namespace Vendor\EventBooking\Model;

use Magento\Framework\Model\AbstractModel;

class Event extends AbstractModel
{
    protected $_idFieldName = 'id';
    protected $_table = 'event';

    protected $_data = [
        'title' => '',
        'description' => '',
        'start_date' => '',
        'end_date' => '',
        'country' => '',
        'capacity' => 0,
        'created_by' => 0
    ];
}
