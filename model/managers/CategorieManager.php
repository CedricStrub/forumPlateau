<?php
namespace Model\Managers;

use App\Manager;
use App\DAO;
use Model\Managers\CategorieManager;

class CategorieManager extends Manager{

    protected $className = "Model\Entities\Categorie";
    protected $tableName = "categorie";


    public function __construct(){
        parent::connect();
    }

    public function editer($txt,$id){
        var_dump($txt);
        var_dump($id);
        $sql = "UPDATE categorie
            SET nom = :txt
            WHERE id_categorie = :id";
        DAO::update($sql,["id" => $id,"txt" => $txt]);
    }

}