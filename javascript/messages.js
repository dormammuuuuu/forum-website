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
let conversation_list = [];

function fetchMessageList(){
    messagelist = setInterval(() => {
        $.ajax({
            type: "post",
            url: "../php-scripts/message-scripts.php",
            data: {fetchlist: 1},
            dataType: "json",
            success: function (response) {
                response.sort(function(a, b){
                    return new Date(b.lastmessage_date + " " + b.lastmessage_time) - new Date(a.lastmessage_date + " " + a.lastmessage_time);
                });
                if (response.length == 0){
                    $('.message-list').empty().append(no_messages);
                    return;
                }
                if (JSON.stringify(conversation_list) === JSON.stringify(response)){
                    return;
                }
                $('.message-list').empty();
                
                response.forEach(data => {
                    renderList(data);
                });

                $.urlParam = function(name){
                    var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
                    if (results==null) {
                       return null;
                    }
                    return decodeURI(results[1]) || 0;
                }
                let active_convo = $.urlParam('id');
                $('[data-uid="' + active_convo + '"]').addClass('active-convo');

                conversation_list = response;
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
    let not_seen;
    if (data.lastmessage_seen === "0"){
        console.log(data.session_id == data.lastmessage_sender);
        if (data.session_id == data.lastmessage_sender){
            not_seen = "";
        } else {
            not_seen = "not-seen";
        }
    } else {
        not_seen = "";
    }
    //let not_seen = (data.lastmessage_seen === "1") ? () ? "" : "not-seen" : "not-seen";
    console.log(data.session_id + " " + data.lastmessage_sender);
    let datetime = jQuery.timeago(data.lastmessage_date + " " + data.lastmessage_time);
    let layout = `<div class="message-card ${not_seen}" data-uid="${data.uid}">
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

function responsiveMessageList(){
    let width = $(window).width();
    if (width < 1000){
        $('#side-list').append($('.users-list').children());
        $('.users-list').hide();
    } else {
        $('.users-list').append($('#side-list').children());
        $('.users-list').show();
    }
}


$(function () {

    let receiverid = $('#receiverID').val();
    window.emojiPicker = new EmojiPicker({
        emojiable_selector: '[data-emojiable=true]',
        assetsPath: '../styles/assets/emojis/',
        popupButtonClasses: 'fa fa-smile-o'
    });
    
    responsiveMessageList();
    $(window).resize(responsiveMessageList);

    window.emojiPicker.discover();
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
            complete: function () {
                $('.loader-messages').fadeOut();
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

$(document).on("keypress", ".emoji-wysiwyg-editor", function(e){
    if (e.which === 13) {
        e.preventDefault();
        $('#input-message').val($(this).text());
        $('.send-button').click();
    }
});

$(document).on("click", "#sidelist-button", function(e){
    $('.side-button').show();
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
                $('#input-message').val("");
                $('.emoji-wysiwyg-editor').html("");
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
    conversation_list = [];
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

