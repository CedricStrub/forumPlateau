<?php
    namespace Model\Managers;
    
    use App\Manager;
    use App\DAO;
    use Model\Managers\MessageManager;

    class MessageManager extends Manager{

        protected $className = "Model\Entities\Message";
        protected $tableName = "messages";

        public function __construct(){
            parent::connect();
        }

        public function findMsgByPost($id){
            $sql = "SELECT m.texte
                FROM " . $this->tableName . "a
                WHERE a.id_sujet = :id" ;

            return $this->getMultipleResults(
                DAO::select($sql, ['id' => $id]),
                $this->className
            );
        }

    }