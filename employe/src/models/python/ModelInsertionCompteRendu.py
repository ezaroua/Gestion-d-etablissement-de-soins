import sys
from pymongo import MongoClient
import base64


def create_sequence(db, sequence_name):
    if db.sequences.find_one({"_id": sequence_name}) is None:
        db.sequences.insert_one({"_id": sequence_name, "seq": 0})
        print(f"Sequence '{sequence_name}' created.")
    else:
        print(f"Sequence '{sequence_name}' already exists.")

def get_next_sequence_value(db, sequence_name):
    sequence_document = db.sequences.find_one_and_update(
        {"_id": sequence_name},
        {"$inc": {"seq": 1}},
        return_document=True
    )
    if sequence_document is None:
        create_sequence(db, sequence_name)
        return get_next_sequence_value(db, sequence_name)
    return sequence_document['seq']

def main():
    if len(sys.argv) != 7:
        print("Usage: python ModelInsertionCompteRendu.py <id_user> <date> <motif> <compte_rendu> <nom_medecin> <id_service>")
        sys.exit(1)

    id_user, date_consultation, motif_consultation, compte_rendu, nom_medecin, id_service = sys.argv[1:7]
    compte_rendu = base64.b64decode(compte_rendu).decode('utf-8')  # Décodez ici le texte encodé
    client = MongoClient('mongodb://localhost:27017/')
    
    if id_service == "2":
        db = client['urgences']
    elif id_service == "3":
        db = client['radiologie']
    else:
        print("ID de service non reconnu.")
        sys.exit(1)

    create_sequence(db, 'consultation_id')
    consultation_id = get_next_sequence_value(db, 'consultation_id')

    result = db.patient.update_one(
        {"Informations.id_user": id_user},
        {"$push": {"consultations": {
            "consultation_id": consultation_id,
            "date": date_consultation,
            "motif": motif_consultation,
            "compte_rendu": compte_rendu,  # Utilisation du texte brut
            "nom_medecin": nom_medecin
        }}}
    )

    if result.modified_count > 0:
        print("Mise à jour réussie")
    else:
        print("Erreur lors de la mise à jour ou aucun document trouvé")

if __name__ == '__main__':
    main()

#hhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhh
