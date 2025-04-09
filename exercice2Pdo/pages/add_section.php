<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header('Location: login.php');
    exit;
}

require_once '../includes/config.php';
require_once '../classes/Section.php';

$sectionRepo = new Section($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $designation = $_POST['designation'];
    $description = $_POST['description'];

    $data = [
        'designation' => $designation,
        'description' => $description
    ];
    $sectionRepo->create($data);
    header('Location: sections.php');
    exit;
}
?>
<?php require_once '../includes/header.php'; ?>
<div class="container mt-3">
    <h2>Add Section</h2>
    <form method="POST">
        <div class="mb-3">
            <label for="designation" class="form-label">Designation</label>
            <input type="text" class="form-control" id="designation" name="designation" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Add Section</button>
    </form>
</div>
<?php require_once '../includes/footer.php'; ?>