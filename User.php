<?php

class User implements JsonSerializable {

    private $id;

    private $username;

    private $name;

    private $age;

    private $password;

    public function setUsername(string $username) {
      $this->username = $username;
    }

    public function getUsername(): string {
      return $this->username;
    }

    public function setName(string $name) {
      $this->name = $name;
    }

    public function getName(): string {
      return $this->name;
    }

    public function jsonSerialize(): array {
        return [
          'username'   => $this->getUsername(),
          'name' => $this->getName(),
        ];
    }

    public function mergeWithAnother(User $user): User {
      return null;
    }

    public static function createFromArray(array $data): User {

      if (!$data) {
        return null;
      }

      $user = new User();

      $user->setUsername($data['username']);
      $user->setName($data['name']);
      // setters

      return $user;
    }

}
