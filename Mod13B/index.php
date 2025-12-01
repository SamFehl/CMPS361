<html>
    <head>
        <title>A Guide to Sams</title>
        <link rel="stylesheet" href="./css/stylesheet.css">
        <script src="./js/bot.js" defer></script>
    </head>
    <body>
        <!-- Main content -->
        <div class="paragraphs">
            <h1>A Guide to Sams</h1>

            <h2>"Help, there are two Sams in my class!"</h2>
            <p>
                Don't panic. Multiple Sams in one class is a common natural phenomenon, much like 
                spotting two squirrels fighting over the same acorn or two people wearing the exact 
                same outfit at Target. Academically speaking, the average class can sustain up to 
                2.5 Sams before the ecosystem collapses. If you find yourself surrounded by more 
                than two Sams, stay calm, maintain eye contact with the Sam you intend to summon, 
                and for the love of group projects, be specific.
            </p>

            <h2>Telling Your Sams Apart</h2>
            <p>
                Distinguishing between Sams is more art than science. Some Sams can be identified 
                by their unique plumage: perhaps curly hair, a backwards hat, or that one hoodie 
                they've worn every day since orientation week. Other Sams display behavioral clues: 
                one might always walk into class five minutes early, while the other slides in at the 
                exact moment the professor says, “Okay, let's get started.” You can also use context 
                clues. When in doubt, just guess; you have a 50/50 chance.
            </p>

            <h2>Grading Your Sams</h2>
            <p>
                Sams should always receive an A+ no matter what.
            </p>
        </div>    

        <!-- Chatbot widget (overlays page) -->
        <div class="chat-widget">
            <!-- Small button that appears after 10 seconds and can be clicked -->
            <button id="chat-toggle">
                💬 Chat with SamsGPT
            </button>

            <!-- Popup chat window -->
            <div id="chat-popup">
                <div class="chat-container">
                    <div class="chat-header">
                        <h1>SamsGPT</h1>
                        <button id="chat-close" aria-label="Close chat">&times;</button>
                    </div>

                    <div id="chatbot">
                        <div id="messages"></div>
                    </div>

                    <form id="chat-form" method="POST">
                        <input type="text" name="user_input" id="user_input" placeholder="Ask me something about Sams." required>
                        <button type="submit">Send</button>
                    </form>

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
                </div>
            </div>
        </div>
    </body>
</html>
