<html>
    <head>
        <title>SamsGPT</title>
        <link rel="stylesheet" href="./css/stylesheet.css">
        <script src="./js/bot.js" defer></script>
    </head>
    <body>
        <div class="chat-container">
            <h1>SamsGPT</h1>
            <div id="chatbot">
                <div id="messages"></div>
            </div>
            <form id="chat-form" method="POST">
                <input type="text" name="user_input" id="user_input" placeholder="Ask me something about Sams." required>
                <button type="submit">Send</button>
            </form>
        </div>

        <div class="suggested-questions">
            <h2>Suggested Questions</h2>
            <p>
                <span class="suggestion">1. Who is Sam?</span><br>
                <span class="suggestion">2. Who is Sam A?</span><br>
                <span class="suggestion">3. Who is Sam F?</span><br>
                <span class="suggestion">4. How many Sams are there?</span><br>
                <span class="suggestion">5. Is Sam involved on campus?</span><br>
                <span class="suggestion">6. What does Sam do for work?</span><br>
                <span class="suggestion">7. Can you describe Sam?</span><br>
                <span class="suggestion">8. Has Sam gone on any vacations recently?</span><br>
                <span class="suggestion">9. Are the Sams even different?</span><br>
                <span class="suggestion">10. How are the Sams different?</span><br>
                <span class="suggestion">11. Can Sam do my homework?</span>
            </p>
        </div>
    </body>
</html>