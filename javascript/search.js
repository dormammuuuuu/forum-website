
$(function () {
    $('[data-fetch="people"]').click();
});

function renderPeople(arr){
    let layout = `
        <div class="person-container" data-acct="${arr.uid}">
            <img src="${arr.avatar}" class="result-avatar" alt="avatar">
            <div class="search-user-details">
                <p class="user-name">${arr.firstname} ${arr.lastname}</p>
                <p class="user-details">Threads: ${arr.threads} , Comments: ${arr.comments}    </p>
            </div>
        </div>
    `;
    $('.result-container').append(layout);
    return;
}

function renderThreads(arr){
    let date = jQuery.timeago(arr.date_posted + " " + arr.time_posted);
    let layout = `
        <div class="thread-container" data-thread="${arr.tid}">
            <img src="${arr.author_avatar}" class="result-avatar" alt="avatar">
            <div class="search-user-details">
                <p class="thread-name">${arr.title}</p>
                <p class="user-details">Author: ${arr.author_fname} ${arr.author_lname}, Posted ${date}</p>
            </div>
        </div>`;
    $('.result-container').append(layout);
    return;
}

$(document).on("click", ".person-container", (function(){
    let userid = $(this).data('acct');
    window.open(`profile.php?view=${userid}`, '_blank');
}));

$(document).on("click", ".thread-container", (function(){
    let threadid = $(this).data('thread');
    window.open(`thread.php?threadid=${threadid}`, '_blank');
}));

$('[data-fetch="people"]').click(function (e) {
    let searchstring = $('#search-string').val();
    $.ajax({
        type: "post",
        url: "../php-scripts/search-scripts.php",
        data: {people: searchstring},
        dataType: "json",
        success: function (response) {
            if(response.length == 0){
                $('.result-container').html('<div class="no-results">No results found</div>');
                return;
            }
            $('.result-container').empty();
            for (let i = 0; i < response.length; i++) {
                renderPeople(response[i]);
            }
        },
        error: function (response) {
            console.log(response.responseText);
        }
    });
});

$('[data-fetch="threads"]').click(function (e) {
    let searchstring = $('#search-string').val();
    $.ajax({
        type: "post",
        url: "../php-scripts/search-scripts.php",
        data: {threads: searchstring},
        dataType: "json",
        success: function (response) {
            if(response.length == 0){
                $('.result-container').html('<div class="no-results">No results found</div>');
                return;
            }
            $('.result-container').empty();
            for (let i = 0; i < response.length; i++) {
                renderThreads(response[i]);
            }
        },
        error: function (request, status, error) {
            console.log(request);
            console.log(status);
            console.log(error);
        }
    });
});