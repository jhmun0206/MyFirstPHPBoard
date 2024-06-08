<?php
//include $_SERVER['DOCUMENT_ROOT']."db.php";
require "/Applications/XAMPP/xamppfiles/htdocs/MyBoardProject/db.php";

$bno = $_GET['idx'];
$username = $_POST['name'];
$userpw = password_hash($_POST['pw'], PASSWORD_DEFAULT);
$title = $_POST['title'];
$content = $_POST['content'];

// MySQLi를 사용하여 준비된 명령문 생성
$stmt = $conn->prepare("UPDATE MyBoard SET name=?, pw=?, title=?, content=? WHERE idx=?");
$stmt->bind_param("ssssi", $username, $userpw, $title, $content, $bno);

// 명령문 실행
$stmt->execute();

// 명령문 닫기
$stmt->close();

// 데이터베이스 연결 닫기
$conn->close();

?>
<script type="text/javascript">alert("수정되었습니다.");</script>
<meta http-equiv="refresh" content="0; url=/MyBoardProject/read.php?idx=<?php echo $bno; ?>">
