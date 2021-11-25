<?php

    namespace Source\Controllers;

use Source\Models\Companies;
use Source\Models\Finance;
    use Source\Models\Message;
    use Source\Models\User;


    class Api extends Controller
    {
        
        public function __construct()
        {
            if(empty($_SESSION["id_user"]) || !(new User())->auth_user($_SESSION["id_user"], $_SESSION["id_sub_user"])){
                session_destroy();
                redirect();
                
            }
        }

        public function getDateGraph($data)
        {   
            return print_r(json_encode((new Finance)->getDateGraph($_SESSION['id_user'])));
        }

        public function getDataGraph($data)
        {
            print_r(json_encode((new Finance())->getGraph($_SESSION['id_user'],  $data['min_date'], $data['max_date'])));
        }

        public function msgCounterReset($data)
        {
                $id = $data["id"];
                if($data["id"] != $_SESSION['id_user']){
                $data["id"] = 1;
                }
                $msgCount = (new Message())->msgCounterReset($id);  
                
        }

        public function getCompanies($data) 
        {
            return print_r(json_encode((new Companies)->getCompanies($_SESSION['id_user'])));
        }

    }