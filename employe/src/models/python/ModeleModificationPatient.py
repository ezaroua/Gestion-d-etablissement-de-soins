import cheminPython

import sys
from pymongo import MongoClient

arguments = sys.argv[1:]  # Ignorer le premier argument qui est le nom du script Python

id_user=arguments[0]
prenom=arguments[1]
nom=arguments[2]
mail=arguments[3]
sexe=arguments[4]
date_naissance=arguments[5]
adresse=arguments[6]
cp=arguments[7]
ville=arguments[8]
pays=arguments[9]
profession=arguments[10]
situation_familial=arguments[11]
num_tel=arguments[12]
langue=arguments[13]
num_secu=arguments[14]
assurance=arguments[15]
medecin_traitant=arguments[16]
personne_cas_urgence=arguments[17]
tel_cas_urgence=arguments[18]
lien_cas_urgence=arguments[19]

Informations = {"nom": nom, "prenom": prenom, "sexe": sexe, "mail":mail, "date_naissance":date_naissance, "profession":profession, "situation_familial":situation_familial, "adresse":adresse, "cp":cp, "ville":ville, "pays":pays, "telephone":num_tel, "type_assurance":assurance, "contacte_cas_urgence":personne_cas_urgence, "tel_cas_urgence":tel_cas_urgence, "lien_cas_urgence":lien_cas_urgence, "medecin_traitant":medecin_traitant, "langue":langue, "id_user":id_user}

service=2

# Se connecter à MongoDB
client = MongoClient('mongodb://localhost:27017/', unicode_decode_error_handler='ignore')

while service<=3:
    if service==2:
        db = client['urgences']
    elif service==3:
        db = client['radiologie']

    # Sélectionner une collection
    collection = db['patient']

    filtre={"Informations.id_user": id_user}

    mise_a_jour={
        "$set":{
            "numero_securite_sociale": num_secu,
            "Informations":Informations
        }
    }

    collection.update_one(filtre, mise_a_jour)

    service=service+1