<?php

    include('db.php');
    session_start();

    function fetchThreads($limit){
        global $conn;
        $sql = "SELECT * FROM threads WHERE thread_status NOT IN ('pending','declined') ORDER BY id DESC LIMIT $limit, 10";
        $thread = $conn->query($sql) or die ($conn->error);
        $row = $thread->fetch_assoc();

        if (!empty($row)){
            
            
            do{ 
            $user = mysqli_query($conn, "SELECT * FROM users WHERE uid='{$row["author"]}'");
            $data = mysqli_fetch_array($user);
            if (isset($_SESSION['uid'])){
                $saved = mysqli_query($conn, "SELECT * FROM save WHERE thread_id='{$row["thread_id"]}' AND uid='{$_SESSION["uid"]}'");
                $savedClass = (mysqli_num_rows($saved) > 0) ? 'saved' : '';
                $savedIcon = (mysqli_num_rows($saved) > 0) ? 'bxs-star' : 'bx-star';
            }
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
                                    <p class="thread-name" data-acct="<?php echo $row['author'] ?>"><?php echo $author_given_name . " " . $author_family_name ?></p>
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
                        <?php
                        if(isset($_SESSION['uid'])){ ?>
                            <div class="thread-save <?php echo $savedClass ?>" data-threadid="<?php echo $row['thread_id'] ?>">
                                <i class='bx <?php echo $savedIcon ?>'></i>
                            </div>
                        <?php } ?>
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
        $sql = mysqli_query($conn, "SELECT * FROM `save` WHERE thread_id='$savethread' AND uid='$user'");
        if(mysqli_num_rows($sql) == 0){
            $sql = mysqli_query($conn, "INSERT INTO `save` (thread_id, uid) VALUES ('$savethread', '$user')");
            $result_json['statusCode'] = 200;
            $result_json['message'] = "Added to Saved";
        }else{
            $sql = mysqli_query($conn, "DELETE FROM `save` WHERE thread_id='$savethread' AND uid='$user'");
            $result_json['statusCode'] = 202;
            $result_json['message'] = "Removed to Saved";
        }
        echo json_encode($result_json);
        mysqli_close($conn);
    }

?>