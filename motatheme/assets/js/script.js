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
      $('#refPhoto').val($('#reference').text().trim().toUpperCase());
  })(jQuery);



