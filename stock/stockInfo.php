
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
$url = "http://asp1.krx.co.kr/servlet/krx.asp.XMLSise?code=025880";
$data = preg_replace("/\n+/", "", file_get_contents($url));
$xml = simplexml_load_string($data);

//2. 아래 $JongCd 에 종목코드를 넣어주세요.
$JongCd = "025880";
$up = "▲";
$down = "▼";
$bohab = "─";
$NowTime = $xml->stockInfo['myNowTime'];
$JangGubun =  $xml->stockInfo['myJangGubun'];

// 주가정보
$TBL_StockInfo0 = $xml->TBL_StockInfo['JongName'];
$TBL_StockInfo1 = $xml->TBL_StockInfo['CurJuka'];
$TBL_StockInfo2 = $xml->TBL_StockInfo['DungRak'];
$TBL_StockInfo3 = $xml->TBL_StockInfo['Debi'];
$TBL_StockInfo4 = $xml->TBL_StockInfo['PrevJuka'];
$TBL_StockInfo5 = $xml->TBL_StockInfo['Volume'];
$TBL_StockInfo6 = $xml->TBL_StockInfo['Money'];
$TBL_StockInfo7 = $xml->TBL_StockInfo['StartJuka'];
$TBL_StockInfo8 = $xml->TBL_StockInfo['HighJuka'];
$TBL_StockInfo9 = $xml->TBL_StockInfo['LowJuka'];
$TBL_StockInfo10 = $xml->TBL_StockInfo['High52'];
$TBL_StockInfo11 = $xml->TBL_StockInfo['Low52'];
$TBL_StockInfo12 = $xml->TBL_StockInfo['UpJuka'];
$TBL_StockInfo13 = $xml->TBL_StockInfo['DownJuka'];
$TBL_StockInfo14 = $xml->TBL_StockInfo['Per'];
$TBL_StockInfo15 = $xml->TBL_StockInfo['Amount'];
$TBL_StockInfo16 = $xml->TBL_StockInfo['FaceJuka'];

$CurJuka = str_replace(",", "",$TBL_StockInfo1);
$Debi = str_replace(",", "",$TBL_StockInfo3);
		if($TBL_StockInfo2 == '1'||$TBL_StockInfo2 == '2'||$TBL_StockInfo2 == '3'){
			$StandardPrice = $CurJuka - $Debi;
		} else if($TBL_StockInfo2 == '4'||$TBL_StockInfo2 == '5'){
			$StandardPrice = $CurJuka + $Debi;
		}
		// 등락률 = (당일종가 - 기준가) / 기준가 * 100
		// 기준가 = 당일종가(현재가) - 전일대비

if($StandardPrice == null)
{
	$DungRakrate = 0;
}
else
{
	$DungRakrate = (($CurJuka - $StandardPrice) / $StandardPrice) * 100;
}
//$DungRakrate = (($CurJuka - $StandardPrice) / $StandardPrice) * 100;
$DungRakrate_str = sprintf("%.2f", $DungRakrate);

// 호가
$Hoga0 = $xml->TBL_Hoga['mesuJan0'];
$Hoga1 = $xml->TBL_Hoga['mesuHoka0'];
$Hoga2 = $xml->TBL_Hoga['mesuJan1'];
$Hoga3 = $xml->TBL_Hoga['mesuHoka1'];
$Hoga4 = $xml->TBL_Hoga['mesuJan2'];
$Hoga5 = $xml->TBL_Hoga['mesuHoka2'];
$Hoga6 = $xml->TBL_Hoga['mesuJan3'];
$Hoga7 = $xml->TBL_Hoga['mesuHoka3'];
$Hoga8 = $xml->TBL_Hoga['mesuJan4'];
$Hoga9 = $xml->TBL_Hoga['mesuHoka4'];
$Hoga10 = $xml->TBL_Hoga['medoJan0'];
$Hoga11 = $xml->TBL_Hoga['medoHoka0'];
$Hoga12 = $xml->TBL_Hoga['medoJan1'];
$Hoga13 = $xml->TBL_Hoga['medoHoka1'];
$Hoga14 = $xml->TBL_Hoga['medoJan2'];
$Hoga15 = $xml->TBL_Hoga['medoHoka2'];
$Hoga16 = $xml->TBL_Hoga['medoJan3'];
$Hoga17 = $xml->TBL_Hoga['medoHoka3'];
$Hoga18 = $xml->TBL_Hoga['medoJan4'];
$Hoga19 = $xml->TBL_Hoga['medoHoka4'];
$Hoga21 = str_replace(",", "",$Hoga0) + str_replace(",", "",$Hoga2) + str_replace(",", "",$Hoga4) + str_replace(",", "",$Hoga6) + str_replace(",", "",$Hoga8);
$Hoga20 = str_replace(",", "",$Hoga10) + str_replace(",", "",$Hoga12) + str_replace(",", "",$Hoga14) + str_replace(",", "",$Hoga16) + str_replace(",", "",$Hoga18);

