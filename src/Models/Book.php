<?php

namespace App\Models;

class Book {
    public string $isbn;
    public string $title;
    public string $category;
    public int $publicationYear;
    public int $totalCopies;

    public function __construct($isbn, $title, $category, $publicationYear, $totalCopies = 0) {
        $this->isbn = $isbn;
        $this->title = $title;
        $this->category = $category;
        $this->publicationYear = $publicationYear;
        $this->totalCopies = $totalCopies;
    }
}