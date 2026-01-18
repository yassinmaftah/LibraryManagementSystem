<?php

namespace App\Models;

class Author {
    public int $id;
    public string $name;
    public ?string $biography;
    public ?string $nationality;

    public function __construct($id, $name, $biography = null, $nationality = null) {
        $this->id = $id;
        $this->name = $name;
        $this->biography = $biography;
        $this->nationality = $nationality;
    }
}