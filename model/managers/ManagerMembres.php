<?php
    namespace Model\Managers;
    
    use App\Manager;
    use App\DAO;
    use Model\Managers\ManagerMembres;

    class ManagerMembres extends Manager{

        protected $className = "Model\Entities\Membre";
        protected $tableName = "membres";


        public function __construct(){
            parent::connect();
        }

    }