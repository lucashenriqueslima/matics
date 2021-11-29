<?php

function site(string $param = null): string
    {
        if($param && !empty(SITE[$param])){
            return SITE[$param];
        }

        return SITE["root"];
    }

    function views(string $path): string
    {
        return VIEWSPATH.$path.".php";
    }

    function route(string $path = null): string
    {
        return site().$path;
    }

    function asset(string $path, $time = true): string
    {
        return SITE['root']."/views/assets/{$path}";
        
/*
        if($time && file_exists($fileOnDir)){
            $file .="?time=".filemtime($fileOnDir);
        }
         
        return $file;
        */
    }

       
    
    function flash(string $type = null, string $message = null): ?string
    {
        if($type && $message){
            $_SESSION["flash"] = [
                "type"=> $type,
                "message"=> $message
            ];
            
            return null;
        }

        if(!empty($_SESSION["flash"])){
            
            echo "<script>const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                  toast.addEventListener('mouseenter', Swal.stopTimer)
                  toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
              })
              Toast.fire({
                icon: '".$_SESSION['flash']['type']."',
                title: '".$_SESSION['flash']['message']."'
              })</script>";

            unset($_SESSION['flash']);
        }

        return null;
    }

    function redirect($url = null)
    {
   echo "<script> window.location.href = '".site().$url."' </script>";
 
    }


    function verifyAccess($i)
    {
        if(isset($i) && $_SESSION['access'][$i] == false){
            redirect("/me");
            flash("error", "Acesso negado ¯\_( ͡❛ ͜ʖ ͡❛)_/¯");
            
        }
    }

    function scriptJs($script)
    {
        return "<script> ".$script." </script>";
    }

    function activeMenu($title, $itemMenu)
    {   
        foreach($itemMenu as $item){ 
            if($title == $item){
                return "active";
            }
        }
    }

    function showMenu($title, $itemMenu)
    {
        foreach($itemMenu as $item){
            if($item == $title){
                return "show";
            }
        }
    }

    function showMessages(array $messages)
    {
        foreach($messages as $msg)
        {
        echo '<a class="dropdown-item d-flex align-items-center" href="'.$msg['link'].'">
        <div class="mr-3">
            <div class="icon-circle bg-'.$msg['icon_type'].'">
                <i class="'.$msg['icon'].' text-white"></i>
            </div>
        </div>
        <div>
            <div class="small text-gray-500">'.$msg['date'].'</div>
            '.$msg['message'].'
        </div>
    </a>';
        }
    }

    