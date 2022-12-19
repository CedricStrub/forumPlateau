<?php
    namespace Model\Entities;

    use App\Entity;

    final class Message extends Entity{

        private $id;
        private $texte;
        private $dateCreation;

        public function __construct($data){         
            $this->hydrate($data);        
        }

        public function getId()
        {
            return $this->id;
        }

        public function setId($id)
        {
            $this->id = $id;

            return $this;
        }

        public function getTexte()
        {
            return $this->texte;
        }

        public function setTexte($texte)
        {
            $this->texte = $texte;

            return $this;
        }

        public function getDateCreation(){
            $dateFormater = $this->dateCreation->format("d/m/Y, H:i:s");
            return $dateFormater;
        }

        public function setDateCreation($date){
            $this->dateCreation = new \DateTime($date);

            return $this;
        }



    }