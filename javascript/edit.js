$(function () {
    
    let id = $('#thread').val();
    $.ajax({
        type: "post",
        url: "../php-scripts/edit-scripts.php",
        data: {
            thread_data: id
        },
        dataType: "json",
        success: function (response) {
            console.log(response);
            console.log(JSON.parse(response.tags));
            var jsonData = JSON.parse(response.tags);
            for (var i = 0; i < jsonData.selected.length; i++) {
                var counter = jsonData.selected[i];
                $('#tags option[value="' + counter + '"]').prop('selected', true);
            }
            let secondElement = new Choices('#tags',{
                maxItemCount: 5,
                allowHTML: false,
                removeItems: true,
                removeItemButton: true,
                item: counter
            });
            $('#input-title').val(response.title);
            $('#tags').val(counter);
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
                },
                data: JSON.parse(response.body)
            });
        },
        error: function (request, status, error) {
            console.log(request.responseText);
            console.log(status);
            console.log(error);
        }
    });



    // $('#create-form').submit(function (e) { 
    //     e.preventDefault();
    //     $('#error').empty();
    //     let json_body;
    //     let inputTitle = $('#input-title').val();
    //     editor.save().then((outputData) => {
    //         json_body = JSON.stringify(outputData);
    //         $.ajax({
    //             type: "post",
    //             url: "../php-scripts/create-scripts.php",
    //             data: {
    //                 title: inputTitle,
    //                 body: json_body
    //             },
    //             success: function (response) {
    //                 console.log(response);
    //                 location.href = 'home.php';
    //             },
    //             error: function(jqXHR, exception) {
    //                 //Ajax request failed.
    //                 var msg = '';
    //                 if (jqXHR.status === 0) {
    //                     msg = 'Not connect.\n Verify Network.';
    //                 } else if (jqXHR.status == 404) {
    //                     msg = 'Requested page not found. [404]';
    //                 } else if (jqXHR.status == 500) {
    //                     msg = 'Internal Server Error [500].';
    //                 } else if (exception === 'parsererror') {
    //                     msg = 'Requested JSON parse failed.';
    //                 } else if (exception === 'timeout') {
    //                     msg = 'Time out error.';
    //                 } else if (exception === 'abort') {
    //                     msg = 'Ajax request aborted.';
    //                 } else {
    //                     msg = 'Uncaught Error.\n' + jqXHR.responseText;
    //                 }
    //                 $('#error').html(msg);
    //             }
    //         });
    //     });
    //     }).catch((error) => {
    //         console.log(error);
    //     });   
});




