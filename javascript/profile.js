let user_profileID;

$(function () {
    $.urlParam = function(name){
        var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
        if (results==null) {
           return null;
        }
        return decodeURI(results[1]) || 0;
    }
    user_profileID = $.urlParam('view');
    console.log(user_profileID);
});

$(document).on("click", ".message-user", function () {
    window.open("/messages.php?id=" + user_profileID, "_blank");
});

