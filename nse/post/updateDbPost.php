<?
    include "../../admin/inc/config.php"; 
	include "../../admin/inc/mysql.inc.php";  // 데이터 베이스 접속 프로그램 불러오기
	include "../../admin/inc/lib.inc.php";  // 데이터 베이스 접속 프로그램 불러오기
	
    $nse_content = $_POST['ir1'];
    $seq = $_POST['seq'];
    $subject = $_POST['subject'];
	
	$db = new Mysql();
	
	$DATA["subject"] = $subject;
	$DATA["content"] = $nse_content;

	$db->Update('board',$DATA,"seq={$seq}");
	LIB::Alert("추가 완료", "../board2.html");
?>