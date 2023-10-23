// Get the modal
//const modal = document.querySelector('#myModal');

// Get the button that opens the modal
//const btn = document.querySelector('.contact-btn');

// Get the <span> element that closes the modal
//const span = document.querySelector('.close');

// When the user clicks on the button, open the modal
//btn.addEventListener('click', function() {
//    modal.style.display = "block";
//})



// When the user clicks on <span> (x), close the modal
//span.addEventListener('click', function() {
//    modal.style.display = "none";
//})

// When the user clicks anywhere outside of the modal, close it
//document.addEventListener('click', function(event) {
//    if (event.target == modal) {
//        //modal.classList.add('close');
//        modal.style.display = "none";
//    }
//})



//jQuery(document).ready(function(){
//    jQuery('#refPhoto').val('hello');
//});
//===========================================================================================================================Modale Contact, input Référence
(function ($) { 
      // Tout le code jQuery ira ici ,  $ recupere jQuery, evite conflit
      $('.contact-btn').on('click', function() {//ouvrir la modale de contact
        $('#myModal').show();
    });
    
    $('.close').on('click', function() {//fermer la modale de contact
        $('#myModal').hide();
    })
   $(document).on('click', function(event) {//click en dehors de la modale 
       if(event.target == $('#myModal')[0]) {
           $('#myModal').hide();
       }
   });
      $('#refPhoto').val($('#reference').text().trim().toUpperCase());//Changer la valeur de l'input référence
      //alert(MYAJAX.ajax_url);
      $('btn-charger-plus').on('click', function() {
        $.ajax({
            type:'POST',
            url: 'http://localhost/mota/wp-admin/admin-ajax.php',
            data: {
                action: 'charger_plus',
            },
            success: function(response) {
                console.log(response);
            }
        })//Reqête Ajax
      })
  })(jQuery);

//===========================================================================================================================Flèche gauche
const arrow_left = document.querySelector(".arrow_left");//Récupération élément image flèche gauche
if(arrow_left) {
    const displayImageLeft = document.querySelector('.display-none-image-left')//Récupération élément image
arrow_left.addEventListener("mouseover", (event) => {
    displayImageLeft.classList.add("show-image")
});

arrow_left.addEventListener("mouseleave", (event) => {
    displayImageLeft.classList.remove("show-image")
});
}


//===========================================================================================================================Flèche droite
const arrow_right = document.querySelector(".arrow_right");//Récupération élément image flèche droite
if(arrow_right) {
    const displayImageRight = document.querySelector('.display-none-image-right')//Récupération élément image
arrow_right.addEventListener("mouseover", (event) => {
    displayImageRight.classList.add("show-image")
});

arrow_right.addEventListener("mouseleave", (event) => {
    displayImageRight.classList.remove("show-image")
});
}


//===========================================================================================================================
