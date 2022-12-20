<?php
    namespace Model\Entities;

    use App\Entity;

    final class Sujet extends Entity{

        private $id;
        private $titre;
        private $membre;
        private $dateCreation;
        private $verrouillage;

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

        public function getTitre()
        {
                return $this->titre;
        }

        public function setTitre($titre)
        {
                $this->titre = $titre;

                return $this;
        }

        public function getMembre()
        {
                return $this->membre;
        }

        public function setMembre($membre)
        {
                $this->membre = $membre;

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

        public function getVerrouillage()
        {
                return $this->verrouillage;
        }

        public function setVerrouillage($verrouillage)
        {
                $this->verrouillage = $verrouillage;

                return $this;
        }
    }
