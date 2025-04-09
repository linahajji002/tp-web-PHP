<?php
class Session {
    private $visitCount;

    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['visit_count'])) {
            $_SESSION['visit_count'] = 0;
        }

        $this->visitCount = $_SESSION['visit_count'];
    }

    public function incrementVisit() {
        $this->visitCount++;
        $_SESSION['visit_count'] = $this->visitCount;
    }

    public function getVisitCount() {
        return $this->visitCount;
    }

    public function resetSession() {
        $_SESSION['visit_count'] = 0;
        $this->visitCount = 0;
    }
}
?>