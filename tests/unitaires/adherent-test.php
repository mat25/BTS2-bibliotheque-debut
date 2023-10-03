<?php

require __DIR__."/../../vendor/autoload.php";
require "tests/utils/couleurs.php";

echo "Test : vérifier que la date d’adhésion, si non précisée à la création, est égale à la date du jour \n";
$adherent=  new \App\Adherent("michel","maurice","mm@test.fr");
$dateJour = new \DateTime();

if ($adherent->getDateAdhesion()->format("d/m/Y") == $dateJour->format("d/m/Y")) {
    echo GREEN."Test OK".RESET.PHP_EOL;
} else {
    echo RED."Test pas OK".RESET.PHP_EOL;
}

echo "Test : vérifier que la date d’adhésion, si précisée à la création, est bien prise en compte \n";
$adherent=  new \App\Adherent("michel","maurice","mm@test.fr","01/10/2023");
$dateJour = \DateTime::createFromFormat("d/m/Y","01/10/2023");

if ($adherent->getDateAdhesion()->format("d/m/Y") == $dateJour->format("d/m/Y")) {
    echo GREEN."Test OK".RESET.PHP_EOL;
} else {
    echo RED."Test pas OK".RESET.PHP_EOL;
}


echo "Test : vérifier que le numéro d’adhérent, à la création, est valide \n";
$adherent=  new \App\Adherent("michel","maurice","mm@test.fr",);

$debutNumero =  substr($adherent->getNumeroAdherent(),0,3);
$numero =  substr($adherent->getNumeroAdherent(),3,9);
if ($debutNumero == "AD-" && ($numero > 000000 && $numero < 999999)) {
    echo GREEN."Test OK".RESET.PHP_EOL;
} else {
    echo RED."Test pas OK".RESET.PHP_EOL;
}


echo "Test : vérifier que le numéro d’adhérent, à la création, est valide \n";
$adherent=  new \App\Adherent("michel","maurice","mm@test.fr",);

$debutNumero =  substr($adherent->getNumeroAdherent(),0,3);
$numero =  substr($adherent->getNumeroAdherent(),3,9);
if ($debutNumero == "AD-" && ($numero > 000000 && $numero < 999999)) {
    echo GREEN."Test OK".RESET.PHP_EOL;
} else {
    echo RED."Test pas OK".RESET.PHP_EOL;
}


echo "Test : vérifier que l’adhésion est valable (valide) quand la date d’adhésion n’est pas dépassée (moins d’un an)  \n";
$adherent=  new \App\Adherent("michel","maurice","mm@test.fr","02/10/2023");
if ($adherent->adhesionValable()) {
    echo GREEN."Test OK".RESET.PHP_EOL;
} else {
    echo RED."Test pas OK".RESET.PHP_EOL;
}

echo "Test : vérifier que l’adhésion est non valable (invalide) quand la date d’adhésion est dépassée (plus d’un an)   \n";
$adherent=  new \App\Adherent("michel","maurice","mm@test.fr","02/10/2022");
if (!$adherent->adhesionValable()) {
    echo GREEN."Test OK".RESET.PHP_EOL;
} else {
    echo RED."Test pas OK".RESET.PHP_EOL;
}


echo "Test : vérifier que l’adhésion est renouvelée  \n";
$adherent=  new \App\Adherent("michel","maurice","mm@test.fr","02/10/2022");
$dateAdhesion1ans = DateTime::createFromFormat("d/m/Y","02/10/2022");
$dateAdhesion1ans = $dateAdhesion1ans->modify("+1 year")->format("d/m/Y");
$adherent->renouvelerAdhesion();
if ($dateAdhesion1ans == $adherent->getDateAdhesion()->format("d/m/Y")) {
    echo GREEN."Test OK".RESET.PHP_EOL;
} else {
    echo RED."Test pas OK".RESET.PHP_EOL;
}



