$('.create-thread').click(function () { 
    window.location.href = "create.php";
});


$('.thread').click(function (e) { 
    e.preventDefault();
    let tid = $(this).attr('data-thread');
    location.href = "thread.php?threadid=" + tid;
});
