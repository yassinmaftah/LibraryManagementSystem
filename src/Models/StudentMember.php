<?php

namespace App\Models;

class StudentMember extends Member 
{
    public function LoanDuration() {return 14; }
    public function getMaxBorrowLimit() {return 3;}
    public function getDailyLateFee() {return 0.50;}
}