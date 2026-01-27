<?php

class Student {

protected $name;
protected $number;

    public function __construct($name, $number) {

        if (empty($number)) {
            throw new Exception("Name cannot be empty");
        }
        
        $this->number = $number;
        $this->name = $name;
    }



    public function getName() {return $this->name; }
    public function getNumber() {return $this->number; }
}

