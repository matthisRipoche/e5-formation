<?php
include_once 'head.php';
?>
<?php
$requestedUrl = $_SERVER['REQUEST_URI'];
$requestedUrl = parse_url($requestedUrl, PHP_URL_PATH);
$baseUrl = '/e5-formation/';
$relativeUrl = str_replace($baseUrl, '', $requestedUrl);
$home = 'home';

if (file_exists('templates/' . $relativeUrl . '.php')) {
    require_once('templates/' . $relativeUrl . '.php');
} elseif ($relativeUrl == '') {
    require_once('templates/' . $home . '.php');
} else {
    require_once('templates/404.php');
}

include_once 'footer.php';
?>