<?php

namespace App\Models;
use PDO;

class User{

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
        $this->country = strtoupper(trim($country));;
    }



    public function addUser() {
        $sql = "INSERT INTO users (email, password, firstname, lastname, country) VALUES (:email, :password, :firstname, :lastname, :country)";
        $request = $this->db->prepare($sql);
        $request->bindParam(':email', $this->email);

        $request->bindParam(':password', $this->pwd);

        $request->bindParam(':firstname', $this->firstname);
        $request->bindParam(':lastname',$this->lastname);
        $request->bindParam(':country', $this->country);

        return $request->execute(); 
    }
    
    public function emailExists($email) {
        $sql = "SELECT COUNT(*) FROM users WHERE email = :email";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':email' => $email]);
        return $stmt->fetchColumn() > 0;
    }











}
