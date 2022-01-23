(function($) {
    var user_id = $('#user_id').val();
    if(user_id != null){
        $.ajax({
            type: "GET",
            url: `/api/getAllProductsByUser/${user_id}`,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    
         
            dataType: "json",
            success: function(response) {
               
                if(response.success == true){   
                    response.data[0].product.map((items)=>{
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
                                <p class="card-text">Description: ${items.product_description}</p>
                                <p class="card-text">Price: ₱${items.price}</p> 
                                <p class="card-text">Quantity: ${items.quantity}</p>
                                ${availability}
                                <div class="cta-wrapper">
                                <button class="btn btn-primary" data-id="${items.id}" data-title="${items.product_name}" data-desc="${items.product_description}" data-qty="${items.quantity}"  data-price="${items.price}" data-image_link="${items.image_link}" data-status="${items.status}" id="edit" >Edit</button>
                                <button class="btn btn-danger" data-id="${items.id}" id="delete">Delete</button>
                                </div>
                            </div>
                        `])
                        $('.product-container').append(div);
                       
                    });
                    $('.product-container ').on("click",'#edit',function(e){
                        e.preventDefault();
                       
                        var title = $(this).data('title');
                        var id = $(this).data('id');
                        var desc = $(this).data('desc');
                        var qty = $(this).data('qty');
                        var price = $(this).data('price');
                        var status = $(this).data('status');
                        let available;
                        if(status == 1){
                            statusUpdate.checked = true
                            available = 1;
                        }
                        else{
                            statusUpdate.checked = false
                            available = 0;
                        }
                        var image_link = $(this).data('image_link');
                      let newTitle = $('#titleUpdate').val(title);
                       let newDesc =  $('#descriptionUpdate').val(desc);
                        $('#qtyUpdate').val(qty);
                        $('#priceUpdate').val(price);
                        
                        // $('#imageUpdate').val(image_link);
                        let image = ` <label >Current Image:</label>
                        <img src="${image_link}" style="width:100%;height:150px;background-image:no-repeat;">`;
                        $('.form-group.mt-2.image').append().html(image);
                        $('.modal.update').addClass('show');
                        var reader = new FileReader();
                        var baseString;
                        $('.btn.btn-primary.uploadProduct').on("click",function(e){
                            var file_check = $('.form-control.mt-2.imageUpdate');
                            var imageUpdate = $('.form-control.mt-2.imageUpdate').prop('files')[0];
                            let newTitle = $('#titleUpdate').val();
                            let newDesc =  $('#descriptionUpdate').val();
                           let newQty =  $('#qtyUpdate').val();
                            let newPrice =  $('#priceUpdate').val();
                          
                            let statusUpdate = $('#statusUpdate').attr("checked") ? 1 : 0;
                            reader.onloadend = function () { 
                                baseString = reader.result;
                             
                                
                                $.ajax({
                                    type: "POST",
                                    url: "/api/uploadImage",
                                    data:{
                                        product_image:baseString,
                                    },
                                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                                    dataType: "json",
                                    success: function(response) {
                                        console.log(response);
                                        if(response.success == true){
                                            console.log(id);
                                            $.ajax({
                                                type: "PUT",
                                                url: `/api/updateProduct/${id}`,
                                                data:{
                                                    title:newTitle,
                                                    description:newDesc,
                                                    price:newPrice,
                                                    quantity:newQty,
                                                    product_image:response.data_url.secure_url,  
                                                    status:statusUpdate, 
                                                },
                                                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                                                dataType: "json",
                                                success: function(response) {
                                                    console.log(response)
                                                    if(response.success == true){
                                                        toastr.success(response.message);
                                                        setInterval(function() {
                                                          window.location.replace("/Product");
                                                        }, 2000);
                                                    }
                                                    else{
                                                        toastr.error('Unable to create a new Product !');
                                                        setInterval(function() {
                                                          window.location.replace("/Product");
                                                        }, 2000);
                                                    }
                                                },
                                                error: function(error) {
                                                    console.log(error);
                                                }
                                            
                                              })
                                        }
                                        else{
                                            toastr.error('Unable to update a Product !');
                                            setInterval(function() {
                                              window.location.replace("/Product");
                                            }, 2000);
                                        }
                                    },
                                    error: function(error) {
                                        console.log(error);
                                    }
                                })
                            };
                            if( file_check.prop('files').length == 0 ){
                                toastr.error('Please upload image');
                              }
                            else{
                            
                                  reader.readAsDataURL(imageUpdate);
                              }  
                        })
                      
                        
                    })
                   
                }
            },
            error: function(error) {
                console.log(error);
            }
        
          })
    }
})(jQuery); 