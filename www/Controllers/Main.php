<?php
namespace App\Controllers;

use App\Core\View;

class Main
{

    public function home(): void
    {
            
        $pseudo = "killian";
        $view = new View("Main/home.php", "front.php");
        $view->addProp("pseudo",$pseudo);


        // afficahnt bonjour, $pseudo.
    }


}