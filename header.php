<?php
$base_url = sprintf(
    "%s://%s%s",
    isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
    $_SERVER['SERVER_NAME'],
    rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\')
);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

    <base href="<?php echo $base_url; ?>/">

    <title>Formation</title>
</head>

<body>
    <header>
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <div class="logo_container">
                    <h2><a href="/e5-formation/">Sign and Work</a></h2>
                </div>
                <div>
                    <a href="/e5-formation/login">login</a> / <a href="/e5-formation/register">register</a>
                </div>
            </div>
        </div>
    </header>