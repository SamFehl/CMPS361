<?php 
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if(!isset($_SESSION['session_id'])){
        $_SESSION['session_id'] = bin2hex(random_bytes(16));
    }

    //DB Conn and Tracking Helper for all pages
    require_once __DIR__ . '/conn.php';
    require_once __DIR__ . '/helper.php';

    $currentSessionId = $_SESSION['session_id'];
    $currentUserId = $_SESSION['user_id'] ?? null;

    //Track sessions -> require_once __DIR__ . '/bootstrap.php';
    updateSession($pdo, $currentSessionId, $currentUserId);
    logPageView($pdo, $currentSessionId, $currentUserId);
?>