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

    public function getID() {return $this->id ;}
    public function getName() {return $this->name ;}
    public function getEmail() {return $this->email ;}
    public function getmemberType() {return $this->memberType ;}
    public function getmembershipExpiry() {return $this->membershipExpiry ;}

    abstract public function LoanDuration();
    abstract public function getMaxBorrowLimit();
    abstract public function getDailyLateFee();
}