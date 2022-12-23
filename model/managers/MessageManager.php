<?php
namespace Model\Managers;

use App\Manager;
use App\DAO;
use Model\Managers\MessageManager;

class MessageManager extends Manager{

    protected $className = "Model\Entities\Message";
    protected $tableName = "message";

    public function __construct(){
        parent::connect();
    }

    public function findMsgByPost($id){
        $sql = "SELECT *
            FROM " . $this->tableName . " a
            WHERE a.sujet_id = :id" ;

        return $this->getMultipleResults(
            DAO::select($sql, ['id' => $id]),
            $this->className
        );
    }

    public function findMsgByUser($id){
        $sql = "SELECT *
            FROM " . $this->tableName . " a
            WHERE a.membre_id = :id" ;

        return $this->getMultipleResults(
            DAO::select($sql, ['id' => $id]),
            $this->className
        );
    }

}