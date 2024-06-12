<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Compte Rendu Médical</title>
    <style>
        body {
            font-family: 'Times New Roman', serif;
            margin: 40px;
            background: #fff;
            color: #333;
        }
        .header, .footer {
            text-align: center;
            margin: 10px 0;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .content {
            margin-top: 20px;
            line-height: 1.6;
        }
        .content p {
            margin: 10px 0;
        }
        .signature {
            margin-top: 30px;
            text-align: right;
            font-style: italic;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Compte Rendu Médical</h1>
    </div>
    <div class="content">
        <p><strong>Nom du Patient:</strong> Jean Dupont</p>
        <p><strong>Date de Consultation:</strong> 1er Juin 2023</p>
        <p><strong>Motif de Consultation:</strong> Visite annuelle de routine</p>
        <p><strong>Numéro de Sécurité Sociale:</strong> 123 456 789 0123</p>
        <p><strong>Compte Rendu:</strong> Le patient présente un bon état de santé général. Aucune anomalie n'a été détectée durant l'examen. Recommandations pour maintenir une alimentation équilibrée et une activité physique régulière.</p>
    </div>
    <div class="signature">
        <p>Dr. Alain Delon</p>
        <p>Le Médecin Traitant</p>
    </div>
    <div class="footer">
        <p>Clinique Sainte-Marie, 123 Rue de la Santé, 75012 Paris</p>
    </div>

    
<?php if (!empty($comptesRendus)): ?>
            <table>
                <tr>
                    <th>Date</th>
                    <th>Motif</th>
                    <th>Compte Rendu</th>
                </tr>
                <?php foreach ($comptesRendus as $cr): ?>
                <tr>
                    <td><?= htmlspecialchars($cr['date']) ?></td>
                    <td><?= htmlspecialchars($cr['motif']) ?></td>
                    <td><?= htmlspecialchars($cr['compte_rendu']) ?></td>
                </tr>
                <?php endforeach; ?>
            </table>

<?php endif; ?>
</body>
</html>

