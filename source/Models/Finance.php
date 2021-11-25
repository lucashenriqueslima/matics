<?php

namespace Source\Models;

class Finance extends Model
{
    public function getDateGraph($id_user)
    {
        $stmt = $this->pdo->prepare('SELECT
        DATE_FORMAT(MIN(DATE), "%Y-%m") AS min_date, 
        DATE_FORMAT(MAX(DATE), "%Y-%m") AS max_date
        FROM finance_month WHERE id_user = ? ORDER BY date');
        $stmt->execute(array($id_user));
        return $stmt->fetch();
    }
    public function getGraph($id_user, $min_date, $max_date)
    {
       $query = $this->pdo->prepare("SELECT DATE_FORMAT(date, '%m/%Y') AS date,
       credit,
       earning,
       expense
               FROM finance_month
                       WHERE id_user = ?
                               AND date BETWEEN ? AND ? ORDER BY date");
        $query->execute(array($id_user, $min_date, $max_date));
        
        return $query->fetchAll();

   
    
    }
}
