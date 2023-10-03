<?php

require __DIR__."/../../vendor/autoload.php";
require "tests/utils/couleurs.php";

echo "vérifier que la date d’emprunt, à la création, est égale à la date du jour \n";
$adherent=  new \App\Adherent("michel","maurice","mm@test.fr");
$livre = new \App\Livre("L'homme des mille détours","isbn-18546","Agnès Martin-Lugand",150);
$emprunt = new \App\Emprunt($adherent,$livre);
$dateJour = (new \DateTime())->format("d/m/Y");

if ($emprunt->getDateEmprunt()->format("d/m/Y") == $dateJour) {
    echo GREEN."Test OK".RESET.PHP_EOL;
} else {
    echo RED."Test pas OK".RESET.PHP_EOL;
}

echo "vérifier que la date de retour estimée, à la création, est égale à la date du jour + 21 jours pour l’emprunt d’un livre \n";
$adherent=  new \App\Adherent("michel","maurice","mm@test.fr");
$livre = new \App\Livre("L'homme des mille détours","isbn-18546","Agnès Martin-Lugand",150);
$emprunt = new \App\Emprunt($adherent,$livre);
$dateActuelPlus21Jour = (new \DateTime())->modify("+21 days")->format("d/m/Y");

if ($emprunt->getDateRetourEstime()->format("d/m/Y") == $dateActuelPlus21Jour) {
    echo GREEN."Test OK".RESET.PHP_EOL;
} else {
    echo RED."Test pas OK".RESET.PHP_EOL;
}


echo "vérifier que la date de retour estimée, à la création, est égale à la date du jour + 15 jours pour l’emprunt d’un blu-ray \n";
$adherent=  new \App\Adherent("michel","maurice","mm@test.fr");
$bluRay = new \App\BluRay("TestBlu-ray","Tom",150,"2005");
$emprunt = new \App\Emprunt($adherent,$bluRay);
$dateActuelPlus21Jour = (new \DateTime())->modify("+15 days")->format("d/m/Y");

if ($emprunt->getDateRetourEstime()->format("d/m/Y") == $dateActuelPlus21Jour) {
    echo GREEN."Test OK".RESET.PHP_EOL;
} else {
    echo RED."Test pas OK".RESET.PHP_EOL;
}


echo "vérifier que la date de retour estimée, à la création, est égale à la date du jour + 10 jours pour l’emprunt d’un magazine \n";
$adherent=  new \App\Adherent("michel","maurice","mm@test.fr");
$magazine = new \App\Magazine(18549,"TestMagazine","01/05/1900");
$emprunt = new \App\Emprunt($adherent,$magazine);
$dateActuelPlus21Jour = (new \DateTime())->modify("+10 days")->format("d/m/Y");
if ($emprunt->getDateRetourEstime()->format("d/m/Y") == $dateActuelPlus21Jour) {
    echo GREEN."Test OK".RESET.PHP_EOL;
} else {
    echo RED."Test pas OK".RESET.PHP_EOL;
}


echo "vérifier que l’emprunt est en cours quand la date de retour n’est pas renseignée \n";
$adherent=  new \App\Adherent("michel","maurice","mm@test.fr");
$magazine = new \App\Magazine(18549,"TestMagazine","01/05/1900");
$emprunt = new \App\Emprunt($adherent,$magazine);
if ($emprunt->empruntEnCours()) {
    echo GREEN."Test OK".RESET.PHP_EOL;
} else {
    echo RED."Test pas OK".RESET.PHP_EOL;
}

echo "vérifier que l’emprunt est en cours quand la date de retour n’est pas renseignée \n";
$adherent=  new \App\Adherent("michel","maurice","mm@test.fr");
$magazine = new \App\Magazine(18549,"TestMagazine","01/05/1900");
$emprunt = new \App\Emprunt($adherent,$magazine);
if ($emprunt->empruntEnCours()) {
    echo GREEN."Test OK".RESET.PHP_EOL;
} else {
    echo RED."Test pas OK".RESET.PHP_EOL;
}


echo "vérifier que l’emprunt est en alerte quand la date de retour estimée est antérieure à la date du jour et que l’emprunt est en cours\n";
$adherent=  new \App\Adherent("michel","maurice","mm@test.fr");
$magazine = new \App\Magazine(18549,"TestMagazine","01/05/1900");
$emprunt = new \App\Emprunt($adherent,$magazine);
$emprunt->setDateRetourEstime($emprunt->getDateRetourEstime()->modify("-40 days"));
if ($emprunt->empruntEnAlerte()) {
    echo GREEN."Test OK".RESET.PHP_EOL;
} else {
    echo RED."Test pas OK".RESET.PHP_EOL;
}

echo "vérifier que la durée de l’emprunt a été dépassée quand la date de retour est postérieure à la date de retour estimée \n";
$adherent=  new \App\Adherent("michel","maurice","mm@test.fr");
$magazine = new \App\Magazine(18549,"TestMagazine","01/05/1900");
$emprunt = new \App\Emprunt($adherent,$magazine);
$emprunt->setDateRetour(DateTime::createFromFormat("d/m/Y","20/11/2023"));
if ($emprunt->dateRetourDepasser()) {
    echo GREEN."Test OK".RESET.PHP_EOL;
} else {
    echo RED."Test pas OK".RESET.PHP_EOL;
}