#!C:\Users\thoma\AppData\Local\Programs\Python\Python312\python.exe 
from pymongo import MongoClient

# Se connecter à MongoDB
client = MongoClient('mongodb://localhost:27017/')

# Sélectionner une base de données
db = client['urgences']

# Sélectionner une collection
collection = db['patient']

numero_securite_sociale = "111-45-6711"
nom="Letoublon"
prenom="Thomas"
sexe="M"
mail="toto@gmail.com"

# Insérer le numéro de sécurité sociale dans un document
collection.insert_one({"numero_securite_sociale": numero_securite_sociale})

# Tableau clé-valeur
Informations = {"nom": nom, "prenom": prenom, "sexe": sexe, "mail":mail}

# Mettre à jour le document pour inclure le tableau clé-valeur
collection.update_one({"numero_securite_sociale": numero_securite_sociale}, {"$set": {"Informations": Informations}}, upsert=True)

# Rechercher des documents
for document in collection.find():
    print(document)