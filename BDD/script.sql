-- Création de la table Utilisateurs
CREATE TABLE Users (
    id_user INT NOT NULL PRIMARY KEY,
    Nom_user VARCHAR(255) NOT NULL,
    prenom_user VARCHAR(255) NOT NULL,
    sexe VARCHAR(50) NOT NULL,
    adresse_mail VARCHAR(255) NOT NULL,
    mot_de_passe_hash VARCHAR(255) NOT NULL
);

-- Création de la table Employe
CREATE TABLE employes (
    id_user INT NOT NULL PRIMARY KEY,
    poste VARCHAR(50) NOT NULL,
    date_embauche DATE NOT NULL,
    type_contrat CHAR(3) NOT NULL,
    date_debut_contrat DATE,
    date_fin_contrat DATE,
    id_service INT,
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


-- Création de la table Service
CREATE TABLE service (
    id_service INT NOT NULL PRIMARY KEY,
    nom_service VARCHAR(50) NOT NULL,
    role_service VARCHAR(255) NOT NULL
);

-- Création de la table DemandeModificationPatient
CREATE TABLE demandeModificationPatient (
    id_modification VARCHAR(50) NOT NULL PRIMARY KEY,
    nom_champ VARCHAR(50) NOT NULL,
    ancienne_valeur VARCHAR(50) NOT NULL,
    valeur_demandee VARCHAR(50) NOT NULL,
    date_demande DATETIME NOT NULL,
    statut VARCHAR(50) NOT NULL,
    date_traitement DATETIME,
    id_user INT NOT NULL,
    FOREIGN KEY (id_user) REFERENCES Patient(id_user)
);


ALTER TABLE users
ADD CONSTRAINT contrainte_unique UNIQUE (id_user);

ALTER TABLE patients
ADD CONSTRAINT contrainte_unique UNIQUE (num_sec);

ALTER TABLE employes
ADD CONSTRAINT id_service
FOREIGN KEY(id_service) REFERENCES Service(id_service)