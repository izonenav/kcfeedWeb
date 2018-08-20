<!doctype html>
<?
include "../admin/inc/config.php"; 
include "../admin/inc/mysql.inc.php"; 


$db = new Mysql();

$seq = $_GET["seq"];

if($seq > 0)
{
	$db->que = " SELECT * FROM board WHERE seq =".$seq;
	$db->query();
	$row = $db->getRow();
	$value = $row["content"];
}
?>
<html>
<head>
<meta charset="utf-8" />
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">

<script type="text/javascript" src="./nse_files/js/HuskyEZCreator.js" charset="utf-8"></script>
<script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<title>관리자페이지</title>
<style>
.nse_content{width:660px;height:500px}
</style>
</head>
<body>
    <form name="nse" action="post/addDbPost.php" method="post" style="padding : 20px;">
		<div class="form-check form-check-inline">
		  <input class="form-check-input" type="radio" name="gubun" value="notice">
		  <label class="form-check-label">공지사항</label>
		</div>
		<div class="form-check form-check-inline">
		  <input class="form-check-input" type="radio" name="gubun" value="growth">
		  <label class="form-check-label">사양관리</label>
		</div>
		<div class="form-check form-check-inline">
		  <input class="form-check-input" type="radio" name="gubun" value="disease">
		  <label class="form-check-label">질병관리</label>
		</div>
		<input type="text" name="subject" class="form-control" style="width:660px;" placeholder="제목"/>
		<textarea name="ir1" id="ir1" class="nse_content" value=<?=$value?> ></textarea>
	<script type="text/javascript">
var oEditors = [];
nhn.husky.EZCreator.createInIFrame({
    oAppRef: oEditors,
    elPlaceHolder: "ir1",
    sSkinURI: "./nse_files/SmartEditor2Skin.html",
    fCreator: "createSEditor2"
});
function submitContents(elClickedObj) {
    // 에디터의 내용이 textarea에 적용됩니다.
    oEditors.getById["ir1"].exec("UPDATE_CONTENTS_FIELD", []);
    // 에디터의 내용에 대한 값 검증은 이곳에서 document.getElementById("ir1").value를 이용해서 처리하면 됩니다.
 
    try {
        elClickedObj.form.submit();
    } catch(e) {}
}
</script>
    <input type="submit" value="전송" onclick="submitContents(this)" class="btn btn-primary" />
</form>
</body>

</html>