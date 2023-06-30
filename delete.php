<?php
    include 'database.php';
    $database = new Database;
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $where = "id=$id";
        $result = $database->delete('users', $where);
        if($result) header('location:display.php');
    }    
?>