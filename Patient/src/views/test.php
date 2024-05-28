<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Interface de Gestion des Patients</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .navbar {
            background-color: #003366;
            overflow: hidden;
            color: white;
            padding: 14px 20px;
        }

        .navbar a {
            float: left;
            color: white;
            text-align: center;
            padding: 12px;
            text-decoration: none;
            font-size: 17px;
        }

        .logout, .dropdown {
            float: right; /* Positionnement à droite pour les éléments de déconnexion et utilisateur */
            right: 0;
        }

        .dropdown .dropbtn {
            cursor: pointer;
            border: none;
            outline: none;
            background-color: inherit;
            font-family: inherit;
            margin: 0;
            padding: 0; /* Ajustement pour aligner l'image si nécessaire */
        }

        .dropdown .dropbtn img {
            height: 32px; /* Hauteur de l'image pour l'icône utilisateur */
            vertical-align: middle;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
            right: 0;
        }

        .dropdown-content a {
            float: none;
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            text-align: left;
        }

        .dropdown-content a:hover {
            background-color: #ddd;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <a href="#home">ACCUEIL</a>
        <a href="?url=CreationPatient">PATIENT</a>
        <a href="#join">REJOIGNEZ NOUS</a>
        <div class="dropdown">
            <button class="dropbtn"><img src="image.png" alt="User"></button>
            <div class="dropdown-content">
                <a href="#">Mon compte</a>
                <a href="#">Changer mon mot de passe</a>
                <a href="#">Déconnexion</a>
            </div>
        </div>
    </div>

    <!-- Le reste de votre code HTML va ici... -->

</body>
</html>
