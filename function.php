<?php

    function val_champs_obligatoires($data){
    $erreurs = [];

        $champes = [
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
        foreach ($champes as $champ) {
            if(!isset($data[$champ])||trim($data[$champ])== ''){
            $erreurs[$champ] = 'veuillez remplir le champ';
            }

        }if(!isset($data['Symptomes'])){
            $erreurs['Symptomes']='Veuillze choiser au moins un symptome';
        }

    }

    function valider_mesures_Numb($data, $mesures)
    {
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


// $mesures = [
//   "temperature" => [
//      "label" => "Température",
//       "min" => 35, 
//       "max" => 42 ],

?>