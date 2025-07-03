<?php
session_start();
include('../config/db.php');

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'student') {
    header("Location: ../login.php");
    exit();
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $student_id = $_SESSION['user']['id'];
    $subject_id = $_POST['subject_id'] ?? '';
    $faculty_id = $_POST['faculty_id'] ?? '';
    $rating     = $_POST['rating'] ?? '';
    $comments   = $_POST['comments'] ?? '';

    $stmt = $conn->prepare("SELECT id FROM subjects WHERE id = ?");
    $stmt->bind_param("i", $subject_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $row = $result->fetch_assoc()) {
        $stmt = $conn->prepare("INSERT INTO feedback (student_id, faculty_id, subject_id, rating, comments) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("iiiis", $student_id, $faculty_id, $subject_id, $rating, $comments);

        if ($stmt->execute()) {
            echo "<script>alert('✅ Feedback submitted successfully!'); window.location.href = 'dashboard.php';</script>";
            exit();
        } else {
            $message = "❌ Error submitting feedback: " . $stmt->error;
        }
    } else {
        $message = "❌ Invalid subject selected.";
    }

    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Submit Feedback</title>
    <style>
        :root {
            --base-font-size: 16px;
        }

        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            font-size: var(--base-font-size);
            background-color: #eef2f7;
            display: flex;
        }

        .sidebar {
            width: 220px;
            background: #0f172a;
            color: white;
            padding-top: 30px;
            height: 100vh;
            position: fixed;
            left: 0;
        }

        .sidebar h2 {
            text-align: center;
            color: orange;
            margin-bottom: 30px;
        }

        .sidebar a {
            display: block;
            padding: 12px 25px;
            color: white;
            text-decoration: none;
            transition: background 0.3s;
        }

        .sidebar a:hover {
            background: #1e293b;
        }

        .main {
            margin-left: 240px;
            padding: 40px;
            width: 100%;
        }

        .form-card {
            background: #fff;
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: auto;
        }

        .form-card h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
            display: block;
            margin-top: 12px;
        }

        select,
        input[type=number],
        textarea {
            width: 100%;
            padding: 10px;
            margin-top: 6px;
            margin-bottom: 15px;
            border-radius: 6px;
            border: 1px solid #ccc;
        }

        input[type=submit] {
            background-color: #4CAF50;
            color: white;
            font-weight: bold;
            border: none;
            padding: 12px;
            width: 100%;
            border-radius: 6px;
            cursor: pointer;
        }

        input[type=submit]:hover {
            background-color: #43a047;
        }

        .settings-panel {
            position: fixed;
            top: 100px;
            right: 30px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            padding: 20px;
            width: 200px;
            display: block;
        }

        .tips {
            position: fixed;
            top: 100px;
            left: 260px;
            background: #1e293b;
            color: white;
            padding: 15px;
            border-radius: 8px;
            font-size: 14px;
        }

        .tips strong {
            display: block;
            margin-bottom: 6px;
        }
    </style>
    <script>
        function loadFaculty(subjectId) {
            if (subjectId === "") {
                document.getElementById("faculty_id").innerHTML = "<option value=''>-- Choose Faculty --</option>";
                return;
            }
            const xhr = new XMLHttpRequest();
            xhr.open("GET", "get_faculty.php?subject_id=" + subjectId, true);
            xhr.onload = function() {
                if (this.status === 200) {
                    document.getElementById("faculty_id").innerHTML = this.responseText;
                }
            };
            xhr.send();
        }

        function changeTextSize(value) {
            document.documentElement.style.setProperty('--base-font-size', value + 'px');
        }
    </script>
</head>

<body>
    <div class="sidebar">
        <h2>AFS ▾</h2>
        <a href="../index.php">Login Page</a>
        <a href="#" onclick="document.querySelector('.tips').style.display='block'">Help ▸</a>
        <a href="#" onclick="document.querySelector('.settings-panel').style.display='block'">Settings</a>
        <a href="#" onclick="alert('🛠 Utilities include shortcuts and usage info!')">Utilities</a>
    </div>
    <div class="main">
        <div class="form-card">
            <h2>📝 Submit Feedback</h2>
            <?php if ($message): ?>
                <p style="color: red; text-align:center;"> <?= $message ?> </p>
            <?php endif; ?>
            <form method="POST" action="">
                <label for="subject_id">Subject:</label>
                <select name="subject_id" id="subject_id" onchange="loadFaculty(this.value)" required>
                    <option value="">-- Select Subject --</option>
                    <?php
                    $query = "SELECT id, subject_name FROM subjects";
                    $result = $conn->query($query);
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='{$row['id']}'>{$row['subject_name']}</option>";
                    }
                    ?>
                </select>
                <label for="faculty_id">Faculty:</label>
                <select name="faculty_id" id="faculty_id" required>
                    <option value="">-- Choose Faculty --</option>
                </select>
                <label for="rating">Rating (1 to 5):</label>
                <input type="number" name="rating" min="1" max="5" required>
                <label for="comments">Comments:</label>
                <textarea name="comments" rows="4" placeholder="Enter your feedback here..." required></textarea>
                <input type="submit" value="Submit Feedback">
            </form>
        </div>
    </div>
    <div class="settings-panel">
        <strong>Settings</strong>
        <label for="text-size">Text Size:</label>
        <input type="range" min="12" max="24" value="16" oninput="changeTextSize(this.value)">
    </div>
    <div class="tips" style="display:none;">
        <strong>📖 Tips:</strong>
        <ul>
            <li>Use Submit Feedback to rate faculty.</li>
            <li>All data is stored securely.</li>
            <li>You can change layout via Settings.</li>
        </ul>
    </div>
</body>

</html>