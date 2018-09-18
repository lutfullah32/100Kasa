<?php
/**
 * Created by PhpStorm.
 * User: lutfu
 * Date: 13.09.2018
 * Time: 21:33
 */
    session_start();
    if($_POST){
        $durum=$_POST["durum"];
        $tutar=$_POST["tutar"];
        $secenek=$_POST["secenek"];
        $username=$_SESSION["username"];
        $conn = new mysqli("localhost", "root", "", "100kasa");
        $conn->query("SET CHARACTER SET utf8");
        $conn->query("INSERT INTO gelir_gider SET user_name='$username',
                                                         durum='$durum',
                                                         tutar='$tutar',
                                                         secenek_id=$secenek");
        $data=array("message"=>"başarılı");
        echo json_encode($data);

    }