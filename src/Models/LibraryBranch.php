<?php

namespace App\Models;

class LibraryBranch {
    public int $id;
    public string $name;
    public string $address;
    public string $phone;

    public function __construct($id, $name, $address, $phone) {
        $this->id = $id;
        $this->name = $name;
        $this->address = $address;
        $this->phone = $phone;
    }
}