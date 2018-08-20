<?
require_once "../inc/config.php"; 
require_once "../inc/lib.inc.php"; 
require_once "../inc/mysql.inc.php"; 
require_once "../inc/notice.inc.php"; 


$gubunDetail = $_GET["gubunDetail"];
// lib::Plog($gubunDetail);


$db = new Mysql();
$notice = new Notice($db);

$notice->gubunDetail = $gubunDetail;


$tableData = $notice->getNoticeSub();

// $DATA = array($noticeStartRow , $tableData);
echo $tableData;



?>
