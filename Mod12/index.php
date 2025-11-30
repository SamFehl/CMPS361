<?php 
    session_start();

    require_once __DIR__ . '/bootstrap.php';

    //Ensure Tracking Session ID Exists
    if(!isset($_SESSION['session_id'])){
        $_SESSION['session_id'] = bin2hex(random_bytes(16));
    }

    $currentSessionId = $_SESSION['session_id'];
    $currentUserId = $_SESSION['user_id'] ?? null;

    //updateSession($pdo, $currentSessionId, $currentUserId);

?>

<html>
    <head>
        <title>Home</title>
        <style>
            :root {
                --color1: #CFBAE1; /* light purple */
                --color2: #3A5683; /* deep blue */
                --color3: #FC9E4F; /* orange accent */
                --color4: #61C9A8; /* mint green */
                --color5: #BA3B46; /* red accent */
                --color6: #a4a4a4; /* gray */
                --color7: #2E4756; /* dark blue-gray */
                --color8: #16262E; /* near black background */
                --color9: #3C7A89; /* teal */
            }

            /* Global Page Layout */
            body {
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                margin: 0;
                background-color: var(--color8);
                color: var(--color1);
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
            }

            h1 {
                color: var(--color4);
                font-size: 2.5rem;
                margin-bottom: 25px;
                text-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
                letter-spacing: 0.04em;
            }

            /* Image Link Styling */
            a img {
                border-radius: 12px;
                width: 300px;
                box-shadow: 0 5px 20px rgba(0, 0, 0, 0.45);
                transition: transform 0.3s ease, box-shadow 0.3s ease;
                cursor: pointer;
            }

            a img:hover {
                transform: scale(1.06);
                box-shadow: 0 8px 28px rgba(0, 0, 0, 0.55);
            }

            /* Mobile Responsiveness */
            @media (max-width: 768px) {
                h1 {
                    font-size: 2rem;
                }
                a img {
                    width: 240px;
                }
            }
        </style>
    </head>
    <body>
        <center>
            <h1>Welcome to My App</h1>
            <a href="./metrics.php">
                <img src="./img/metrics.png" style="width:300px;">
            </a>
        </center>
    </body>
</html>