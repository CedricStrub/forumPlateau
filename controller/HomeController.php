<?php

namespace Controller;

use App\Session;
use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\SujetManager;
use Model\Managers\CategorieManager;
use Model\Managers\MessageManager;
use Model\Managers\MembreManager;

class HomeController extends AbstractController implements ControllerInterface{

    public function index(){
        
        
            return [
                "view" => VIEW_DIR."home.php"
            ];
        }
        
    

    public function users(){
        $this->restrictTo("ADMIN");

        $manager = new MembreManager();
        $users = $manager->findAll(['dateInscription', 'DESC']);


        return [
            "view" => VIEW_DIR."security/users.php",
            "data" => [
                "users" => $users
            ]
        ];
    }

    public function forumRules(){
        
        return [
            "view" => VIEW_DIR."rules.php"
        ];
    }

    /*public function ajax(){
        $nb = $_GET['nb'];
        $nb++;
        include(VIEW_DIR."ajax.php");
    }*/
}
