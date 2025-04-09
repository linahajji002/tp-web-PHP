<?php
$students = [];

?>
<?php include '../templates/header.php'; ?>
<h2>Delete Student</h2>
<input type="hidden" name="id" value="<?php echo htmlspecialchars($student['id']); ?>">

<p>Are you sure you want to delete <?php echo $student['name']; ?>?</p>
<form method="POST">
    <button type="submit" class="btn btn-danger">Yes, Delete</button>
    <a href="students.php" class="btn btn-secondary">Cancel</a>
</form>
<?php include '../templates/footer.php'; ?>