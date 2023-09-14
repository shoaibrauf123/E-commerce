@extends('homeLayout.master')
@section("title","Checkout")
@push('header-style')
<style>
	.checkout_cart_qty{
		top:-12px;
		right:-12px;
		border-radius: 50%;
		width:25px;
		height:25px;
		line-height:25px;
		text-align: center;
		color: #fff;
		font-weight: 800;
		font-size: 12px;
	}
</style>
@endpush
@section("content")

	@if(!Session::has('cart') || count( Session::get('cart') ) == 0)
		<script>
			window.location = "{{route('home')}}";
		</script>	
	@endif
	<section class="bg-light py-5">
	  <div class="container">
	    <div class="row">
	      <div class="col-xl-8 col-lg-8 mb-4">
	      	@if(!Auth::check())
		        <div class="card mb-4 border shadow-0">
		          <div class="p-4 d-flex justify-content-between">
		            <div class="">
		              <h5>Have an account?</h5>
		              <p class="mb-0 text-wrap ">Lorem ipsum dolor sit amet, consectetur adipisicing elit</p>
		            </div>
		            <div class="d-flex align-items-center justify-content-center flex-column flex-md-row">
		              <a href="{{route('user-register-form')}}" class="btn btn-outline-primary me-0 me-md-2 mb-2 mb-md-0 w-100">Register</a>
		              <a href="{{route('user-login-form')}}" class="btn btn-primary shadow-0 text-nowrap w-100">Sign in</a>
		            </div>
		          </div>
		        </div>
		    @endif

	        <!-- Checkout -->
	        @if(Auth::check())
		        <div class="card shadow-0 border">
		          <div class="p-4">
		            <h5 class="card-title mb-3">Shipping info</h5>
		            <form action="{{route('payment-order')}}" method="POST">
		            	@csrf
			            <div class="row">
			            	@php $total = 0; @endphp
		        				@if(Session::has("cart"))
									@foreach(Session::get("cart") as $id => $cart_item)
										@php 
											$subTotal = $cart_item["price"] * $cart_item["qty"]; 
											$total += $subTotal;
										@endphp
									@endforeach
								@endif		
				            <div class="col-sm-8 mb-3">
				                <p class="mb-0">Address</p>
				                <div class="form-outline">
				                  	<input type="text" name="address" placeholder="Type here" class="form-control" />
				                  	<input type="hidden" name="total_price" value="{{$total}}" class="form-control" />
				                	@error('address')
				                		<div class="text-danger">{{$message}}</div>
				                	@enderror
				                </div>
				            </div>
				            <div class="col-sm-4 mb-3">
				                <p class="mb-0">State</p>
				                <select class="form-select" name="state">
					                <option value="punjab">Punjab</option>
					                <option value="sarhad">Sarhad</option>
					                <option value="sindh">Sindh</option>
					                <option value="blochistan">Blochistan</option>
				                  	@error('state')
				                		<div class="text-danger">{{$message}}</div>
				                	@enderror
				                </select>

				            </div>

				            <div class="col-sm-4 mb-3">
				                <p class="mb-0">City</p>
				                <select class="form-select" name="city">
					                <option value="lahore">Lahore</option>
					                <option value="sheikhpura">Sheikhpura</option>
					                <option value="sharkpur">Sharkpur</option>
					                <option value="faisalabad">Faisalabad</option>
					                @error('city')
				                		<div class="text-danger">{{$message}}</div>
				                	@enderror
				                </select>
				        	</div>

				            <div class="col-sm-4 col-6 mb-3">
				                <p class="mb-0">Postal code</p>
				                <div class="form-outline">
				                  	<input type="text" id="typeText" name="postal_code" class="form-control" />
				                	@error('postal_code')
				                		<div class="text-danger">{{$message}}</div>
				                	@enderror
				                </div>
				            </div>

				            <div class="col-sm-4 col-6 mb-3">
				                <p class="mb-0">Pin code</p>
				                <div class="form-outline">
				                  	<input type="text" id="typeText" name="pin_code" class="form-control" />
				                	@error('pin_code')
				                		<div class="text-danger">{{$message}}</div>
				                	@enderror
				                </div>
				            </div>
			            </div>
			            <hr>
			            <h5>Payment Information</h5>
			            <div class="row">
			            	<div class="col-md-12">
			            		<div class="form-group">
				            		<b>COD</b> <input type="radio" name="payment_type" id="" value="cod">
				            		<b>Easy Pay</b> <input type="radio" sname="payment_type" id="" value="easy_pay">
			            		</div>
			            	</div>
			            	<div class="col-md-12">
			            		<input type="submit" value="Integration" class="btn btn-primary btn-sm float-end fw-bold fs-6">
			            	</div>

			            </div>

			        </form>
		          </div>
		        </div>
		    @endif
	        <!-- Checkout -->
	      </div>
	      <div class="col-xl-4 col-lg-4 d-flex justify-content-center justify-content-lg-end">
	        <div class="ms-lg-4 mt-4 mt-lg-0" style="max-width: 320px;">
	        	<h6 class="text-dark my-4">Items in cart</h6>
	        	@php $total = 0; @endphp
		        @if(Session::has("cart"))
					@foreach(Session::get("cart") as $id => $cart_item)
					@php 
						$subTotal = $cart_item["price"] * $cart_item["qty"]; 
						$total += $subTotal;
					@endphp

				        <div class="d-flex align-items-center mb-4">
				            <div class="me-3 position-relative">
					            <span class="position-absolute bg-danger checkout_cart_qty">
					                {{$cart_item['qty']}}
					            </span>
				                <img src="{{asset('assets/img/admin_product/'.$cart_item['cart_image'])}}" style="height: 96px; width: 96x;" class="img-sm rounded border" />
				            </div>
				            <div class="">
				                <a href="#" class="nav-link">
				                	{{$cart_item['name']}}
				                </a>
				                <div class="price text-muted">Total: Rs. {{$cart_item['price']}}</div>
				            </div>
				            <a href="{{route('delete-cart-item',$id)}}" class="btn btn-danger btn-sm float-end ms-5"><i class="fas fa-solid fa-trash"></i></a>
				        </div>

			        @endforeach
			    @endif
			    <hr />
	          <h6 class="mb-3">Summary</h6>
	          <div class="d-flex justify-content-between">
	            <p class="mb-2">Total price:</p>
	            <p class="mb-2">Rs. {{$total}}</p>
	          </div>
	          <!-- <div class="d-flex justify-content-between">
	            <p class="mb-2">Discount:</p>
	            <p class="mb-2 text-danger">- $60.00</p>
	          </div> -->
	          <div class="d-flex justify-content-between">
	            <p class="mb-2">Shipping cost:</p>
	            <p class="mb-2">Rs. {{$total + 50}}</p>
	          </div>
	          <hr />
	          <div class="d-flex justify-content-between">
	            <p class="mb-2">Total price:</p>
	            <p class="mb-2 fw-bold">Rs. {{$total+50}}</p>
	          </div>

	          <div class="input-group mt-3 mb-4">
	            <input type="text" class="form-control border" name="" placeholder="Promo code" />
	            <button class="btn btn-light text-primary border">Apply</button>
	          </div>

	          
	          

	          
	        </div>
	      </div>
	    </div>
	  </div>
	</section>
@endsection