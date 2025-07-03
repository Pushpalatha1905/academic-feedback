<?php
session_start();
include('../config/db.php');

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'student') {
    header("Location: ../login.php");
    exit();
}

$student = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Student Dashboard</title>
    <style>
        body {
            margin: 0;
            background: #f0f2f5;
            font-family: 'Segoe UI', sans-serif;
            transition: background 0.4s ease, color 0.4s ease;
        }

        .card,
        label,
        select,
        input,
        textarea,
        button {
            transition: all 0.3s ease;
        }


        .sidebar {
            width: 200px;
            background-color: #111827;
            color: #facc15;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            padding: 20px;
        }

        .sidebar h3 {
            margin: 0;
            font-size: 1.5rem;
            margin-bottom: 30px;
        }

        .sidebar a {
            display: block;
            color: white;
            margin: 12px 0;
            text-decoration: none;
            transition: all 0.3s ease;
            padding: 8px 10px;
            border-radius: 6px;
        }

        .sidebar a:hover {
            background-color: #374151;
        }

        main {
            margin-left: 220px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .card {
            background: #ffffff;
            padding: 50px 60px;
            border-radius: 20px;
            box-shadow: 10px 10px 25px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 650px;
            font-size: 1.1rem;
            transition: all 0.3s ease;
        }

        h2 {
            font-size: 2rem;
            margin-bottom: 25px;
            font-size: 2.4rem;
        }

        p {
            font-size: 1.1rem;
            margin: 10px 0;
            color: #444;
        }

        .btn {
            display: inline-block;
            padding: 14px 24px;
            margin: 10px 5px;
            border-radius: 12px;
            text-decoration: none;
            font-weight: bold;
            font-size: 1rem;
            transition: background 0.3s ease, transform 0.2s ease;
        }

        .btn-feedback {
            background-color: #4CAF50;
            color: white;
        }

        .btn-logout {
            background-color: #f44336;
            color: white;
        }

        .btn:hover {
            transform: scale(1.05);
        }

        .emoji {
            font-size: 2.6rem;
        }

        #helpTooltip,
        #settingsPanel {
            display: none;
            position: absolute;
            background-color: #1e1e1e;
            color: white;
            padding: 15px;
            border-radius: 10px;
            max-width: 250px;
            z-index: 1000;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        #helpTooltip {
            top: 150px;
            left: 220px;
        }

        #settingsPanel {
            top: 100px;
            right: 40px;
            background-color: #ffffff;
            color: black;
        }

        #settingsPanel select,
        #settingsPanel input {
            margin-top: 5px;
        }
    </style>
</head>

<body>

    <div class="sidebar">
        <h3>AFS ▼</h3>
        <a href="../index.php">Login Page</a>
        <a href="#" onclick="toggleHelp()">Help</a>
        <a href="#" onclick="toggleSettings()">Settings</a>
        <a href="#" onclick="showUtility()">Utilities</a>
    </div>

    <main>
        <div class="card">
            <h2 class="emoji">🎓 Welcome, <?= htmlspecialchars($student['name']) ?></h2>
            <p>📘 Branch: <strong><?= htmlspecialchars($student['branch']) ?></strong></p>
            <p>📅 Year: <strong><?= htmlspecialchars($student['year']) ?></strong></p>

            <a class="btn btn-feedback" href="submit_feedback.php">📝 Submit Feedback</a>
            <a href="../logout.php" class="btn btn-logout">🔴 Logout</a>
        </div>
    </main>

    <!-- Help Tooltip -->
    <div id="helpTooltip">
        <strong>📘 Tips:</strong>
        <ul style="margin-top: 10px; padding-left: 18px;">
            <li>Use Submit Feedback to rate faculty.</li>
            <li>All data is stored securely.</li>
            <li>You can change layout via Settings.</li>
        </ul>
    </div>

    <!-- Settings Panel -->
    <div id="settingsPanel">
        <h4>⚙ Settings</h4>
        <label for="themeSelect">Theme:</label><br>
        <select id="themeSelect" onchange="changeTheme(this.value)">
            <option value="light">Light</option>
            <option value="dark">Dark</option>
        </select><br><br>

        <label for="textSize">Text Size:</label><br>
        <input type="range" id="textSize" min="12" max="24" value="16" onchange="adjustTextSize(this.value)">
    </div>

    <script>
        function toggleHelp() {
            const help = document.getElementById("helpTooltip");
            help.style.display = (help.style.display === "none" || help.style.display === "") ? "block" : "none";
        }

        function toggleSettings() {
            const settings = document.getElementById("settingsPanel");
            settings.style.display = (settings.style.display === "none" || settings.style.display === "") ? "block" : "none";
        }

        function showUtility() {
            alert("🛠 Utilities:\n- View Profile\n- Change Password\n- Update Preferences\nMore tools coming soon!");
        }

        function adjustTextSize(size) {
            document.body.style.fontSize = size + "px";
            document.querySelectorAll('.card, label, select, textarea, input, button').forEach(el => {
                el.style.fontSize = size + "px";
            });
        }

        function changeTheme(theme) {
            if (theme === "dark") {
                document.body.style.backgroundColor = "#121212";
                document.body.style.color = "#f0f0f0";
            } else {
                document.body.style.backgroundColor = "#f0f2f5";
                document.body.style.color = "#000000";
            }
        }
    </script>

</body>

</html>