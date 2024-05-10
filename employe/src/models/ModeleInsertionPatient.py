import cheminPython

import sys
from pymongo import MongoClient

# Récupérer les arguments passés par le script PHP
arguments = sys.argv[1:]  # Ignorer le premier argument qui est le nom du script Python

# Si vous avez besoin de deux arguments
if len(arguments) != 5:
    print("Erreur : Le script doit recevoir exactement deux arguments.")
    sys.exit(1)

# Assigner les arguments à des variables appropriées
argument1 = arguments[0]
argument2 = arguments[1]
argument3 = arguments[2]
argument4 = arguments[3]
argument5 = arguments[4]

Informations = {"nom": argument2, "prenom": argument3, "sexe": argument4, "mail":argument5}

# Se connecter à MongoDB
client = MongoClient('mongodb://localhost:27017/')

# Sélectionner une base de données
db = client['urgences']

# Sélectionner une collection
collection = db['patient']

# Insérer le numéro de sécurité sociale dans un document
collection.insert_one({"numero_securite_sociale": argument1, "Informations":Informations})

# Rechercher des documents
#for document in collection.find():
#    print(document)