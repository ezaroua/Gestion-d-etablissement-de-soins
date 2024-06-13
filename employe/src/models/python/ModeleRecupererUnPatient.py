import cheminPython

import sys
from pymongo import MongoClient

arguments = sys.argv[1:]  # Ignorer le premier argument qui est le nom du script Python

# Récupérer l'argument passé par le script PHP (le premier après le nom du script)
service=arguments[0]
id_user = arguments[1]

# Se connecter à MongoDB
client = MongoClient('mongodb://localhost:27017/', unicode_decode_error_handler='ignore')

if service=="2":
    db = client['urgences']
    collection = db['patient']
elif service=="3":
    db = client['radiologie']
    collection = db['patient']
else:
    print("erreur")

# Appliquer le filtre pour rechercher le patient par id_user
query = {"Informations.id_user": id_user}

# Récupérer tous les documents correspondants
consultations = collection.find(query)

# Récupérer tous les documents
documents = collection.find(query, {"_id": 0})
#, "numero_securite_sociale": 1, "Informations.nom": 1, "Informations.prenom": 1, "Informations.sexe": 1, "Informations.medecin_traitant": 1, "Informations.id_user": 1, "Informations.date_naissance": 1}

# Afficher les documents
for document in documents:
    print([document["numero_securite_sociale"], document["Informations"]["prenom"], document["Informations"]["nom"], document["Informations"]["id_user"], document["Informations"]["date_naissance"], document["Informations"]["sexe"], document["Informations"]["medecin_traitant"], document["Informations"]["mail"], document["Informations"]["profession"], document["Informations"]["situation_familial"], document["Informations"]["adresse"], document["Informations"]["cp"], document["Informations"]["ville"], document["Informations"]["pays"], document["Informations"]["telephone"], document["Informations"]["type_assurance"], document["Informations"]["langue"], document["Informations"]["contacte_cas_urgence"], document["Informations"]["tel_cas_urgence"], document["Informations"]["lien_cas_urgence"]])
