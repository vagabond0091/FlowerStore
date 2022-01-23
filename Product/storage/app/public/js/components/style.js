(function($) {
  $('#addProduct').on("click",function(e){
      e.preventDefault();
      $('.modal.add').toggleClass('show');
  })
  $('.close-add.btn-danger').on("click",function(e){
      e.preventDefault()
      $('.modal.add').removeClass('show');
  })
  $('.close-update.btn-danger').on("click",function(e){
    e.preventDefault()
    $('#updateProduct').removeClass('show');
})

$('.close-singleProduct.btn-danger').on("click",function(e){
    e.preventDefault()
    $('.modal.singleProduct').removeClass('show');
})
})(jQuery); 