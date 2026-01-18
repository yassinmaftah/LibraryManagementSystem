<?php

namespace App\Repositories;

use App\Models\StudentMember;
use App\Models\FacultyMember;
use PDO;

class MemberRepository {
    private $db;

    public function __construct() {$this->db = Database::getInstance();}

    public function findById($id) {
        $database = $this->db;
        $stmt = $database->prepare("SELECT * FROM members WHERE member_id = ?");
        $stmt->execute([$id]);
        $member = $stmt->fetch();
        if (!$member) {return null;}
        if ($member['member_type'] === 'student') 
            return new StudentMember($member['member_id'],$member['name'], $member['email'], $member['member_type'], $member['membership_expiry']); 
        else
            return new FacultyMember($member['member_id'], $member['name'], $member['email'], $member['member_type'],$member['membership_expiry']);
    }
}