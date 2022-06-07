<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Landing Page</title>
        <link rel="stylesheet" href="styles/default.css">
        <link rel="stylesheet" href="styles/index.css">
        <link rel="stylesheet" href="styles/navbar.css">
        <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
        <script src="javascript/jquery-3.6.0.js"></script>
    </head>
    <body class="container">

           
                <div class="first-div">
                   <div class="main-intro">
                        <h1 id="main-title">TUP Speak</h1>
                        <p>A platform for learning and sharing information. A place where you can ask questions and interact with others who can provide insightful responses.</p>
                        <button type="button" id="index" class="btn_start">Get Started!</button>
                    </div>

                   <div class="main-img">
                   </div>
                </div>

                <div class="second-div">
                    <div class="second-obj-desc">
                        <div class="cards" id="card-1">
                            <img src="assets/images/sending-thread.png" class="card-img">
                            <h1>Creating Threads</h1>
                            <p>Share your ideas</p>
                        </div>

                        <div class="cards" id="card-2">
                            <img src="assets/images/thread-proc.png" class="card-img">
                            <h1>Admin's Approval</h1>
                            <p>Wait for the admin's approval for your created threads</p>
                        </div>

                        <div class="cards" id="card-3">
                            <img src="assets/images/approve.png" class="card-img">
                            <h1>Thread Published</h1>
                            <p>Let the other hear your concern</p>
                        </div>

                    </div>
                </div>

                <div class="objective-div">
                    <div class="objective-container">
                        
                        <img src="assets/images/comm.png" id="comm-img"">
                      
                    </div>

                    <div class="main-obj-desc">
                        <h1 class="obj-title">Communication</h1>
                            <p class="obj-desc">Participants gain emotionally and academically from their connections with their peers by contributing to others, developing new friends and contacts, staying update on current events, and learning about new possibilities.</p>
                    </div>
                </div>

                <div class="objective-div">
                    <div class="main-obj-desc">
                        <h1 class="obj-title">Teamwork</h1>
                        <p class="obj-desc">Members are allowed to share their files about their reviewers, studies, lectures, and other knowledge to help others so that they are able to grow and learn that may help them to be ready for their career in the near future. They have complete freedom to use facts to educate one another in a rightful manner.</p>
                    </div>

                    <div class="objective-container">
                      <img src="assets/images/teamwork.png" id="teamwork-img">
                    </div>
                </div>

                <div class="objective-div">
                    <div class="objective-container">
                        <img src="assets/images/friendly.png" id="friendly-img">
                    </div>

                    <div class="main-obj-desc">
                            <h1 class="obj-title">Healthy Environment</h1>
                            <p class="obj-desc">TUP is one of the best engineering schools that offers affordable tuition fees and quality education. All of the people under the university are either professional or learning to be come professional, and also at the right age to control themselves, to act right in any situation that builds an effective healthy environment for tup speak forum.</p>
                    </div>
                </div>

                <div class="status-div">
                    <div class="status-container">
                        <div class="status-card">
                            <h1 class="status-number">16</h1>
                            <p class="status-title">Active User</p>
                        </div>

                        <div class="status-card">
                            <h1 class="status-number">12</h1>
                            <p class="status-title">Students</p>
                        </div>

                        <div class="status-card">
                            <h1 class="status-number">4</h1>
                            <p class="status-title">Teachers</p>
                        </div>
                    </div>
                </div>

                <div class="contact-us">
                    <div class="container-contact-us">

                        <div class="send-us">
                            <p class="contact-title">Send us a message</p>

                                <div class="message-detail">
                                    <div class="contact-name">
                                        <p>Name:</p>
                                        <input  class="comment-box" placeholder="Add Name"></textarea>
                                    </div>
                                    <div class="contact-email">
                                        <p>Contact Email:</p>
                                        <input  class="comment-box" placeholder="Add Email"></textarea>
                                    </div>

                                </div>

                            <div class="contact-message">
                                <p>Message: </p>
                                <textarea id="message-box"  placeholder="Add Message"></textarea>
                                <button type="button" class="btn_start">Submit</button>
                            </div>

                        </div>

                        <div class="contacts">
                            <p class="contact-title">Contact Us</p>
                            <div class="contact-details">
                               <div class="address">
                                   <p class="contact-sub-title">Address</p>
                                   <p class="contact-desc">HXPM+RW7, Ayala Blvd, Ermita, Manila, 1000 Metro Manila</p>
                               </div>

                               <div class="email">
                                    <p class="contact-sub-title">Email</p>
                                    <p class="contact-desc" >forum.bsit@gmail.com</p>
                               </div>

                               <div class="contact-number">
                                    <p class="contact-sub-title">Call us</p>
                                    <p class="contact-desc">09292062242</p>
                               </div>
                            </div>

                        </div>

                    </div>
                </div>

                <footer class="footer-container">
                    <div class="footer-socmed">
                        <i class='bx bxl-facebook-circle'></i>
                        <i class='bx bxl-twitter'></i>
                        <i class='bx bxl-instagram-alt' ></i>
                        <i class='bx bxl-github' ></i>                        
                    </div>

                    <div>
                        <p>&copyTUP-SPEAK 2022</p>
                    </div>
                </footer>


          
        
        <script src="javascript/index.js"></script>

    </body>
</html>
