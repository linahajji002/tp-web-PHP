<?php
// Mock data for sections
$sections = [
    [
        'id' => 1,
        'designation' => 'GI',
        'description' => 'Génie Logiciel'
    ],
    [
        'id' => 2,
        'designation' => 'RT',
        'description' => 'Réseau et Télécommunication'
    ]
];
?>
<?php include '../templates/header.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-3">
  <h2 class="mb-0">Liste des sections</h2>
  <a href="add_section.php" class="btn btn-primary btn-lg" data-bs-toggle="tooltip" data-bs-placement="top" title="Ajouter un étudiant">
    <i class="bi bi-person-plus me-1"></i>
  </a>
</div>
<table id="dataTable" class="table table-bordered">
    <thead>
        <tr>
            <th>id</th>
            <th>designation</th>
            <th>description</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($sections as $section): ?>
            <tr>
                <td><?php echo $section['id']; ?></td>
                <td><?php echo $section['designation']; ?></td>
                <td><?php echo $section['description']; ?></td>
                <td>
                <a href="edit_section.php?id=<?php echo $student['id']; ?>" class="btn btn-primary btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Modifier">
        <i class="bi bi-pencil"></i>
    </a>
    <a href="delete_section.php?id=<?php echo $student['id']; ?>" class="btn btn-danger btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Supprimer">
        <i class="bi bi-trash"></i>
    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php include '../templates/footer.php'; ?>