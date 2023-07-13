@extends("layout.master")
@section("title","Admin Product")
@section("content")
<main id="main" class="main">

    <div class="pagetitle">
        <h1 class="d-inline">Product Records</h1>
        <a href="{{route('admin.productForm')}}" class="btn btn-primary btn-sm float-end">Create</a>
    </div>

    <section id="table">
    	<table class="table table-striped">
    		<thead>
    			<tr>
    				<th></th>
    				<th>Product Name</th>
    				<th>Category Name</th>
    				<th>Price</th>
    				<th>Mrp</th>
    				<th>Description</th>
    				<th>status</th>
    				<th>Action</th>
    			</tr>
    		</thead>
            <tbody>
                @if(!empty($product))
                    @foreach($product as $item)

                    <tr>
                        <td></td>
                        <td>{{$item->product_name}}</td>
                        <td>{{$item->categories->cat_name}}</td>
                        <td>{{$item->product_price}}</td>
                        <td>{{$item->product_mrp}}</td>
                        <td>{{$item->description}}</td>
                        <td>
                            @if($item->status == 1)
                                {{'Active'}}
                                @else
                                    {{'Not Active'}}
                            @endif
                        </td>
                        <td><a href="{{route('admin.editProductForm',$item->id)}}" class="btn btn-primary btn-sm fw-bold">Edit</a>
                            <a href="{{route('admin.deleteProduct',$item->id)}}" class="btn btn-danger btn-sm fw-bold">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                @endif
            </tbody>
    	</table>
    </section>
</main>
@endsection