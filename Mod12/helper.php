<?php 
    function updateSession(PDO $pdo, string $sessionId, ?int $userId): void {
        $ip = $_SERVER['REMOTE_ADDR'] ?? NULL;
        $ua = $_SERVER['HTTP_USER_AGENT'] ?? NULL;

        $sql = "
            INSERT INTO web_sessions(session_id, user_id, ip_address, user_agent)
            VALUES(:session_id, :user_id, :ip, :ua)
            ON CONFLICT (session_id) DO UPDATE
            SET last_seen_at = NOW(),
                user_id = COALESCE(EXCLUDED.user_id, web_sessions.user_id)
        ";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':session_id' => $sessionId,
            ':user_id' => $userId,
            ':ip' => $ip,
            ':ua' => $ua
        ]);  
    }

    function logPageView(PDO $pdo, string $sessionId, ?int $userId): void {
        $path = $_SERVER['REQUEST_URI'] ?? '/';
        $method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
        $referrer = $_SERVER['HTTP_REFERRER'] ?? NULL;
        $statusCode = http_response_code();

        $sql = "
            INSERT INTO page_views(session_id, user_id, path, http_method, referrer, status_code)
            VALUES(:session_id, :user_id, :path, :method, :referrer, :status_code)
        ";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':session_id' => $sessionId,
            ':user_id' => $userId,
            ':path' => $path,
            ':method' => $method,
            ':referrer' => $referrer,
            ':status_code' => $statusCode,
        ]);

    }


?>