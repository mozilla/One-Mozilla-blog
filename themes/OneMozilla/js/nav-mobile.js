jQuery( document ).ready(function() {
  jQuery( '#nav-primary-toggle' ).on( 'click', function() {
    jQuery( '#nav-primary' ).toggleClass( 'visible' );
  });
});