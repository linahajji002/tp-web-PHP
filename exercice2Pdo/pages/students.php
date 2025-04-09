<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

require_once '../includes/config.php';
require_once '../classes/Student.php';
require_once '../classes/Section.php';

$studentRepo = new Student($pdo);
$sectionRepo = new Section($pdo);

$students = [];
if (isset($_GET['filter_name']) && !empty($_GET['filter_name'])) {
    if ($_SESSION['user']['role'] !== 'admin') {
        header('Location: students.php');
        exit;
    }
    $students = $studentRepo->findByName($_GET['filter_name']);
} else {
    $students = $studentRepo->findAll();
}
?>
<?php require_once '../includes/header.php'; ?>
<div class="container mt-3">
    <h2>Liste des étudiants</h2>
    <?php if ($_SESSION['user']['role'] === 'admin'): ?>
        <div class="mb-3">
            <form method="GET" class="d-inline">
                <input type="text" name="filter_name" placeholder="Filter by name" class="form-control d-inline-block w-auto">
                <button type="submit" class="btn btn-danger">Filtrer</button>
            </form>
            <a href="add_student.php" class="btn btn-primary"><i class="bi bi-person-plus"></i></a>
        </div>
    <?php endif; ?>
    <table id="studentsTable" class="table table-bordered">
        <thead>
            <tr>
                <th>id</th>
                <th>IMAGE</th>
                <th>name</th>
                <th>birthday</th>
                <th>section</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($students)): ?>
                <tr>
                    <td colspan="6">No students found.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($students as $student): ?>
                    <tr>
                        <td><?= htmlspecialchars($student['id']) ?></td>
                        <td><img src="../assets/images/<?= htmlspecialchars($student['image']) ?>" alt="Student Image" width="50"></td>
                        <td><?= htmlspecialchars($student['name']) ?></td>
                        <td><?= htmlspecialchars($student['birthday']) ?></td>
                        <td>
                            <?php
                            $section = $sectionRepo->findById($student['section_id']);
                            echo htmlspecialchars($section['designation']);
                            ?>
                        </td>
                        <td>
                            <a href="view_student.php?id=<?= htmlspecialchars($student['id']) ?>" class="btn btn-info btn-sm"><i class="bi bi-info-circle"></i></a>
                            <?php if ($_SESSION['user']['role'] === 'admin'): ?>
                                <a href="edit_student.php?id=<?= htmlspecialchars($student['id']) ?>" class="btn btn-warning btn-sm"><i class="bi bi-pencil"></i></a>
                                <a href="delete_student.php?id=<?= htmlspecialchars($student['id']) ?>" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></a>
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
    $('#studentsTable').DataTable({
       "paging": true,
        "searching": true,
        "ordering": true,
        dom: 'Bfrtip',
        buttons: ['copy', 'excel', 'csv', 'pdf']
    });
});
</script>
<?php require_once '../includes/footer.php'; ?>