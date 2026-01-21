<?php

namespace App\Models;

class Author {
    private int $id;
    private string $name;
    private ?string $biography;
    private ?string $nationality;

    public function __construct($id, $name, $biography = null, $nationality = null) {
        $this->id = $id;
        $this->name = $name;
        $this->biography = $biography;
        $this->nationality = $nationality;
    }

    public function getId() { return $this->id; }
    public function setId(int $id) { $this->id = $id; }

    public function getName() { return $this->name; }
    public function setName(string $name) { $this->name = $name; }

    public function getBiography() { return $this->biography; }
    public function setBiography(?string $biography) { $this->biography = $biography; }

    public function getNationality() { return $this->nationality; }
    public function setNationality(?string $nationality) { $this->nationality = $nationality; }
}