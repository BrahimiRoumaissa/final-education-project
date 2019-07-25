$(function (){
		'use strict';
		//Adjust slider hieght
		var winHi = $(window).height(),
		    navH  =$('.navbar').innerHeight();

		$('.slider').height(winHi - navH);
		//featured 
	$('.featured-work ul li').on('click', function ()
	 {
    $(this).addClass('active').siblings().removeClass('active');
  if ($(this).data('class') === 'all') {
$('.mother .col-sm').css('opacity',1);
  }
  else{
	$('.mother .col-sm').css('opacity','.08');
	$($(this).data('class')).parent().css('opacity',1);
  }
	});

 });
//tric for confirme delete 
    $('.confirme').click(function(){
       return confirm('Are you sure?');
    });


 $('#exampleModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var recipient = button.data('whatever') // Extract info from data-* attributes
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  var modal = $(this)
  modal.find('.modal-title').text('Products is: ')
  modal.find('.modal-body input').val(recipient)
});
 $('#Modal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var recipient = button.data('whatever') // Extract info from data-* attributes
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  var modal = $(this)
  modal.find('.modal-title').text('New message ')
  modal.find('.modal-body input').val(recipient)
});

