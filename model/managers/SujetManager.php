<?php
namespace Model\Managers;

use App\Manager;
use App\DAO;
use Model\Managers\SujetManager;

class SujetManager extends Manager{

    protected $className = "Model\Entities\Sujet";
    protected $tableName = "sujet";


    public function __construct(){
        parent::connect();
    }

    public function findPostByTopic($id){
        $sql = "SELECT *
            FROM " . $this->tableName ." a
            WHERE a.categorie_id = :id" ;

        return $this->getMultipleResults(
            DAO::select($sql, ['id' => $id]),
            $this->className
        );
    }

    public function findPostByUser($id){
        $sql = "SELECT *
            FROM " . $this->tableName ." a
            WHERE a.membre_id = :id" ;

        return $this->getMultipleResults(
            DAO::select($sql, ['id' => $id]),
            $this->className
        );
    }

    public function lock($id){
        $sql = "UPDATE sujet
            SET verrouillage = 1
            WHERE id_sujet = :id";
        DAO::update($sql,["id" => $id]);
    }

    public function unlock($id){
        $sql = "UPDATE sujet
            SET verrouillage = 0
            WHERE id_sujet = :id";
        DAO::update($sql,["id" => $id]);
    }

    public function deleteFrom($id){
        $sql = "DELETE FROM message
                WHERE sujet_id = :id
                ";

        return DAO::delete($sql, ['id' => $id]); 
    }

    public function editer($txt,$id){
        var_dump($txt);
        var_dump($id);
        $sql = "UPDATE sujet
            SET titre = :txt
            WHERE id_sujet = :id";
        DAO::update($sql,["id" => $id,"txt" => $txt]);
    }

}