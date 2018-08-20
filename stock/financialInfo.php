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
$url = "http://asp1.krx.co.kr/servlet/krx.asp.XMLJemu?code=025880";
$data = preg_replace("/\n+/", "", file_get_contents($url));
$xml = simplexml_load_string($data);

$NowTime = date("Y-m-d H:i:s",time());

$DaeCha_ym[0] = $xml->TBL_DaeCha['year0'];
$DaeCha_ym[1] = $xml->TBL_DaeCha['month0'];
$DaeCha_ym[2] = $xml->TBL_DaeCha['year1'];
$DaeCha_ym[3] = $xml->TBL_DaeCha['month1'];
$DaeCha_ym[4] = $xml->TBL_DaeCha['year2'];
$DaeCha_ym[5] = $xml->TBL_DaeCha['month2'];

$value_TBL_DaeCha_data = Count($xml->TBL_DaeCha->TBL_DaeCha_data);
for($i=0;$i < $value_TBL_DaeCha_data;$i++) {
$DaeCha_data[$i][0] = $xml->TBL_DaeCha->TBL_DaeCha_data[$i]['hangMok'.$i];
$DaeCha_data[$i][1] = $xml->TBL_DaeCha->TBL_DaeCha_data[$i]['year1Money'.$i];
$DaeCha_data[$i][2] = $xml->TBL_DaeCha->TBL_DaeCha_data[$i]['year1GuSungRate'.$i];
$DaeCha_data[$i][3] = $xml->TBL_DaeCha->TBL_DaeCha_data[$i]['year1JungGamRate'.$i];
$DaeCha_data[$i][4] = $xml->TBL_DaeCha->TBL_DaeCha_data[$i]['year2Money'.$i];
$DaeCha_data[$i][5] = $xml->TBL_DaeCha->TBL_DaeCha_data[$i]['year2GuSungRate'.$i];
$DaeCha_data[$i][6] = $xml->TBL_DaeCha->TBL_DaeCha_data[$i]['year2JungGamRate'.$i];
$DaeCha_data[$i][7] = $xml->TBL_DaeCha->TBL_DaeCha_data[$i]['year3Money'.$i];
$DaeCha_data[$i][8] = $xml->TBL_DaeCha->TBL_DaeCha_data[$i]['year3GuSungRate'.$i];
$DaeCha_data[$i][9] = $xml->TBL_DaeCha->TBL_DaeCha_data[$i]['year3JungGamRate'.$i];
}

$SonIk_ym[0] = $xml->TBL_SonIk['year0'];
$SonIk_ym[1] = $xml->TBL_SonIk['month0'];
$SonIk_ym[2] = $xml->TBL_SonIk['year1'];
$SonIk_ym[3] = $xml->TBL_SonIk['month1'];
$SonIk_ym[4] = $xml->TBL_SonIk['year2'];
$SonIk_ym[5] = $xml->TBL_SonIk['month2'];

$value_TBL_SonIk_data = Count($xml->TBL_SonIk->TBL_SonIk_data);
for($i=0;$i<$value_TBL_SonIk_data;$i++) {
$SonIk_data[$i][0] = $xml->TBL_SonIk->TBL_SonIk_data[$i]['hangMok'.$i];
$SonIk_data[$i][1] = $xml->TBL_SonIk->TBL_SonIk_data[$i]['year1Money'.$i];
$SonIk_data[$i][2] = $xml->TBL_SonIk->TBL_SonIk_data[$i]['year1GuSungRate'.$i];
$SonIk_data[$i][3] = $xml->TBL_SonIk->TBL_SonIk_data[$i]['year1JungGamRate'.$i];
$SonIk_data[$i][4] = $xml->TBL_SonIk->TBL_SonIk_data[$i]['year2Money'.$i];
$SonIk_data[$i][5] = $xml->TBL_SonIk->TBL_SonIk_data[$i]['year2GuSungRate'.$i];
$SonIk_data[$i][6] = $xml->TBL_SonIk->TBL_SonIk_data[$i]['year2JungGamRate'.$i];
$SonIk_data[$i][7] = $xml->TBL_SonIk->TBL_SonIk_data[$i]['year3Money'.$i];
$SonIk_data[$i][8] = $xml->TBL_SonIk->TBL_SonIk_data[$i]['year3GuSungRate'.$i];
$SonIk_data[$i][9] = $xml->TBL_SonIk->TBL_SonIk_data[$i]['year3JungGamRate'.$i];
}

