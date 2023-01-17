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
        $managerCategorie = new CategorieManager();
        $users = $manager->findAll(['dateInscription', 'DESC']);

        return [
            "view" => VIEW_DIR."forum/listMembres.php",
            "data" => [
                "categories" => $managerCategorie->findAll(["nom", "ASC"]),
                "users" => $users
            ]
        ];
    }

    public function verrouiller($id){
        $managerMembre = new MembreManager();
        var_dump($id);
        $managerMembre->lock($id);
        $this->redirectTo("home", "users", $id);
    }

    public function deverrouiller($id){
        $managerMembre = new MembreManager();
        var_dump($id);
        $managerMembre->unlock($id);
        $this->redirectTo("home", "users", $id);
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
