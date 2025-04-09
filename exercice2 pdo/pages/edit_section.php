<?php
// Placeholder for backend data
$section = ['designation' => '', 'description' => ''];
?>
<?php include '../templates/header.php'; ?>
<h2>Edit Section</h2>
<form method="POST">
    <div class="mb-3">
        <label for="designation" class="form-label">Designation</label>
        <input type="text" class="form-control" id="designation" name="designation" value="<?php echo $section['designation']; ?>" required>
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control" id="description" name="description"><?php echo $section['description']; ?></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
</form>
<?php include '../templates/footer.php'; ?>