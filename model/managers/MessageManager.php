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
            var_dump($this->tableName);
            
            $sql = "SELECT m.texte
                FROM sujets a
                INNER JOIN messages m ON a.id_sujets = m.id_sujets
                WHERE a.id_sujets = :id" ;

            return $this->getMultipleResults(
                DAO::select($sql, ['id' => $id]),
                $this->className
            );
        }

    }