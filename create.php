<?php
    include('php-scripts/create-scripts.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create thread</title>
    <link rel="stylesheet" href="styles/default.css">
    <link rel="stylesheet" href="styles/navbar.css">
    <link rel="stylesheet" href="styles/create.css">
    <link rel="stylesheet" href="styles/choices.min.css">
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <script src="javascript/jquery-3.6.0.js"></script>
    <script src="javascript/choices.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/editorjs@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/header@2.6.2/dist/bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/list@1.7.0/dist/bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/simple-image@1.4.1/dist/bundle.min.js"></script>
</head>
<body>
    
    <?php include('php-scripts/navbar.php');?>
    <section class="main">

        <div class="create-containers">
            <form class="create-inputs" id="create-form">
                <p class="input-label">Title</p>
                <p class="input-sublabel">Be specific and imagine you're asking a question to another person</p>
                <input class="inputs" id="input-title" type="text" name="title" placeholder="e.g. Anong ulam natin mamaya?" required>
                <p class="input-label">Body</p>
                <p class="input-sublabel">Include all the information someone would need to answer your question</p>
                <div id="editorjs"></div>
                <!-- <textarea class="inputs" id="input-body" rows="4" name="body" cols="50" type="text" required></textarea> -->
                <p class="input-label">Tags</p>
                <p class="input-sublabel">Add upto 5 tags to describe what your question is about</p>
                <select name="tags" id="tags" multiple>
                    <option value="general">General</option>
                    <option value="event">Event</option>
                    <option value="registrar">Registrar</option>
                    <option value="cos">COS</option>
                    <option value="coe">COE</option>
                    <option value="cafa">CAFA</option>
                    <option value="cie">CIE</option>
                    <option value="cit">CIT</option>
                    <option value="library">Library</option>
                    <option value="vandalism">Vandalism</option>
                    <option value="bullying">Bullying</option>
                    <option value="missingitem">Missing Item</option>
                    <option value="lgbtq">LGBTQ+</option>
                    <option value="suspension">Suspension</option>
                </select>
                <div id="error"></div>

                <input type="submit" id="create-submit" value="Submit Thread">
            </form>
            <div class="guide-container">
                <div class="guide" data-number="1">
                    <div class="guide-card">
                        <p class="guide-step">Step 1: Draft your question</p>
                        <i class='dropdown-icon bx bx-chevron-down'></i>
                    </div>
                    <div class="guide-expanded">
                        <p>Summarize the problem</p>
                        <ul>
                            <li>Include the details about your goal</li>
                            <li>Describe expected and actual result</li>
                            <li>Include any error messages</li>
                        </ul>
                    </div>
                </div>

                <div class="guide" data-number="2">
                    <div class="guide-card">
                        <p class="guide-step">Step 2: Lorem Ipsum</p>
                        <i class='dropdown-icon bx bx-chevron-down'></i>
                    </div>
                    <div class="guide-expanded">
                        <p class="dropdown-title">Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis aliquid aliquam veritatis dolor veniam dicta incidunt sequi, facere iusto, laborum ipsa mollitia quis optio et maiores laudantium beatae, ullam dignissimos.</p>
                        
                    </div>
                </div>

                <div class="guide" data-number="3">
                    <div class="guide-card">
                        <p class="guide-step">Step 3: Lorem Ipsum</p>
                        <i class='dropdown-icon bx bx-chevron-down'></i>
                    </div>
                    <div class="guide-expanded">
                        <p class="dropdown-title">Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis aliquid aliquam veritatis dolor veniam dicta incidunt sequi, facere iusto, laborum ipsa mollitia quis optio et maiores laudantium beatae, ullam dignissimos.</p>
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="javascript/create.js"></script>
</body>
</html>