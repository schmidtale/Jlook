<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


if (!isset($basePath)) {
    $basePath = "";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title><?= $pageTitle ?? "Jlook" ?></title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Global CSS -->
    <link rel="stylesheet"
        href="<?= $basePath ?>assets/css/style.css">

    <!-- Page CSS -->
    <?php if (!empty($pageCSS)): ?>

        <link rel="stylesheet"
            href="<?= $pageCSS ?>">

    <?php endif; ?>

</head>

<body>