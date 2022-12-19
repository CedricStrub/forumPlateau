<?php
    namespace Model\Managers;
    
    use App\Manager;
    use App\DAO;
    use Model\Managers\ManagerMessages;

    class ManagerMessages extends Manager{

        protected $className = "Model\Entities\Message";
        protected $tableName = "messages";


        public function __construct(){
            parent::connect();
        }

    }