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
 
        /**
         * Get the value of id
         */ 
        public function getId()
        {
                return $this->id;
        }

        /**
         * Set the value of id
         *
         * @return  self
         */ 
        public function setId($id)
        {
                $this->id = $id;

                return $this;
        }

        /**
         * Get the value of title
         */ 
        public function getTitre()
        {
                return $this->titre;
        }

        /**
         * Set the value of title
         *
         * @return  self
         */ 
        public function setTitre($titre)
        {
                $this->titre = $titre;

                return $this;
        }

        /**
         * Get the value of user
         */ 
        public function getMembre()
        {
                return $this->membre;
        }

        /**
         * Set the value of user
         *
         * @return  self
         */ 
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

        /**
         * Get the value of closed
         */ 
        public function getVerrouillage()
        {
                return $this->verrouillage;
        }

        /**
         * Set the value of closed
         *
         * @return  self
         */ 
        public function setVerrouillage($verrouillage)
        {
                $this->verrouillage = $verrouillage;

                return $this;
        }
    }
