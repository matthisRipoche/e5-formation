<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Personnaliser l'affichage des erreurs en utilisant un gestionnaire d'erreurs
set_error_handler('customErrorHandler');

function customErrorHandler($errno, $errstr, $errfile, $errline)
{
    // Définir un style rouge pour les erreurs
    echo "<div style='color: red; border: 1px solid red; padding: 10px; margin: 10px;'>
            <strong>Error:</strong> [$errno] $errstr<br>
            <strong>File:</strong> $errfile<br>
            <strong>Line:</strong> $errline
          </div>";
}

function dd($var)
{
    dump($var);
    die;
}
function dump($var)
{
    preprint($var);
}
function preprint($var)
{
    echo "
<pre style='color:red'>";
    print_r($var);
    echo "</pre>";
}

require_once 'include/index.php';
