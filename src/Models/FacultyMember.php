<?php

namespace App\Models;

class FacultyMember extends Member 
{
    public function getLoanDurationDays() {return 30;}
    public function getMaxBorrowLimit() {return 10;}
    public function getDailyLateFee() {return 0.25;}
}