$(document).ready(function(){
    setInterval(() => {
        reveal();
    }, 500);

    setInterval(() => {
        card();   
    }, 250);
    

    $("#main-title").delay(300).animate({
        opacity: 1
    }, "slow");

    $(".main-intro p").delay(500).animate({
        opacity: 1
    }, "slow");

    $(".btn_start").delay(700).animate({
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
        let revealpoint = 150;
        if(revealtop < height - revealpoint){
            rev[i].classList.add('open');          
        }
        else{
            rev[i].classList.remove('open');
            
        }
    }

}

window.addEventListener('scroll', card);
function card(){
    let card1 = document.querySelectorAll('#card-1');
    let card2 = document.querySelectorAll('#card-2');
    let card3 = document.querySelectorAll('#card-3');

        for(var j = 0; j < card1.length; j++){
            let cardheight = window.innerHeight;
            let cardtop = card1[j].getBoundingClientRect().top;
            let point = 25;

            if(cardtop < cardheight - point){
                card1[j].classList.add('open');
            }
            else{
                card1[j].classList.remove('open');
            }
        }

         
        for(var j = 0; j < card2.length; j++){
            let cardheight = window.innerHeight;
            let cardtop = card2[j].getBoundingClientRect().top;
            let point = 100;
    
            if(cardtop < cardheight - point){
                card2[j].classList.add('open');
            }
            else{
                card2[j].classList.remove('open');
            }
        }
        
        for(var j = 0; j < card3.length; j++){
            let cardheight = window.innerHeight;
            let cardtop = card3[j].getBoundingClientRect().top;
            let point = 100;
    
            if(cardtop < cardheight - point){
                card3[j].classList.add('open');
            }
            else{
                card3[j].classList.remove('open');
            }
        }
    
}



