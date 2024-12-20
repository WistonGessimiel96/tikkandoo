<?php


function redefineDateTme($date)
{
    if ($date == null) {
        return "";
    }

    $mois = array("", "janvier", "février", "mars", "avril", "mai", "juin", "juillet", "aout", "septembre", "octobre", "novembre", "décembre");
    if (strpos($date, 'T')) {
        $tmp = explode("T", $date);
    } else {
        $tmp = explode(" ", $date);
    }
    $date = explode("-", $tmp[0]);
    $date[1] = $mois[intval($date[1])];
    $date = implode(" ", array_reverse($date));
    if (isset($tmp[1])) {
        $time = explode(":", $tmp[1]);
        $time = ' à ' . $time[0] . 'h' . $time[1];
    } else {
        $time = "";
    }
    return $date . $time;
}

function redefineTme($date)
{
    $time = explode(":", $date);
    $time = $time[0] . 'h' . $time[1];
    return $time;
}

function chooseLevel($level)
{
    switch ($level):
        case "doc":
            return "Doctorat & Doctorant";
        case "m2":
            return "Master 2";
        case "m1":
            return "Master 1";
        case "l3":
            return "Licence 3";
        case "l2":
            return "Licence 2";
        case "l1":
            return "Licence 1";
        case "bac":
            return "BAC ou Terminal";
        case "second":
            return "Moins du BAC";
        case "nope":
            return "Je n'ai pas fréquenté !";
        default:
            return "";
    endswitch;
}
function chooseInstrument($level)
{
    switch ($level):
        case "piano":
            return "Piano / Orgue";
        case "guitare_basse":
            return "Guitare Basse";
        case "guitare_acc_solo":
            return "Guitare accompagnement / Solo";
        case "batterie_percussion":
            return "Batterie / Percussion";
        case "ventriste":
            return "Ventriste (Trompette, saxophone, flute, etc.)";
        default:
            return "";
    endswitch;
}

function redefineDateTmeSession($date)
{
    $mois = array("", "janvier", "février", "mars", "avril", "mai", "juin", "juillet", "aout", "septembre", "octobre", "novembre", "décembre");
    $tmp = explode("T", $date);
    $date = explode("-", $tmp[0]);
    $date[1] = $mois[intval($date[1])];
    $date = implode(" ", array_reverse($date));
    $time = explode(":", $tmp[1]);
    $time = $time[0] . 'h' . $time[1];
    return $date . ' à ' . $time;
}

function callNumber($number)
{
    return "<a href='tel:" . $number . "' class='m-btn m-btn-5 w-100' target='_blank'><i class='fa fa-phone'></i> Appel</a>";
}

function callWhatsapp($number, $service)
{
    $message = 'Bonjour ' . $service . ' Je voudrais envoyer un colis par vous s\'il vous plait.';

    $link = http_build_query([
        "phone" => substr($number, 1),
        "text" => $message
    ]);
    return "<a href='https://api.whatsapp.com/send?" . $link . "' class='m-btn m-btn-5 w-100' target='_blank'><i class='fa fa-inbox-out'></i> Whatsapp</a>";
}

function slugify_helper($text, $divider = '-')
{
    // replace non letter or digits by divider
    $text = preg_replace('~[^\pL\d]+~u', $divider, $text);

    // transliterate
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

    // remove unwanted characters
    $text = preg_replace('~[^-\w]+~', '', $text);

    // trim
    $text = trim($text, $divider);

    // remove duplicate divider
    $text = preg_replace('~-+~', $divider, $text);

    // lowercase
    $text = strtolower($text);

    if (empty($text)) {
        return 'n-a';
    }
    return $text;
}

?>
