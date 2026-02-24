<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php if (isset($resultat)): ?>

<h2>📋 Rapport de Consultation</h2>

<hr>

<h3>👤 Informations Patient</h3>
<p>
<strong>Nom:</strong> <?= $resultat['nom']; ?> <?= $resultat['prenom']; ?><br>
<strong>Sexe:</strong> <?= $resultat['sexe']; ?><br>
<strong>Âge:</strong> <?= $resultat['age']; ?> ans<br>
<strong>Téléphone:</strong> <?= $resultat['telephone']; ?>
</p>

<hr>

<h3>🩺 Consultation</h3>
<p>
<strong>Date:</strong> <?= $resultat['date_consultation']; ?><br>
<strong>Motif:</strong> <?= $resultat['motif']; ?><br>
<strong>Symptômes:</strong>
<?= implode(", ", $resultat['symptomes']); ?>
</p>

<hr>

<h3>🌡 Température</h3>
<p>
<?= $resultat['temperature_valeur']; ?> °C —
<?= $resultat['temperature']['etat']; ?>
(Level <?= $resultat['temperature']['level']; ?>)
</p>

<hr>

<h3>❤️ Tension Artérielle</h3>
<p>
<?= $resultat['tension_sys']; ?> / <?= $resultat['tension_dia']; ?> —
<?= $resultat['tension']['etat']; ?>
 (Level <?= $resultat['tension']['level']; ?>)
</p>

<hr>

<h3>⚖️ IMC</h3>
<p>
<strong>Poids:</strong> <?= $resultat['poids']; ?> kg<br>
<strong>Taille:</strong> <?= $resultat['taille']; ?> m<br>
<strong>IMC:</strong> <?= $resultat['imc']; ?> —
<?= $resultat['imc_etat']['etat']; ?>
(Level <?= $resultat['imc_etat']['level']; ?>)
</p>

<hr>

<h2><?= $resultat['alert']; ?></h2>

<?php endif; ?>
</body>
</html>