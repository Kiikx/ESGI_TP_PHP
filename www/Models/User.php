<?php

namespace App\Models;

use PDO;

class User
{

    private int $id;
    private string $firstname;
    private string $lastname;
    private string $email;
    private string $pwd;
    private string $country;
    private string $bio;

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

    /**
    * @return String
    */
   public function getBio(): string
   {
       return $this->bio;
   }

   /**
    * @param String $bio
    */
   public function setBio(string $bio): void
   {
       $this->bio = ucwords(strtolower(trim($bio)));
   }



    public function addUser()
    {
        $sql = "INSERT INTO users (email, password, firstname, lastname, country, bio) VALUES (:email, :password, :firstname, :lastname, :country, :bio)";
        $request = $this->db->prepare($sql);
        $request->bindParam(':email', $this->email);

        $request->bindParam(':password', $this->pwd);

        $request->bindParam(':firstname', $this->firstname);
        $request->bindParam(':lastname', $this->lastname);
        $request->bindParam(':country', $this->country);
        $request->bindParam(':bio', $this->bio);

        return $request->execute();
    }

    public function emailExists($email)
    {
        $sql = "SELECT COUNT(*) FROM users WHERE email = :email";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':email' => $email]);
        return $stmt->fetchColumn() > 0;
    }

    public function getUserByEmail(string $email): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute([':email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public function getPwdByEmail(string $email): ?string
    {
        $stmt = $this->db->prepare("SELECT password FROM users WHERE email = :email");
        $stmt->execute([':email' => $email]);
        return $stmt->fetchColumn() ?: null;
    }

    public function deleteUserByEmail(string $email): bool
    {
        $sql = "DELETE FROM users WHERE email = :email";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    
        return $stmt->execute();
    }
    

}
