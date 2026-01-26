<?php

class Student {

public $name;
public $number;

    public function __construct($name, $number) {
        $this->number = $number;
        $this->name = $name;
    }



    public function getName() {return $this->name; }
    public function getNumber() {return $this->number; }
}

