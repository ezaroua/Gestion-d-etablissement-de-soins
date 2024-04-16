<?php

$_bdd = new PDO('mysql:host=localhost;dbname=db_administrative_patient;charset=utf8', 'root', '');
$_bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
require('../models/ModeleCreationPatient.php');
require('../views/ViewCreationPatient.php');
