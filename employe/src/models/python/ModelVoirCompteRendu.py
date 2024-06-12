import sys
from pymongo import MongoClient

# Vérifier si l'argument est passé
if len(sys.argv) < 2:
    print("ID utilisateur non fourni")
    sys.exit(1)

id_user = sys.argv[1]  # Récupérer l'ID utilisateur depuis les arguments

client = MongoClient('mongodb://localhost:27017/', unicode_decode_error_handler='ignore')
db = client['urgences']
collection = db['patient']

# Créer un filtre pour récupérer les données basé sur l'ID utilisateur
query = {"Informations.id_user": id_user}

consultations = collection.find(query)

# Imprimer les résultats pour que PHP puisse les lire
for patient in consultations:
    for consultation in patient.get("consultations", []):  # Assurer que 'consultations' existe
        print(f"{consultation['date']}${consultation['motif']}${consultation['compte_rendu']}")
