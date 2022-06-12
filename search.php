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
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <script src="javascript/jquery-3.6.0.js"></script>
    <script src="javascript/jquery.timeago.js"></script>
    <title>Search</title>
</head>
<body>
    <?php include('php-scripts/navbar.php'); ?>
    <input type="text" id="search-string" value="<?php echo $_GET['search']?>">
    <section class="main">
        <h1>Search results for '<?php echo $_GET['search'] ?>'</h1>
        <div class="search-container" >
            <div class="navigation-bar">
                <p class="navigation-item" data-fetch="people"><i class='bx bxs-user-rectangle'></i> People</p>
                <p class="navigation-item" data-fetch="threads"><i class='bx bxs-message-square-detail'></i> Threads</p>
            </div>
            <div class="result-container">

            </div>
        </div>
    </section>
    <script src="javascript/search.js"></script>
</body>
</html>