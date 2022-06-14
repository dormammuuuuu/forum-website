const no_messages = `
    <div class="no-messages">
        <p>No messages</p>
    </div>
`;

const no_conversation = `
    <div class="no-conversation">
        <p>Start sending a message.</p>
    </div>
`;

let response_length = 0;
let messagelist;

function fetchMessageList(){
    messagelist = setInterval(() => {
        $.ajax({
            type: "post",
            url: "../php-scripts/message-scripts.php",
            data: {fetchlist: 1},
            dataType: "json",
            success: function (response) {
                if (response.length == 0){
                    $('.message-list').empty().append(no_messages);
                    return;
                }
                $('.message-list').empty();
                response.forEach(data => {
                    renderList(data);
                });
            }, 
            error: function (request, status, error) {
                console.log(request.responseText);
                console.log(status);
                console.log(error);
            }
        });
    }, 500);
}

function renderMessage(data){
    let timestamp = jQuery.timeago(data.date + " " + data.time);
    let layout;
    if (data.receiver ==  $('#receiverID').val()){
        layout = `
        <div class="user">
            <div class="bubble me">${data.message}<p class="message-time">${timestamp}</p></div>
        </div>
        `;
    } else{
        layout = `<div class="bubble">${data.message}<p class="message-time">${timestamp}</p></div>`;
        
    }
    $('.conversations').append(layout);    
}

function renderUserSearch(data){
    let layout = `<div class="message-card" data-uid="${data.uid}">
                    <div class="message-details">
                        <div class="user">
                            <img class="message-avatar" src="${data.avatar}" alt="">
                            <span class="message-name">${data.firstname} ${data.lastname}</span>
                        </div>
                        <p class="message-datetime">11/18</p>
                    </div>
                    <p class="message">Open Conversation</p>
                </div>`;
    $('.message-list').append(layout);
}

function renderList(data) {
    let datetime = jQuery.timeago(data.lastmessage_date + " " + data.lastmessage_time);
    let layout = `<div class="message-card" data-uid="${data.uid}">
                    <div class="message-details">
                        <div class="user">
                            <img class="message-avatar" src="${data.avatar}" alt="">
                            <span class="message-name">${data.firstname} ${data.lastname}</span>
                        </div>
                        <p class="message-datetime">${datetime}</p>
                    </div>
                    <p class="message">${data.lastmessage}</p>
                </div>`;
    $('.message-list').append(layout);
}


$(function () {
    let receiverid = $('#receiverID').val();
    setInterval(() => {
        $.ajax({
            type: "POST",
            url: "../php-scripts/message-scripts.php",
            data: {
                fetchconversation: receiverid
            },
            dataType: "json",
            success: function (response) {
                if(response.length == 0){
                    $('.conversations').empty();
                    $('.conversations').append(no_conversation);
                } else {
                    if (response.length == response_length){
                        return;
                    } else {
                        $('.conversations').empty();
                        response.forEach(data => {
                            renderMessage(data);
                        });
                        $(".conversations").scrollTop($(".conversations")[0].scrollHeight);
                    }
                    response_length = response.length; // update response length
                }
            },
            error: function (request, status, error) {
                console.log(request.responseText);
                console.log(status);
                console.log(error);
            }
        });
    }, 500);

    fetchMessageList();
});



$(document).on("click", ".send-button", function () { 
    let message = $("#input-message").val();
    let receiverid = $('#receiverID').val();
    if (!message == ""){
        $.ajax({
            type: "post",
            url: "../php-scripts/message-scripts.php",
            data: {
                message: message,
                receiver: receiverid
            },
            dataType: "json",
            success: function (response) {
                console.log(response);
                $('#input-message').val("");

            },
            error: function (request, status, error) {
                console.log(request.responseText);
                console.log(status);
                console.log(error);
            }
        });
    }    
});

$('.message-search-input').on("input", function () {
    clearInterval(messagelist);
    let search = $(this).val();
    if (search.length == 0) {
        fetchMessageList();
        return;
    }
    $.ajax({
        type: "post",
        url: "../php-scripts/message-scripts.php",
        data: {
            searchuser: search
        },
        dataType: "json",
        success: function (response) {
            $('.message-list').empty();
            console.log(response);
            for (let index = 0; index < response.length; index++) {
                renderUserSearch(response[index]);
            }
        },
        error: function (request, status, error) {
            console.log(request.responseText);
            console.log(status);
            console.log(error);
        }
    });
});

$(document).on('click', '.message-card', function () {
    let uid = $(this).data('uid');
    location.href = "messages.php?id=" + uid;
});