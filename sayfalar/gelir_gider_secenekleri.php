<?php

    if(isset($_POST["option"])){
        $option=$_POST["option"];
        $conn = new mysqli("localhost", "root", "", "100kasa");
        $conn->query("SET CHARACTER SET utf8");
        $result=$conn->query("select id,secenek from gelir_gider_secenekleri where tur='$option'");
        $data=array();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                array_push($data,array("key"=>$row["id"],"value"=>$row["secenek"]));
                
            }
        }
        echo json_encode( $data );
        
    }

?>