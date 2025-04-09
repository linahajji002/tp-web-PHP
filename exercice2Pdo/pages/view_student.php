<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

require_once '../includes/config.php';
require_once '../classes/Student.php';
require_once '../classes/Section.php';

$studentRepo = new Student($pdo);
$sectionRepo = new Section($pdo);

if (!isset($_GET['id'])) {
    header('Location: students.php');
    exit;
}

$student = $studentRepo->findById($_GET['id']);
if (!$student) {
    header('Location: students.php');
    exit;
}

$section = $sectionRepo->findById($student['section_id']);
?>
<?php require_once '../includes/header.php'; ?>
<div class="container mt-3">
    <h2>Student Details</h2>
    <div class="card">
        <div class="card-body">
            <p><strong>ID:</strong> <?= htmlspecialchars($student['id']) ?></p>
            <p><strong>Name:</strong> <?= htmlspecialchars($student['name']) ?></p>
            <p><strong>Birthday:</strong> <?= htmlspecialchars($student['birthday']) ?></p>
            <p><strong>Section:</strong> <?= htmlspecialchars($section['designation']) ?></p>
            <p><strong>Image:</strong></p>
            <img src="../assets/images/<?= htmlspecialchars($student['image']) ?>" alt="Student Image" width="150">
        </div>
    </div>
    <a href="students.php" class="btn btn-secondary mt-3">Back to List</a>
</div>
<?php require_once '../includes/footer.php'; ?>