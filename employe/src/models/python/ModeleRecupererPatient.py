import cheminPython

import sys
from pymongo import MongoClient
# Récupérer les arguments passés par le script PHP
arguments = sys.argv[1:]  # Ignorer le premier argument qui est le nom du script Python

# les arguments doivent etre nom, prénom, date de naissance, numéro de secu pour le tri
nom = arguments[0]
prenom = arguments[1]
date_naissance = arguments[2]
num_sec = arguments[3]
service=arguments[4]

#date au format YYYY-mm-dd


# Se connecter à MongoDB
client = MongoClient('mongodb://localhost:27017/', unicode_decode_error_handler='ignore')

if service=="1":
    db = client['urgences']
    # Sélectionner une collection
    collection = db['patient']
else:
    print("erreur")

#j'applique le filtre
if date_naissance=="":
    query={"Informations.nom":{"$regex": nom, "$options": "i"}, "Informations.prenom":{"$regex": prenom, "$options": "i"}, "numero_securite_sociale":{"$regex": num_sec, "$options": "i"}}
else:
    query={"Informations.nom":{"$regex": nom, "$options": "i"}, "Informations.prenom":{"$regex": prenom, "$options": "i"}, "numero_securite_sociale":{"$regex": num_sec, "$options": "i"}, "Informations.date_naissance":date_naissance}

# Récupérer tous les documents
documents = collection.find(query, {"_id": 0, "numero_securite_sociale": 1, "Informations.nom": 1, "Informations.prenom": 1, "Informations.sexe": 1, "Informations.medecin_traitant": 1, "Informations.id_user": 1, "Informations.date_naissance": 1})

# Afficher les documents
for document in documents:
    print([document["numero_securite_sociale"], document["Informations"]["prenom"], document["Informations"]["nom"], document["Informations"]["id_user"], document["Informations"]["date_naissance"], document["Informations"]["sexe"], document["Informations"]["medecin_traitant"]])