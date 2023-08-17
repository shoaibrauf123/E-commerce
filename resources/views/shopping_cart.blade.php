@extends('homeLayout.master')
@section("title","Product Shopping Cart")
@section("content")
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-12">
				<table class="table table-striped">
					<thead>
						<tr>
							<th></th>
							<th>Product Name</th>
							<th>Product Price</th>
							<th>Product Qty</th>
							<th>Sub Total</th>
							<th></th>
						</tr>
					</thead>
					@php $total = 0; @endphp
					<tbody>
						@if(Session::has("cart"))
							@foreach(Session::get("cart") as $id => $cart_item)
								
								@php 
									$subTotal = $cart_item["price"] * $cart_item["qty"]; 
									$total += $subTotal;
								@endphp
								<tr>
									<td><img style="width: 60px; height: 60px" src="{{asset('assets/img/admin_product/'.$cart_item['cart_image'])}}" alt="no Pic"></td>
									<td>{{$cart_item['name']}}</td>
									<td>{{$cart_item['price']}}</td>
									<td>{{$cart_item['qty']}}</td>
									<td>{{$subTotal}}</td>
									<td><a href="{{route('delete-cart-item',$id)}}" class="btn btn-danger btn-sm">x</a></td>
								</tr>
							@endforeach

						@endif
					</tbody>			
				</table>
				<div class="border border-dark mt-5 ">
				</div>
			</div>
			<div class="col-md-6 my-4">
				<a href="{{ route('home')}}" class="float-start btn btn-warning">Contine Shopping</a>
			</div>
			<div class="col-md-6 my-4">
				<h5 class="offset-4 fw-bold d-inline-block ">Grand Total</h5> : <b>{{$total}}</b>
			</div>
		</div>
	</div>				
@endsection