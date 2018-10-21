<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once 'backend/LeaderBoardDao.php';

$leaderboardDao = new LeaderBoardDao();
$leaderboard = $leaderboardDao->getLeaderboard();
http_response_code(200);
print json_encode($leaderboard,JSON_UNESCAPED_SLASHES);	

?>