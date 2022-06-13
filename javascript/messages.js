const no_messages = `
    <div class="no-messages">
        <p>No messages</p>
    </div>
`;

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

$('.message-search-input').on("input", function () {
    let search = $(this).val();
    if (search.length == 0) {
        $('.message-list').empty().append(no_messages);
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