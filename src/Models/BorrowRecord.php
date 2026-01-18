<?php

namespace App\Models;

class BorrowRecord {
    public int $id;
    public int $memberId;
    public int $copyId;
    public string $borrowDate;
    public string $dueDate;
    public ?string $returnDate;
    public float $fineAmount;

    public function __construct($id, $memberId, $copyId, $borrowDate, $dueDate, $returnDate = null, $fineAmount = 0.0) {
        $this->id = $id;
        $this->memberId = $memberId;
        $this->copyId = $copyId;
        $this->borrowDate = $borrowDate;
        $this->dueDate = $dueDate;
        $this->returnDate = $returnDate;
        $this->fineAmount = $fineAmount;
    }

    public function isOverdue() 
    {
        if ($this->returnDate) {return false;}
        $today = date('Y-m-d H:i:s');
        return $today > $this->dueDate;
    }
}