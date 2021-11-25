<?php

    namespace Source\Controllers;
    use Source\Models\User;

class Auth extends Controller
    {
        public function login($data)
        {
            $username = $data["email"];
            $passwd = filter_var($data["passwd"]);
            
            if(!$passwd || !$username){
                echo $this->ajaxResponse("message", [
                    "type" => "error",
                    "message" => "Preencha todos os campos."
                ]);
                return;
            }

            $user = (new User())->login($username, $passwd); 

            if ($user == false){
                echo $this->ajaxResponse("message", [
                    "type" => "error",
                    "message" => "Login ou senha incorreto."
                ]);
                return;
            }

            

                $_SESSION["id_user"] = $user["id_user"];
                $_SESSION["id_sub_user"] = !empty($user["id_sub_user"]) ? $user["id_sub_user"] : $user["id_user"];
                $_SESSION["email"] = $user["email"];
                str_word_count($user['name']) > 1 ? $_SESSION["name"] = @explode(" ", $user["name"]) : $_SESSION['name'] = $user['name'];
                $_SESSION["access"] = !isset($user['access']) ? 1111111 : $_SESSION['level'] = 1;
                $_SESSION["access"] = str_split($_SESSION["access"]);

                echo $this->ajaxResponse("redirect", [
                    "url" => route("/me"),

                ]);

                flash("success", "Seja bem-vindo {$_SESSION["name"][0]}  :-)");
                
                return;
             
            } 

            

           
            
        

        
    }
    