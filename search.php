<?php
    include('php-scripts/search-scripts.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/default.css">
    <link rel="stylesheet" href="styles/navbar.css">
    <link rel="stylesheet" href="styles/search.css">
    <link rel="stylesheet" href="styles/loader.css">
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <script src="javascript/jquery-3.6.0.js"></script>
    <script src="javascript/jquery.timeago.js"></script>
    <title>Search</title>
</head>
<body>
    <?php include('php-scripts/navbar.php'); ?>
    <div class="loader-superuser">
        <div id="loader"></div>
    </div>
    <section class="main">
        
    </section>
    <script src="javascript/search.js"></script>
</body>
</html>