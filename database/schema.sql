create database library;
use library;
CREATE TABLE library_branches (
    branch_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    address TEXT NOT NULL,
    phone VARCHAR(20) NOT NULL
);

CREATE TABLE members (
    member_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    phone VARCHAR(20),
    member_type ENUM('student', 'faculty') NOT NULL,
    membership_expiry DATE NOT NULL,
    total_borrowed_history INT DEFAULT 0,
    unpaid_fees DECIMAL(10, 2) DEFAULT 0.00
);

CREATE TABLE books (
    isbn VARCHAR(20) PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    category VARCHAR(100) NOT NULL,
    publication_year INT,
    total_copies INT DEFAULT 0
);

CREATE TABLE authors (
    author_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    biography TEXT,
    nationality VARCHAR(100)
);

CREATE TABLE book_authors (
    isbn VARCHAR(20),
    author_id INT,
    PRIMARY KEY (isbn, author_id),
    FOREIGN KEY (isbn) REFERENCES books(isbn) ON DELETE CASCADE,
    FOREIGN KEY (author_id) REFERENCES authors(author_id) ON DELETE CASCADE
);

CREATE TABLE book_copies (
    copy_id INT AUTO_INCREMENT PRIMARY KEY,
    isbn VARCHAR(20),
    branch_id INT,
    status ENUM('available', 'checked_out', 'reserved', 'maintenance') DEFAULT 'available',
    FOREIGN KEY (isbn) REFERENCES books(isbn),
    FOREIGN KEY (branch_id) REFERENCES library_branches(branch_id)
);

CREATE TABLE borrow_records (
    record_id INT AUTO_INCREMENT PRIMARY KEY,
    member_id INT,
    copy_id INT,
    borrow_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    due_date DATETIME NOT NULL,
    return_date DATETIME NULL,
    fine_amount DECIMAL(10, 2) DEFAULT 0.00,
    is_renewed BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (member_id) REFERENCES members(member_id),
    FOREIGN KEY (copy_id) REFERENCES book_copies(copy_id)
);

CREATE TABLE reservations (
    reservation_id INT AUTO_INCREMENT PRIMARY KEY,
    member_id INT,
    isbn VARCHAR(20),
    reservation_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    status ENUM('pending', 'completed', 'expired') DEFAULT 'pending',
    FOREIGN KEY (member_id) REFERENCES members(member_id),
    FOREIGN KEY (isbn) REFERENCES books(isbn)
);