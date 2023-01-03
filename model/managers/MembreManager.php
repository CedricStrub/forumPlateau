<?php
namespace Model\Managers;

use App\Manager;
use App\DAO;
use Model\Managers\MembreManager;

class MembreManager extends Manager{

    protected $className = "Model\Entities\Membre";
    protected $tableName = "membre";


    public function __construct(){
        parent::connect();
    }

    public function findOneByEmail($email){

        $sql = "SELECT *
                FROM " . $this->tableName . " a
                WHERE a.email = :email";

        return $this->getOneOrNullResult(
            DAO::select($sql, ['email' => $email], false),
            $this->className
        );

    }

    public function findOneByPseudo($pseudo){

        $sql = "SELECT *
                FROM " . $this->tableName . " a
                WHERE a.pseudo = :pseudo";

        return $this->getOneOrNullResult(
            DAO::select($sql, ['pseudo' => $pseudo], false),
            $this->className
        );

    }

    

}