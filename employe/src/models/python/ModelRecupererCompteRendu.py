import sys
from pymongo import MongoClient

# Vérifier si l'argument est passé
if len(sys.argv) < 2:
    print("ID utilisateur non fourni")
    sys.exit(1)

# Récupérer l'argument passé par le script PHP (le premier après le nom du script)
id_user = sys.argv[1]

# Se connecter à MongoDB
client = MongoClient('mongodb://localhost:27017/', unicode_decode_error_handler='ignore')
db = client['urgences']
collection = db['patient']

# Appliquer le filtre pour rechercher le patient par id_user
query = {"Informations.id_user": id_user}

# Récupérer tous les documents correspondants
consultations = collection.find(query)

# Afficher les informations de chaque consultation
for patient in consultations:
    for consultation in patient["consultations"]:
        print(f"{consultation['date']}${consultation['motif']}${consultation['compte_rendu'] }")
