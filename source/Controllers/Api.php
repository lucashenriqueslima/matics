<?php

    namespace Source\Controllers;

    use Source\Models\Clients;
    use Source\Models\Companies;
    use Source\Models\Credits;
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

            if(strlen($data['cnpj']) != 18){
                echo $this->ajaxResponse("message", [
                    "type" => "error",
                    "message" => "CNPJ inválido."
                ]);
                return;
            }
            
            (new Companies)->addCompany($_SESSION['id_user'], $data['razao_social'], $data['nome_fantasia'], $data['cnpj']);
                echo $this->ajaxResponse("modal_close", [
                    "type" => "success",
                    "message" => "Empresa <b>".$data['razao_social']."</b> adicionada com sucesso.",
                    "modal" => "addModal"
                ]);
            return;
            
        }

        public function editCompany($data)
        {   

            if(!$data['edit_razao_social'] || !$data['edit_nome_fantasia'] || !$data['edit_cnpj']){
                echo $this->ajaxResponse("message", [
                    "type" => "error",
                    "message" => "Preencha todos os campos."
                ]);
                return;
            }

            if(strlen($data['edit_cnpj']) != 18){
                echo $this->ajaxResponse("message", [
                    "type" => "error",
                    "message" => "CNPJ inválido."
                ]);
                return;
            }

            (new Companies)->editCompany($_SESSION['id_user'], $data['edit_id_company'], $data['edit_razao_social'], $data['edit_nome_fantasia'], $data['edit_cnpj']);

            echo $this->ajaxResponse("modal_close", [
                "type" => "success",
                "message" => "Empresa <b>".$data['edit_razao_social']."</b> editada com sucesso.",
                "modal" => "editModal"
            ]);
            return;
        }

        public function deleteCompany($data)
        {
            return print_r(json_encode((new Companies)->deleteCompany($_SESSION['id_user'], $data['id_company'])));
        }




        public function getClients() 
        {
            return print_r(json_encode((new Clients)->getClients($_SESSION['id_user'])));
        }

        public function addClient($data)
        {

            if(!$data['nome'] || !$data['celular'] || !$data['cpf']){
                echo $this->ajaxResponse("message", [
                    "type" => "error",
                    "message" => "Preencha todos os campos."
                ]);
                return;
            }

            if(strlen($data['celular']) != 15){
                echo $this->ajaxResponse("message", [
                    "type" => "error",
                    "message" => "Celular inválido."
                ]);
                return;
            }

            if(strlen($data['cpf']) != 14){
                echo $this->ajaxResponse("message", [
                    "type" => "error",
                    "message" => "CPF inválido."
                ]);
                return;
            }
            
            (new Clients)->addClient($_SESSION['id_user'], $data['nome'], $data['celular'], $data['cpf']);
                echo $this->ajaxResponse("modal_close", [
                    "type" => "success",
                    "message" => "Cliente <b>".$data['nome']."</b> adicionada com sucesso.",
                    "modal" => "addModal"
                ]);
            return;
            
        }

        public function editClient($data)
        {   

            if(!$data['edit_nome'] || !$data['edit_celular'] || !$data['edit_cpf']){
                echo $this->ajaxResponse("message", [
                    "type" => "error",
                    "message" => "Preencha todos os campos."
                ]);
                return;
            }

            
            if(strlen($data['edit_celular']) != 15){
                echo $this->ajaxResponse("message", [
                    "type" => "error",
                    "message" => "Celular inválido."
                ]);
                return;
            }

            if(strlen($data['edit_cpf']) != 14){
                echo $this->ajaxResponse("message", [
                    "type" => "error",
                    "message" => "CPF inválido."
                ]);
                return;
            }


            (new Clients)->editClient($_SESSION['id_user'], $data['edit_id_client'], $data['edit_nome'], $data['edit_celular'], $data['edit_cpf']);

            echo $this->ajaxResponse("modal_close", [
                "type" => "success",
                "message" => "Cliente <b>".$data['edit_nome']."</b> editado com sucesso.",
                "modal" => "editModal"
            ]);
            return;
        }

        public function deleteClient($data)
        {
            return print_r(json_encode((new Clients)->deleteClient($_SESSION['id_user'], $data['id_client'])));
        }

        

        public function getCredits()
        {
            return print_r(json_encode((new Credits)->getCredits($_SESSION['id_user'])));
        }

    }