<?php
//include $_SERVER['DOCUMENT_ROOT'] . 'db.php';
include 'db.php';
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

// // 디버깅 코드: 연결 확인
// if (isset($conn)) {
//     echo "데이터베이스 연결이 설정되었습니다.<br>";
// } else {
//     echo "데이터베이스 연결이 설정되지 않았습니다.<br>";
// }

// // 디버깅 코드: 함수 확인
// if (function_exists('query')) {
//     echo "쿼리 함수가 정의되었습니다.<br>";
// } else {
//     echo "쿼리 함수가 정의되지 않았습니다.<br>";
// }

// 데이터베이스에서 데이터 가져오기
// $result = query("SELECT * FROM MyBoard");
// if ($result->num_rows > 0) {
//     while($row = $result->fetch_assoc()) {
//         echo "idx: " . $row["idx"]. " - 이름: " . $row["name"]. " - 제목: " . $row["title"]. " - 내용: " . $row["content"]. " - 날짜: " . $row["date"]. " - 조회수: " . $row["hit"]. "<br>";
//     }
// } else {
//     echo "결과가 없습니다.";
// }
?>

<!Doctype html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>게시판</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
<div id="board_area">
    <h1>자유게시판</h1>
    <h4>자유롭게 글을 쓸 수 있는 게시판입니다.</h4>
    <div id="write_btn">
        <a href="write.php"><button>글쓰기</button></a>
    </div>
    <table class="list-table">
        <thead>
        <tr>
            <th width="70">번호</th>
            <th width="500">제목</th>
            <th width="120">글쓴이</th>
            <th width="100">작성일</th>
            <th width="100">조회수</th>
        </tr>
        </thead>
        <?php
        // board테이블에서 idx를 기준으로 내림차순해서 10개까지 표시
        $sql = query("select * from MyBoard order by idx desc limit 0,10");
        while($board = $sql->fetch_array())
        {
            //title변수에 DB에서 가져온 title을 선택
            $title=$board["title"];
            if(strlen($title)>30)
            {
                //title이 30을 넘어서면 ...표시
                $title=mb_substr($board["title"],0,30,"utf-8")."...";}
            ?>
            <tbody>
            <tr>
                <td width="70"><?php echo $board['idx']; ?></td>
                <td width="500"><a href="/MyBoardProject/read.php?idx=<?php echo $board["idx"];?>"><?php echo $title;?></a></td>
                <td width="120"><?php echo $board['name']?></td>
                <td width="100"><?php echo $board['date']?></td>
                <td width="100"><?php echo $board['hit']; ?></td>
            </tr>
            </tbody>
        <?php } ?>
    </table>
</div>
</body>
</html>