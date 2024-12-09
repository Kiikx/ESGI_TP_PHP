<?php
namespace App\Controllers;

use App\Core\User as U;
use App\Models\User;
use App\Models\UserValidator;
use App\Models\UserLoginValidator;
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
            $user->setBio($_POST["bio"]);
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


    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $sql = new SQL();
            $user = new User($sql->GetPdo());
    
            $validator = new UserLoginValidator($user, $_POST["email"], $_POST["pwd"]);
            $errors = $validator->getErrors();
    
            if (empty($errors)) {
                session_start();
                $_SESSION['user'] = $user->getUserByEmail($_POST["email"]);
                header("Location: /");
                exit();
            } else {
                $view = new View("User/login.php", "back.php");
                $view->addData("errors", $errors);
            }
        } else {
            $view = new View("User/login.php", "back.php"); 
        }
    }
    

    public function logout()
    {
        session_start();
        session_destroy();
        header("Location: /?status=not_logged_in"); // ptit bonus : ajout d'un paramètre pour afficher un message de déconnexion 
        exit();
    }
    

        public function delete()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            session_start();

            if (isset($_SESSION['user']['email'])) {
                $email = $_SESSION['user']['email'];
                $sql = new SQL(); 
                $user = new User($sql->GetPdo());

                if ($user->deleteUserByEmail($email)) {
                    session_destroy(); 
                    header("Location: / ");
                    exit();
                } else {
                    $errors = ["Erreur lors de la suppression du compte."];
                    $view = new View("User/home.php", "back.php");
                    $view->addData("errors", $errors);
                }
            } else {
                header("Location: /login");
                exit();
            }
        } else {
            $view = new View("User/home.php", "back.php");
        }
    }


}