let user_profileID;

const no_thread = `
    <div class="no-thread">
        <p>No available thread</p>
    </div>
`;

function capitalizeFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}

function renderTags(tags){
        let tmp = JSON.parse(tags);
        let layout = ``;
        let out_tag;
        for (let index = 0; index < tmp.selected.length; index++) {
            switch (tmp.selected[index]) {
                case 'cos':
                    out_tag = "COS";
                    break;
                case 'coe':
                    out_tag = "COE";
                    break;
                case 'cafa':
                    out_tag = "CAFA";
                    break;
                case 'cie':
                    out_tag = "CIE";
                    break;
                case 'cit':
                    out_tag = "CIT";
                    break; 
                case 'lgbtq':
                    out_tag = "LGBTQ+";
                    break;
                case 'missingitem':
                    out_tag = "Missing Item";
                    break;      
                default:
                    out_tag = capitalizeFirstLetter(tmp.selected[index]);
                    break;
            }
            layout += `<span class="tag">${out_tag}</span>`;
        }
        return layout;
/*
        foreach(tags as $key => $value){
            for($i = 0; $i < count($value); $i++){
                $class = $value[$i];
                
            }
        }*/
}

function renderThreads(data, btn) {
    const edjsParser = edjsHTML();
    let body_data = edjsParser.parse(JSON.parse(data.body));
    let final_body = body_data.join(" ");
    let datetime = jQuery.timeago(data.date + ' ' + data.time);
    let savedClass = (data.saved === true) ? "saved" : "";
    let savedIcon = (data.saved === true) ? "bxs-star" : "bx-star";
    let statusClass = (data.status === "open") ? "open" : "closed";
    let statusIcon = (data.status === "open") ? "bxs-message-square-add" : "bxs-message-square-x";
    let statusText = (data.status === "open") ? "Open for discussion" : "Thread Closed";
    let tags_layout = renderTags(data.tags);
    let layout = `
        <div class="thread-content" data-thread="${data.thread_id}" >
            <div class="thread-thread-title">
                <h1>${data.title}</h1>
            </div>
            <div class="thread-author">
                <img class="thread-thread-avatar" src="` + data.avatar + `" alt="">
                <div class="thread-details">
                    <div class="thread-user">
                        <p class="thread-name">${data.firstname} ${data.lastname}</p>
                        <p class="thread-user-type">${data.type}</p>
                    </div>
                    <p class="thread-date-published">${datetime}</p>
                </div>
            </div>
            <div class="thread-content-text">
                <div class="thread-main-threads">${final_body}</div>
            </div>
            <div class="tags-container">
                <p>Tags: ${tags_layout}</p>
            </div>
            `;
            if (btn !== 'pending' && btn !== 'declined'){
                layout += `
                <div class="thread-buttons">
                    <div class="thread-save ${savedClass}" data-save="${data.thread_id}">
                        <i class='bx ${savedIcon}'></i>
                    </div>
                    <div class="thread-add-response ${statusClass}">
                        <i class='bx ${statusIcon}'></i>
                        <p>${statusText}</p>
                    </div>
                </div>
                `;
            } else if (btn === 'pending'){
                layout += `
                
                <div class="pending-thread" data-declined="${data.thread_id}">
                    <p>Waiting for admin approval...</p>
                    <button class="cancel-thread">Cancel</button>
                </div>
                `;
            } else {
                layout += `
                <div class="declined-thread">
                    <p>Reason for decline: ${data.reason}</p>
                    <div data-declined="${data.thread_id}">
                        <button class="declined-edit">Edit and Submit</button>
                        <button class="cancel-thread">Cancel</button>
                    </div>
                </div>
                `;
            }
        layout += `</div> `;
    return layout;
}

function responsiveUserList(){
    let width = $(window).width();
    if (width < 1000){
        $('.panel-people-l').show();
        $('.panel-people-l').append($('.panel-people').children());
        $('.panel-people').hide();
    } else {
        $('.panel-people').show();
        $('.panel-people').append($('.panel-people-l').children());
        $('.panel-people-l').hide();
    }
}

$(function () {
    $.urlParam = function(name){
        var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
        if (results==null) {
           return null;
        }
        return decodeURI(results[1]) || 0;
    }
    user_profileID = $.urlParam('view');
    if (user_profileID === null || user_profileID === 0){
        location.href = "404.php";
    }
    $('[data-btn="all"]').click();

    responsiveUserList();
    $(window).resize(responsiveUserList);
});

$(document).on("click", ".message-user", function () {
    window.open("/messages.php?id=" + user_profileID, "_blank");
});

$(document).on("click", ".person", function () {
    let user = $(this).data("user");
    window.open("/profile.php?view=" + user, "_self");
});

$(document).on("click", ".panel-menu button", function(){
    let btn = $(this).data('btn');
    $('.panel-menu button').removeClass('active');
    $('[data-btn=' + btn + ']').addClass('active');

    $.ajax({
        type: "post",
        url: "../php-scripts/profile-scripts.php",
        data: {
            fetch: btn,
            user_id: user_profileID
        },
        dataType: "json",
        success: function (response) {
          console.log(response);  
          $('#panel-content').empty();
          if (response.length == 0){
            $('#panel-content').append(no_thread);
          } else {
            for (let index = 0; index < response.length; index++) {
                $('#panel-content').append(renderThreads(response[index], btn));
            }
          }
        },
        error: function (error) {
            console.log(error.responseText);
        }
    });
});

$(document).on("click", ".thread-content", (function (e) {
    let thread_id = $(this).data('thread');
    window.open("/thread.php?threadid=" + thread_id, "_blank");
}));

$(document).on("click", ".thread-save", (function (e) {
    e.stopPropagation();
    let thread_id = $(this).data('save');

    $.ajax({
        type: "post",
        url: "../php-scripts/home-scripts.php",
        data: {
            savethread: thread_id
        },
        dataType: "json",
        success: function (response) {
            console.log(response)
            if (response.statusCode == 200){
                $('[data-save=' + thread_id + ']').addClass('saved');
                $('[data-save=' + thread_id + ']').children('i').removeClass('bx-star').addClass('bxs-star');
            } else {
                $('[data-save=' + thread_id + ']').removeClass('saved');
                $('[data-save=' + thread_id + ']').children('i').removeClass('bxs-star').addClass('bx-star');
            }
        }, 
        error: function (error) {
            console.log(error.responseText);
        }

    });
}));

$('.create-btn').on("click", function () {
    location.href = "create.php";
});

$(document).on("click", ".declined-edit", (function (e) {
    e.stopPropagation();
    let thread_id = $(this).parent().data('declined');
    location.href = "edit.php?id=" + thread_id;
}));

$(document).on("click", ".cancel-thread", (function (e) {
    e.stopPropagation();
    let thread_id = $(this).parent().data('declined');    
    $.ajax({
        type: "post",
        url: "../php-scripts/profile-scripts.php",
        data: {
            cancel: thread_id
        },
        dataType: "json",
        success: function (response) {
            console.log(response)
            if (response.statusCode == 200){
                location.reload();
            }
        },
        error: function (error) {
            console.log(error.responseText);
        }
    });
}));



