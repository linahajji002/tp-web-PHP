<?php
class Etudiant {
public $nom;
public $notes = [];

public function __construct($nom, $notes) {
    $this->nom = $nom;
    $this->notes = $notes;
}

public function afficherNotes() {
    foreach ($this->notes as $note) {
        $couleur = '';
        if ($note < 10) {
            $couleur = 'bg-danger';
        } elseif ($note > 10) {
            $couleur = 'bg-success';
        } else {
            $couleur = 'bg-warning';
        }
        echo "<div class='p-2 text-center text-white $couleur rounded mb-1'>$note</div>";
    }
}

public function calculerMoyenne() {
    return count($this->notes) ? array_sum($this->notes) / count($this->notes) : 0;
}

public function estAdmis() {
    return $this->calculerMoyenne() >= 10 ? "Admis" : "Non admis";
}
}
?>
