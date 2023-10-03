<?php

namespace App;

class Emprunt
{
    private \DateTime $dateEmprunt;
    private \DateTime $dateRetourEstime;

    private ?\DateTime $dateRetour ;
    private Adherent $adherent;
    private Media $media;

    /**
     * @param \DateTime $dateEmprunt
     * @param \DateTime $dateRetourEstime
     * @param Adherent $adherent
     * @param Media $media
     */
    public function __construct(Adherent $adherent, Media $media)
    {
        $this->dateEmprunt = new \DateTime();
        $this->dateRetourEstime = (new \DateTime())->modify("+{$media->getDureeEmprunt()} days");
        $this->adherent = $adherent;
        $this->media = $media;
        $this->dateRetour = null;
    }

    public function getInformationsEmprunt() : string {
        if ($this->empruntEnCours()) {
            $dateRetour = "Pas encore de retour";
        } else {
            $dateRetour = $this->dateRetour->format("d/m/Y");
        }
        return "Date de l'emprunt : {$this->dateEmprunt->format("d/m/Y")}".PHP_EOL."
                Date de retour estimer : {$this->dateRetourEstime->format("d/m/Y")}".PHP_EOL."
                Date retour : {$dateRetour}".PHP_EOL."
        ";
    }

    public function empruntEnCours() : bool {
        if ($this->dateRetour == null) {
            return true;
        }
        return false;
    }

    public function empruntEnAlerte() :bool {
        $dateJour = new \DateTime();
        $dateRetourEstime = $this->dateRetourEstime;
        if ($this->empruntEnCours() && $dateRetourEstime->diff($dateJour)->invert == 0 ) {
            return true;
        }
        return false;
    }

    public function dateRetourDepasser() : bool {
        if ($this->empruntEnCours() == false){
            $dateRetourEstime = $this->dateRetourEstime;
            $dateRetour = $this->dateRetour;
            if ($dateRetour->diff($dateRetourEstime)->invert == 1 ) {
                return true;
            }
        }
        return false;
    }

    /**
     * @param \DateTime $dateRetourEstime
     */
    public function setDateRetourEstime(\DateTime $dateRetourEstime): void
    {
        $this->dateRetourEstime = $dateRetourEstime;
    }

    /**
     * @param \DateTime|null $dateRetour
     */
    public function setDateRetour(?\DateTime $dateRetour): void
    {
        $this->dateRetour = $dateRetour;
    }




    /**
     * @return \DateTime
     */
    public function getDateEmprunt(): \DateTime
    {
        return $this->dateEmprunt;
    }

    /**
     * @return \DateTime
     */
    public function getDateRetourEstime(): \DateTime
    {
        return $this->dateRetourEstime;
    }

    /**
     * @return \DateTime|null
     */
    public function getDateRetour(): ?\DateTime
    {
        return $this->dateRetour;
    }

    /**
     * @return Adherent
     */
    public function getAdherent(): Adherent
    {
        return $this->adherent;
    }

    /**
     * @return Media
     */
    public function getMedia(): Media
    {
        return $this->media;
    }






}