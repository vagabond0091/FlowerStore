@extends('layouts.app')
    
@section('content')

<div class="container">
    <input type="hidden" id="userID"value="{{Auth::user()->id}}">
        <div class="container-wrapper d-flex align-items-center justify-content-between   p-3 mb-2 bg-success text-white mt-3">
            <div class="title-container ">
                <h4>My Orders</h4>
            </div>
            <div class="add-product">

            </div>


        </div>
        <div class="order-wrapper">
             
        </div>
</div>
@endsection