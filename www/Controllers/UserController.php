<?php
namespace App\Controllers;

use App\Core\User as U;
use App\Models\User;
use App\Models\UserValidator;
use App\Core\View;
use App\Core\SQL;

class UserController
{


    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $sql = new SQL();
            $user = new User($sql->GetPdo());

            $user->setFirstname($_POST["firstname"]);
            $user->setLastname($_POST["lastname"]);
            $user->setEmail($_POST["email"]);
            $user->setCountry($_POST["country"]);
            $user->setPwd($_POST["pwd"]);

            $validator = new UserValidator($user, $_POST["pwdconf"]);

            $errors = $validator->getErrors();
            if(empty($errors)){
                echo "Insertion en BDD";
                $user->addUser();
                header('Location: /se-connecter');
                echo "enregistrement réussi";
            }else {
                    $view = new View("User/register.php", "back.php");
                    $view->addData("errors", $errors);

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