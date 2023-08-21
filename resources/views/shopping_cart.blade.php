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
									<td>
										<input type="number" value="{{$cart_item['qty']}}" class="w-25 form-control" id="{{$id}}_qty">
										<a href="javascript:void(0)" class="text-decoration-none ms-3 mt-2" onclick="qty_update({{$id}})">update</a>
									</td>
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
			<div class="col-md-4 my-4">
				<a href="{{ route('home')}}" class="float-start btn btn-warning">Contine Shopping</a>
			</div>
			<div class="col-md-6 my-4">
				<h5 class="d-inline-block float-end">Grand Total : <b>{{$total}}</b> </h5> 
			</div>
			<div class="col-md-2 my-4">
				<a href="{{ route('checkout')}}" class="float-end btn btn-primary">Checkout</a>
			</div>
		</div>
	</div>				
@endsection

@push("script-footer")
<script>
	function qty_update(qty_id){
		let id = $("#"+qty_id+"_qty").val();
		
		$.ajaxSetup({
		    headers: {
		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    }
		});
		$.ajax({
			url :"{{route('qty-update')}}",
			method:"POST",
			data : {qty_id:id,product_id:qty_id},
			success:function(data){
				if(data.status == true){
					
					window.location.href = "{{route('cart')}}";
				}
			}
		});
	}
</script>
@endpush