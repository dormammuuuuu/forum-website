<?php
    include('php-scripts/home-scripts.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="color-scheme" content="light">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="styles/default.css">
    <link rel="stylesheet" href="styles/home.css">
    <link rel="stylesheet" href="styles/navbar.css">
    <script src="javascript/jquery-3.6.0.js"></script>
    <script src="javascript/jquery.timeago.js"></script>
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    
    <?php include('php-scripts/navbar.php'); ?>

    <section class="main">
        <div class="container">
            <div class="content-area">
                <div class="create-thread">+ Make Thread</div>
                <div class="divider">
                    <p>Recent Threads </p>
                    <div>
                        <hr>
                    </div>
                </div>

                <div class="threads-container">

                    <?php fetchThreads(); ?>

                    <div class="thread">
                        <div class="thread-title">Bakit walang ulam?</div>
                        <div class="thread-author">
                            <img class="thread-avatar" src="assets/images/avatar/default.jpg" alt="">
                            <div class="thread-details">
                                <div class="thread-user">
                                    <p class="thread-name">Ramina Santos</p>
                                    <p class="thread-user-type">Student</p>
                                </div>
                                <p class="thread-published">December 25, 2013</p>
                            </div>
                        </div>
                        <div class="thread-content">
                            <p class="thread-content-text">Lörem ipsum blippbetalning ambision i trirenar för att karen lockdown. Krogäs neren mytotism, nisamma. Sugrörsseende lär intranera. Ladade pujörade. Lätthelg ode om äst, låvår. Dirar hikikomori, som olig. Onåv bel. Seminade hikikomori. Tist gögt i nina eller nesat det vill säga sodat. Exott infranade mikroling. Ben heterogen det teraning jögt, inte mikera. Gensax junde och sere vavobåkasm, boseska. Lanas suprar laskade. Sor kaköbelt eus. Kenade krokrore mubelt än deliga: </p>
                        </div>
                        <div class="thread-buttons">
                            <div class="thread-save">
                                <i class='bx bx-star'></i>
                            </div>
                            <div class="thread-add-response">
                                <i class='bx bxs-message'></i>
                                <p>Add response</p>
                            </div>
                        </div>
                    </div>
                    <div class="thread">
                        <div class="thread-title">Bakit walang ulam?</div>
                        <div class="thread-author">
                            <img class="thread-avatar" src="assets/images/avatar/default.jpg" alt="">
                            <div class="thread-details">
                                <div class="thread-user">
                                    <p class="thread-name">Ramina Santos</p>
                                    <p class="thread-user-type">Student</p>
                                </div>
                                <p class="thread-published">December 25, 2013</p>
                            </div>
                        </div>
                        <div class="thread-content">
                            <p class="thread-content-text">Lörem ipsum blippbetalning ambision i trirenar för att karen lockdown. Krogäs neren mytotism, nisamma. Sugrörsseende lär intranera. Ladade pujörade. Lätthelg ode om äst, låvår. Dirar hikikomori, som olig. Onåv bel. Seminade hikikomori. Tist gögt i nina eller nesat det vill säga sodat. Exott infranade mikroling. Ben heterogen det teraning jögt, inte mikera. Gensax junde och sere vavobåkasm, boseska. Lanas suprar laskade. Sor kaköbelt eus. Kenade krokrore mubelt än deliga: </p>
                        </div>
                        <div class="thread-buttons">
                            <div class="thread-save">
                                <i class='bx bx-star'></i>
                            </div>
                            <div class="thread-add-response">
                                <i class='bx bxs-message'></i>
                                <p>Add response</p>
                            </div>
                        </div>
                    </div>
                    <div class="thread">
                        <div class="thread-title">Bakit walang ulam?</div>
                        <div class="thread-author">
                            <img class="thread-avatar" src="assets/images/avatar/default.jpg" alt="">
                            <div class="thread-details">
                                <div class="thread-user">
                                    <p class="thread-name">Ramina Santos</p>
                                    <p class="thread-user-type">Student</p>
                                </div>
                                <p class="thread-published">December 25, 2013</p>
                            </div>
                        </div>
                        <div class="thread-content">
                            <p class="thread-content-text">Lörem ipsum blippbetalning ambision i trirenar för att karen lockdown. Krogäs neren mytotism, nisamma. Sugrörsseende lär intranera. Ladade pujörade. Lätthelg ode om äst, låvår. Dirar hikikomori, som olig. Onåv bel. Seminade hikikomori. Tist gögt i nina eller nesat det vill säga sodat. Exott infranade mikroling. Ben heterogen det teraning jögt, inte mikera. Gensax junde och sere vavobåkasm, boseska. Lanas suprar laskade. Sor kaköbelt eus. Kenade krokrore mubelt än deliga: </p>
                        </div>
                        <div class="thread-buttons">
                            <div class="thread-save">
                                <i class='bx bx-star'></i>
                            </div>
                            <div class="thread-add-response">
                                <i class='bx bxs-message'></i>
                                <p>Add response</p>
                            </div>
                        </div>
                    </div>
                    <div class="thread">
                        <div class="thread-title">Bakit walang ulam?</div>
                        <div class="thread-author">
                            <img class="thread-avatar" src="assets/images/avatar/default.jpg" alt="">
                            <div class="thread-details">
                                <div class="thread-user">
                                    <p class="thread-name">Ramina Santos</p>
                                    <p class="thread-user-type">Student</p>
                                </div>
                                <p class="thread-published">December 25, 2013</p>
                            </div>
                        </div>
                        <div class="thread-content">
                            <p class="thread-content-text">Lörem ipsum blippbetalning ambision i trirenar för att karen lockdown. Krogäs neren mytotism, nisamma. Sugrörsseende lär intranera. Ladade pujörade. Lätthelg ode om äst, låvår. Dirar hikikomori, som olig. Onåv bel. Seminade hikikomori. Tist gögt i nina eller nesat det vill säga sodat. Exott infranade mikroling. Ben heterogen det teraning jögt, inte mikera. Gensax junde och sere vavobåkasm, boseska. Lanas suprar laskade. Sor kaköbelt eus. Kenade krokrore mubelt än deliga: </p>
                        </div>
                        <div class="thread-buttons">
                            <div class="thread-save">
                                <i class='bx bx-star'></i>
                            </div>
                            <div class="thread-add-response">
                                <i class='bx bxs-message'></i>
                                <p>Add response</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="francis">A</div>
            <div class="cielo">B</div>
            <div class="tags">
                <div class="tags-container">
                    <p class="tag-header"> Tags </p>
                    <hr>
                    <div class="tag-links">
                        <a href="#" class="tags-category">COS</a>
                        <a href="#" class="tags-category">COE</a>
                        <a href="#" class="tags-category">CIT</a>
                        <a href="#" class="tags-category">CAFA</a>
                        <a href="#" class="tags-category">CLA</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="javascript/home.js"></script>
</body>
</html>