    <script src="javascript/navbar.js"></script>
    <nav>
        <div>
            <img class="speak-logo" src="assets/images/favicon.png" alt="Logo">
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
                <?php
                if($result['privileged'] == 1){ ?>
                    <li class="nav-links"><a href="superuser.php" target="_blank">SuperUser</a></li>
                <?php } ?>
                <li class="nav-links"><a href="home.php">Home</a></li>
                <li class="nav-links" id="nav-messages">
                    <a href="messages.php">Messages</a>
                    <div class="notification-message"></div>
                </li>
                <li class="nav-links"><a href="#">Saved</a></li>
                <div class="notification">
                    <span>
                        <i class='bx bxs-bell'></i>
                    </span>
                </div>
                <div class="dropdown">
                    <img class="user-avatar" src="<?php echo $result['avatar'] ?>">
                    <div class="dropdown-content">
                        <a href="profile.php?view=<?php echo $_SESSION['uid'] ?>">My profile</a>
                        <a href="settings.php">Account Settings</a>
                        <a href="logout.php">Logout</a>
                    </div>
                </div>                
            </ul>
            
            
        <?php } else { ?>
            <ul>
                <li class="nav-links"><a href="login.php">Login</a></li>
                <li class="nav-links"><a href="register.php">Signup</a></li>
            </ul>

        <?php } ?>
            
        </div>
        <div class="burger">
                <span class="burger-lines"></span>
                <span class="burger-lines"></span>
                <span class="burger-lines"></span>
        </div>
    </nav>