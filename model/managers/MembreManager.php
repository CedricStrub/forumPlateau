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

    public function lock($id){
        $sql = "UPDATE membre
            SET verrouiller = 1
            WHERE id_membre = :id";
        DAO::update($sql,["id" => $id]);
    }

    public function unlock($id){
        $sql = "UPDATE membre
            SET verrouiller = 0
            WHERE id_membre = :id";
        DAO::update($sql,["id" => $id]);
    }

    public function deleteFrom($id){
        $sql = "DELETE FROM membre
                WHERE id_membre = :id
                ";

        return DAO::delete($sql, ['id' => $id]); 
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