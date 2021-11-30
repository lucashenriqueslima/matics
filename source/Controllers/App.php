<?php 

    namespace Source\Controllers;
    use Source\Models\Finance;
    use Source\Models\User;
    use Source\Models\Companies;

class App extends Controller
    {

        

        public function __construct($router)
        {

            if(empty($_SESSION["id_user"]) || !(new User())->auth_user($_SESSION["id_user"], $_SESSION["id_sub_user"])){
                session_destroy();
                redirect();
                
            }
            
            $this->router = $router;
            $this->template = views("/_app_template");  
            
        }

        public function home($data)
        {   
            $year = date("Y");
            $min_date = $year."-01-01";
            $max_date = $year."-12-31";
          
            
            parent::render("/home", [
                "title" => "Home",
                "year" => $year
            ]);
        }

        
        public function companies()
        {  
            parent::render("/companies", [
                "title" => "Empresas",
            ]);
        }

        public function clients()
        {  
            parent::render("/clients", [
                "title" => "Clientes",
            ]);
        }

        public function credits()
        {   
            $companies = (new Companies)->getCompanies($_SESSION['id_user']);
            parent::render("/credits", [
                "title" => "Créditos",
                "companies" => $companies
            ]);
        }

        public function earnings()
        {   
            parent::render("/earnings", [
                "title" => "Ganhos"
            ]);
        }

        public function expenses()
        {   
            parent::render("/expenses", [
                "title" => "Despesas"
            ]);
        }

        public function errorPage($data)
        {
            parent::render("/error_page", [
                "title" => "Erro",
                "errcode" => $data['errcode']
            ]);
        }

        public function logoff()
        {
            session_destroy();     
            redirect();
            
        }
    }