window.addEventListener('scroll', reveal);

function reveal(){
    var rev = document.querySelectorAll('.objective-div');
    for(var i = 0; i < rev.length; i++){
        var height = window.innerHeight;
        console.log(height)
        var revealtop = rev[i].getBoundingClientRect().top;
        var revealpoint = 150;

        if(revealtop < height - revealpoint){
            rev[i].classList.add('.active');
        }
        else{
            rev[i].classList.remove('.active');
        }
    }
}





$(document).ready(function(){
    $("#main-title").delay(300).animate({
        opacity: 1
    }, "slow");

    $(".main-intro p").delay(500).animate({
        opacity: 1
    }, "slow");

    $("#btn_start").delay(700).animate({
        opacity: 1
    }, "slow");

    $(".main-img").delay(400).animate({
        opacity: 1
    }, "slow");

});