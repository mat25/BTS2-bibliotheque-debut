<?php

namespace App;

class Adherent
{
    private string $numeroAdherent;
    private string $prenom;
    private string $nom;
    private string $email;
    private \DateTime $dateAdhesion;

    public function __construct(string $prenom, string $nom, string $dateAdhesion = null) {
        $this->prenom = $prenom;
        $this->nom = $nom;
        if ($dateAdhesion == null) {
            $this->dateAdhesion = new \DateTime();;
        } else {
            $this->dateAdhesion = \DateTime::createFromFormat("d/m/Y",$dateAdhesion);
        }
    }
}