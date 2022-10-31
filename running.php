<?php

require_once 'config/conn.php';
require_once 'function/function.php';

$query ="
    SELECT
        eventid
    FROM
        tb_events
    WHERE
        DATE_FORMAT(tb_events.date_start, '%Y-%m-%d') = DATE_FORMAT(CURRENT_DATE(), '%Y-%m-%d') AND
    STATUS = 2
    limit 10
";


foreach ($conn->query($query) as $row) {


    $sql = "INSERT INTO tb_events_history (userid, notes, status, create_time, eventid, role_code) VALUES (:userid, :notes, :status, :create_time, :eventid, :role_code)";
    $stmt= $conn->prepare($sql);
    $stmt->execute([
        "userid"=> 0,
        "notes"=>"Update by system",
        "status"=> 4,
        "create_time"=> date("Y-m-d H:i:s"),
        "eventid"=> $row['eventid'],
        "role_code"=>0,
    ]);

    $sqlUpdate = "UPDATE tb_events SET   status=:status WHERE eventid=:eventid ";
    $stmtUpdate= $conn->prepare($sqlUpdate);
    $stmtUpdate->execute([
        "status"=> 4,
        "eventid"=> $row['eventid'],
    ]);

    echo  "event id : ".$row['eventid']."\t [ APPROVED to RUNNING ]  updated at : ". date('d-m-Y H:i:s')." by cronjob damkar.id";
}


?>