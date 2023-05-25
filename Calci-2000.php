<?php

class Calci2000 {

    public $guthaben;
    public $grundkosten;
    public $state = false;
    public $letzteRechnungAddition;
    public $letzteRechnungMultiplikation;
    public $letzteRechnungDivision;

    function __construct($start) {

        $this->guthaben=$start;

    }

    function addieren() {

        $this->grundkosten = 1;
        echo "Geben Sie an, was gerechnet werden soll: ";
        $rechnung = trim(fgets(STDIN));

        if (preg_match("/[^0-9+]/", $rechnung)) {
            echo "Bitte geben Sie nur Zahlen inkl. Rechenzeichen ein."."\r\n";
        } elseif (preg_match("/[+]{2,}/", $rechnung)) {
            echo "Es dürfen keine Rechenoperatoren aufeinander folgen"."\r\n";
        } elseif (preg_match("/[0-9+]{2,}/", $rechnung)) {

            $treffer    = preg_split('/[+]/', $rechnung);
            $ergebnis   = 0;

            foreach ($treffer as $zahl) {
                $ergebnis = $ergebnis + $zahl;
            }

            sort($this->letzteRechnungAddition);
            sort($treffer);

            if ($treffer != $this->letzteRechnungAddition) {
                $kosten     = count($treffer);
                $this->guthaben = $this->guthaben - $kosten - $this->grundkosten;
            }

            $this->letzteRechnungAddition = $treffer;

            echo "-----------------------------------"."\r\n";
            echo "Das Ergebnis ist $ergebnis."."\r\n";
            echo "Neues Guthaben: $this->guthaben Gold"."\r\n"."\r\n";
        }
    }

    function subtrahieren() {

        $this->grundkosten = 0;
        echo "Geben Sie an, was gerechnet werden soll: ";
        $rechnung = trim(fgets(STDIN));

        if (preg_match("/[^0-9-]/", $rechnung)) {
            echo "Bitte geben Sie nur Zahlen inkl. Rechenzeichen ein."."\r\n";
        } elseif (preg_match("/[-]{2,}/", $rechnung)) {
            echo "Es dürfen keine Rechenoperatoren aufeinander folgen"."\r\n";
        } elseif (preg_match("/[0-9-]{2,}/", $rechnung)) {

            $treffer    = preg_split('/[-]/', $rechnung);
            $count      = count($treffer);
            $ergebnis   = 0;

            for ($i=0; $i<$count; $i++) {
                if ($i == 0) {
                    $ergebnis = $treffer[$i];
                } else {
                    $ergebnis = $ergebnis - $treffer[$i];
                }
            }

            echo "-----------------------------------"."\r\n";
            echo "Das Ergebnis ist $ergebnis."."\r\n";
            echo "Neues Guthaben: $this->guthaben Gold"."\r\n"."\r\n";
        }
    }

    function multiplizieren() {

        $this->grundkosten = 2;
        echo "Geben Sie an, was gerechnet werden soll: ";
        $rechnung = trim(fgets(STDIN));

        if (preg_match("/[^0-9*]/", $rechnung)) {
            echo "Bitte geben Sie nur Zahlen inkl. Rechenzeichen ein."."\r\n";
        } elseif (preg_match("/[*]{2,}/", $rechnung)) {
            echo "Es dürfen keine Rechenoperatoren aufeinander folgen"."\r\n";
        } elseif (preg_match("/[0-9*]{2,}/", $rechnung)) {

            $treffer    = preg_split('/[*]/', $rechnung);
            $ergebnis   = 1;

            foreach ($treffer as $zahl) {
                $ergebnis = $ergebnis * $zahl;
            }

            sort($this->letzteRechnungMultiplikation);
            sort($treffer);

            if ($treffer != $this->letzteRechnungMultiplikation) {
                $kosten     = count($treffer);
                $this->guthaben = $this->guthaben - $kosten - $this->grundkosten;
            }

            $this->letzteRechnungMultiplikation = $treffer;

            echo "-----------------------------------"."\r\n";
            echo "Das Ergebnis ist $ergebnis."."\r\n";
            echo "Neues Guthaben: $this->guthaben Gold"."\r\n"."\r\n";
        }
    }

