<?php
namespace App\Controllers;

use App\Core\View;

class MainController
{

    public function home(): void
    {
            
        $pseudo = "killian";
        $view = new View("Main/home.php", "front.php");
        $view->addData("pseudo",$pseudo);


        // afficahnt bonjour, $pseudo.
    }


}