<?php
    namespace Model\Managers;
    
    use App\Manager;
    use App\DAO;
    use Model\Managers\SujetManager;

    class SujetManager extends Manager{

        protected $className = "Model\Entities\Sujet";
        protected $tableName = "sujets";


        public function __construct(){
            parent::connect();
        }

        public function findPostByTopic($id){
            $sql = "SELECT *
                FROM " . $this->tableName . "a
                WHERE a.id_sujet = :id" ;

            return $this->getMultipleResults(
                DAO::select($sql, ['id' => $id]),
                $this->className
            );
        }

    }