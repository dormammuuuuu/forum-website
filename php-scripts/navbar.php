    <nav>
        <div>
            <p>Logo</p>
            <div class="search-bar">
                <input class="nav-search" type="text" placeholder="Type to search"> 
                <span class="search-icon"><i class='bx bx-search'></i></span>   
            </div>
        </div>
        <div class="nav-buttons">
        <?php 
            include('db.php');
            @session_start(); 

            if(isset($_SESSION['uid'])){
                $query = mysqli_query($conn, "SELECT * FROM users WHERE uid='{$_SESSION['uid']}'");
                $result = mysqli_fetch_array($query);
            ?>
            <ul>
                <li class="nav-links active"><a href="home.php">Home</a></li>
                <li class="nav-links"><a href="messages.php">Messages</a></li>
                <li class="nav-links"><a href="#">Saved</a></li>
                <li class="nav-links"><a href="logout.php">Logout</a></li>
            </ul>
            <div class="notification">
                <span>
                    <i class='bx bxs-bell'></i>
                </span>
            </div>
            <img class="user-avatar" src="<?php echo $result['avatar'] ?>" alt="">
        <?php } else { ?>
            <ul>
                <li class="nav-links"><a href="login.php">Login</a></li>
                <li class="nav-links"><a href="register.php">Signup</a></li>
            </ul>

        <?php } ?>
            
        </div>
    </nav>