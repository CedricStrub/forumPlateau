<?php

namespace Controller;

use App\Session;
use App\AbstractController;
use App\ControllerInterface;
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
                "role" => 'membre'
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
        var_dump($_POST);
        if ($pseudo && $password) {
            $managerMembre = new MembreManager();

            if ($managerMembre->findOneByEmail($pseudo) != NULL || $managerMembre->findOneByPseudo($pseudo) != NULL) {

                $Session = new Session();

                $user = [
                    "pseudo" => $pseudo
                ];
                //$Session->setUser($user);
                $this->redirectTo("home");

            } else {
                echo ("Identifiant incorrect !");
            }
            $this->redirectTo("home");
        }
        $this->redirectTo("home");
    }


}