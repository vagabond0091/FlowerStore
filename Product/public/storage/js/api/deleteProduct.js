(function($) {
    $('.product-container ').on("click",'#delete',function(e){
        var id = $(this).data('id');
        $.ajax({
            type: "DELETE",
            url: `/api/deleteProduct/${id}`,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data:{
              id:id,
          
          
            },
          
            dataType: "json",
            success: function(response) {
                if(response.success == true){
                    toastr.error(response.message);
                    setInterval(function() {
                      window.location.replace("/Product");
                    }, 2000);
                  }
                  else{
                    toastr.error(' Unable to delete product ! ');
                  }
            },
            error: function(error) {
                console.log(error);
            }
        })
    })
})(jQuery); 