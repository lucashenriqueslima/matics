<?php

namespace Source\Models;

class Expenses extends Model
{
    public function getExpenses($id_user)
    {
        $stmt = $this->pdo->prepare("SELECT    
        description,
        id_expense, 
        value,
        DATE_FORMAT(date, '%d/%m/%Y') AS date
        FROM expenses
        WHERE id_user = ?
        ");

        $stmt->execute(array($id_user));

        return $stmt->fetchAll();
    }

    public function addExpense($id_user, $description, $value, $date)
    {
        $stmt = $this->pdo->prepare("INSERT INTO expenses (id_user, description, value, date) VALUES (?, ?, ?, ?)");
        $stmt->execute(array($id_user, $description, $value, $date));

        $stmt = $this->pdo->prepare("CALL MainProcedure(?, ?, ?, ?)");
        $stmt->execute(array(3, $date, $value, $id_user));

        return;        
    }

    public function deleteExpense($id_user, $id_credit)
    {
        $stmt = $this->pdo->prepare("SELECT date, value FROM expenses WHERE id_expense = ?");
        $stmt->execute(array($id_credit));
        $credit = $stmt->fetch();

        $stmt = $this->pdo->prepare("CALL DeleteProcedure(?, ?, ?, ?, ?)");
        $stmt->execute(array(3, $credit['date'], $credit['value'], $id_credit, $id_user));

        return;
    }

}