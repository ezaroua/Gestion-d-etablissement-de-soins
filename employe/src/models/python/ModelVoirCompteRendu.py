import sys
import json
from pymongo import MongoClient

def log(message):
    """ Journalise les messages sur stderr pour le débogage. """
    print(message, file=sys.stderr)
    
if len(sys.argv) < 3:
    print(json.dumps({"error": "ID utilisateur et ID de consultation sont nécessaires"}))
    sys.exit(1)

id_user = sys.argv[1]
consultation_id = int(sys.argv[2])
service = sys.argv[3]

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

# Trouver la consultation spécifique
query = {
    "Informations.id_user": id_user,
    "consultations.consultation_id": consultation_id
}
projection = {"consultations.$": 1, "Informations": 1, "numero_securite_sociale": 1} 

patient = collection.find_one(query, projection)

if not patient:
    print(json.dumps({"error": "Aucune consultation trouvée avec les IDs spécifiés"}))
    sys.exit(1)

# Retourner les détails de la consultation trouvée et les informations générales du patient
consultation = patient['consultations'][0]
informations = patient['Informations']
numero_securite_sociale = patient['numero_securite_sociale'] 
print(json.dumps({
    "date": consultation['date'],
    "motif": consultation['motif'],
    "compte_rendu": consultation['compte_rendu'],
    "nom_medecin": consultation['nom_medecin'],
    "numero_securite_sociale": numero_securite_sociale,
    "prenom": informations['prenom'],
    "nom": informations['nom'],
    "medecin_traitant": informations['medecin_traitant']
}))
