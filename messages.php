<?php
    include('php-scripts/message-scripts.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messages</title>
    <link rel="stylesheet" href="styles/default.css">
    <link rel="stylesheet" href="styles/navbar.css">
    <link rel="stylesheet" href="styles/loader.css">
    <link rel="stylesheet" href="styles/messages.css">
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="styles/emoji/emoji.css" rel="stylesheet">
    <script src="javascript/jquery-3.6.0.js"></script>
    <script src="javascript/jquery.timeago.js"></script>
    <script src="javascript/emoji/config.js"></script>
    <script src="javascript/emoji/util.js"></script>
    <script src="javascript/emoji/jquery.emojiarea.js"></script>
    <script src="javascript/emoji/emoji-picker.js"></script>

</head>
<body>
    <?php include('php-scripts/navbar.php'); ?>
    <div class="loader-messages">
        <div id="loader"></div>
    </div>
    <input type="hidden" id="receiverID" value="<?php echo (isset($_GET['id'])) ? $_GET['id'] : "" ?>">
    <div class="side-button">
        <div id="side-list">
        </div>
    </div>
    <div id="sidelist-button">
        <i class='bx bx-chevron-right'></i>
    </div>
    <section class="main">
        <div class="message-container">
            <div class="users-list">
                <p class="message-label">Messages</p>
                <div class="message-search">
                    <i class='bx bx-search'></i>
                    <input class="message-search-input" type="text" placeholder="Search Messages">
                </div>

                <div class="message-list">
                </div>
            </div>

            <div class="user-conversation">
                <div class="conversation-container">
                    <?php if (empty($firstname)) {?>
                    <div class="start-conversation">
                        <div>
                        <img src="assets/images/conversation.png" alt="">
                        <p>Start a conversation</p>
                        </div>
                    </div>
                    <?php } else { ?>
                    <div class="grid-container">
                        <div class="conversation-details">
                            <div class="conversation-header">
                                <img class="conversation-avatar" src="<?php echo $avatar ?>" alt="">
                                <div>
                                    <span class="conversation-name"><?php echo $firstname. " " . $lastname ?></span>
                                    <p class="conversation-status">Active now</p>
                                </div>
                            </div>
                        </div>
                        <div class="conversations">
                            <!-- <div class="bubble">Natatandaan mo ba nung nagkakilala tayo, Muhaimin? <p class="message-time">12:49AM</p></div>
                            <div class="bubble">Namimiss ko na kasi yung dati <p class="message-time">12:49AM</p></div>
                            <div class="bubble">Titigilan ko na mag rugby para sayo <p class="message-time">12:49AM</p></div>
                            <div class="user">
                                <div class="bubble me">Sino ka?<p class="message-time">11:33PM</p></div>
                            </div>
                            <div class="user">
                                <div class="bubble me">charot<p class="message-time">11:33PM</p></div>
                            </div>
                            <div class="user">
                                <div class="bubble me">I miss you too, BHD Picardal my love so sweet<p class="message-time">11:33PM</p></div>
                            </div> -->
                        </div>
                        <div class="conversation-form">
                            <input id="input-message" data-emojiable="true" data-emoji-input="unicode" type="text" placeholder="Send a message">
                            <div class="send-button"><i class='bx bxs-send'></i></div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>
    <script src="javascript/messages.js"></script>
</body>
</html>