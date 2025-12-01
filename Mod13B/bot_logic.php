<?php 
    //Database Connection
    $dsn = 'pgsql:host=localhost;port=5432;dbname=stats;';
    $user = 'postgres';
    $pass = '@gL21384';

    try {
        $pdo = new PDO($dsn, $user, $pass, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);
    } catch (PDOException $e) {
        error_log("DB Connection Failed: " . $e->getMessage());
        die("Database error");
    }

    //Logic
    if (isset($_POST['user_input'])) {
        $user_input = trim($_POST['user_input']);
        $stmt = $pdo->prepare("SELECT answer FROM questions_answers WHERE question ILIKE :question");
        $stmt->execute([':question' => '%' . $user_input . '%']);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        //conditional statement
        if ($result) {
            echo $result['answer'];
        } else {
            echo "Sorry, I do not know the answer to that. Ask another Sam.";
        }
    }

?>