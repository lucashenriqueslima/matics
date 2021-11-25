<?php 

    namespace Source\Controllers;
    use Source\Models\Finance;
    use Source\Models\User;

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
                "title" => site('name')."Home",
                "year" => $year
            ]);
        }

        
        public function companies()
        {  
            parent::render("/companies", [
                "title" => site('name')."Empresas",
            ]);
        }

        public function registerCompany()
        {
            parent::render("/register_company", [
                
            ]);
        }


        public function logoff()
        {
            session_destroy();     
            redirect();
            
        }
    }