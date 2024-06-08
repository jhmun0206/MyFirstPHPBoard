<?php
//include $_SERVER['DOCUMENT_ROOT']."/db.php"; // 데이터베이스 연결 파일 포함
require "/Applications/XAMPP/xamppfiles/htdocs/MyBoardProject/db.php";

global $conn;

var_dump($conn);

// 데이터베이스 연결 확인
if ($conn->connect_error) {
    die('데이터베이스 연결 실패: ' . $conn->connect_error);
} else {
    echo '데이터베이스 연결 성공<br>';
}

// POST에서 입력 값을 변수에 저장
$username = $_POST['name'];
$userpw = password_hash($_POST['pw'], PASSWORD_DEFAULT); // 비밀번호 해시
$title = $_POST['title'];
$content = $_POST['content'];
$date = date('Y-m-d'); // 현재 날짜

// 모든 입력 값이 제공되었는지 확인
if($username && $userpw && $title && $content){
    // SQL 쿼리 준비
    $sql = "insert into MyBoard(name, pw, title, content, date) values(?,?,?,?,?)";

    // SQL 인젝션을 방지하기 위해 준비된 명령문 사용
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die('준비된 명령문 생성 실패: ' . $conn->error);
    }

    $stmt->bind_param("sssss", $username, $userpw, $title, $content, $date); // 's'는 변수 유형이 문자열임을 의미

    // 쿼리 실행 결과 확인
    if($stmt->execute()){ // 쿼리 실행
        $alterResult = $conn->query("ALTER TABLE MyBoard AUTO_INCREMENT = 1");
        if ($alterResult === false) {
            die('AUTO_INCREMENT 설정 실패: ' . $conn->error);
        }
        echo "<script>
        alert('글쓰기 완료되었습니다.');
        location.href='index.php';</script>";
    } else {
        // 쿼리 실행 실패 시 디버깅 메시지 출력
        echo "Error: " . $stmt->error . "<br>";
        echo "<script>
        alert('글쓰기에 실패했습니다.');
        history.back();</script>";
    }
    
    // $stmt가 null이 아닐 경우에만 close() 메서드 호출
    if ($stmt != null) {
        $stmt->close();
    }
} else {
    echo "<script>
    alert('모든 필드를 채워주세요.');
    history.back();</script>";
}

// 데이터베이스 연결 종료
$conn->close();
?>
