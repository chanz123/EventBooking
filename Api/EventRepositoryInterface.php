<?php
namespace Vendor\EventBooking\Api;

use Vendor\EventBooking\Api\Data\EventInterface;

interface EventRepositoryInterface
{
    public function save(EventInterface $event): EventInterface;
    public function getById(int $id): ?EventInterface;
    public function delete(int $id): bool;
    public function getList(): array;
}

