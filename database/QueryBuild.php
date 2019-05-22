<?php
/**
 * Created by PhpStorm.
 * User: peone
 * Date: 03.03.2019
 * Time: 11:22
 */

class QueryBuild
{
    public $pdo;

    function __construct()
    {
        $this->pdo = new PDO("mysql:host=localhost; dbname=texode_bd", "root", "");
    }

    function showAll($table, $sort){
        $sql = "SELECT * FROM $table ORDER BY $sort";
        $statement = $this->pdo->prepare($sql); //подготовить
        $statement->execute(); //true || false
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    function showAllDesc($table, $sort){
        $sql = "SELECT * FROM $table ORDER BY $sort DESC";
        $statement = $this->pdo->prepare($sql); //подготовить
        $statement->execute(); //true || false
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function addComment($table, $data){
        $keys = array_keys($data);
        $stringArrayKeys = implode(',', $keys);
        $placeholders = ":" . implode(', :', $keys);
        $sql = "INSERT INTO $table ($stringArrayKeys) VALUES ($placeholders)";
        $statement = $this->pdo->prepare($sql);
        $statement->execute($data); //true || false

        $sql = "SELECT * FROM $table";
        $statement = $this->pdo->prepare($sql); //подготовить
        $statement->execute(); //true || false
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        
        return $result;
    }

    function delete($table, $id){
        $sql = "DELETE FROM $table WHERE id=:id";
        $statement = $this->pdo->prepare($sql);
        $statement->bindParam(":id", $id);
        $statement->execute();
        header("Location: ../index.php");
    }

    function searchUser($name, $password){

       // 1. Проверить существует ли пользователь в базе
        $sql = "SELECT * FROM users WHERE `name`=:name AND `password`=:password";
        $statement = $this->pdo->prepare($sql);
        $statement->bindParam(":name", $name);
        $statement->bindParam(":password", $password);
        $statement->execute();
        $user = $statement->fetch(PDO::FETCH_ASSOC);
        return $user;

    }
    function searchUserName($name){

       // 1. Проверить существует ли пользователь в базе
        $sql = "SELECT * FROM users WHERE `name`=:name";
        $statement = $this->pdo->prepare($sql);
        $statement->bindParam(":name", $name);
        $statement->execute();
        $user = $statement->fetch(PDO::FETCH_ASSOC);
        return $user;

    }
    function addUser($data){
        $keys = array_keys($data);
        $stringArrayKeys = implode(',', $keys);
        $placeholders = ":" . implode(', :', $keys);
        $sql = "INSERT INTO users ($stringArrayKeys) VALUES ($placeholders)";
        $statement = $this->pdo->prepare($sql);
        $statement->execute($data); //true || false
    }

}