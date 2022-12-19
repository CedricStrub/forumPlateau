<?php

    namespace Controller;

    use App\Session;
    use App\AbstractController;
    use App\ControllerInterface;
    use Model\Managers\ManagerSujets;
    use Model\Managers\ManagerCategories;
    use Model\Managers\ManagerMessages;
    use Model\Managers\PostManager;
    
    class ForumController extends AbstractController implements ControllerInterface{

        public function index(){


           $managerSujet = new ManagerSujets();

            return [
                "view" => VIEW_DIR."forum/listSujets.php",
                "data" => [
                    "sujets" => $managerSujet->findAll(["dateCreation", "DESC"])
                ]
            ];
        
        }

        public function listCategories(){

            $managerCategorie = new ManagerCategories();

            return[
                "view" => VIEW_DIR."forum/listCategories.php",
                "data" => [
                    "categories" => $managerCategorie->findAll(["nom", "ASC"])
                ]
            ];

        }

        public function listMessages(){

            $managerMessages = new ManagerMessages();

            return[
                "view" => VIEW_DIR."forum/listMessages.php",
                "data" => [
                    "messages" => $managerMessages->findAll(["texte", "ASC"])
                ]
            ];

        }

        

    }
