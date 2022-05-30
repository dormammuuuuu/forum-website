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
      <link rel="stylesheet" href="styles/thread.css">
      <link rel="stylesheet" href="styles/navbar.css">
      <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
      <script src="javascript/jquery-3.6.0.js"></script>
      <script src="javascript/jquery.timeago.js"></script>
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
                        <div class="author-details">
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
                        <div class="dropdown-container">
                           <?php if(isset($_SESSION['uid'])){?>
                              <button class="dropdown-button"><i class='bx bx-dots-horizontal-rounded bx-rotate-90'></i></button>
                           <?php } ?>
                           <div class="dropdown-menu" data-thread='<?php echo $_GET['threadid']?>'>
                           <?php 
                              $select = mysqli_query($conn, "SELECT * FROM threads WHERE thread_id='$tid'");
                              $selectThread = mysqli_fetch_assoc($select);
                              $newQuery = mysqli_query($conn, "SELECT * FROM users WHERE uid='{$selectThread['author']}'");
                              $threadAuthor = mysqli_fetch_assoc($newQuery);
                              if(isset($_SESSION['uid'])){
                                 if ($_SESSION['uid'] == $threadAuthor['uid']){ 
                                    if ($selectThread['thread_status'] == "open"){?>
                                       <div id="edit-thread" class="dropdown-item"><i class='bx bx-edit-alt' ></i><p>Edit thread</p></div>
                                       <div id="close-thread" class="dropdown-item"><i class='bx bx-message-alt-x'></i><p>Close thread</p></div>
                                 <?php    } ?>
                                 <div class="dropdown-item"><i class='bx bx-edit-alt' ></i><p>Save thread</p></div>
                                 <div id="delete-thread" class="dropdown-item"><i class='bx bxs-trash-alt' ></i><p>Delete thread</p></div>
                                       <?php
                                       } else { ?>
                                    <div class="dropdown-item"><i class='bx bx-edit-alt' ></i><p>Save thread</p></div>
                                 <?php }
                              }
                           ?>
                              
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="main-threads">
                     <p class="thread-content-text"><?php echo jsonToHtml($data['body']) ?></p>
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
               </div>
               <?php if (isset($_SESSION['uid']) && $data['thread_status'] == "open") { ?>
               <div class="your-comment">
                  <div class="divider">
                     <p>Your Response</p>
                     <div>
                        <hr>
                     </div>
                  </div>
                  <form method="POST" id="comment-form" name="comment-form">
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