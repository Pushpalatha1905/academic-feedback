<?php
session_start();
include('../config/db.php');

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'faculty') {
    header("Location: ../login.php");
    exit();
}

$faculty_id = $_SESSION['user']['id'];
$faculty_name = $_SESSION['user']['name'];
$course = isset($_SESSION['user']['subject']) ? $_SESSION['user']['subject'] : 'N/A';


// Count students enrolled
$student_count = 0;
$avg_rating = 0;
$recent_comments = [];

$student_query = $conn->prepare("SELECT COUNT(*) as total FROM feedback WHERE faculty_id = ?");
$student_query->bind_param("i", $faculty_id);
$student_query->execute();
$result = $student_query->get_result();
if ($row = $result->fetch_assoc()) {
    $student_count = $row['total'];
}
$student_query->close();

// Average rating
$rating_query = $conn->prepare("SELECT AVG(rating) as average FROM feedback WHERE faculty_id = ?");
$rating_query->bind_param("i", $faculty_id);
$rating_query->execute();
$rating_result = $rating_query->get_result();
if ($row = $rating_result->fetch_assoc()) {
    $avg_rating = round($row['average'], 2);
}
$rating_query->close();

// Recent feedback with submitted_at
$comments_query = $conn->prepare("SELECT comments, submitted_at FROM feedback WHERE faculty_id = ? ORDER BY id DESC LIMIT 5");
$comments_query->bind_param("i", $faculty_id);
$comments_query->execute();
$comment_result = $comments_query->get_result();
while ($row = $comment_result->fetch_assoc()) {
    $recent_comments[] = [
        'comment' => $row['comments'],
        'submitted_at' => date("d M Y, h:i A", strtotime($row['submitted_at']))
    ];
}
$comments_query->close();
?>
<!DOCTYPE html>
<html>

<head>
    <title>Faculty Dashboard</title>
    <link rel="stylesheet" href="dashboard.css">
</head>

<body>
    <div class="container">
        <h2>👩‍🏫 Faculty Dashboard</h2>

        <div class="card">
            <h3>👤 Name: <?= htmlspecialchars($faculty_name) ?></h3>
            <h4>📚 Course: <?= htmlspecialchars($course) ?></h4>
        </div>

        <div class="card">
            <h3>👨‍🎓 Students Enrolled: <?= $student_count ?></h3>
        </div>

        <div class="card">
            <h3>📊 Average Rating: <?= $avg_rating ?></h3>
        </div>

        <div class="card">
            <h3>🗣 Recent Feedback</h3>
            <ul>
                <?php if (count($recent_comments) > 0): ?>
                    <?php foreach ($recent_comments as $feedback): ?>
                        <li>
                            <strong>Anonymous:</strong> <?= htmlspecialchars($feedback['comment']) ?><br>
                            <small>🕒 <?= $feedback['submitted_at'] ?></small>
                        </li>
                    <?php endforeach; ?>
                <?php else: ?>
                    <li>No feedback yet.</li>
                <?php endif; ?>
            </ul>
        </div>


        <div class="bottom-actions">
            <a href="analytics.php" class="btn-analytics">📈 View Analytics</a>
            <a href="../logout.php" class="btn-logout">🔴 Logout</a>
        </div>


    </div>
</body>

</html>