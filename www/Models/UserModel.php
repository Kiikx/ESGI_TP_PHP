<?php

namespace App\Models;
use PDO;

class UserModel{

    private int $id;
    private string $firstname;
    private string $lastname;
    private string $email;
    private string $pwd;
    private string $country;

    private PDO $db;


    public function __construct(PDO $db) 
    {
        $this->db = $db;
    }
    /**
     * @return Id
     */
    public function getid(): int
    {
        return $this->id;
    }

    /**
     * @param String $id
     */
    public function setId(string $id): void
    {
        $this->id = $id;
    }

    /**
     * @return String
     */
    public function getFirstname(): string
    {
        return $this->firstname;
    }

    /**
     * @param String $firstname
     */
    public function setFirstname(string $firstname): void
    {
        $this->firstname = ucwords(strtolower(trim($firstname)));
    }

    /**
     * @return String
     */
    public function getLastname(): string
    {
        return $this->lastname;
    }

    /**
     * @param String $lastname
     */
    public function setLastname(string $lastname): void
    {
        $this->lastname = strtoupper(trim($lastname));
    }

    /**
     * @return String
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param String $email
     */
    public function setEmail(string $email): void
    {
        $this->email = strtolower(trim($email));
    }

    /**
     * @return String
     */
    public function getPwd(): string
    {
        return $this->pwd;
    }

    /**
     * @param String $pwd
     */
    public function setPwd(string $pwd): void
    {
        $this->pwd = password_hash($pwd, PASSWORD_DEFAULT);
    }

        /**
     * @return String
     */
    public function getCountry(): string
    {
        return $this->country;
    }

    /**
     * @param String $country
     */
    public function setCountry(string $country): void
    {
        $this->pwd = $country;
    }



    public function addUser($data) {
        $sql = "INSERT INTO users (email, password, firstname, lastname, country) VALUES (:email, :password, :firstname, :lastname, :country)";
        $request = $this->db->prepare($sql);
        $request->bindParam(':email', $data["email"]);

        $hashPwd = password_hash($data["password"], PASSWORD_BCRYPT);
        $request->bindParam(':password', $hashPwd);

        $request->bindParam(':firstname', $data["firstname"]);
        $request->bindParam(':lastname', $data["lastname"]);
        $request->bindParam(':country', $data["country"]);

        return $request->execute(); // Retourne true si l'insertion réussit
    }











}
