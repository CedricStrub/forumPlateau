<?php
    namespace App;

    abstract class AbstractController{

        public function index(){}
        
        public function redirectTo($ctrl = null, $action = null, $id = null){
            if($ctrl != "home"){
                $url = "/CedricStrub/forumPlateau/index.php?";
                $url.= $ctrl ? "ctrl=".$ctrl : "";
                $url.= $action ? "&action=".$action : "";
                $url.= $id ? "&id=".$id : "";
            }elseif($ctrl == "home" && $action != null){
                $url = "/CedricStrub/forumPlateau/index.php?";
                $url.= $ctrl ? "ctrl=".$ctrl : "";
                $url.= $action ? "&action=".$action : "";
                $url.= $id ? "&id=".$id : "";
            }
            else $url = "/CedricStrub/forumPlateau/index.php";
            header("Location: $url");
            die();

        }

        public function restrictTo($role){
            
            if(!Session::getUser() || !Session::getUser()->hasRole($role)){
                $this->redirectTo("security", "login");
            }
            return;
        }

    }