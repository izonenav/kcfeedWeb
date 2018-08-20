<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?

include "../../admin/inc/config.php"; 
include "../../admin/inc/mysql.inc.php"; 
include "../../admin/inc/paging.inc.php"; 
include "../../admin/inc/lib.inc.php"; 

//-+-+-+-+-+-+-+-+//-+-+-+-+-+-+-+-+

$db = new Mysql();

//-+-+-+-+-+-+-+-+/add(추가) 시 사용/-+-+-+-+-+-+-+-+
$mode = $_POST["mode"];
$egg = $_POST["egg"];
$chi = $_POST["chi"];
$pig = $_POST["pig"];
$cow = $_POST["cow"];
$region_cd = $_POST["region_cd"];
$dDate = $_POST["dDate"];
//-+-+-+-+-+-+-+-+/modify, remove 시 사용/-+-+-+-+-+-+-+-+
$seq = $_POST["seq"];
//-+-+-+-+-+-+-+-+/modify 시 사용/-+-+-+-+-+-+-+-+
$ModifyRegion_cd = $_POST["ModifyRegion_cd"];
$ModifyItem_cd = $_POST["ModifyItem_cd"];
$ModifyItem_price = $_POST["ModifyItem_price"];
$modifydDate = $_POST["modifydDate"];

if(is_array($egg))
{
	$itemRow = $egg;
}
else if(is_array($chi))
{
	$itemRow = $chi;
}
else if(is_array($pig))
{
	$itemRow = $pig;
}
else if(is_array($cow))
{
	$itemRow = $cow;
}

if($mode == "add")
{	
	$DATA["region_cd"] = $region_cd;
	$DATA["dDate"] = $dDate;

	foreach($itemRow as $key => $value)
	{	
		$DATA["item_cd"] = $key;
		$DATA["item_price"] = $value;
		$db->Insert('price_info',$DATA);
	}

	LIB::Alert("추가 완료", "../main.html");
}
else if($mode == "modify")
{

	$DATA["item_price"] = $ModifyItem_price;
	$DATA["dDate"] = $modifydDate;

	
	$db->Update("price_info", $DATA, "where seq=". $seq, "");
	
	LIB::Alert("수정 완료", "../main.html");
}
else if($mode == "remove")
{
	$db->que = "DELETE FROM price_info WHERE seq=".$seq;
	$db->query();
	LIB::Alert("삭제 완료", "../main.html");
}

?>

