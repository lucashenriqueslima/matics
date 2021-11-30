<?php

namespace Source\Models;

class Earnings extends Model
{
    public function getEarnings($id_user)
    {
        $stmt = $this->pdo->prepare("SELECT 
        c.nome_fantasia, 
        c.cnpj,
        e.description,
        e.value, 
        DATE_FORMAT(e.date, '%d/%m/%Y') AS date,
        DATE_FORMAT(e.date_payed, '%d/%m/%Y') AS date_payed
        FROM earnings e
        INNER JOIN companies c
        ON e.id_company = c.id_company
        WHERE e.id_user = ?
        ");

        $stmt->execute(array($id_user));

        return $stmt->fetchAll();
    }


}