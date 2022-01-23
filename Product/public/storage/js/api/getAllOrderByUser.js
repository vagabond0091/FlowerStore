(function($) {
    let user = $('#userID').val();
    $.ajax({
        type: "GET",
        url: `/api/getAllOrdersbyUser/${user}`,
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},

        dataType: "json",
        success: function(response) {
            response.data.map((items)=>{
                let total_price = items.quantity * items.price;
                let div = $("<div/>",{"class": "w-100 d-flex card-container mt-3"});
                div.append([`
                <div class="product-image">
                    <img src="${items.image_link}" alt="" style="width:100%;height:250px;">
                </div>
                <div class="product-details ">
                    <h5 class="mt-2">Order ID:${items.id}</h5>
                    <h5>Product Name: ${items.product_name}</h5>
                    <p>Description: ${items.product_description}</p>
                    <p>Price:${items.price}</p>
                    <p>Quantity:${items.quantity}</p>
                    <p>Total Price:${total_price}</p>
                  
                </div>
    
                `])
                $('.order-wrapper').append(div)
            })
        
        },
        error: function(error) {
            console.log(error);
        }
    
      })
})(jQuery); 