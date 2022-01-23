@extends('layouts.app')
    
    @section('content')
    <div class="container">
        <div class="container-wrapper d-flex align-items-center justify-content-between   p-3 mb-2 bg-success text-white mt-3">
            <div class="title-container ">
                <h4>My Product</h4>
            </div>
            <div class="add-product">
                <button class="btn btn-primary fw-light" id="addProduct">
                    Add Product
                </button>
            </div>


        </div>
        <div class="product-container d-flex align-items-center justify-content-start flex-wrap">
                
            </div>
    </div>
    <!-- Modal Add Product -->
   
    <div class="modal add" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Product</h5>
                <button type="button" class="close-add btn-danger" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true " class="fs-5">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form method="POST" id="createProduct">
            @csrf
                <div class="form-group mt-2">
                    <label>Title:</label>
                    <input type="text" class="form-control mt-2" id="title" placeholder="Title" required>
                </div>
         
                <div class="form-group mt-2">
                    <label >Description:</label>
                    <textarea class="form-control mt-2" id="description" rows="3" required></textarea>
                </div>
                <div class="form-group mt-2">
                    <label >Product Image:</label>
                    <input type="file" class="form-control mt-2" id="image" placeholder="Product Image" required>
                </div>
                <div class="form-group mt-2">
                    <label >Price:</label>
                    <input type="number" class="form-control mt-2" id="price" placeholder="Price" required>
                </div>
                <div class="form-group mt-2">
                    <label >Quantity:</label>
                    <input type="number" class="form-control mt-2" id="qty" placeholder="Quantity" required>
                </div>
                <div class="form-group mt-2 align-items-center">
                    <label for="status">Availability</label>
                    <input type="checkbox" id="status" name="status" >
                   
                </div>
                <div class="form-group mt-2">

                    <input type="hidden" class="form-control mt-2" id="user_id" placeholder="Quantity" value="{{Auth::id()}}">
                </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="uploadProduct">Save changes</button>

            </div>
            </div>
        </div>
    </div>

    <!-- Modal Update Product -->
    <div class="modal update" tabindex="-1" role="dialog" id="updateProduct">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Product</h5>
                <button type="button" class="close-update btn-danger " data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true " class="fs-5">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group mt-2">
                    <label>Title:</label>
                    <input type="text" class="form-control mt-2" id="titleUpdate" placeholder="Title" required>
                </div>
                <div class="form-group mt-2">
                    <label >Description:</label>
                    <textarea class="form-control mt-2" id="descriptionUpdate" rows="3" required></textarea>
                </div>
                <div class="form-group mt-2 image">
                   

                </div>
                <div class="form-group mt-2">
                    <label >Product Image:</label>
                    <input type="file" class="form-control mt-2 imageUpdate" id="imageUpdate" placeholder="Product Image" required>
                </div>
                <div class="form-group mt-2">
                    <label >Price:</label>
                    <input type="number" class="form-control mt-2" id="priceUpdate" placeholder="Price" required>
                </div>
                <div class="form-group mt-2">
                    <label >Quantity:</label>
                    <input type="number" class="form-control mt-2" id="qtyUpdate" placeholder="Quantity" required>
                </div>
                <div class="form-group mt-2 align-items-center">
                    <label for="status">Availability</label>
                    <input type="checkbox" id="statusUpdate" name="statusUpdate" >
                   
                </div>
               
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary uploadProduct" id="uploadProduct">Save</button>

            </div>
            </div>
        </div>
    </div>
    @endsection

 
