<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}
?>
<?php require_once '../includes/header.php'; ?>
<div class="container mt-3">
    <h1>Hello, PHP LOVERS! Welcome to your administration Platform</h1>
    <p>You are logged in as a <?php echo htmlspecialchars($_SESSION['user']['role']); ?>.</p>
    <?php if ($_SESSION['user']['role'] === 'user'): ?>
        <p>You have read-only access to view students and sections.</p>
    <?php endif; ?>
</div>
<?php require_once '../includes/footer.php'; ?>