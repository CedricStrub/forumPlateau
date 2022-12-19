<?php
    namespace Model\Managers;
    
    use App\Manager;
    use App\DAO;
    use Model\Managers\ManagerSujets;

    class ManagerSujets extends Manager{

        protected $className = "Model\Entities\Sujet";
        protected $tableName = "sujets";


        public function __construct(){
            parent::connect();
        }

    }