<?php include '../templates/header.php'; ?>
<h2>Add Student</h2>
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
            <!-- Options will be populated by Person A -->
        </select>
    </div>
    <div class="mb-3">
        <label for="image" class="form-label">Image</label>
        <input type="file" class="form-control" id="image" name="image">
    </div>
    <button type="submit" class="btn btn-primary">Add</button>
</form>
<?php include '../templates/footer.php'; ?>