$CashFlow_ym[0] = $xml->TBL_CashFlow['year0'];
$CashFlow_ym[1] = $xml->TBL_CashFlow['month0'];
$CashFlow_ym[2] = $xml->TBL_CashFlow['year1'];
$CashFlow_ym[3] = $xml->TBL_CashFlow['month1'];
$CashFlow_ym[4] = $xml->TBL_CashFlow['year2'];
$CashFlow_ym[5] = $xml->TBL_CashFlow['month2'];

$value_TBL_CashFlow_data = Count($xml->TBL_CashFlow->TBL_CashFlow_data);
for($i=0;$i<$value_TBL_CashFlow_data;$i++) {
$CashFlow_data[$i][0] = $xml->TBL_CashFlow->TBL_CashFlow_data[$i]['hangMok'.$i];
$CashFlow_data[$i][1] = $xml->TBL_CashFlow->TBL_CashFlow_data[$i]['year1Money'.$i];
$CashFlow_data[$i][2] = $xml->TBL_CashFlow->TBL_CashFlow_data[$i]['year1JungGamRate'.$i];
$CashFlow_data[$i][3] = $xml->TBL_CashFlow->TBL_CashFlow_data[$i]['year2Money'.$i];
$CashFlow_data[$i][4] = $xml->TBL_CashFlow->TBL_CashFlow_data[$i]['year2JungGamRate'.$i];
$CashFlow_data[$i][5] = $xml->TBL_CashFlow->TBL_CashFlow_data[$i]['year3Money'.$i];
$CashFlow_data[$i][6] = $xml->TBL_CashFlow->TBL_CashFlow_data[$i]['year3JungGamRate'.$i];
}

