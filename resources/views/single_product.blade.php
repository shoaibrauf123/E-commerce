@extends('homeLayout.master')
@section("title","Product Page")
@section("content")
	
	<!-- Open Content -->
    <section class="bg-light">
        <div class="container pb-5">
            <div class="row">
                <div class="col-lg-5 mt-5">
                    <div class="card mb-3">
                        <img class="card-img img-fluid" src="{{asset('assets/img/admin_product/'.$single_product->product_image)}}" alt="Card image cap" id="product-detail">
                    </div>
                   
                </div>
                <!-- col end -->
                <div class="col-lg-7 mt-5">
                    <div class="card">
                        <div class="card-body">
                            <h1 class="h2">Active Wear</h1>
                            <p class="h3 py-2"><b>Rs.</b> {{$single_product->product_price}}</p>

                            <h6>Description:</h6>
                            <p class="mb-3">{{$single_product->description}}</p>

                            <h6 class="d-inline-block">Category:</h6>
                            <p class="d-inline-block mb-4">{{$single_product->categories->cat_name}}</p>

                            
                           

                            <form action="" method="GET">
                                <input type="hidden" name="product-title" value="Activewear">
                                <div class="row">
    
                                    <div class="col-auto">
                                        <ul class="list-inline pb-3">
                                            <li class="list-inline-item text-right">
                                                Quantity
                                                <input type="hidden" name="product-quanity" id="product-quanity" value="1">
                                            </li>
                                            <li class="list-inline-item"><span class="btn btn-success" id="btn-minus">-</span></li>
                                            <li class="list-inline-item"><span class="badge bg-secondary" id="var-value">1</span></li>
                                            <li class="list-inline-item"><span class="btn btn-success" id="btn-plus">+</span></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="row pb-3">
                                   <div class="col d-grid">
                                        <a href="{{route('add-to-cart',$single_product->id)}}" class="btn btn-success btn-lg" >Add To Cart</a>
                                    </div>
                                    
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Close Content -->

@endsection