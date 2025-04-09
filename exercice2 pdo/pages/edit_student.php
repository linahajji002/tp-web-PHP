<?php
// Placeholder for backend data
$students = [
    ['id' => 1, 'name' => 'Aymen', 'birthday' => '1982-02-07', 'section_id' => 1, 'image' => '../assets/images/aymen.jpg'],
    ['id' => 2, 'name' => 'Skander', 'birthday' => '2018-07-11', 'section_id' => 1, 'image' => '../assets/images/skander.jpg'],
];

$sections = [
    ['id' => 1, 'designation' => 'GI'],
    ['id' => 2, 'designation' => 'RT'],
];
$student = null;
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = (int)$_GET['id'];
    foreach ($students as $s) {
        if ($s['id'] == $id) {
            $student = $s;
            break;
        }
    }
    if (!$student) {
        // If the student doesn't exist, redirect to students.php with an error
        header('Location: students.php?error=StudentNotFound');
        exit;
    }
} else {
    // If no ID is provided, redirect to students.php
    header('Location: students.php?error=NoStudentId');
    exit;
}

// Simulate form submission (since we don't have a backend)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Normally, this would update the database, but we'll just redirect with a success message
    header('Location: students.php?success=StudentUpdated');
    exit;
}
?>
<?php include '../templates/header.php'; ?>
<h2>Edit Student</h2>
<form method="POST" enctype="multipart/form-data">
<input type="hidden" name="id" value="<?php echo htmlspecialchars($student['id']); ?>">
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" id="name" name="name" value="<?php echo $student['name']; ?>" required>
    </div>
    <div class="mb-3">
        <label for="birthday" class="form-label">Birthday</label>
        <input type="date" class="form-control" id="birthday" name="birthday" value="<?php echo $student['birthday']; ?>" required>
    </div>
    <div class="mb-3">
        <label for="section_id" class="form-label">Section</label>
        <select class="form-control" id="section_id" name="section_id" required>
            <?php foreach ($sections as $section): ?>
                <option value="<?php echo $section['id']; ?>" <?php if ($section['id'] == $student['section_id']) echo 'selected'; ?>>
                    <?php echo $section['designation']; ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="image" class="form-label">Image</label>
        <input type="file" class="form-control" id="image" name="image">
        <p>Current Image: <img src="<?php echo $student['image']; ?>" width="50" class="rounded-circle"></p>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
</form>
<?php include '../templates/footer.php'; ?>