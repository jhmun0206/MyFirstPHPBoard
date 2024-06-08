<?php
$host = 'localhost';
$port = 3306;
$user = 'root';
$password = 'votmdnjem1';
$dbname = 'my_db'; // 실제 데이터베이스 이름으로 변경

// 데이터베이스 연결
global $conn;
$conn = new mysqli($host, $user, $password, $dbname, $port);

// 연결 확인
if ($conn->connect_error) {
    die('데이터베이스 접속 실패: ' . $conn->connect_error);
}

// 문자셋 설정
if (!$conn->set_charset("utf8")) {
    die('문자셋 설정 실패: ' . $conn->error);
}

// 쿼리 함수 정의
function query($sql) {
    global $conn;
    $result = $conn->query($sql);
    if ($result === false) {
        die('쿼리 오류: ' . $conn->error);
    }
    return $result;
}


// 성공 메시지
//echo "데이터베이스 연결 및 설정 성공";
//var_dump($conn);
?>
