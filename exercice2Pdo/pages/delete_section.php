<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header('Location: login.php');
    exit;
}

require_once '../includes/config.php';
require_once '../classes/Section.php';

$sectionRepo = new Section($pdo);

if (!isset($_GET['id'])) {
    header('Location: sections.php');
    exit;
}

$students = $sectionRepo->getStudentsInSection($_GET['id']);
if (!empty($students)) {
    header('Location: sections.php?error=Cannot delete section with students');
    exit;
}

$sectionRepo->delete($_GET['id']);
header('Location: sections.php');
exit;
?>