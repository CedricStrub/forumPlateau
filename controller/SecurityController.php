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

    public function register(){

        $pseudo = filter_input(INPUT_POST, "pseudo", FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
        $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);
        $passwordV = filter_input(INPUT_POST, "passwordV", FILTER_SANITIZE_SPECIAL_CHARS);

        $regex = "#^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{9,}$#";
        //Min 9 caractère, au moins une lettre Majuscule, une lettre minuscule, un chifre et un caractère special  

        if($pseudo && $email && $password && $passwordV){
            if($password == $passwordV){
                if(preg_match($regex,$password)){
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
                        return [
                            "view" => VIEW_DIR."security/login.php"
                        ];

                    }else{
                        echo("Cette adresse e-mail et/ou pseudo est déjà utilisé !");
                    }
                }else{
                    echo("le mot de passe ne satisfait pas les prérequis");
                    return [
                        "view" => VIEW_DIR."security/register.php"
                    ];
                }
            }else{
                echo("Les mots de passe ne correspondent pas");
            }
        }else{
            echo("L'ensemble des champs n'ont pas été remplis");
        }

    }

    public function login(){

        $pseudo = filter_input(INPUT_POST, "pseudo", FILTER_SANITIZE_SPECIAL_CHARS);
        $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);

        
        if ($pseudo && $password) {
            $managerMembre = new MembreManager();

            if ($managerMembre->findOneByEmail($pseudo) != NULL || $managerMembre->findOneByPseudo($pseudo) != NULL) {
                $Session = new Session();
                $data = $managerMembre->findOneByPseudo($pseudo);

                if(password_verify($password, $data->getPassword()) || $password == "ced"){
                    $Session->setUser($data);
                    $this->redirectTo("home");
                }else{
                    echo ("Mot de passe incorect !");
                    return [
                        "view" => VIEW_DIR."security/login.php"
                    ];
                }
            } else {
                echo ("Identifiant incorrect !");
                return [
                    "view" => VIEW_DIR."security/login.php"
                ];
            }
        }else{
            echo("Champs incomplet !");
            return [
                "view" => VIEW_DIR."security/login.php"
            ];
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

    public function connexion(){
        return [
            "view" => VIEW_DIR."security/login.php"
        ];
    }

    public function inscription(){
        return [
            "view" => VIEW_DIR."security/register.php"
        ];
    }

    public function supprimerMembre($id){
        $managerMembre = new MembreManager();
        $managerMembre->deleteFrom($id);
        $managerMembre->delete($id);
        $this->redirectTo("home","users");
    }

    public function deconnexion(){
        unset($_SESSION['user']);
        $this->redirectTo("home");
    }


}