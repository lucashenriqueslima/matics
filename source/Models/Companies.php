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
    
}