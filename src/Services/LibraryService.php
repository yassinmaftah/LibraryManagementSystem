<?php

namespace App\Services;

use App\Repositories\Database;
use App\Repositories\MemberRepository;
use App\Repositories\BorrowRepository;
use Exception;

class LibraryService {
    private $db;
    private $memberRepo;
    private $borrowRepo;

    public function __construct() {
        $this->db = Database::getInstance();
        $this->memberRepo = new MemberRepository();
        $this->borrowRepo = new BorrowRepository();
    }

    public function borrowBook($memberId, $isbn, $branchId) {
        try {
            $this->db->beginTransaction();

            $memberRepo = $this->memberRepo;
            $member = $memberRepo->findById($memberId);

            if (!$member) {throw new Exception("Member not found");}

            $numberofborrow = $this->borrowRepo->getActiveBorrowsCount($memberId);
            if ($numberofborrow >= $member->getMaxBorrowLimit())
                throw new Exception("Sorry , You can't borrow more books");

            $stmt = $this->db->prepare("SELECT copy_id FROM book_copies WHERE isbn = ? AND branch_id = ?AND status = 'available' LIMIT 1");
            $stmt->execute([$isbn, $branchId]);
            $copyBook = $stmt->fetch();
            if (!$copyBook) 
                {throw new Exception("we don't hove more copies of this book in this branch.");}
            $copyId = $copyBook['copy_id'];
            $days = $member->LoanDuration();
            $dueDate = date('Y-m-d H:i:s', strtotime("+$days days"));

            $this->borrowRepo->createBorrowRecord($memberId, $copyId, $dueDate);

            $updateStmt = $this->db->prepare("UPDATE book_copies SET status = 'checked_out' WHERE copy_id = :id");
            $updateStmt->execute(['id' => $copyId]);

            $this->db->commit();
            return "Success! Book borrowed. Due date: " . $dueDate;
        }
        catch (Exception $e) 
        {
            $this->db->rollBack();
            return "Error: " . $e->getMessage();
        }
    }
}