<?php
//header('Content-Type: application/xml');
$output = "<?xml version='1.0' encoding='UTF-8'?>";
print ($output);
?>
<!DOCTYPE cross-domain-policy SYSTEM 
  "http://www.macromedia.com/xml/dtds/cross-domain-policy.dtd">
<cross-domain-policy>
  <allow-http-request-headers-from domain="* " headers="*" />
</cross-domain-policy>
<?
//1. 아래 code= 부분에 종목코드를 넣어주세요.
$url = "http://asp1.krx.co.kr/servlet/krx.asp.DisList4MainServlet?code=035720&gubun=K";
$data = preg_replace("/\n+/", "", file_get_contents($url));
$xml = simplexml_load_string($data);

$NowTime = date("Y-m-d H:i:s",time());

$value_disInfo = Count($xml->disInfo);
for($i=0;$i<$value_disInfo;$i++) {
$disInfo[$i][0] = $xml->disInfo[$i]['distime'];
$disInfo[$i][1] = $xml->disInfo[$i]['disAcpt_no'];
$disInfo[$i][2] = $xml->disInfo[$i]['disTitle'];
$disInfo[$i][3] = $xml->disInfo[$i]['submitOblgNm'];
}

?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<script  src="http://code.jquery.com/jquery-latest.min.js"></script>
<script type="text/javascript" src="./js/common.js"></script>
<script src="http://asp1.krx.co.kr/inc/js/asp_chart.js"></script>
<link rel="stylesheet" type="text/css" href="./css/disinfo.css"/>
<title>공시정보</title>
</head>
<body>
	<div class="header-wrap">
	공시정보<span><span class="time_img"></span><?=$NowTime?> 기준</span>
	</div>
	<div class="body-wrap">
	<table id="disInfo">
		<tr>
			<th>번호</th>
			<th>일자</th>
			<th>공시제목</th>
			<th>제출의무자</th>
		</tr>
		<?if($value_disInfo > 0){ ?>
		<?for($k=0; $k<$value_disInfo;$k++) {?>
		<tr>
			<td><?=$value_disInfo-$k?></td>
			<td><?=substr($disInfo[$k][0],0,4);?>/<?=substr($disInfo[$k][0],4,2);?>/<?=substr($disInfo[$k][0],6,2);?></td>		
			<td><a href="#" onclick="window.open('http://kind.krx.co.kr/common/disclsviewer.do?method=search&acptno=<?=$disInfo[$k][1]?>','공시상세보기','width=1200,height=800,top=100,left=350,toolbar=no,menubar=no,scrollbars=no,resizable=yes');return false;"><?=$disInfo[$k][2]?></a></td>
			<td><?=$disInfo[$k][3]?></td>
		</tr>
		<?} ?>
		<?} else {?>
		<tr>
			<td colspan="4">데이터가 없습니다.</td>
		</tr>
		<?} ?>
	</table>
	
	</div>
	<div class="footer-wrap"></div>
</body>
</html>
