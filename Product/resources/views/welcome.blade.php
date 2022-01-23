@extends('layouts.app')
    
    @section('content')
    <div class="container">
    <div class="container-wrapper d-flex align-items-center justify-content-between   mb-2  fs-1 mt-3">
        @if(Auth::check())
        <input type="hidden" name="user_id" id="user_id" value="{{Auth::user()->id}}">
        @endif
            <div class="title-container ">
                <h2>List of Product</h2>
            </div>
           


        </div>
        <div class="product-wrapper d-flex align-items-center justify-content-start flex-wrap">

        </div>
        <!-- Show Product Modal -->
        <div class="modal singleProduct " tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Product Details</h5>
                <button type="button" class="close-singleProduct btn-danger" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true " class="fs-5">&times;</span>
                </button>
            </div>
          <div class="details-container ">
            
          </div>
            
          
              
              
              
            
         
            </div>
        </div>
    </div>
    </div>
    @endsection

 
