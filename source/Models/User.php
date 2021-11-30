<?php

    namespace Source\Models;
    

    Class User extends Model
    {

        public function login($login, $passwd)
        {   
            $query = $this->pdo->prepare("SELECT * FROM sub_users WHERE sub_users.email = ? AND sub_users.passwd = ? OR sub_users.cpf = ? AND sub_users.passwd = ?");
            $query->execute(array($login, $passwd, $login, $passwd));
            if ($query->rowcount() == 1){
                return $query->fetch();
            }

            return false;
        }

        public function register($name, $email, $cpf, $passwd)
        {
            $stmt = $this->pdo->prepare("INSERT INTO sub_users VALUES (NULL, 1, ?, ?, ?, ?, '111111111111')");
            $stmt->execute(array($name, $email, $cpf, $passwd));
            return true;
        }

        function auth_user(int $id_user, int $id_sub_user)
        {
            $query = $this->pdo->prepare("SELECT count(*) FROM sub_users WHERE id_user = ? AND id_sub_user = ?");
            $query->execute(array($id_user, $id_sub_user));
            return $query->rowcount();
        }

        



    }