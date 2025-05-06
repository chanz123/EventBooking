<?php
namespace Vendor\EventBooking\Api\Data;

interface EventInterface
{
    public function getId(): ?int;
    public function setId(int $id): self;

    public function getTitle(): string;
    public function setTitle(string $title): self;

    public function getDate(): string;
    public function setDate(string $date): self;

    public function getLocation(): string;
    public function setLocation(string $location): self;

    public function getCapacity(): int;
    public function setCapacity(int $capacity): self;
}
