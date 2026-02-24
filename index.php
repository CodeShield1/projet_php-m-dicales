<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultations List</title>
    <style>
        /* Style sghir bach yban l-jadwel mzyan */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #ddd;
        }
    </style>
</head>
<body>

<?php
require("function.php");

$consultations = get_consultation();

echo "<h2>Consultations List</h2>";

// Check if there are consultations
if (empty($consultations)) {
    echo "<p>No consultations found.</p>";
} else {
    
    echo "<table>";
    // Correction: Poid -> Poids, w tag th msakar mzyan
    echo "<tr>
            <th>ID</th>
            <th>Patient Name</th>
            <th>Sex</th>
            <th>Age</th>
            <th>Telephone</th>
            <th>Consultation Date</th>
            <th>Motif</th>
            <th>Temperature (°C)</th>
            <th>Tension</th>
            <th>Poids (kg)</th>
            <th>Taille (M)</th>
            <th>Symptomes</th>
          </tr>";

    
    foreach ($consultations as $consultation) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($consultation["id"]) . "</td>";
        // Correction: ajout espace bin nom w prenom
        echo "<td>" . htmlspecialchars($consultation["nom"] . " " . $consultation["prenom"]) . "</td>";
        echo "<td>" . htmlspecialchars($consultation["sexe"]) . "</td>";
        echo "<td>" . htmlspecialchars($consultation["age"]) . "</td>";
        echo "<td>" . htmlspecialchars($consultation["telephone"]) . "</td>";
        echo "<td>" . htmlspecialchars($consultation["date_consultation"]) . "</td>";
        echo "<td>" . htmlspecialchars($consultation["motif"]) . "</td>";
        
        // Verification bach ma yghltch ila kan tableau fakhya
        $temp_val = $consultation["temperature"]["temp"] ?? 'N/A';
        $temp_etat = $consultation["temperature"]["etat"] ?? '';
        echo "<td>" . $temp_etat . " / " . $temp_val . "</td>";
        
        $tension_sys = $consultation["tension"]["sys"] ?? 'N/A';
        $tension_dia = $consultation["tension"]["dia"] ?? 'N/A';
        echo "<td>" . $tension_sys . " / " . $tension_dia . "</td>";
        
        echo "<td>" . htmlspecialchars($consultation["poids"]) . "</td>";
        echo "<td>" . htmlspecialchars($consultation["taille"]) . "</td>";
        
        $syms = is_array($consultation["symptomes"]) ? implode(" , ", $consultation["symptomes"]) : "";
        echo "<td>" . htmlspecialchars($syms) . "</td>";
        echo "</tr>";
    }

    echo "</table>";
}
?>

</body>
</html>