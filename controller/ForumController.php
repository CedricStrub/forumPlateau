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

        public function listMessages(){

            $managerMessages = new MessageManager();

            return[
                "view" => VIEW_DIR."forum/listMessages.php",
                "data" => [
                    "messages" => $managerMessages->findAll(["texte", "ASC"])
                ]
            ];

        }

        

    }
