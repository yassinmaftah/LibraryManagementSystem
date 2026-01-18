<?php

namespace App\Models;

abstract class Member {
    public int $id;
    public string $name;
    public string $email;
    public string $memberType;
    public string $membershipExpiry;
    public function __construct($id, $name, $email, $memberType, $membershipExpiry) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->memberType = $memberType;
        $this->membershipExpiry = $membershipExpiry;
    }
    abstract public function getLoanDurationDays();
    abstract public function getMaxBorrowLimit();
    abstract public function getDailyLateFee();
}