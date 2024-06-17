import sys
import json
from pymongo import MongoClient

def log(message):
    """ Log messages to stderr for debugging purposes. """
    print(message, file=sys.stderr)

if len(sys.argv) < 3:
    log("Arguments insuffisants fournis")
    sys.exit(1)

id_user = sys.argv[1]
service = sys.argv[2]

try:
    client = MongoClient('mongodb://localhost:27017/', unicode_decode_error_handler='ignore')
    if service.strip() == "":
        log("Le nom de la base de données ne peut pas être vide")
        sys.exit(1)
    db = client[service]
    collection = db['patient']
except Exception as e:
    log(f"Erreur de connexion à MongoDB: {e}")
    sys.exit(1)

query = {"Informations.id_user": id_user}
consultations = collection.find(query)
results = list(consultations)

if not results:
    log("Aucune consultation trouvée correspondant aux critères.")
else:
    for patient in results:
        for consultation in patient.get("consultations", []):
            data = {
                'date': consultation.get('date', 'Non spécifié'),
                'motif': consultation.get('motif', 'Non spécifié'),
                'compte_rendu': consultation.get('compte_rendu', 'Non spécifié'),
                'nom_medecin': consultation.get('nom_medecin', 'Non spécifié'),
                'consultation_id': consultation.get('consultation_id', 'Non spécifié')
            }
            print(json.dumps(data))
