<?php

namespace App\Models;

class Book {
    private string $isbn;
    private string $title;
    private string $category;
    private int $publicationYear;
    private int $totalCopies;

    public function __construct($isbn, $title, $category, $publicationYear, $totalCopies = 0) {
        $this->isbn = $isbn;
        $this->title = $title;
        $this->category = $category;
        $this->publicationYear = $publicationYear;
        $this->totalCopies = $totalCopies;
    }

    public function getIsbn() { return $this->isbn; }
    public function setIsbn(string $isbn) { $this->isbn = $isbn; }

    public function getTitle() { return $this->title; }
    public function setTitle(string $title) { $this->title = $title; }

    public function getCategory() { return $this->category; }
    public function setCategory(string $category) { $this->category = $category; }

    public function getPublicationYear() { return $this->publicationYear; }
    public function setPublicationYear(int $publicationYear) { $this->publicationYear = $publicationYear; }

    public function getTotalCopies() { return $this->totalCopies; }
    public function setTotalCopies(int $totalCopies) { $this->totalCopies = $totalCopies; }
}