<?php

    include('db.php');
    session_start();

    function fetchThreads($limit){
        global $conn;
        $sql = "SELECT * FROM threads WHERE thread_status NOT IN ('pending','declined') ORDER BY id DESC LIMIT $limit, 3";
        $thread = $conn->query($sql) or die ($conn->error);
        $row = $thread->fetch_assoc();

        if (!empty($row)){
            
            
            do{ 
            $user = mysqli_query($conn, "SELECT * FROM users WHERE uid='{$row["author"]}'");
            $data = mysqli_fetch_array($user);
            if ($data){
                $author_given_name = $data['firstname'];
                $author_family_name = $data['lastname'];
                $author_avatar = $data['avatar'];
                $author_type = $data['account_type'];
            }
            $thread_status = ($row['thread_status'] == "open") ? "Open for discussion" : "Thread Closed";
            $thread_icon = ($row['thread_status'] == "open") ? "bxs-message-square-add" : "bxs-message-square-x"; 
            $thread_class = ($row['thread_status'] == "open") ? "open" : "closed";
            ?>
                <div class="thread" data-thread="<?php echo $row['thread_id'] ?>">
                    <div class="thread-title"><?php echo $row['title']?></div>
                    <div class="thread-author">
                        <div class="thread-author-details">
                            <img class="thread-avatar" src="<?php echo $author_avatar ?>" alt="">
                            <div class="thread-details">
                                <div class="thread-user">
                                    <p class="thread-name"><?php echo $author_given_name . " " . $author_family_name ?></p>
                                    <p class="thread-user-type"><?php echo ucfirst($author_type) ?></p>
                                </div>
                                <p class="thread-published" data-date="<?php echo $row['thread_id'] ?>"><script>$("[data-date=<?php echo $row['thread_id'] ?>]").html(jQuery.timeago("<?php echo $row['date_posted'] . " " . $row['time_posted'] ?>"))</script></p>
                            </div>
                        </div>
                        <div class="tags-container">
                            <?php
                                $array = json_decode($row['tags']);
                                foreach($array as $key => $value){
                                    for($i = 0; $i < count($value); $i++){
                                        $class = $value[$i];
                                        switch ($value[$i]) {
                                            case 'cos':
                                                $out = "COS";
                                                break;
                                            case 'coe':
                                                $out = "COE";
                                                break;
                                            case 'cafa':
                                                $out = "CAFA";
                                                break;
                                            case 'cie':
                                                $out = "CIE";
                                                break;
                                            case 'cit':
                                                $out = "CIT";
                                                break; 
                                            case 'lgbtq':
                                                $out = "LGBTQ+";
                                                break;
                                            case 'missingitem':
                                                $out = "Missing Item";
                                                break;      
                                                
                                            default:
                                                $out = ucfirst($value[$i]);
                                                break;
                                        }
                                        echo '<span class="thread-tags '.$class.'">'.$out.'</span>';
                                    }
                                }
                            ?>
                        </div>
                    </div>
                    <div class="thread-content">
                        <p class="thread-content-text"><?php echo jsonToHtml($row['body']) ?></p>
                    </div>
                    <div class="thread-buttons">
                        <div class="thread-save" data-threadid="<?php echo $row['thread_id']?>">
                            <i class='bx bx-star'></i>
                        </div>
                        <div class="thread-add-response <?php echo $thread_class ?>">
                            <i class='bx <?php echo $thread_icon ?>'></i>
                            <p><?php echo $thread_status ?></p>
                        </div>
                    </div>
                </div>
            <?php
            } while ($row = $thread->fetch_assoc());
        }
    }

    function jsonToHtml($jsonStr) {
        $obj = json_decode($jsonStr);

        $html = '';
        foreach ($obj->blocks as $block) {
            switch ($block->type) {
                case 'paragraph':
                    $html .= '<p>' . $block->data->text . '</p>';
                    break;
                
                case 'header':
                    $html .= '<p>' . $block->data->text . '</p>';
                    break;
                
                default:
                    break;
            }
        }
        
        return $html;

    }

    //load more threads
    if (isset($_POST['loadmore'])){
        $limit = mysqli_real_escape_string($conn, $_POST['loadmore']);
        fetchThreads($limit);
    }

    if(isset($_POST['savethread'])){
        $savethread = mysqli_real_escape_string($conn, $_POST['savethread']);
        $user = mysqli_real_escape_string($conn, $_SESSION['uid']);
        $sql = mysqli_query($conn, "SELECT * FROM saved_threads WHERE thread_id='$savethread' AND user_id='$user'");
        if(mysqli_num_rows($sql) == 0){
            $sql = mysqli_query($conn, "INSERT INTO saved_threads (thread_id, user_id) VALUES ('$savethread', '$user')");
        
    }

?>