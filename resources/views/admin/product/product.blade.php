@extends("layout.master")
@section("title","Admin Product")
@section("content")
<main id="main" class="main">

    <div class="pagetitle">
        <h1 class="d-inline">Product</h1>
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
    	</table>
    </section>
</main>
@endsection