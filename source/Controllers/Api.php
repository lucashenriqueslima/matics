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

        public function addCompany($data)
        {
            

            if(!$data['razao_social'] || !$data['nome_fantasia'] || !$data['cnpj']){
                echo $this->ajaxResponse("message", [
                    "type" => "error",
                    "message" => "Preencha todos os campos."
                ]);
                return;
            }
            
            (new Companies)->addCompany($_SESSION['id_user'], $data['razao_social'], $data['nome_fantasia'], $data['cnpj']);
                echo $this->ajaxResponse("modal_close", [
                    "type" => "success",
                    "message" => 'Empresa adicionada.',
                    "modal" => "addModal"
                ]);
            return;
            
        }

        public function deleteCompany($data)
        {
            return print_r(json_encode((new Companies)->deleteCompany($_SESSION['id_user'], $data['id_company'])));
        }

    }