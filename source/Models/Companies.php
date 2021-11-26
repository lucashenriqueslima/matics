<?php

namespace Source\Models;

class Companies extends Model
{
    public function getCompanies($id_user)
    {
        $stmt = $this->pdo->prepare("SELECT razao_social, nome_fantasia, cnpj, id_company FROM companies WHERE id_user = ?");
        $stmt->execute(array($id_user));

        return $stmt->fetchAll();
    }

    public function deleteCompany($id_user, $id_company)
    {
        $stmt = $this->pdo->prepare("DELETE FROM companies WHERE id_user = ? AND id_company = ?");
        $stmt->execute(array($id_user, $id_company));
        
        return($stmt);
    }
    
}