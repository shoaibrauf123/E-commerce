@extends("layout.master")
@section("title","Admin Create Product")
@section("content")
<main id="main" class="main">
	<div class="pagetitle">
	    <h1 class="">Create Product</h1>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<form action="{{route('admin.updateProduct',$product->id)}}" method="POST" enctype="multipart/form-data">
					@csrf
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="categories">Categories</label>
								<select name="categories" id="categories" class="form-select">
									<option value="">Select Categoies</option>
									@if(isset($category))
										@foreach($category as $item)
											<option value="{{$item->id}}" {{$product->category_id_fk == $item->id ? "selected" : "" }} >{{$item->cat_name}}</option>
										@endforeach
									@endif
								</select>
								@error('categories') <div class="text-danger">{{$message}}</div> @enderror
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="product_name">Product Name</label>
								<input type="text" name="product_name" id="product_name" value="{{$product->product_name}}" class="form-control" placeholder="Enter Product Name">
							@error('product_name') <div class="text-danger">{{$message}}</div> @enderror
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="product_price">Product Price</label>
								<input type="number" name="product_price" id="product_price" value="{{$product->product_price}}" class="form-control" placeholder="Enter Product Price">
							@error('product_price') <div class="text-danger">{{$message}}</div> @enderror
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="product_mrp">Product Mrp</label>
								<input type="number" name="product_mrp" id="product_mrp" value="{{$product->product_mrp}}" class="form-control" placeholder="Enter Product Mrp">
							@error('product_mrp') <div class="text-danger">{{$message}}</div> @enderror
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="product_qty">Product Qty</label>
								<input type="number" name="product_qty" id="product_qty" value="{{$product->product_qty}}" class="form-control" placeholder="Enter Product Qty">
							@error('product_qty') <div class="text-danger">{{$message}}</div> @enderror
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="short_desc">Short Description</label>
								<input type="text" name="short_desc" id="short_desc" value="{{$product->short_desc}}" class="form-control" placeholder="Enter Short Description">
							@error('short_desc') <div class="text-danger">{{$message}}</div> @enderror
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="description">Description</label>
								<textarea name="description" id="descripiton" value="{{$product->description}}" cols="" rows="2" class="form-control" placeholder="Enter Description...">{{$product->description}}</textarea>
							@error('description') <div class="text-danger">{{$message}}</div> @enderror
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="meta_title">Meta Title</label>
								<textarea name="meta_title" id="meta_title" cols="" value="{{$product->meta_title}}" rows="2" class="form-control" placeholder="Enter Some Meta Title...">{{$product->meta_title}}</textarea>
							@error('meta_title') <div class="text-danger">{{$message}}</div> @enderror
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="meta_desc">Meta Description</label>
								<input type="text" name="meta_desc" id="meta_desc" value="{{$product->meta_desc}}" class="form-control" placeholder="Enter Meta Description">
							@error('meta_desc') <div class="text-danger">{{$message}}</div> @enderror	
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="meta_keyword">Meta Keyword</label>
								<input type="text" name="meta_keyword" id="meta_keyword" value="{{$product->meta_keyword}}" class="form-control" placeholder="Enter Meta Keyword">
							@error('meta_keyword') <div class="text-danger">{{$message}}</div> @enderror	
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="product_image">Product Image</label>
								<input type="file" name="product_image" id="product_image" class="form-control" value="{{$product->product_image}}">

								<img style="width:80px;height: 80px" class="mt-2" src="{{asset('assets/img/admin_product/'.$product->product_image)}}" alt="No Pic"> {{$product->product_image}}
								@error('product_image') <div class="text-danger">{{$message}}</div> @enderror	
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="product_image">Product Status</label>
								<select name="product_status" id="product_status" class="form-select">
									<option value="">Select Option</option>
									<option value="1" {{$product->status == 1 ? "selected" : ""}}>Active</option>
									<option value="0" {{$product->status == 0 ? "selected" : ""}}>Not Active</option>
								</select>
								@error('product_status') <div class="text-danger">{{$message}}</div> @enderror	
							</div>
						</div>
						
						<div class="form-group mt-3">
							<input type="submit" value="Update Product" class="btn btn-primary btn-sm fw-bold float-end">
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>					
</main>
@endsection