?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<script  src="http://code.jquery.com/jquery-latest.min.js"></script>
<script type="text/javascript" src="./js/common.js"></script>
<link rel="stylesheet" type="text/css" href="./css/financialInfo.css"/>
<title>재무정보</title>
</head>
<body>
	<div class="header-wrap">
	재무정보<span><span class="time_img"></span><?=$NowTime?> 기준</span>
	</div>
	<div class="body-wrap">
		<div class="data-lists">
			<dl>
				<dt><span></span>대차대조표</dt>
				<dd>
					<table id="balance">
						<tr>
							<th rowspan="2">재무항목</th>
							<? if($DaeCha_ym[0]) {?>
							<th colspan="3"><?=$DaeCha_ym[0]?>년 <?=$DaeCha_ym[1]?>월</th>
							<th colspan="3"><?=$DaeCha_ym[2]?>년 <?=$DaeCha_ym[3]?>월</th>
							<th colspan="3"><?=$DaeCha_ym[4]?>년 <?=$DaeCha_ym[5]?>월</th>
							<? }?>
						</tr>
						<tr>
							<th>금액</th>
							<th>구성비</th>
							<th>증감율</th>
							<th>금액</th>
							<th>구성비</th>
							<th>증감율</th>
							<th>금액</th>
							<th>구성비</th>
							<th>증감율</th>
						</tr>
						<? if($value_TBL_DaeCha_data > 0){?>
							<? for($i=0;$i<$value_TBL_DaeCha_data;$i++){ ?>
							<tr>
								<td><?=$DaeCha_data[$i][0]?></td>
								<td><?=$DaeCha_data[$i][1]?></td>
								<td><?=$DaeCha_data[$i][2]?></td>
								<td><?=$DaeCha_data[$i][3]?></td>
								<td><?=$DaeCha_data[$i][4]?></td>
								<td><?=$DaeCha_data[$i][5]?></td>
								<td><?=$DaeCha_data[$i][6]?></td>
								<td><?=$DaeCha_data[$i][7]?></td>
								<td><?=$DaeCha_data[$i][8]?></td>
								<td><?=$DaeCha_data[$i][9]?></td>
							</tr>
							<? }?>
						<? }?>
					</table>
				</dd>
				<dt><span></span>손익계산서</dt>
				<dd>
					<table id="income_statement">
						<tr>
							<th rowspan="2">재무항목</th>
							<? if($SonIk_ym[0]) {?>
							<th colspan="3"><?=$SonIk_ym[0]?>년 <?=$SonIk_ym[1]?>월</th>
							<th colspan="3"><?=$SonIk_ym[2]?>년 <?=$SonIk_ym[3]?>월</th>
							<th colspan="3"><?=$SonIk_ym[4]?>년 <?=$SonIk_ym[5]?>월</th>
							<? }?>
						</tr>
						<tr>
							<th>금액</th>
							<th>구성비</th>
							<th>증감율</th>
							<th>금액</th>
							<th>구성비</th>
							<th>증감율</th>
							<th>금액</th>
							<th>구성비</th>
							<th>증감율</th>
						</tr>
						<? if($value_TBL_SonIk_data > 0){?>
							<? for($i=0;$i<$value_TBL_SonIk_data;$i++){ ?>
							<tr>
								<td><?=$SonIk_data[$i][0]?></td>
								<td><?=$SonIk_data[$i][1]?></td>
								<td><?=$SonIk_data[$i][2]?></td>
								<td><?=$SonIk_data[$i][3]?></td>
								<td><?=$SonIk_data[$i][4]?></td>
								<td><?=$SonIk_data[$i][5]?></td>
								<td><?=$SonIk_data[$i][6]?></td>
								<td><?=$SonIk_data[$i][7]?></td>
								<td><?=$SonIk_data[$i][8]?></td>
								<td><?=$SonIk_data[$i][9]?></td>
							</tr>
							<? }?>
						<? }?>
					</table>
				</dd>
				<dt><span></span>현금흐름표</dt>
				<dd>
					<table id="cash_flow">
						<tr>
							<th rowspan="2">재무항목</th>
							<? if($CashFlow_ym[0]) {?>
							<th colspan="2"><?=$CashFlow_ym[0]?>년 <?=$CashFlow_ym[1]?>월</th>
							<th colspan="2"><?=$CashFlow_ym[2]?>년 <?=$CashFlow_ym[3]?>월</th>
							<th colspan="2"><?=$CashFlow_ym[4]?>년 <?=$CashFlow_ym[5]?>월</th>
							<? }?>
						</tr>
						<tr>
							<th>금액</th>
							<th>증감액</th>
							<th>금액</th>
							<th>증감액</th>
							<th>금액</th>
							<th>증감액</th>
						</tr>
						<? if($value_TBL_CashFlow_data > 0){?>
							<? for($i=0;$i<$value_TBL_CashFlow_data;$i++){ ?>
							<tr>
								<td><?=$CashFlow_data[$i][0]?></td>
								<td><?=$CashFlow_data[$i][1]?></td>
								<td><?=$CashFlow_data[$i][2]?></td>
								<td><?=$CashFlow_data[$i][3]?></td>
								<td><?=$CashFlow_data[$i][4]?></td>
								<td><?=$CashFlow_data[$i][5]?></td>
								<td><?=$CashFlow_data[$i][6]?></td>
							</tr>
							<? }?>
						<? }?>
					</table>
				</dd>
			</dl>
		</div>
	</div>
	<div class="footer-wrap"></div>
</body>
</html>