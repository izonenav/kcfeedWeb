<?php
    include "../admin/inc/config.php"; 
	include "../admin/inc/mysql.inc.php";  // 데이터 베이스 접속 프로그램 불러오기
	include "../admin/inc/lib.inc.php";  // 데이터 베이스 접속 프로그램 불러오기
	$db = new Mysql();
    $db->que = " SELECT * FROM nse_tb ORDER BY no DESC LIMIT 1 ";
	$db->query();
    $row = $db->getRow();
    // $showContent = $res->fetch_array(MYSQLI_ASSOC);
    echo $row["content"];
?>