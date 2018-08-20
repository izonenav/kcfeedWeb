<?
    include "../admin/inc/config.php"; 
	include "../admin/inc/mysql.inc.php";  // 데이터 베이스 접속 프로그램 불러오기
	include "../admin/inc/lib.inc.php";  // 데이터 베이스 접속 프로그램 불러오기
    $nse_content = $_POST['ir1'];
	$db = new Mysql();
	//$connect->escape_string($_POST['ir1']);
    $db->que = "insert into nse_tb(content)";
    $db->que .= " values ('{$nse_content}')";
    $res = $db->query();
	// lib::Plog($res);
    if(is_null($res)){
        echo "fail";
    } else{
        echo "success"; // 디비 입력 실패시 fail표시
    }
?>