
$(function () {
    $(".guide-expanded").hide();
    var globalGuide = 1;
    $('.guide')[0].click(); 
    let secondElement = new Choices('#tags', {
        maxItemCount: 5,
        allowHTML: false,
        removeItems: true,
        removeItemButton: true
    });

    const editor = new EditorJS({
        holder: 'editorjs',
        tools: { 
            header: {
                class: Header, 
                inlineToolbar: ['link'] 
            }, 
            list: { 
                class: List, 
                inlineToolbar: true 
            },
            image: SimpleImage
        }
    });

    editor.isReady.then(() => {
        console.log('Editor.js is ready to work!')
    }).catch((reason) => {
        console.log(`Editor.js initialization failed because of ${reason}`)
    });

    $('#create-form').submit(function (e) { 
        e.preventDefault();
        $('#error').empty();
        let json_body;
        let inputTitle = $('#input-title').val();
        let inputTags = $('#tags').val();
        let tags = new Object();
        tags.selected = inputTags;
        let json_tags = JSON.stringify(tags);
        if (json_tags.length == 15){
            $('#error').text("Error: Select a tag");
            return;
        }
        editor.save().then((outputData) => {
            json_body = JSON.stringify(outputData);
            $.ajax({
                type: "post",
                url: "../php-scripts/create-scripts.php",
                data: {
                    title: inputTitle,
                    body: json_body,
                    tags: json_tags
                },
                
                success: function (response) {
                    console.log(response);
                    location.href = 'home.php';
                },
                error: function(jqXHR, exception) {
                    //Ajax request failed.
                    var msg = '';
                    if (jqXHR.status === 0) {
                        msg = 'Not connect.\n Verify Network.';
                    } else if (jqXHR.status == 404) {
                        msg = 'Requested page not found. [404]';
                    } else if (jqXHR.status == 500) {
                        msg = 'Internal Server Error [500].';
                    } else if (exception === 'parsererror') {
                        msg = 'Requested JSON parse failed.';
                    } else if (exception === 'timeout') {
                        msg = 'Time out error.';
                    } else if (exception === 'abort') {
                        msg = 'Ajax request aborted.';
                    } else {
                        msg = 'Uncaught Error.\n' + jqXHR.responseText;
                    }
                    $('#error').html(msg);
                }
            });
        });
        }).catch((error) => {
            console.log(error);
        });   
});


var globalGuide = 0;

$('.guide').click(function () {
    
    let current = $(this).attr("data-number");
    if(current != globalGuide){
        $(".guide-expanded").slideUp();
        $(this).children(".guide-expanded").slideDown();
        globalGuide = current;
    } else {
        $(this).children(".guide-expanded").slideUp();
        globalGuide = current;
        if ($(this).children(".guide-expanded").css("display") == "none"){
            $(this).children(".guide-expanded").slideDown();
        }
    }
});



