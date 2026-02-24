<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Consultations</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f6f9;
            margin: 0;
            padding: 20px;
            color: #333;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 20px;
        }
        .table-responsive {
            overflow-x: auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 900px; /* Force scroll sur mobile */
        }
        th, td {
            padding: 12px 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #3498db;
            color: white;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.9em;
            position: sticky;
            top: 0;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .badge {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 0.85em;
            font-weight: bold;
        }
        .badge-temp { background: #fff3cd; color: #856404; }
        .badge-tension { background: #d1ecf1; color: #0c5460; }
        .no-data {
            text-align: center;
            padding: 20px;
            color: #777;
            font-style: italic;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>📋 Liste des Consultations</h2>
    
    <?php
    require("function.php");
    $consultations = get_consultation();

    if (empty($consultations)) {
        echo "<p class='no-data'>Aucune consultation trouvée.</p>";
    } else {
        echo "<div class='table-responsive'>";
        echo "<table>";
        echo "<thead>
                <tr>
                    <th>ID</th>
                    <th>Patient</th>
                    <th>Sexe</th>
                    <th>Âge</th>
                    <th>Téléphone</th>
                    <th>Date</th>
                    <th>Motif</th>
                    <th>Température</th>
                    <th>Tension</th>
                    <th>Poids</th>
                    <th>Taille</th>
                    <th>Symptômes</th>
                    <th>ALERT</th>
                    

                </tr>
              </thead>";
        echo "<tbody>";
        
        foreach ($consultations as $c) {
            // Sécurisation des données affichées
            $nom = htmlspecialchars($c["nom"] . " " . $c["prenom"]);
            $symptomes = htmlspecialchars(implode(", ", $c["symptomes"] ?? []));
            
            // Formatage des badges pour les constantes
            $tempBadge = "<span class='badge badge-temp'>{$c['temperature']['temp']}°C ({$c['temperature']['etat']})</span>";
            $tensionVal = $c["tension"]["sys"] . "/" . $c["tension"]["dia"];
            $tensionBadge = "<span class='badge badge-tension'>{$tensionVal}</span>";

            echo "<tr>";
            echo "<td><strong>" . htmlspecialchars($c["id"]) . "</strong></td>";
            echo "<td>{$nom}</td>";
            echo "<td>" . htmlspecialchars($c["sexe"]) . "</td>";
            echo "<td>" . htmlspecialchars($c["age"]) . "</td>";
            echo "<td>" . htmlspecialchars($c["telephone"]) . "</td>";
            echo "<td>" . htmlspecialchars($c["date_consultation"]) . "</td>";
            echo "<td>" . htmlspecialchars($c["motif"]) . "</td>";
            echo "<td>{$tempBadge}</td>";
            echo "<td>{$tensionBadge}</td>";
            echo "<td>" . htmlspecialchars($c["poids"]) . " kg</td>";
            echo "<td>" . htmlspecialchars($c["taille"]) . " m</td>";
            echo "<td>{$symptomes}</td>";
            echo "<td>" . htmlspecialchars($c["alert"]) . " m</td>";

            echo "</tr>";
        }
        
        echo "</tbody></table></div>";
    }
    ?>
</div>

</body>
</html>