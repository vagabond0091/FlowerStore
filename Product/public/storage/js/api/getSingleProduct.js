(function($) {
    $('.product-wrapper').on('click','#show',function(){
        $('.details-container').empty();     
    var title = $(this).data('title');
    var id = $(this).data('id');
    var desc = $(this).data('desc');
    var user = $(this).data('user');
    var qty = $(this).data('qty');
    var price = $(this).data('price');
    var image_link = $(this).data('image_link');
    var status = $(this).data('status');;
    let availability = '';
    if(status == 1){
        availability = `<p class="card-text">Status: Available</p>`
    }
    else{
       availability = `<p class="card-text">Status: Not Available</p>`
    }
    console.log(id);
    $('.modal.singleProduct').addClass('show');
    let div = $("<div/>",{"class": "data-wrapper d-flex  justify-content-between mt-3 p-3"});
    div.append([`
    <div class="image-container ">
        <img src="${image_link}" alt="" style="width:100%;height:195px;">
    </div> 
    <div class="details-wrapper">
            <h2>Title: ${title}</h2>
            <p>Description:</p>
            <p>${desc}</p>
            <p>Price: ${price}</p>
            <p>Quantity:
                <input type="number" class="form-control mt-2" id="qtyOrder" placeholder="Quantity"  value="${qty}"required>
            </p>
            ${availability}
            <div class="cta-wrapper">
            <button class="btn btn-success" data-user="${user}" data-id="${id}"  data-status="${status}"data-title="${title}" data-desc="${desc}" data-qty="${qty}"  data-price="${price}" data-image_link="${image_link}" id="orderProduct" >Order Product</button>
            </div>
    </div>
    `])
    $('.details-container').append(div);

        // order product
        $('#orderProduct').on('click',function(){
            var id = $(this).data('id');
            var status = $(this).data('status');
            var user = $(this).data('user');
            var qty = $('#qtyOrder').val();
            var price = $(this).data('price');
            var userLoggedIn = $('#user_id').val()
            if(status == 1){
                // proceed the order 
                    $.ajax({
                type: "POST",
                url: "/api/createOrder",
                data:{
                    user_id:userLoggedIn,
                    qty:qty,
                    price:price,
                    product_id:id
                },
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                dataType: "json",
                success: function(response) {
                    if(response.success == true){
                        toastr.success(response.message);
                        setInterval(function() {
                          window.location.replace("/");
                        }, 2000);
                    }
                    else{
                        toastr.error('Unable to create a order !');
                        setInterval(function() {
                          window.location.replace("/");
                        }, 2000);
                    }
                },
                error: function(error) {
                    console.log(error);
                }
            })
            }
            else{
                // toaster pop up
                toastr.error('The product is not available right now !');
                setInterval(function() {
                  window.location.replace("/");
                }, 2000);
            }
         

        })
    })

})(jQuery); 