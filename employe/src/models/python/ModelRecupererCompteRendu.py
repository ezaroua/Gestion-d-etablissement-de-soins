import sys
from pymongo import MongoClient
import json

if len(sys.argv) < 2:
    print("ID utilisateur non fourni")
    sys.exit(1)

id_user = sys.argv[1]
client = MongoClient('mongodb://localhost:27017/', unicode_decode_error_handler='ignore')
db = client['urgences']
collection = db['patient']
query = {"Informations.id_user": id_user}
consultations = collection.find(query)

for patient in consultations:
    for consultation in patient["consultations"]:
        data = {
            'date': consultation.get('date', 'Non spécifié'),
            'motif': consultation.get('motif', 'Non spécifié'),
            'compte_rendu': consultation.get('compte_rendu', 'Non spécifié'),
            'nom_medecin': consultation.get('nom_medecin', 'Non spécifié'),
            'consultation_id': consultation.get('consultation_id', 'Non spécifié')
        }
        print(json.dumps(data))
