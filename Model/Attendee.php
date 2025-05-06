<?php
namespace Vendor\EventBooking\Model;

use Magento\Framework\Model\AbstractModel;
use Vendor\EventBooking\Api\Data\AttendeeInterface;

class Attendee extends AbstractModel implements AttendeeInterface
{
    protected function _construct()
    {
        $this->_init(\Vendor\EventBooking\Model\ResourceModel\Attendee::class);
    }

    public function getId()
    {
        return $this->getData(self::ID);
    }

    public function getName()
    {
        return $this->getData(self::NAME);
    }

    public function setName($name)
    {
        return $this->setData(self::NAME, $name);
    }

    public function getEmail()
    {
        return $this->getData(self::EMAIL);
    }

    public function setEmail($email)
    {
        return $this->setData(self::EMAIL, $email);
    }

    public function getPhone()
    {
        return $this->getData(self::PHONE);
    }

    public function setPhone($phone)
    {
        return $this->setData(self::PHONE, $phone);
    }
}
