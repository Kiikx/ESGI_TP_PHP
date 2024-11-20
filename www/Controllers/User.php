<?php
namespace App\Controllers;

use App\Core\User as U;
use App\Models\UserModel;
use App\Core\View;
use App\Core\SQL;

class User
{

    // public function register(): void
    // {

    //     $sql = new SQL();
    //     $user = new UserModel($sql->GetPdo());
    //     var_dump($_POST);

    //     // if($user->addUser("killiangoncalves@hotmail.com","89451948651dazbnNfzkle","killian","Goncalves","FR")){
    //     //     echo "User add succesfully";
    //     // };
    //     $view = new View("User/register.php", "back.php");
    //     //echo $view;
    // }


    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'email' => $_POST["email"],
                'password' => $_POST["pwd"] ,
                'firstname' => $_POST["firstname"],
                'lastname' => $_POST["lastname"],
                'country' => $_POST["country"],
            ];

            $sql = new SQL();
            $user = new UserModel($sql->GetPdo());

            if ($user->addUser($data)) {
                // header('Location: /success');
                echo "enregistrement réussi";
                exit;
            } else {
                echo "Error: Unable to register.";
                $view = new View("User/register.php", "back.php");
            }
        } else {
            $view = new View("User/register.php", "back.php");
        }
    }

    public function login(): void
    {
        echo "Se connecter";
    }


    public function logout(): void
    {
        $user = new U();
        $user->logout();
        echo "Déconnexion";
    }

}