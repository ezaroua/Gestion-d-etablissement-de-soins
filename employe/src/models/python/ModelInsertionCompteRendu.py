import sys
from pymongo import MongoClient

def main():
    if len(sys.argv) != 5:
        print("Usage: python ModelInsertionCompteRendu.py <id_user> <date> <motif> <compte_rendu>")
        sys.exit(1)

    id_user, date_consultation, motif_consultation, compte_rendu = sys.argv[1:5]

    print(f"Received data - ID: {id_user}, Date: {date_consultation}, Motif: {motif_consultation}, Compte Rendu: {compte_rendu}")

    client = MongoClient('mongodb://localhost:27017/')
    db = client['urgences']
    collection = db['patient']

    result = collection.update_one(
        {"Informations.id_user": id_user},
        {"$push": {"consultations": {
            "date": date_consultation,
            "motif": motif_consultation,
            "compte_rendu": compte_rendu
        }}}
    )

    if result.modified_count > 0:
        print("Mise à jour réussie")
    else:
        print("Erreur lors de la mise à jour ou aucun document trouvé")

if __name__ == '__main__':
    main()
