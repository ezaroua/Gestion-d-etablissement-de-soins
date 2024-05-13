import cheminPython

import sys
from pymongo import MongoClient

# Récupérer les arguments passés par le script PHP
arguments = sys.argv[1:]  # Ignorer le premier argument qui est le nom du script Python

# Si il n'y a pas le bon nombre d'argument
if len(arguments) < 1:
    print("Erreur : Le script doit recevoir exactement deux arguments.")
    sys.exit(1)

# Assigner les arguments à des variables appropriées
nom = "test"
prenom = "test"
sexe = "test"
mail = "test"
date_naissance = "test"
profession = "test"
situation_familial = "test"
num_sec = "test"
adresse_postal = "test"
cp = "test"
ville = "test"
pays = "test"
num_tel = "test"
type_assurance = "test"
contacte_cas_urgence = "test"
medecin_traitant = "test"
langue = "test"
print(nom)

Informations = {"nom": nom, "prenom": prenom, "sexe": sexe, "mail":mail, "date_naissance":date_naissance, "profession":profession, "situation_familial":situation_familial, "adresse":adresse_postal, "cp":cp, "ville":ville, "pays":pays, "telephone":num_tel, "type_assurance":type_assurance, "contacte_cas_urgence":contacte_cas_urgence, "medecin_traitant":medecin_traitant, "langue":langue}

# Se connecter à MongoDB
client = MongoClient('mongodb://localhost:27017/')

# Sélectionner une base de données
db = client['urgences']

# Sélectionner une collection
collection = db['patient']

# Insérer le numéro de sécurité sociale dans un document
collection.insert_one({"numero_securite_sociale": num_sec, "Informations":Informations})

# Rechercher des documents
#for document in collection.find():
    #print(document)