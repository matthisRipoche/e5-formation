<?php

// include des fichiers a la racine
require_once 'connexionbdd.php';
require_once 'rooting.php';

// include des fichiers entity

require_once 'entity/user.php';
require_once 'entity/classe.php';
require_once 'entity/matiere.php';
require_once 'entity/cour.php';

// include des fichiers dans formhandle
require_once 'formhandle/formvalidator.php';
require_once 'formhandle/loginformhandler.php';
require_once 'formhandle/registerformhandler.php';

// include des fichiers dans eleve
require_once 'eleve/elevehomeController.php';

// include des fichiers dans prof
require_once 'enseignant/enseignanthomeController.php';

// include des fichiers dans admin
require_once 'admin/adminhomeController.php';
require_once 'admin/adminclasseController.php';
require_once 'admin/adminmatiereController.php';
require_once 'admin/admincourController.php';
require_once 'admin/adminuserController.php';
