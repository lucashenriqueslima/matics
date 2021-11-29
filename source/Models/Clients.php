<?php

namespace Source\Models;

class Clients extends Model
{
    public function getClients($id_user)
    {
        $stmt = $this->pdo->prepare("SELECT name, cellphone, cpf, id_client FROM clients WHERE id_user = ? AND status = 1");
        $stmt->execute(array($id_user));

        return $stmt->fetchAll();
    }

    public function addClient($id_user, $razao_social, $nome_fantasia, $cnpj)
    {
        $stmt = $this->pdo->prepare("INSERT INTO clients VALUES (NULL, ?, ?, ?, ?, 1)");
        $stmt->execute(array($id_user, $razao_social, $nome_fantasia, $cnpj));

        return $stmt->rowCount();
    }

    public function editClient($id_user, $id_company, $razao_social, $nome_fantasia, $cnpj)
    {
        $stmt = $this->pdo->prepare("UPDATE clients SET name = ?, cellphone = ?, cpf = ? WHERE id_user = ? AND id_client = ?");
        $stmt->execute(array($razao_social, $nome_fantasia, $cnpj, $id_user, $id_company));
        
        return $stmt->rowCount();
    }

    public function deleteClient($id_user, $id_company)
    {
        $stmt = $this->pdo->prepare("UPDATE clients SET status = 0 WHERE id_user = ? AND id_client = ?");
        $stmt->execute(array($id_user, $id_company));
        
        return $stmt->rowCount();
    }
}