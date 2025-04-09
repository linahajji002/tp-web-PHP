<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

require_once '../includes/config.php';
require_once '../classes/Section.php';

$sectionRepo = new Section($pdo);

if (!isset($_GET['id'])) {
    header('Location: sections.php');
    exit;
}

$section = $sectionRepo->findById($_GET['id']);
if (!$section) {
    header('Location: sections.php');
    exit;
}

$students = $sectionRepo->getStudentsInSection($section['id']);
?>
<?php require_once '../includes/header.php'; ?>
<div class="container mt-3">
    <h2>Section Details</h2>
    <div class="card">
        <div class="card-body">
            <p><strong>ID:</strong> <?= htmlspecialchars($section['id']) ?></p>
            <p><strong>Designation:</strong> <?= htmlspecialchars($section['designation']) ?></p>
            <p><strong>Description:</strong> <?= htmlspecialchars($section['description']) ?></p>
            <h5>Students in this Section:</h5>
            <ul>
                <?php if (empty($students)): ?>
                    <li>No students in this section.</li>
                <?php else: ?>
                    <?php foreach ($students as $student): ?>
                        <li><?= htmlspecialchars($student['name']) ?> (Birthday: <?= htmlspecialchars($student['birthday']) ?>)</li>
                    <?php endforeach; ?>
                <?php endif; ?>
            </ul>
        </div>
    </div>
    <a href="sections.php" class="btn btn-secondary mt-3">Back to List</a>
</div>
<?php require_once '../includes/footer.php'; ?>