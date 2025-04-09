<?php
require_once 'Repository.php';
class Student extends Repository {
    public function __construct(PDO $pdo) {
        parent::__construct($pdo, 'students');
    }

    public function findByName($name) {
        $stmt = $this->pdo->prepare("SELECT * FROM students WHERE name LIKE ?");
        $stmt->execute(["%$name%"]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
