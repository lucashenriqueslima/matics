<?php 

    namespace Source\Controllers;

    class Controller
    {   

        protected $template;
        protected $user_msg;

        public function render($content, $vars = [])
        {   
            $content = views($content);
            if(file_exists($content)){
                extract($vars);
                require($this->template);
            }
        }

        public function ajaxResponse(string $param = null, array $values = null): string
        {
            return json_encode([$param => $values]);
        }
        
        
    }


   