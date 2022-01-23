(function($) {
    $.ajax({
        type: "GET",
        url: `/api/getAllProducts`,
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},

     
        dataType: "json",
        success: function(response) {
          
            if(response.success == true){   
                $('.details-container').empty();
                response.data.map((items)=>{
                    console.log(items)
                    let desc = items.product_description;
                    var status = items.status;
                    let availability = '';
                    if(status == 1){
                        availability = `<p class="card-text">Status: Available</p>`
                    }
                    else{
                       availability = `<p class="card-text">Status: Not Available</p>`
                    }
                    let div = $("<div/>",{"class": "card mr-3 mt-3", "style":"width:18rem;"});
                    div.append([`
                        <img class="card-img-top" src="${items.image_link}" alt="Card image cap" style="width:100%;height:200px;">
                        <div class="card-body">
                            <h5 class="card-title">Title: ${items.product_name}</h5>
                            <p class="card-text">Description: ${desc}</p>
                            <p class="card-text">Price: ₱${items.price}</p> 
                            <p class="card-text">Quantity: ${items.quantity}</p>
                            ${availability}
                            <div class="cta-wrapper">
                            <button class="btn btn-success" data-user="${items.user[0].id}"data-id="${items.id}"  data-status="${items.status}"data-title="${items.product_name}" data-desc="${items.product_description}" data-qty="${items.quantity}"  data-price="${items.price}" data-image_link="${items.image_link}" id="show" >View Product</button>
                            </div>
                        </div>
                    `])
                    $('.product-wrapper').append(div);
                })
                
               
                  
                  
                    
               
               
            }
        },
        error: function(error) {
            console.log(error);
        }
    
      })
})(jQuery); 