// 회원사별
$value_AskPrice = Count($xml->TBL_AskPrice->AskPrice);
for($i=0;$i<$value_AskPrice;$i++) {
$AskPrice[$i][0] = $xml->TBL_AskPrice->AskPrice[$i]['member_memdoMem'];
$AskPrice[$i][1] = $xml->TBL_AskPrice->AskPrice[$i]['member_memdoVol'];
$AskPrice[$i][2] = $xml->TBL_AskPrice->AskPrice[$i]['member_memsoMem'];
$AskPrice[$i][3] = $xml->TBL_AskPrice->AskPrice[$i]['member_mesuoVol'];
}

// 시간대별
$value_TBL_TimeConclude = Count($xml->TBL_TimeConclude->TBL_TimeConclude);
for($k=0;$k<$value_TBL_TimeConclude;$k++) {
$TBL_TimeConclude[$k][0] = $xml->TBL_TimeConclude->TBL_TimeConclude[$k]['time'];
$TBL_TimeConclude[$k][1] = $xml->TBL_TimeConclude->TBL_TimeConclude[$k]['negoprice'];
$TBL_TimeConclude[$k][2] = $xml->TBL_TimeConclude->TBL_TimeConclude[$k]['Dungrak'];
$TBL_TimeConclude[$k][3] = $xml->TBL_TimeConclude->TBL_TimeConclude[$k]['Debi'];
$TBL_TimeConclude[$k][4] = $xml->TBL_TimeConclude->TBL_TimeConclude[$k]['sellprice'];
$TBL_TimeConclude[$k][5] = $xml->TBL_TimeConclude->TBL_TimeConclude[$k]['buyprice'];
$TBL_TimeConclude[$k][6] = $xml->TBL_TimeConclude->TBL_TimeConclude[$k]['amount'];
}

// 일자별
$value_DailyStock = Count($xml->TBL_DailyStock->DailyStock);
for($j=0;$j<$value_DailyStock;$j++) {
$DailyStock[$j][0] = $xml->TBL_DailyStock->DailyStock[$j]['day_Date'];
$DailyStock[$j][1] = $xml->TBL_DailyStock->DailyStock[$j]['day_EndPrice'];
$DailyStock[$j][2] = $xml->TBL_DailyStock->DailyStock[$j]['day_Dungrak'];
$DailyStock[$j][3] = $xml->TBL_DailyStock->DailyStock[$j]['day_getDebi'];
$DailyStock[$j][4] = $xml->TBL_DailyStock->DailyStock[$j]['day_Start'];
$DailyStock[$j][5] = $xml->TBL_DailyStock->DailyStock[$j]['day_High'];
$DailyStock[$j][6] = $xml->TBL_DailyStock->DailyStock[$j]['day_Low'];
$DailyStock[$j][7] = $xml->TBL_DailyStock->DailyStock[$j]['day_Volume'];
$DailyStock[$j][8] = $xml->TBL_DailyStock->DailyStock[$j]['day_getAmount'];

if($TBL_StockInfo2=='1' || $TBL_StockInfo2=='2')
{
	$icon = "<i class='fas fa-arrow-up' style='font-size : 14px !important'>";
}
else if($TBL_StockInfo2=='3')
{
	$icon = "<i class='fas fa-equals' style='font-size : 14px !important'>";
}
else if($TBL_StockInfo2=='4' || $TBL_StockInfo2=='5')
{
	$icon = "<i class='fas fa-arrow-down' style='font-size : 14px !important'>";
}
}
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<script src="http://code.jquery.com/jquery-latest.min.js"></script>
<script src="http://asp1.krx.co.kr/inc/js/asp_chart.js"></script>
<script type="text/javascript" src="./js/common.js"></script>
<link rel="stylesheet" type="text/css" href="css/stockinfo.css"/>
</head>

