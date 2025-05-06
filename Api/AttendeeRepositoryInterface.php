<?php
namespace Vendor\EventBooking\Api;

use Vendor\EventBooking\Api\Data\AttendeeInterface;

interface AttendeeRepositoryInterface
{
    public function save(AttendeeInterface $attendee): AttendeeInterface;
    public function getById(int $id): ?AttendeeInterface;
    public function delete(int $id): bool;
}
