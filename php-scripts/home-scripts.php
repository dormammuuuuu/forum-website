<?php

    include('db.php');
    session_start();

    function fetchThreads(){
        global $conn;
        $sql = "SELECT * FROM threads ORDER BY id DESC";
        $thread = $conn->query($sql) or die ($conn->error);
        $row = $thread->fetch_assoc();

        if (!empty($row)){
            $user = mysqli_query($conn, "SELECT * FROM users WHERE uid='{$row["author"]}'");
            $data = mysqli_fetch_array($user);
            if ($data){
                $author_given_name = $data['firstname'];
                $author_family_name = $data['lastname'];
                $author_avatar = $data['avatar'];
            }
            
            do{ 
            ?>
                <div class="thread" data-thread="<?php echo $row['thread_id'] ?>">
                    <div class="thread-title"><?php echo $row['title']?></div>
                    <div class="thread-author">
                        <img class="thread-avatar" src="<?php echo $author_avatar ?>" alt="">
                        <div class="thread-details">
                            <div class="thread-user">
                                <p class="thread-name"><?php echo $author_given_name . " " . $author_family_name ?></p>
                                <p class="thread-user-type">Student</p>
                            </div>
                            <p class="thread-published"><script>document.write(jQuery.timeago('<?php echo $row['date_posted'] . " " . $row['time_posted'] ?>'));</script></p>
                        </div>
                    </div>
                    <div class="thread-content">
                        <p class="thread-content-text"><?php echo jsonToHtml($row['body']) ?></p>
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
?>