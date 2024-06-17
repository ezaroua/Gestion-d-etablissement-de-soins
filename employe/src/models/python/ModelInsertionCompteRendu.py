import sys
import base64
from pymongo import MongoClient

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
    if len(sys.argv) != 6:
        print("Usage: python ModelInsertionCompteRendu.py <id_user> <date> <motif> <compte_rendu_encoded> <nom_medecin>")
        sys.exit(1)

    id_user, date_consultation, motif_consultation, compte_rendu_encoded, nom_medecin = sys.argv[1:6]
    compte_rendu = base64.b64decode(compte_rendu_encoded).decode('utf-8')  # Décodez ici le texte encodé

    client = MongoClient('mongodb://localhost:27017/')
    db = client['urgences']


    create_sequence(db, 'consultation_id')
    consultation_id = get_next_sequence_value(db, 'consultation_id')

    result = db.patient.update_one(
        {"Informations.id_user": id_user},
        {"$push": {"consultations": {
            "consultation_id": consultation_id,
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
