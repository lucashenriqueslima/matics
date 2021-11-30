<?php

namespace Source\Models;

class Credits extends Model
{
    public function getCredits($id_user)
    {
        $stmt = $this->pdo->prepare("SELECT 
        c.razao_social, 
        c.nome_fantasia, 
        c.cnpj,
        ce.id_credit_earning, 
        ce.value, 
        DATE_FORMAT(ce.date, '%d/%m/%Y') AS date
        FROM credits_earnings ce 
        INNER JOIN companies c
        ON ce.id_company = c.id_company
        WHERE ce.id_user = ?
        AND ce.status = 1
        ");

        $stmt->execute(array($id_user));

        return $stmt->fetchAll();
    }
}