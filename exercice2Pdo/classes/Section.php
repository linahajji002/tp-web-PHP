<?php
require_once 'Repository.php';
class Section extends Repository {
    public function __construct(PDO $pdo) {
        parent::__construct($pdo, 'sections');
    }

    public function getStudentsInSection($sectionId) {
        $stmt = $this->pdo->prepare("SELECT * FROM students WHERE section_id = ?");
        $stmt->execute([$sectionId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>