<body>
<!--
	<div class="header-wrap">
	실시간 시세<span><span class="time_img"></span><?=$NowTime?> 기준(<?=$JangGubun?>)</span>
	</div>
	<div class="body-wrap">
		<div id="gpDisp"></div>
	
		<div class="data-lists">
			<dl>
				<dt><span></span>주가정보 <?=$NowTime?> 기준(<?=$JangGubun?>)</span></dt>
				<dd>
					<div class="main_stock_box1">
						<ul>
							<li>
								<div class="main_stock_box1_title">
									<?if($TBL_StockInfo0){ ?>
									<ul>			
										<li class="main_stock_box1_title1">A<?=$JongCd?><span><?=$TBL_StockInfo0?></span></li>
										<li class="main_stock_box1_title2"><span class="CurJuka">현재가</span><?=$TBL_StockInfo1?></li>
									</ul>
									<ul>
										<li class="main_stock_box1_contn"><span class="title">전일대비</span>
										<span>
										<?if($TBL_StockInfo2=='1' || $TBL_StockInfo2=='2'){ ?>
										<span class="up">
										<?=$up?><?=$TBL_StockInfo3?>(<?=$DungRakrate_str?>%)
										</span>
										<? } ?>
										<?if($TBL_StockInfo2=='3'){ ?>
										<span class="bohab">
										<?=$bohab?><?=$TBL_StockInfo3?>(<?=$DungRakrate_str?>%)
										</span>
										<? } ?>
										<?if($TBL_StockInfo2=='4' || $TBL_StockInfo2=='5'){ ?>
										<span class="down">
										<?=$down?><?=$TBL_StockInfo3?>(<?=$DungRakrate_str?>%)
										</span>	
										<? } ?>
										</span>
										</li>
										<li class="main_stock_box1_contn"><span class="title">거래량</span>
										<span><?=$TBL_StockInfo5?></span>
										</li>
										<li class="main_stock_box1_contn"><span class="title">거래대금</span>
										<span><?=$TBL_StockInfo6?></span>
										</li>
									</ul>
									<?}?>
								</div>
							</li>
						</ul>
					</div>
					
					
					
					
					<div class="main_stock_box2">
					<table id="stockInfo">
						<tr>
							<th>시가</th>
							<td><?=$TBL_StockInfo7?></td>
							<th colspan="2">상한가</th>
							<td><?=$TBL_StockInfo12?></td>
						</tr>
						<tr>
							<th>고가</th>
							<td><?=$TBL_StockInfo8?></td>
							<th colspan="2">하한가</th>
							<td><?=$TBL_StockInfo13?></td>
						</tr>
						<tr>
							<th>저가</th>						
							<td><?=$TBL_StockInfo9?></td>
							<th colspan="2">액면가</th>
							<td><?=$TBL_StockInfo16?></td>
						</tr>
						<tr>
							<th>PER</th>
							<td><?=$TBL_StockInfo14?></td>
							<th rowspan="2" style="border-bottom:1px solid #dbdbdb;">52주<br>(종가기준)</th>
							<th>최고</th>
							<td><?=$TBL_StockInfo10?></td>
						</tr>
						<tr>
							<th>상장주식수</th>
							<td><?=$TBL_StockInfo15?></td>
							<th>최저</th>
							<td><?=$TBL_StockInfo11?></td>
						</tr>
					</table>
					</div>
					
				</dd>
			</dl>
			<ul class="tabs">
		    	<li><a href="#tab1">호가</a></li>
		   		<li><a href="#tab2">시간대별체결가</a></li>
		   		<li><a href="#tab3">회원사별거래</a></li>
		   		<li><a href="#tab4">일자별시세</a></li>
			</ul> 
			
			<dl>
				<dt><span></span>호가</dt>
				<dd>
					<div class="tab_container">
						<div id="tab1" class="tab_content">
							<table id="Hoga">
								<tr>
									<th>매도잔량</th>
									<th>호가</th>
									<th>매수잔량</th>
								</tr>
								<? if($Hoga0) {?>
									<tr>
										<td><?=$Hoga10?></td>
										<td><?=$Hoga11?></td>
										<td></td>
									</tr>
									<tr>
										<td><?=$Hoga12?></td>
										<td><?=$Hoga13?></td>
										<td></td>
									</tr>
									<tr>
										<td><?=$Hoga14?></td>
										<td><?=$Hoga15?></td>
										<td></td>
									</tr>
									<tr>
										<td><?=$Hoga16?></td>
										<td><?=$Hoga17?></td>
										<td></td>
									</tr>
									<tr>
										<td><?=$Hoga18?></td>
										<td><?=$Hoga19?></td>
										<td></td>
									</tr>
									<tr>
										<td></td>
										<td><?=$Hoga1?></td>
										<td><?=$Hoga0?></td>
									</tr>
									<tr>
										<td></td>
										<td><?=$Hoga3?></td>
										<td><?=$Hoga2?></td>
									</tr>
									<tr>
										<td></td>
										<td><?=$Hoga5?></td>
										<td><?=$Hoga4?></td>
									</tr>
									<tr>
										<td></td>
										<td><?=$Hoga7?></td>
										<td><?=$Hoga6?></td>
									</tr>
									<tr>
										<td></td>
										<td><?=$Hoga9?></td>
										<td><?=$Hoga8?></td>
									</tr>
									<tr>
										<td><?=number_format($Hoga20)?></td>
										<td>잔량합계</td>
										<td><?=number_format($Hoga21)?></td>
									</tr>
								<?} else {?>
									<tr>
										<td colspan="3">데이터가 없습니다.</td>
									</tr>
								<?} ?>
							</table>
						</div>
					</div>
				</dd>
			</dl>
			<dl>
				<dt><span></span>시간대별체결가</dt>
				<dd>
					<div class="tab_container">
						<div id="tab2" class="tab_content">
							<table>
								<tr>
									<th>시간</th>
									<th>체결가</th>
									<th>전일대비</th>
									<th>매도호가</th>
									<th>매수호가</th>
									<th>매수잔량</th>
								</tr>
								<?if($value_TBL_TimeConclude > 0){ ?>
								<?for($k=0; $k<$value_TBL_TimeConclude;$k++) {?>
									<tr>
										<td><?=$TBL_TimeConclude[$k][0]?></td>
										<td><?=$TBL_TimeConclude[$k][1]?></td>
										<td><?if($TBL_TimeConclude[$k][2]=="1"||$TBL_TimeConclude[$k][2]=="2"){ ?><span class="up"><?=$up?></span><?} ?><?if($TBL_TimeConclude[$k][2]=="3"){ ?><span class="bohab"><?=$bohab?></span><?} ?><?if($TBL_TimeConclude[$k][2]=="4"||$TBL_TimeConclude[$k][2]=="5"){ ?><span class="down"><?=$down?></span><?} ?><?=$TBL_TimeConclude[$k][3]?></td>
										<td><?=$TBL_TimeConclude[$k][4]?></td>
										<td><?=$TBL_TimeConclude[$k][5]?></td>
										<td><?=$TBL_TimeConclude[$k][6]?></td>
									</tr>
									<?} ?>
								<?} else {?>
									<tr>
										<td colspan="6">데이터가 없습니다.</td>
									</tr>
								<?} ?>
							</table>
						</div>
					</div>
				</dd>
			</dl>
			<dl>
				<dt><span></span>회원사별거래</dt>
				<dd>
					<div class="tab_container">
						<div id="tab3" class="tab_content">
							<table id="member_trade">
							<tr>
								<th colspan="2">매도상위</th>
								<th colspan="2">매수상위</th>
							</tr>
							<tr>
								<th>증권사</th>
								<th>거래량</th>
								<th>증권사</th>
								<th>거래량</th>
							</tr>
							<?if($value_AskPrice > 0){ ?>
							<?for($i=0; $i<$value_AskPrice;$i++) {?>
							<tr>
								<td><?=$AskPrice[$i][0]?></td>
								<td><?=$AskPrice[$i][1]?></td>
								<td><?=$AskPrice[$i][2]?></td>
								<td><?=$AskPrice[$i][3]?></td>
							</tr>
							<?} ?>
							<?} else {?>
							<tr>
								<td colspan="4">데이터가 없습니다.</td>
							</tr>
							<?} ?>
							</table>
						</div>
					</div>
				</dd>
			</dl>
			<dl>
				<dt><span></span>일자별시세</dt>
				<dd>
					<div class="tab_container">
						<div id="tab4" class="tab_content">
							<table id="tradedPrice_day">
								<tr>
									<th>일자</th>
									<th>종가</th>
									<th>전일대비</th>
									<th>시가</th>
									<th>고가</th>
									<th>저가</th>
									<th>거래량</th>
									<th>거래대금</th>
								</tr>
								<?if($value_DailyStock > 0){ ?>
								<?for($j=0; $j<$value_DailyStock;$j++) {?>
									<tr>
										<td><?=$DailyStock[$j][0]?></td>
										<td><?=$DailyStock[$j][1]?></td>
										<td><?if($DailyStock[$j][2]=="1"||$DailyStock[$j][2]=="2"){ ?><span class="up"><?=$up?></span><?} ?><?if($DailyStock[$j][2]=="3"){ ?><span class="bohab"><?=$bohab?></span><?} ?><?if($DailyStock[$j][2]=="4"||$DailyStock[$j][2]=="5"){ ?><span class="down"><?=$down?></span><?} ?><?=$DailyStock[$j][3]?></td>
										<td><?=$DailyStock[$j][4]?></td>
										<td><?=$DailyStock[$j][5]?></td>
										<td><?=$DailyStock[$j][6]?></td>
										<td><?=$DailyStock[$j][7]?></td>
										<td><?=$DailyStock[$j][8]?></td>
									</tr>
									<?} ?>
									<?} else {?>
									<tr>
										<td colspan="8">데이터가 없습니다.</td>
									</tr>
								<?} ?>
							</table>
						</div>
					</div>
				</dd>
			</dl>
			
		</div>
	</div>
	<div class="footer-wrap"></div>
	-->
</body>
</html>