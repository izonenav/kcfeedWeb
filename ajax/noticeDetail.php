<?
require_once "../inc/config.php"; 
require_once "../inc/lib.inc.php"; 
require_once "../inc/mysql.inc.php"; 
require_once "../inc/notice.inc.php"; 


$seq = $_GET["seq"];
$gubun = $_GET["gubun"];
$growthRow = array("산란계g","육계g","양돈g","축우g","최근정보g");
$diseaseRow = array("가금d","양돈d","축우d","기타d","최근정보d");


if(in_array($gubun , $growthRow))
{
	$listButton = "<button class='btn btn-dark' id='listFetch' onclick=\"noticeObj.fetchNoticeSub('".$gubun."' , 0)\"><i class='fas fa-arrow-circle-left fa-lg'>목록으로</i></button>";
}
else if(in_array($gubun , $diseaseRow))
{
	$listButton = "<button class='btn btn-dark' id='listFetch' onclick=\"noticeObj.fetchNoticeSub('".$gubun."' , 0)\"><i class='fas fa-arrow-circle-left fa-lg'>목록으로</i></button>";
}
else
{
	$listButton = "<button class='btn btn-dark' id='listFetch' onclick=\"fetchNotice('else' , '".$gubun."')\"><i class='fas fa-arrow-circle-left fa-lg'>목록으로</i></button>";
}

//else if(in_array($gubun , $diseaseRow))
//{
//
//}

$db = new Mysql();
$db->que = " SELECT * FROM board WHERE seq =".$seq;
$db->query();
$row = $db->getRow();

/*	
$DATA = "
	<div class='row'>
		<div class='col-md-12' >
			  <div>
				<h5 class='card-title' style='font-weight : 700'; 'color : #af648d; font-weight : bold;'>".$row["subject"]."</h5>								
				".$row["content"]."
			  </div>
			  <div style='padding : 5px;' class='text-center'>
  				<button class='btn btn-dark' id='listFetch' onclick=\"fetchNotice('else' , '".$gubun."')\"><i class='fas fa-arrow-circle-left fa-lg'>목록으로</i></button>
			  </div>
		</div>
	</div>";
*/
	
$DATA = "
	<div class='row'>
		<div class='col-md-12' >
			  <div>
				<h5 class='card-title' style='font-weight : 700'; 'color : #af648d; font-weight : bold;'>".$row["subject"]."</h5>								
				".$row["content"]."
			  </div>
			  <div style='padding : 5px;' class='text-center'>
  				{$listButton}
			  </div>
		</div>
	</div>";

echo $DATA;



?>
