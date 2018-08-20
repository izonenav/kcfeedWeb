<?
require_once "../inc/config.php"; 
require_once "../inc/lib.inc.php"; 
require_once "../inc/mysql.inc.php"; 
require_once "../inc/notice.inc.php"; 


$seq = $_GET["seq"];


$db = new Mysql();
$db->que = " SELECT * FROM board WHERE seq =".$seq;
$db->query();
$row = $db->getRow();
$DATAS = '
	<div class="row">
		<div class="col-md-12" >
			  <div class="card-body" style="padding-right : 0px; ">
				<h5 class="card-title" style="font-weight : 700"; "color : #af648d; font-weight : bold;">'.$row["subject"].'</h5>								
				'.$row["content"].'
			  </div>
		</div>
	</div>';
	
$DATA = '
	<div class="row">
		<div class="col-md-12" >
			  <div>
				<h5 class="card-title" style="font-weight : 700"; "color : #af648d; font-weight : bold;">'.$row["subject"].'</h5>								
				'.$row["content"].'
			  </div>
			  <div style="padding : 5px;">
  				<button class="btn btn-dark" id="listFetch" onclick=\'fetchNotice("else")\'><i class="fas fa-arrow-circle-left fa-lg" >목록으로</i></button>
			  </div>
		</div>
	</div>';

echo $DATA;



?>
