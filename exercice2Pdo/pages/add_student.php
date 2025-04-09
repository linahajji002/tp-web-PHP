<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header('Location: login.php');
    exit;
}

require_once '../includes/config.php';
require_once '../classes/Student.php';
require_once '../classes/Section.php';

$studentRepo = new Student($pdo);
$sectionRepo = new Section($pdo);
$sections = $sectionRepo->findAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $birthday = $_POST['birthday'];
    $section_id = $_POST['section_id'];

    $image = '';
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = '../assets/images/';
        $image = basename($_FILES['image']['name']);
        $uploadFile = $uploadDir . $image;
        if (!move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
            $error = "Failed to upload image.";
        }
    
    } else {
        $error = "Please upload an image.";
    }

    if (!isset($error)) {
        $data = [
            'name' => $name,
            'birthday' => $birthday,
            'image' => $image,
            'section_id' => $section_id
        ];
        $studentRepo->create($data);
        header('Location: students.php');
        exit;
    }
}
?>
<?php require_once '../includes/header.php'; ?>
<div class="container mt-3">
    <h2>Add Student</h2>
    <?php if (isset($error)) echo "<p class='text-danger'>$error</p>"; ?>
    <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="birthday" class="form-label">Birthday</label>
            <input type="date" class="form-control" id="birthday" name="birthday" required>
        </div>
        <div class="mb-3">
            <label for="section_id" class="form-label">Section</label>
            <select class="form-control" id="section_id" name="section_id" required>
                <?php foreach ($sections as $section): ?>
                    <option value="<?= htmlspecialchars($section['id']) ?>"><?= htmlspecialchars($section['designation']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Student</button>
    </form>
</div>
<?php require_once '../includes/footer.php'; ?>