<?php

    function val_champs_obligatoires($data) {
        $erreurs = [];

        $champs = [
            'nom',
            'prenom',
            'date_naissance',
            'sexe',
            'téléphone',
            'date_consultation',
            'motif_de_consultation',
            'poids',
            'taille',
            'temperature',
            'tension_systolique',
            'tension_diastolique',
        ];
        
        foreach ($champs as $champ) {
            if (!isset($data[$champ]) || trim($data[$champ]) == '') {
                $erreurs[$champ] = 'Veuillez remplir le champ';
            }
        }
        
        if (!isset($data['Symptomes'])) {
            $erreurs['Symptomes'] = 'Veuillez choisir au moins un symptôme';
        }
        
        return $erreurs;
    }

    function val_mesures_Numb($data, $mesures) {
        $erreur = [];

        foreach ($mesures as $key => $config) {
            $value = $data[$key] ?? null;

            if (!is_numeric($value)) {
                $erreur[$key] = "Le champ {$config['label']} doit être un nombre";
                continue;
            }

            $number = (float) $value;

            if ($number < $config['min']) {
                $erreur[$key] = "{$config['label']} doit être ≥ {$config['min']}";
                continue;
            }

            if ($number > $config['max']) {
                $erreur[$key] = "{$config['label']} doit être ≤ {$config['max']}";
                continue;
            }
        }

        return $erreur;
    }

    $mesures = [
        "temperature" => [
            "label" => "Température",
            "min" => 35,
            "max" => 42
        ],
        "poids" => [
            "label" => "Poids",
            "min" => 2,
            "max" => 250
        ],
        "taille" => [
            "label" => "Taille",
            "min" => 0.5,
            "max" => 2.5
        ],
        "tension_systolique" => [
            "label" => "Tension systolique",
            "min" => 80,
            "max" => 200
        ],
        "tension_diastolique" => [
            "label" => "Tension diastolique",
            "min" => 40,
            "max" => 130
        ]
    ];


    function val_date_consultation($data)
    {
        $erreurs = [];

        $date = $data['date_consultation'];

        $date_consultation = strtotime($date);
        $today = strtotime(date("Y-m-d"));

        if ($date_consultation === false) {
            $erreurs['date_consultation'] = "Format de date invalide";
        } elseif ($date_consultation > $today) {
            $erreurs['date_consultation'] = "La date ne peut pas être dans le futur";
        }

        return $erreurs;
    }


   

function calcul_age($date_naissance)
{
    $timestamp_naissance = strtotime($date_naissance);

    $timestamp_today = strtotime(date("Y-m-d"));

    $difference = $timestamp_today - $timestamp_naissance;

    $age = floor($difference / (365 * 24 * 60 * 60));

    return $age;
}















//  function calcul_age($date_naissance){
//     $date_naiss = new DateTime($date_naissance);

//     $today = new DateTime();

//     $difference = $today->diff($date_naiss);

//     return $difference->y;
// }













// function generer_erreurs($data, $mesures)
// {
//     $erreurs = [];

//     $erreurs = array_merge(
//         val_champs_obligatoires($data),
//         valider_mesures_Numb($data, $mesures),
//         valider_date_consultation($data)
//     );

//     return $erreurs;
// }


?>