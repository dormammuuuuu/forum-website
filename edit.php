<?php
    include('php-scripts/edit-scripts.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit thread</title>
    <link rel="stylesheet" href="styles/default.css">
    <link rel="stylesheet" href="styles/navbar.css">
    <link rel="stylesheet" href="styles/edit.css">
    <link rel="stylesheet" href="styles/choices.min.css">
    <link rel="stylesheet" href="styles/loader.css">
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <script src="javascript/jquery-3.6.0.js"></script>
    <script src="javascript/choices.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/editorjs@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/header@2.6.2/dist/bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/list@1.7.0/dist/bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/simple-image@1.4.1/dist/bundle.min.js"></script>
</head>
<body>
    <div class="loader-editor">
        <div id="loader"></div>
    </div>
    <?php include('php-scripts/navbar.php');?>
    <section class="main">
        <input type="hidden" name="" id="thread" value="<?php echo $_GET['id'] ?>">
        <div id="error"></div>
        <div class="edit-containers">
            <form class="edit-inputs" id="edit-form">
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
                <input type="submit" id="edit-submit" value="Submit Thread">
            </form>
        </div>
    </section>
    <script src="javascript/edit.js"></script>
</body>
</html>