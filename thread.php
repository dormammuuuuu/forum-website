<?php
   include('php-scripts/thread-scripts.php');  
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Threads</title>
      <link rel="stylesheet" href="styles/default.css">
      <link rel="stylesheet" href="styles/thread-home.css">
      <link rel="stylesheet" href="styles/navbar.css">
      <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
     
   </head>
   <body>
      <?php include('php-scripts/navbar.php'); ?>
      <section class="main">
         <div class="container">
            <div class="container-1">
               <div class="threads">
                  <div class="titles">
                     <div class="thread-title">
                        <?php echo $data['title']?>
                     </div>
                     <div class="author">
                        <img class="thread-avatar" src="<?php echo $user_data['avatar']?>" alt="">
                        <div class="details">
                           <div class="user">
                              <p class="name"><?php echo $user_data['firstname'] . " " . $user_data['lastname']?></p>
                              <p class="user-type">Student</p>
                           </div>
                           <p class="date-published">
                              <script>document.write(jQuery.timeago('<?php echo $data['date_posted'] . " " . $data['time_posted'] ?>'))</script>
                           </p>
                        </div>
                     </div>
                  </div>
                  <div class="main-threads">
                     <p class="thread-content-text"><?php echo $data['body'] ?></p>
                  </div>
               </div>
               <div class="divider">
                  <p>Responses</p>
                  <div>
                     <hr>
                  </div>
               </div>
               <div id="comments">
                  <?php fetchComments($_GET['threadid']) ?>
                  
                    <!-- <div class="main-comment">
                        <div class="author-comment">
                            <img class="thread-avatar" src="assets/images/avatar/default.jpg" alt="">
                            <div class="details">
                            <div class="user">
                                <p class="name">Raymond T. Matullano</p>
                                <p class="user-type">Student</p>
                            </div>
                            <p class="date-published">December 27, 2013</p>
                            </div>
                        </div>
                        <p id="main-answer"> Lörem ipsum blippbetalning ambision i trirenar för att karen lockdown. Krogäs neren mytotism, nisamma. Sugrörsseende lär intranera. Ladade pujörade. Lätthelg ode om äst, låvår. Dirar hikikomori, som olig. Onåv bel. Seminade hikikomori. Tist gögt i nina eller nesat det vill säga sodat. Exott infranade mikroling. Ben heterogen det teraning jögt, inte mikera. Gensax junde och sere vavobåkasm, boseska. Lanas suprar laskade. Sor kaköbelt eus.Lörem ipsum blippbetalning ambision i trirenar för att karen lockdown. Krogäs neren mytotism, nisamma. Sugrörsseende lär intranera. Ladade pujörade. Lätthelg ode om äst, låvår. Dirar hikikomori, som olig. Onåv bel. Seminade hikikomori. Tist gögt i nina eller nesat det vill säga sodat. Exott infranade mikroling. Ben heterogen det teraning jögt, inte mikera. Gensax junde och sere vavobåkasm, boseska. Lanas suprar laskade. Sor kaköbelt eus.</p>
                        <div class="response">
                            <div class="vote-button">
                            <i class='bx bx-like'></i><span class="comment-upvote">110</span>
                            </div>
                            <div class="vote-button">
                            <i class='bx bx-dislike'></i><span class="comment-downvote">0</span>
                            </div>
                        </div>
                    </div> -->
               </div>
               <?php if (isset($_SESSION['uid'])) { ?>
               <div class="your-comment">
                  <div class="divider">
                     <p>Your Response</p>
                     <div>
                        <hr>
                     </div>
                  </div>
                  <form method="POST" id="comment-form">
                     <div class="submission">
                        <input type="hidden" name="thread-id" value="<?php echo $_GET['threadid']?>" id="thread-id">
                        <textarea id="user-comment" class="comment-box" placeholder="Add Response"></textarea>
                        <input type="submit" name="submit" value="Comment" class="submit-btn" id="submit-comment">
                     </div>
                  </form>
               </div>
               <?php } ?>
            </div>
            <div class="container-2">
            </div>
         </div>
      </section>
      <script src="javascript/thread.js"></script>
   </body>
</html>