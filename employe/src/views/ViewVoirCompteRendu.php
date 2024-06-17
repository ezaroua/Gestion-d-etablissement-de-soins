<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Compte Rendu Médical</title>
    <style>
        body, html {
            margin: 0;
            padding: 0;
            font-family: 'Times New Roman', serif;
            background: #fff;
            color: #000;
        }
        .container {
            width: 80%;
            margin: 20px auto;
            padding: 20px;
            background: #fff;
            box-shadow: none;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h1 {
            font-size: 24px;
        }
        .section {
            margin-bottom: 20px;
        }
        .section h2 {
            font-size: 18px;
            border-bottom: 1px solid #ccc;
            padding-bottom: 5px;
        }
        .content p {
            font-size: 16px;
            line-height: 1.5;
        }
        .report-content {
            font-size: 18px; 
            margin-top: 10px; 
        }
        .signature {
            text-align: right;
            margin-top: 40px;       
            padding-right: 20px;"
        }
        
        .footer {
            text-align: center;
            font-size: 14px;
            margin-top: 20px;
        }

        @media print {
            body {
                width: 100%;
                margin: 0;
                box-shadow: none;
            }
            .container {
                width: 100%;
                max-width: none;
                margin: 0 auto;
                box-shadow: none;
            }
            .section .content, .report-content {
                font-size: 18px; 
            }
            .footer, .header {
                display: none; 
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Compte Rendu Médical</h1>
        </div>
        <div class="section">
            <h2>Informations Générales</h2>
            <p>Patient : <?= htmlspecialchars($consultation['prenom'] . " " . $consultation['nom']) ?></p>
            <p><strong>Date de Consultation:</strong> <?= htmlspecialchars($consultation['date']) ?></p>
            <p><strong>Numéro de Sécurité Sociale:</strong> <?= htmlspecialchars($consultation['numero_securite_sociale']) ?></p>
            <p>Médecin Traitant: <?= htmlspecialchars($consultation['nom_medecin']) ?></p>
        </div>
        <div class="section">
            <h2>Description de la Consultation</h2>
            <div class="report-content">
                <p><strong>Motif de Consultation: </strong> <?= htmlspecialchars($consultation['motif']) ?></p>
                <strong>Compte Rendu:</strong>
                <p><?= nl2br(html_entity_decode($consultation['compte_rendu'])) ?></p>
            </div>
        </div>
        <div class="section">
            <h2>Médecin</h2>
            <p><?= htmlspecialchars($consultation['medecin_traitant']) ?></p>
        </div>
        <div class="signature">
            <p>Signature du Médecin</p>
        </div>
        <div class="footer">
            <p>Clinique Sainte-Marie, 123 Rue de la Santé, 75012 Paris</p>
        </div>
    </div>
</body>
</html>
