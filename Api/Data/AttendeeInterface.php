<?php
namespace Vendor\EventBooking\Api\Data;

interface AttendeeInterface
{
    public function getId(): ?int;
    public function setId(int $id): self;

    public function getName(): string;
    public function setName(string $name): self;

    public function getEmail(): string;
    public function setEmail(string $email): self;

    public function getPhone(): string;
    public function setPhone(string $phone): self;
}
