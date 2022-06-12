<?php

    include('db.php');

    function getUserData($uid){
        global $conn;
        $out = array();
        $sql = mysqli_query($conn, "SELECT * FROM users WHERE uid = '$uid'");
        $result = mysqli_fetch_assoc($sql);
        $out['firstname'] = $result['firstname'];
        $out['lastname'] = $result['lastname'];
        $out['avatar'] = $result['avatar'];
        return $out;
    }

    function getUserSummary($uid){
        global $conn;
        $out = array();
        $sql = mysqli_query($conn, "SELECT COUNT(id) FROM threads WHERE author = '$uid'");
        $data = mysqli_fetch_assoc($sql);
        $out['threads'] = $data['COUNT(id)'];
        $sql = mysqli_query($conn, "SELECT COUNT(id) FROM comments WHERE comment_author = '$uid'");
        $data = mysqli_fetch_assoc($sql);
        $out['comments'] = $data['COUNT(id)'];
        return $out;
    }

    if(isset($_POST['people'])){
        $json_response = array();
        $search = mysqli_real_escape_string($conn, $_POST['people']);
        $query = "SELECT * FROM users WHERE firstname LIKE '%".$search."%' OR lastname LIKE '%".$search."%'";
        $result = mysqli_query($conn, $query);
        $resultCheck = mysqli_num_rows($result);
        if($resultCheck > 0){
            while($row = mysqli_fetch_assoc($result)){
                $summary = getUserSummary($row['uid']);
                $json_response[] = array(
                    'uid' => $row['uid'],
                    'threads' => $summary['threads'],
                    'comments' => $summary['comments'],
                    'firstname' => $row['firstname'],
                    'lastname' => $row['lastname'],
                    'avatar' => $row['avatar']                    
                );
            }
        }
        echo json_encode($json_response);
        mysqli_close($conn);
    }

    if(isset($_POST['threads'])){
        $json_response = array();
        $search = mysqli_real_escape_string($conn, $_POST['threads']);
        $query = "SELECT * FROM threads WHERE title LIKE '%".$search."%'";
        $result = mysqli_query($conn, $query);
        $resultCheck = mysqli_num_rows($result);
        if($resultCheck > 0){
            while($row = mysqli_fetch_assoc($result)){
                $user_data = getUserData($row['author']);
                $json_response[] = array(
                    'tid' => $row['thread_id'],
                    'title' => $row['title'],
                    'date_posted' => $row['date_posted'],
                    'time_posted' => $row['time_posted'],
                    'author_fname' => $user_data['firstname'],
                    'author_lname' => $user_data['lastname'],
                    'author_avatar' => $user_data['avatar'],
                    'thread_status' => $row['thread_status'],
                );
            }
        }
        echo json_encode($json_response);
        mysqli_close($conn);
    }
?>