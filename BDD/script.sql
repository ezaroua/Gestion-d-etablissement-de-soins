-- Création de la table Utilisateurs
CREATE TABLE Users (
    id_user INT NOT NULL PRIMARY KEY,
    Nom_user VARCHAR(255) NOT NULL,
    prenom_user VARCHAR(255) NOT NULL,
    sexe VARCHAR(50) NOT NULL,
    adresse_mail VARCHAR(255) NOT NULL,
    login VARCHAR(50) NOT NULL,
    mot_de_passe_hash VARCHAR(50) NOT NULL
);

-- Création de la table Employe
CREATE TABLE employes (
    id_user INT NOT NULL PRIMARY KEY,
    poste VARCHAR(50) NOT NULL,
    date_embauche DATE NOT NULL,
    type_contrat CHAR(3) NOT NULL,
    date_debut_contrat DATE,
    date_fin_contrat DATE,
    FOREIGN KEY (id_user) REFERENCES Users(id_user)
);

-- Création de la table Patient
CREATE TABLE patients (
    id_user INT NOT NULL PRIMARY KEY,
    date_naissance DATE NOT NULL,
    profession VARCHAR(50),
    situation_familial VARCHAR(50),
    num_sec CHAR(14) NOT NULL,
    adresse_postal VARCHAR(150) NOT NULL,
    num_tel CHAR(10),
    type_assurance VARCHAR(50),
    contacte_cas_urgence VARCHAR(255),
    MedecinTraitant VARCHAR(150),
    langue_parler VARCHAR(50),
    FOREIGN KEY (id_user) REFERENCES Users(id_user)
);

-- Création de la table Groupe
CREATE TABLE groupe (
    id_groupe INT NOT NULL PRIMARY KEY,
    nom_groupe VARCHAR(150) NOT NULL,
    role INT NOT NULL,
    droit VARCHAR(50)
);

-- Création de la table Rendez_vous
CREATE TABLE rendez_vous (
    id VARCHAR(50) NOT NULL PRIMARY KEY,
    id_patient INT NOT NULL,
    id_employe INT NOT NULL,
    date_heure DATETIME NOT NULL,
    motif VARCHAR(255) NOT NULL,
    statut VARCHAR(50) NOT NULL,
    FOREIGN KEY (id_patient) REFERENCES Patient(id_user),
    FOREIGN KEY (id_employe) REFERENCES Employe(id_user)
);

-- Création de la table Facturation
CREATE TABLE facturation (
    id_facture INT NOT NULL PRIMARY KEY,
    date_facturation DATETIME NOT NULL,
    montant DECIMAL(15,2) NOT NULL,
    statut_paiement VARCHAR(50) NOT NULL,
    id_user INT NOT NULL,
    FOREIGN KEY (id_user) REFERENCES Users(id_user)
);

-- Création de la table Service
CREATE TABLE service (
    id_service INT NOT NULL PRIMARY KEY,
    nom_service VARCHAR(50) NOT NULL,
    libelle_service VARCHAR(255) NOT NULL,
    responsable INT NOT NULL,
    FOREIGN KEY (responsable) REFERENCES Employe(id_user)
);

-- Création de la table DemandeModificationPatient
CREATE TABLE demandeModificationPatient (
    id_modification VARCHAR(50) NOT NULL PRIMARY KEY,
    nom_champ VARCHAR(50) NOT NULL,
    valeur_actuelle VARCHAR(50) NOT NULL,
    valeur_demandee VARCHAR(50) NOT NULL,
    date_demande DATETIME NOT NULL,
    statut VARCHAR(50) NOT NULL,
    date_traitement DATETIME,
    id_user INT NOT NULL,
    FOREIGN KEY (id_user) REFERENCES Patient(id_user)
);

-- Création de la table Hospitalisation
CREATE TABLE hospitalisation (
    id_hospitalisation INT NOT NULL PRIMARY KEY,
    date_entree DATETIME NOT NULL,
    date_sortie DATETIME,
    chambre INT NOT NULL,
    lit INT NOT NULL,
    id_service INT NOT NULL,
    id_user INT NOT NULL,
    FOREIGN KEY (id_service) REFERENCES Service(id_service),
    FOREIGN KEY (id_user) REFERENCES Patient(id_user)
);


CREATE TABLE Appartient (
    id_user INT NOT NULL,
    id_groupe INT NOT NULL,
    PRIMARY KEY (id_user, id_groupe),
    FOREIGN KEY (id_user) REFERENCES Users(id_user),
    FOREIGN KEY (id_groupe) REFERENCES Groupe(id_groupe)
);


ALTER TABLE users
ADD CONSTRAINT contrainte_unique UNIQUE (id_user);

ALTER TABLE patients
ADD CONSTRAINT contrainte_unique UNIQUE (num_sec);
