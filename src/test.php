<?php
require_once __DIR__ . '/../vendor/autoload.php';
use App\Repositories\Database;
use App\Repositories\MemberRepository;
use App\Repositories\BookRepository;
use App\Services\LibraryService;

use App\Models\Member;
use App\Models\Book;

echo "<br>----------------------<br>";
echo "Test database : <br>";
$db = Database::getInstance();
var_dump($db);
$newdb = Database::getInstance();

if ($db === $newdb) 
    echo "<br>The same Database<br>";

echo "<br>----------------------<br>";
echo "test find Member by id<br>";

$MemberRepo = new MemberRepository();
$member = $MemberRepo->findById(2);
if ($member)
{
    echo "id : " .  $member->getID() . "<br>";
    echo "name :" .  $member->getName() . "<br>";
    echo "email : " .  $member->getEmail() . "<br>";
    echo "member Type :" .  $member->getmemberType() . "<br>";
    echo "member ship Expiry :" .  $member->getmembershipExpiry() . "<br>";
    echo "Loan Duration Days :" .  $member->LoanDuration() . "<br>";
echo "Max Borrow Limit:" .  $member->getMaxBorrowLimit() . "<br>";
echo "Daily Late Fee:" .  $member->getDailyLateFee() . "<br>";
}
else
    echo "We don't have Member with this id<br>";


echo "<br>----------------------<br>";
echo "test find Book By Isbn<br>";

$RepoBook = new BookRepository();
$book = $RepoBook->findByIsbn("B2");
if ($book)
{
   echo "isbn :" . $book->isbn . "<br>";
   echo "title :" . $book->title . "<br>";
   echo "category :" . $book->category . "<br>";
   echo "publication Year :" . $book->publicationYear . "<br>";
   echo "totalCopies :" . $book->totalCopies . "<br>";
}
else
    echo "We fon't hove Book with this Isbn<br>";

echo "<br>----------------------<br>";
echo "Test: Borrowing Logic";

$service = new LibraryService();
$branchId = 1;


echo "<br>Ahmed Student<br>";
echo "Result: " . $service->borrowBook(1, 'B1', $branchId) . "<br>";
echo "<br>Sara Student, has 3 books<br>";
echo "Result: " . $service->borrowBook(2, 'B1', $branchId) . "<br>";
echo "Dr. Yassine (Faculty)<br>";
echo "Result: " . $service->borrowBook(3, 'B2', $branchId) . "<br>";
