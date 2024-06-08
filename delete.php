<?php
require "/Applications/XAMPP/xamppfiles/htdocs/MyBoardProject/db.php";
	
$bno = $_GET['idx'];
$sql = query("delete from MyBoard where idx='$bno';");
?>
<script type="text/javascript">alert("삭제되었습니다.");</script>
<meta http-equiv="refresh" content="0 url=index.php" />
