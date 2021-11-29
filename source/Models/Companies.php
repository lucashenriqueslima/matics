<?php

namespace Source\Models;

class Companies extends Model
{
    public function getCompanies($id_user)
    {
        $stmt = $this->pdo->prepare("SELECT razao_social, nome_fantasia, cnpj, id_company FROM companies WHERE id_user = ? AND status = 1");
        $stmt->execute(array($id_user));

        return $stmt->fetchAll();
    }

    public function addCompany($id_user, $razao_social, $nome_fantasia, $cnpj)
    {
        $stmt = $this->pdo->prepare("INSERT INTO companies (id_company, id_user, razao_social, nome_fantasia, cnpj) VALUES (NULL, ?, ?, ?, ?)");
        $stmt->execute(array($id_user, $razao_social, $nome_fantasia, $cnpj));

        return $stmt->rowCount();
    }

    public function editCompany($id_user, $id_company, $razao_social, $nome_fantasia, $cnpj)
    {
        $stmt = $this->pdo->prepare("UPDATE companies SET razao_social = ?, nome_fantasia = ?, cnpj = ? WHERE id_user = ? AND id_company = ?");
        $stmt->execute(array($razao_social, $nome_fantasia, $cnpj, $id_user, $id_company));
        
        return $stmt->rowCount();
    }

    public function deleteCompany($id_user, $id_company)
    {
        $stmt = $this->pdo->prepare("UPDATE companies SET status = 0 WHERE id_user = ? AND id_company = ?");
        $stmt->execute(array($id_user, $id_company));
        
        return $stmt->rowCount();
    }
    
}