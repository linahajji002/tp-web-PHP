<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

require_once '../includes/config.php';
require_once '../classes/Section.php';

$sectionRepo = new Section($pdo);
$sections = $sectionRepo->findAll();

if (isset($_GET['error'])) {
    $error = $_GET['error'];
}
?>
<?php require_once '../includes/header.php'; ?>
<div class="container mt-3">
    <h2>Liste des sections</h2>
    <?php if (isset($error)) echo "<p class='text-danger'>$error</p>"; ?>
    <?php if ($_SESSION['user']['role'] === 'admin'): ?>
        <div class="mb-3">
            <a href="add_section.php" class="btn btn-primary"><i class="bi bi-plus"></i> Add Section</a>
        </div>
    <?php endif; ?>
    <table id="sectionsTable" class="table table-bordered">
        <thead>
            <tr>
                <th>id</th>
                <th>designation</th>
                <th>description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($sections)): ?>
                <tr>
                    <td colspan="4">No sections found.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($sections as $section): ?>
                    <tr>
                        <td><?= htmlspecialchars($section['id']) ?></td>
                        <td><?= htmlspecialchars($section['designation']) ?></td>
                        <td><?= htmlspecialchars($section['description']) ?></td>
                        <td>
                            <a href="view_section.php?id=<?= htmlspecialchars($section['id']) ?>" class="btn btn-info btn-sm"><i class="bi bi-info-circle"></i></a>
                            <?php if ($_SESSION['user']['role'] === 'admin'): ?>
                                <a href="delete_section.php?id=<?= htmlspecialchars($section['id']) ?>" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script> 
<script>
$(document).ready(function() {
    $('#sectionsTable').DataTable({
       "paging": true,
        "searching": true,
        "ordering": true,
        dom: 'Bfrtip',
        buttons: ['copy', 'excel', 'csv', 'pdf']
    });
});
</script>
<?php require_once '../includes/footer.php'; ?>