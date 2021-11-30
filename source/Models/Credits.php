<?php

namespace Source\Models;

class Credits extends Model
{
    public function getCredits($id_user)
    {
        $stmt = $this->pdo->prepare("SELECT 
        c.nome_fantasia, 
        c.cnpj,
        ce.description,
        ce.id_credit, 
        ce.value, 
        DATE_FORMAT(ce.date, '%d/%m/%Y') AS date
        FROM credits ce 
        INNER JOIN companies c
        ON ce.id_company = c.id_company
        WHERE ce.id_user = ?
        ");

        $stmt->execute(array($id_user));

        return $stmt->fetchAll();
    }

    public function payedCredit($id_user, $id_credit)
    {   
        $stmt = $this->pdo->prepare("SELECT c.id_user, c.id_company, c.description, c.value, c.date FROM credits c WHERE c.id_user = ? AND c.id_credit = ?");
        $stmt->execute(array($id_user, $id_credit));

        $earning = $stmt->fetch();

        $stmt = $this->pdo->prepare("INSERT INTO 
        earnings 
        (id_user, id_company, description, value, date, date_payed)
        SELECT c.id_user, c.id_company, c.description, c.value, c.date, CURDATE()
        FROM credits c 
        WHERE c.id_user = ? AND c.id_credit = ?");

        $stmt->execute(array($id_user, $id_credit));

        $stmt = $this->pdo->prepare("DELETE FROM credits WHERE id_user = ? AND id_credit = ?");
        $stmt->execute(array($id_user, $id_credit));


        $stmt = $this->pdo->prepare("CALL MainProcedure(?, ?, ?, ?)");
        $stmt->execute(array(2, $earning['date'], $earning['value'], $earning['id_user']));

        return;
    }

    public function addCredit($id_user, $id_company, $description, $value, $date)
    {
        $stmt = $this->pdo->prepare("INSERT INTO credits (id_user, id_company, description, value, date) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute(array($id_user, $id_company, $description, $value, $date));

        $stmt = $this->pdo->prepare("CALL MainProcedure(?, ?, ?, ?)");
        $stmt->execute(array(1, $date, $value, $id_user));

        return;        
    }

    public function deleteCredit($id_user, $id_credit)
    {
        $stmt = $this->pdo->prepare("SELECT date, value FROM credits WHERE id_credit = ?");
        $stmt->execute(array($id_credit));
        $credit = $stmt->fetch();

        $stmt = $this->pdo->prepare("CALL DeleteProcedure(?, ?, ?, ?, ?)");
        $stmt->execute(array(1, $credit['date'], $credit['value'], $id_credit, $id_user));

        return;
    }
}