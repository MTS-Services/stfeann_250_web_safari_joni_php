<?php

class User {
    public $name;

    public function __construct($name) {
        $this->name = $name;
    }

    public function greet() {
        return "Hello, {$this->name}";
    }
}
