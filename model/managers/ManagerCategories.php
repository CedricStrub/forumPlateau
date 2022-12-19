<?php
    namespace Model\Managers;
    
    use App\Manager;
    use App\DAO;
    use Model\Managers\ManagerCategories;

    class ManagerCategories extends Manager{

        protected $className = "Model\Entities\Categorie";
        protected $tableName = "categories";


        public function __construct(){
            parent::connect();
        }

    }