    function dividieren() {

        $this->grundkosten = 3;
        echo "Geben Sie an, was gerechnet werden soll: ";
        $rechnung = trim(fgets(STDIN));

        if (preg_match("/[^0-9\/]/", $rechnung)) {
            echo "Bitte geben Sie nur Zahlen inkl. Rechenzeichen ein."."\r\n";
        } elseif (preg_match("/[\/]{2,}/", $rechnung)) {
            echo "Es dürfen keine Rechenoperatoren aufeinander folgen"."\r\n";
        } elseif (preg_match("/[0-9\/]{2,}/", $rechnung)) {

            $treffer    = preg_split('/[\/]/', $rechnung);
            $count      = count($treffer);
            $ergebnis   = 0;

            for ($i=0;$i<$count;$i++) {
                if ($i == 0) {
                    $ergebnis = $treffer[$i];
                } else {
                    $ergebnis = $ergebnis / $treffer[$i];
                }
            }

            if ($treffer != $this->letzteRechnungDivision) {
                $kosten     = count($treffer);
                $this->guthaben= $this->guthaben - $kosten - $this->grundkosten;
            }

            $this->letzteRechnungDivision = $treffer;

            echo "-----------------------------------"."\r\n";
            echo "Das Ergebnis ist $ergebnis."."\r\n";
            echo "Neues Guthaben: $this->guthaben Gold"."\r\n"."\r\n";
        }
    }

    function ausgabe() {

        echo "Ihr Startguthaben beträgt $this->guthaben Gold"."\r\n";
        echo "-----------------------------------"."\r\n";
        echo "Wählen Sie Ihre Rechenart:"."\r\n"."\r\n";
        echo "Addition | Kosten: 1 Gold + 1 Gold pro Zahl"."\r\n";
        echo "Subtraktion | Kosten: kostenlos"."\r\n";
        echo "Multiplikation | Kosten: 2 Gold + 1 Gold pro Zahl"."\r\n";
        echo "Division | Kosten: 3 Gold + 1 Gold pro Zahl"."\r\n"."\r\n";
        echo "Rechenart: ";
        $rechenart = trim(fgets(STDIN));

        switch($rechenart) {
            case "Addition":
                $this->addieren();
                break;
            case "Subtraktion":
                $this->subtrahieren();
                break;
            case "Multiplikation":
                $this->multiplizieren();
                break;
            case "Division":
                $this->dividieren();
                break;
            default:
                echo "Bitte geben Sie eine korrekte Rechenart an."."\r\n";
                $this->ausgabe();
                break;
        }

        echo "Möchten Sie eine neue Rechnung durchführen? (Ja/Nein): ";
        $antwortRechnung = trim(fgets(STDIN));
        echo "\r\n";

        if ($antwortRechnung === "Ja") {
            echo $this->ausgabe($this->guthaben);
        } elseif ($antwortRechnung === "Nein") {
            echo "Restguthaben auszahlen? (Ja/Nein): ";
            $antwortRestguthaben = trim(fgets(STDIN));
            echo "\r\n";

            if ($antwortRestguthaben === "Ja") {
                echo "Sie haben $this->guthaben Goldmünzen ausgezahlt."."\r\n";
                echo "-----------------------------------"."\r\n";
                echo "Vielen Dank und auf Wiedersehen";
                $this->state = true;
            } elseif ($antwortRestguthaben === "Nein") {
                echo "Vielen Dank und auf Wiedersehen"."\r\n";
                $this->state = true;
            }
        }
    }
}

echo "Bitte wirf ein paar Goldmünzen ein: ";
$einwurf = trim(fgets(STDIN));
$calci = new Calci2000($einwurf);

while ($calci->state === false) {
    echo $calci->ausgabe();
}
