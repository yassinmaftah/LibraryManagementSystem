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

    public function returnBook($memberId, $isbn) {
        try {
            $this->db->beginTransaction();

            $sql = "SELECT br.record_id, br.due_date, br.copy_id 
                    FROM borrow_records br
                    JOIN book_copies bc ON br.copy_id = bc.copy_id
                    WHERE br.member_id = ?
                    AND bc.isbn = ? AND br.return_date IS NULL LIMIT 1";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$memberId,$isbn]);
            $record = $stmt->fetch();

            if (!$record)
                throw new Exception("we don't find any activeties.");

            $fine = 0;
            $today = date('Y-m-d H:i:s');
            $dueDate = $record['due_date'];
            if ($today > $dueDate) {
                $member = $this->memberRepo->findById($memberId);
                $dailyFee = $member->getDailyLateFee();
                $diff = strtotime($today) - strtotime($dueDate);
                $daysLate = ceil($diff / (60 * 60 * 24));
                $fine = $daysLate * $dailyFee;
            }

            $updateRecord = $this->db->prepare("UPDATE borrow_records 
                SET return_date = ?, fine_amount = ? WHERE record_id = ? ");
            $updateRecord->execute([$today,$fine,$record['record_id']]);

            $updateCopy = $this->db->prepare("UPDATE book_copies 
                SET status = 'available' WHERE copy_id = ?");
            $updateCopy->execute([$record['copy_id']]);
            $this->db->commit();
            return "Book returned successfully";

        } catch (Exception $e) {
            $this->db->rollBack();
            return "Error: " . $e->getMessage();
        }
    }
}