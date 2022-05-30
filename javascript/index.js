$(document).ready(function(){
    setInterval(() => {
        reveal();
    }, 500);

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

window.addEventListener('scroll', reveal);
function reveal(){  
    let rev = document.querySelectorAll('.objective-div');
    for(var i = 0; i < rev.length; i++){
        let height = window.innerHeight;      
        let revealtop = rev[i].getBoundingClientRect().top;
        let revealpoint = 100;
        if(revealtop < height - revealpoint){
            rev[i].classList.add('open');
        }
        else{
            rev[i].classList.remove('open');
        }
    }
}


