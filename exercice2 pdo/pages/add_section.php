<?php include '../templates/header.php'; ?>
<h2>Add Section</h2>
<form method="POST">
    <div class="mb-3">
        <label for="designation" class="form-label">Designation</label>
        <input type="text" class="form-control" id="designation" name="designation" required>
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control" id="description" name="description"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Add</button>
</form>
<?php include '../templates/footer.php'; ?>