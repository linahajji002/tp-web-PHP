<?php
$section = ['designation' => ''];
?>
<?php include '../templates/header.php'; ?>
<h2>Delete Section</h2>
<p>Are you sure you want to delete <?php echo $section['designation']; ?>?</p>
<form method="POST">
    <button type="submit" class="btn btn-danger">Yes, Delete</button>
    <a href="sections.php" class="btn btn-secondary">Cancel</a>
</form>
<?php include '../templates/footer.php'; ?>