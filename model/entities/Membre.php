<?php
    namespace Model\Entities;

    use App\Entity;

    final class Membre extends Entity{

        private $id;
        private $pseudo;
        private $mail;
        private $password;
        private $role;
        private $dateInscription;

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

        public function getPseudo()
        {
            return $this->pseudo;
        }

        public function setPseudo($pseudo)
        {
            $this->pseudo = $pseudo;

            return $this;
        }

        public function getMail()
        {
            return $this->mail;
        }

        public function setMail($mail)
        {
            $this->mail = $mail;

            return $this;
        }

        public function getPassword()
        {
            return $this->password;
        }

        public function setPassword($password)
        {
            $this->password = $password;

            return $this;
        }

        public function getRole()
        {
            return $this->role;
        }

        public function setRole($role)
        {
            $this->role = $role;

            return $this;
        }

        public function getDateInscription(){
            $dateFormater = $this->dateInscription->format("d/m/Y, H:i:s");
            return $dateFormater;
        }

        public function setDateInscription($date){
            $this->dateInscription = new \DateTime($date);

            return $this;
        }

        
    }