import sys
import base64
from pymongo import MongoClient

def main():
    if len(sys.argv) != 6:
        print("Usage: python ModelInsertionCompteRendu.py <id_user> <date> <motif> <compte_rendu> <nom_medecin>")
        sys.exit(1)

    id_user, date_consultation, motif_consultation, compte_rendu_encoded, nom_medecin = sys.argv[1:6]
    compte_rendu = base64.b64decode(compte_rendu_encoded).decode('utf-8')  # Décoder la chaîne Base64

    print(f"Received data - ID: {id_user}, Date: {date_consultation}, Motif: {motif_consultation}, Compte Rendu: {compte_rendu}, Nom Medecin: {nom_medecin}")

    client = MongoClient('mongodb://localhost:27017/')
    db = client['urgences']
    collection = db['patient']

    result = collection.update_one(
        {"Informations.id_user": id_user},
        {"$push": {"consultations": {
            "date": date_consultation,
            "motif": motif_consultation,
            "compte_rendu": compte_rendu,
            "nom_medecin": nom_medecin
        }}}
    )

    if result.modified_count > 0:
        print("Mise à jour réussie")
    else:
        print("Erreur lors de la mise à jour ou aucun document trouvé")

if __name__ == '__main__':
    main()
