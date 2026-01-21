<?php

namespace App\Models;

abstract class Member {
    private int $id;
    private string $name;
    private string $email;
    private string $memberType;
    private string $membershipExpiry;

    public function __construct($id, $name, $email, $memberType, $membershipExpiry) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->memberType = $memberType;
        $this->membershipExpiry = $membershipExpiry;
    }

    public function getId() { return $this->id; }
    public function setId(int $id) { $this->id = $id; }

    public function getName() { return $this->name; }
    public function setName(string $name) { $this->name = $name; }

    public function getEmail() { return $this->email; }
    public function setEmail(string $email) { $this->email = $email; }

    public function getMemberType() { return $this->memberType; }
    public function setMemberType(string $memberType) { $this->memberType = $memberType; }

    public function getMembershipExpiry() { return $this->membershipExpiry; }
    public function setMembershipExpiry(string $membershipExpiry) { $this->membershipExpiry = $membershipExpiry; }

    abstract public function LoanDuration();
    abstract public function getMaxBorrowLimit();
    abstract public function getDailyLateFee();
}