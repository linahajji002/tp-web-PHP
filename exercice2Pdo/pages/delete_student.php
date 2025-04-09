<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header('Location: login.php');
    exit;
}
require_once '../includes/config.php';
require_once '../classes/Student.php';

$studentRepo = new Student($pdo);

if (!isset($_GET['id'])) {
    header('Location: students.php');
    exit;
}

$studentRepo->delete($_GET['id']);
header('Location: students.php');
exit;
?>