<?php

if (!isset($_SESSION['user'])) {
    header('Location: login');
    exit;
}

if ($_SESSION['user']->getRole() === 'admin') {
    require_once 'templates/dashboards/admin/home.php';
} elseif ($_SESSION['user']->getRole() === 'enseignant') {
    require_once 'templates/dashboards/prof/home.php';
} elseif ($_SESSION['user']->getRole() === 'eleve') {
    require_once 'templates/dashboards/eleve/home.php';
}
