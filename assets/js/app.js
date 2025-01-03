function refresh(){
    location.reload();
}

function openModalOnHash() {
    try {
      if(window.location.hash && window.location.hash!='') {
        var hash = window.location.hash.substring(1);
        $('#'+hash).addClass('open');
      }else{
        $('.custom-modal').removeClass('open');
      }
    }
    catch(err) {
      //document.getElementById("demo").innerHTML = err.message;
    }
}

$(document).ready(function(){
    $('.sidenav').sidenav();
    $('.collapsible').collapsible();
    $('.dropdown-trigger').dropdown({
        'alignment':'right',
        'coverTrigger':false
    });
    $('select').formSelect();
    $('.modal').modal({
        'dismissible':false
    });

    //open modal via url
    openModalOnHash();

    $(window).on('hashchange', function(e){
        openModalOnHash();
    });


    $(".btn-back").click(function(){
        $('.custom-modal').removeClass('open');
    });
});

if ( window.history.replaceState ) {
    window.history.replaceState( null, null, window.location.href );
}

$('#txtSearch').keypress(function(event){
    var keycode = (event.keyCode ? event.keyCode : event.which);
    if(keycode == '13'){
        mulai_cari();
    }
});

function mulai_cari(){
    var q = $('#txtSearch').val();
    document.location.href="diskon.php?page=1&q="+q;
}