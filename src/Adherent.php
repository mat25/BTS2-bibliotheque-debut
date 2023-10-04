<?php

namespace App;

class Adherent
{
    private string $numeroAdherent;
    private string $prenom;
    private string $nom;
    private string $email;
    private \DateTime $dateAdhesion;

    public function __construct(string $prenom, string $nom,string $email, string $dateAdhesion = null) {
        $this->numeroAdherent = $this->genererNumero();
        $this->prenom = $prenom;
        $this->nom = $nom;
        $this->email = $email;
        if ($dateAdhesion == null) {
            $this->dateAdhesion = new \DateTime();;
        } else {
            $this->dateAdhesion = \DateTime::createFromFormat("d/m/Y",$dateAdhesion);
        }
    }

    private function genererNumero() :string {
        return "AD-".random_int(100000,999999);
    }

    public function renouvelerAdhesion() : void {
        $this->dateAdhesion = $this->dateAdhesion->modify("+1 year");
    }

    /**
     * @return string
     */
    public function getNumeroAdherent(): string
    {
        return $this->numeroAdherent;
    }


    public function getInformationsAdherent() :string {
        return "Numero : {$this->numeroAdherent}".PHP_EOL."
                Nom : {$this->nom}".PHP_EOL."
                Prenom : {$this->prenom}".PHP_EOL."
                Email : {$this->email}".PHP_EOL."
                Date d'adhésion : {$this->dateAdhesion}".PHP_EOL."
                ";
    }

    public function adhesionValable() :bool  {
        $dateValidite = \DateTime::createFromFormat("d/m/Y",$this->dateAdhesion->format("d/m/Y"));
        $dateValidite->modify("+1 year");
        $dateJour = new \DateTime();
        if ($dateJour->diff($dateValidite)->invert == 0) {
            return true;
        } else {
            return false;
        }
    }
    /**
     * @return string
     */
    public function getPrenom(): string
    {
        return $this->prenom;
    }

    /**
     * @return string
     */
    public function getNom(): string
    {
        return $this->nom;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return \DateTime
     */
    public function getDateAdhesion(): \DateTime
    {
        return $this->dateAdhesion;
    }


}