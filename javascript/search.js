const null_search = `
    <div class="null-search">
        <p>Invalid search Term. Please try again!</p>
    </div>
`;

let searchstring;

$(function () {
    $.urlParam = function(name){
        var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
        if (results==null) {
            return null;
        }
        return decodeURI(results[1]) || 0;
    }
    searchstring = $.urlParam('search');
    if (searchstring === null || searchstring === 0){
        $(".main").empty().append(null_search);
    } else {
        $(".main").append(`
        <h1>Search results for </h1>
        <div class="search-container" >
            <div class="navigation-bar">
                <p class="navigation-item" data-fetch="people"><i class='bx bxs-user-rectangle'></i> People</p>
                <p class="navigation-item" data-fetch="threads"><i class='bx bxs-message-square-detail'></i> Threads</p>
            </div>
            <div class="result-container">

            </div>
        </div>`);
        $('[data-fetch="people"]').click();
    }
    $('.main h1').append(`'${searchstring}'`);

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

$(document).on('click','[data-fetch="people"]',function (e) {
    $.ajax({
        type: "post",
        url: "../php-scripts/search-scripts.php",
        data: {people: searchstring},
        dataType: "json",
        beforeSend: function(){
            $(".loader-superuser").show();
        },
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
        complete: function(){
            $(".loader-superuser").hide();
        },
        error: function (response) {
            console.log(response.responseText);
        }
    });
});

$(document).on('click','[data-fetch="threads"]',function (e) {
    $.ajax({
        type: "post",
        url: "../php-scripts/search-scripts.php",
        data: {threads: searchstring},
        dataType: "json",
        beforeSend: function(){
            $(".loader-superuser").show();
        },
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
        complete: function(){
            $(".loader-superuser").hide();
        },
        error: function (request, status, error) {
            console.log(request);
            console.log(status);
            console.log(error);
        }
    });
});