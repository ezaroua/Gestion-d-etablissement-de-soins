import sys
import json
from pymongo import MongoClient

def log(message):
    """ Journalise les messages sur stderr pour le débogage. """
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
projection = {"consultations": 1, "Informations": 1, "numero_securite_sociale": 1} 
patient = collection.find_one(query, projection)

if not patient:
    print(json.dumps({"error": "Aucune consultation trouvée avec les IDs spécifiés"}))
    sys.exit(1)

# Retourner les détails de toutes les consultations trouvées et les informations générales du patient
consultations = patient['consultations'] if 'consultations' in patient else []
informations = patient['Informations'] if 'Informations' in patient else {}
numero_securite_sociale = patient.get('numero_securite_sociale', '')

resultats = []
for consultation in consultations:
    resultats.append({
        "date": consultation.get('date', ''),
        "motif": consultation.get('motif', ''),
        "compte_rendu": consultation.get('compte_rendu', ''),
        "nom_medecin": consultation.get('nom_medecin', ''),
        "numero_securite_sociale": numero_securite_sociale,
        "consultation_id": consultation.get('consultation_id', ''),
        "prenom": informations.get('prenom', ''),
        "nom": informations.get('nom', ''),
        "service": service
    })

print(json.dumps(resultats))
