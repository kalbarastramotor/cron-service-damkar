<?php 

function insert_data($data){

    $sql = "INSERT INTO tb_events_history (userid, notes, status, create_time, eventid, role_code) VALUES (:userid, :notes, :status, :create_time, :eventid, :role_code)";
    $stmt= $conn->prepare($sql);
    $stmt->execute([
        "userid"=> $data["userid"],
        "notes"=> $data["notes"],
        "status"=> $data["status"],
        "create_time"=> $data["create_time"],
        "eventid"=> $data["eventid"],
        "role_code"=> $data["role_code"]
    ]);
}



?>