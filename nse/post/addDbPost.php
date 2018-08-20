<?
    include "../../admin/inc/config.php"; 
	include "../../admin/inc/mysql.inc.php";  // 데이터 베이스 접속 프로그램 불러오기
	include "../../admin/inc/lib.inc.php";  // 데이터 베이스 접속 프로그램 불러오기
	
    $nse_content = $_POST['ir1'];
    $subject = $_POST['subject'];
    $gubun = $_POST['gubun'];
	
	
	$db = new Mysql();
	//$connect->escape_string($_POST['ir1']);
    $db->que = "insert into board(content , subject , gubun)";
    $db->que .= " values ('{$nse_content}' , '{$subject}' , '{$gubun}')";
	// lib::Plog($db->que);
    $res = $db->query();
	// lib::Plog($res);
    if(is_null($res)){
		LIB::Alert("실패 전산실 문의 바랍니다", "../board2.html");
    } else{
		LIB::Alert("추가 완료", "../board2.html");
    }
?>