<?php
// Mock data for students
$students = [
    [
        'id' => 1,
        'name' => 'Aymen',
        'birthday' => '1982-02-07',
        'image' => '../assets/images/aymen.jpg',
        'section_id' => 1
    ],
    [
        'id' => 2,
        'name' => 'Skander',
        'birthday' => '2018-07-11',
        'image' => '../assets/images/skander.jpg',
        'section_id' => 1
    ]
];

$sectionMap = [
    1 => 'GL',
    2 => 'RT'
];

?>
<?php include '../templates/header.php'; ?>
<h2>Liste des étudiants</h2>
<div class="mb-3">
    <form method="GET" class="d-inline">
        <input type="text" name="filter_name" placeholder="Filtrer par nom" class="form-control d-inline-block w-auto">
        <button type="submit" class="btn btn-danger">Filtrer</button>
    </form>
    <a href="add_student.php" class="btn btn-primary btn-lg" data-bs-toggle="tooltip" data-bs-placement="top" title="Ajouter un étudiant"><i class="bi bi-person-plus me-1"></i></a></div>

<table id="dataTable" class="table table-bordered">
    <thead>
        <tr>
            <th>id</th>
            <th>image</th>
            <th>name</th>
            <th>birthday</th>
            <th>section</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($students as $student): ?>
            <tr>
                <td><?php echo $student['id']; ?></td>
                <td><img src="<?php echo $student['image']; ?>" width="50" height="50" class="rounded-circle"></td>
                <td><?php echo $student['name']; ?></td>
                <td><?php echo $student['birthday']; ?></td>
                <td><?php echo $sectionMap[$student['section_id']] ?? 'N/A'; ?></td>
                <td>
                <a href="edit_student.php?id=<?php echo $student['id']; ?>" class="btn btn-primary btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Modifier">
        <i class="bi bi-pencil"></i>
    </a>
    <a href="delete_student.php?id=<?php echo $student['id']; ?>" class="btn btn-danger btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Supprimer">
        <i class="bi bi-trash"></i>
    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php include '../templates/footer.php'; ?>
