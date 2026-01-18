<?php

namespace App\Repositories;

use App\Models\Book;
use PDO;

class BookRepository {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function findByIsbn($isbn) 
    {
        $Database = $this->db;
        $stmt = $Database->prepare("SELECT * FROM books WHERE isbn = ?");
        $stmt->execute([$isbn]);
        $book = $stmt->fetch();

        if (!$book) 
            return null;
        return new Book($book['isbn'],$book['title'],$book['category'],
        $book['publication_year'],$book['total_copies']);
    }
}