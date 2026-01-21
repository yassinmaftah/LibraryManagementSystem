<?php

namespace App\Models;

class BorrowRecord {
    private int $id;
    private int $memberId;
    private int $copyId;
    private string $borrowDate;
    private string $dueDate;
    private ?string $returnDate;
    private float $fineAmount;

    public function __construct($id, $memberId, $copyId, $borrowDate, $dueDate, $returnDate = null, $fineAmount = 0.0) {
        $this->id = $id;
        $this->memberId = $memberId;
        $this->copyId = $copyId;
        $this->borrowDate = $borrowDate;
        $this->dueDate = $dueDate;
        $this->returnDate = $returnDate;
        $this->fineAmount = $fineAmount;
    }

    public function getId() { return $this->id; }
    public function setId(int $id) { $this->id = $id; }

    public function getMemberId() { return $this->memberId; }
    public function setMemberId(int $memberId) { $this->memberId = $memberId; }

    public function getCopyId() { return $this->copyId; }
    public function setCopyId(int $copyId) { $this->copyId = $copyId; }

    public function getBorrowDate() { return $this->borrowDate; }
    public function setBorrowDate(string $borrowDate) { $this->borrowDate = $borrowDate; }

    public function getDueDate() { return $this->dueDate; }
    public function setDueDate(string $dueDate) { $this->dueDate = $dueDate; }

    public function getReturnDate() { return $this->returnDate; }
    public function setReturnDate(?string $returnDate) { $this->returnDate = $returnDate; }

    public function getFineAmount() { return $this->fineAmount; }
    public function setFineAmount(float $fineAmount) { $this->fineAmount = $fineAmount; }

    public function isOverdue() 
    {
        if ($this->returnDate) { return false; }
        $today = date('Y-m-d H:i:s');
        if ($today > $this->dueDate)
            return true;
        else
            return false;
    }
}