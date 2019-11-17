<?php

class User {

    private $name;

    public function __construct(string $name) {
       $this->name = $name;
    }

    public function greet(): string {
      return 'Hi, my name is ' . $this->name;
    }

    public static function f() {
        return "asdf";
    }

}