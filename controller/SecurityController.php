<?php

namespace Controller;

use App\Session;
use App\AbstractController;
use App\ControllerInterface;
use Model\Entities\Membre;
use Model\Managers\SujetManager;
use Model\Managers\CategorieManager;
use Model\Managers\MessageManager;
use Model\Managers\MembreManager;

class SecurityController extends AbstractController implements ControllerInterface{

    public function inscription(){

        $pseudo = filter_input(INPUT_POST, "pseudo", FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
        $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);
        $passwordV = filter_input(INPUT_POST, "passwordV", FILTER_SANITIZE_SPECIAL_CHARS);

        if($password == $passwordV){
            $password = password_hash($password, PASSWORD_DEFAULT);
            $user = [
                "id_membre" => 0,
                "pseudo" => $pseudo,
                "email" => $email,
                "password" => $password,
                "role" => 'MEMBRE'
            ];

            $managerMembre = new MembreManager();

            if($managerMembre->findOneByEmail($user['email']) == NULL && $managerMembre->findOneByPseudo($user['pseudo']) == NULL){

                $managerMembre->add($user);
                $this->redirectTo("security", "login");

            }else{
                echo("Cette adresse e-mail et/ou pseudo est déjà utilisé !");
            }

        }else{
            echo("Les mots de passe ne correspondent pas");
        }

    }

    public function connexion(){

        $pseudo = filter_input(INPUT_POST, "pseudo", FILTER_SANITIZE_SPECIAL_CHARS);
        $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);

        if ($pseudo && $password) {
            $managerMembre = new MembreManager();

            if ($managerMembre->findOneByEmail($pseudo) != NULL || $managerMembre->findOneByPseudo($pseudo) != NULL) {

                $Session = new Session();

                $data = $managerMembre->findOneByPseudo($pseudo);

                $Session->setUser($data);
                $this->redirectTo("home");

            } else {
                echo ("Identifiant incorrect !");
            }
        }
    }

    public function profil(){
        $managerSujet = new SujetManager();
        $managerMessage = new MessageManager();
        
        return[
            "view" => VIEW_DIR."security/profil.php",
            "data" => [
                "membre" => $_SESSION['user'],
                "sujet" => $managerSujet->findPostByUser($_SESSION["user"]->getId()),
                "message" => $managerMessage->findMsgByUser($_SESSION["user"]->getId())
            ]
        ];
    }

    public function deconnexion(){
        unset($_SESSION['user']);
        $this->redirectTo("home");
    }


}