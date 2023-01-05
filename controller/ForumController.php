<?php

namespace Controller;

use App\Session;
use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\SujetManager;
use Model\Managers\CategorieManager;
use Model\Managers\MessageManager;
use Model\Managers\MembreManager;

class ForumController extends AbstractController implements ControllerInterface{

    public function listSujets($id){


        $managerSujet = new SujetManager();
        $managerCategorie = new CategorieManager();

        return [
            "view" => VIEW_DIR."forum/listSujets.php",
            "data" => [
                "categorie" => $managerCategorie->findOneById($id),
                "sujets" => $managerSujet->findPostByTopic($id)
            ]
        ];
    
    }

    public function listCategories(){

        $managerCategorie = new CategorieManager();

        return[
            "view" => VIEW_DIR."forum/listCategories.php",
            "data" => [
                "categories" => $managerCategorie->findAll(["nom", "ASC"])
            ]
        ];

    }

    public function listMessages($id){

        $managerMessages = new MessageManager();
        $managerSujet = new SujetManager();

        return[
            "view" => VIEW_DIR."forum/listMessages.php",
            "data" => [

                "sujet" => $managerSujet->findOneById($id),
                "messages" => $managerMessages->findMsgByPost($id)
            ]
        ];

    }

    public function addSujet(){
        $titre = filter_input(INPUT_POST, "titre", FILTER_SANITIZE_SPECIAL_CHARS);
        $message = filter_input(INPUT_POST, "message", FILTER_SANITIZE_SPECIAL_CHARS);
        $categorie = filter_input(INPUT_POST, "categorie", FILTER_SANITIZE_NUMBER_INT);

        if ($titre && $message) {
            $managerMessages = new MessageManager();
            $managerSujet = new SujetManager();

            $userId = $_SESSION["user"]->getId();
            $data = [
                "titre" => $titre,
                "membre_id" => $userId,
                "categorie_id" => $categorie,
                "verrouillage" => 0
            ];

            $sujet = $managerSujet->add($data);

            $data = [
                "texte" => $message,
                "membre_id" => $userId,
                "sujet_id" => $sujet
            ];

            $managerMessages->add($data);
            $this->redirectTo("forum", "listMessages", $sujet);
        }else{
            echo "titre ou message vide";
            $this->redirectTo("forum", "listSujets", $categorie);
        }

    } 

    public function addMessage(){
        $message = filter_input(INPUT_POST, "message", FILTER_SANITIZE_SPECIAL_CHARS);
        $sujet = filter_input(INPUT_POST, "sujet", FILTER_SANITIZE_NUMBER_INT);

        if ($message) {
            $managerMessages = new MessageManager();
            $userId = $_SESSION["user"]->getId();

            $data = [
                "texte" => $message,
                "membre_id" => $userId,
                "sujet_id" => $sujet
            ];

            $managerMessages->add($data);
            
            $this->redirectTo("forum", "listMessages", $sujet);
        }else{
            echo "titre ou message vide";
            $this->redirectTo("forum", "listMessages", $sujet);
        }
    }

    public function verrouiller($id){
        $managerSujet = new SujetManager();
        $managerSujet->lock($id);
        $this->redirectTo("forum", "listMessages", $id);
    }

    public function deverrouiller($id){
        $managerSujet = new SujetManager();
        $managerSujet->unlock($id);
        $this->redirectTo("forum", "listMessages", $id);
    }

    public function supprimerSujet($id){
        $managerSujet = new SujetManager();
        $managerSujet->deleteFrom($id);
        $managerSujet->delete($id);
        $this->redirectTo("home");
    }

    public function supprimerMessage($id){
        $managerMessage = new MessageManager();
        $sujet = $managerMessage->findOneById($id)->getSujet()->getId();
        $managerMessage->delete($id);
        $this->redirectTo("forum", "listMessages", $sujet);
    }

    public function addCategorie(){
        $nom = filter_input(INPUT_POST, "nom", FILTER_SANITIZE_SPECIAL_CHARS);
    
        if($nom){
            $managerCategorie = new CategorieManager();
            $data = [
                "nom" => $nom
            ];
            $managerCategorie->add($data);
        }
        $this->redirectTo("forum", "listCategories");
    }

    public function supprimerCategorie($id){
        $managerCategorie = new CategorieManager();
        $managerCategorie->delete($id);
        $this->redirectTo("forum", "listCategories");
    }

}
