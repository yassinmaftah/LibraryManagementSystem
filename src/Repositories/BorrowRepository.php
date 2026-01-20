<?php

namespace App\Repositories;

use PDO;

class BorrowRepository {
    private $db;

    public function __construct() {$this->db = Database::getInstance();}

    public function getActiveBorrowsCount($memberId) 
    {
        $sql = "SELECT COUNT(*) as total FROM borrow_records WHERE member_id = ? AND return_date IS NULL";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$memberId]);
        $result = $stmt->fetch();
        return $result['total'];
    }

    public function createBorrowRecord($memberId, $copyId, $dueDate) {
        $sql = "INSERT INTO borrow_records (member_id, copy_id, due_date) 
                VALUES (?,?,?)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$memberId,$copyId,$dueDate]);
    }
}