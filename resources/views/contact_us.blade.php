@extends('homeLayout.master')
@section("title","Contact Us Page")
@section("content")
	
	 <!-- Start Content Page -->
    <div class="container-fluid bg-light py-5">
        <div class="col-md-6 m-auto text-center">
            <h1 class="h1">Contact Us</h1>
            <p>
                Proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                Lorem ipsum dolor sit amet.
            </p>
        </div>
    </div>

  


    <!-- Start Contact -->
    <div class="container py-5">
        <div class="row py-5">
            <form class="col-md-9 m-auto" action="{{route('submit_contact_us')}}" method="post" role="form">
                @csrf
                <div class="row">
                    <div class="form-group col-md-6 mb-3">
                        <label for="inputname">Name</label>
                        <input type="text" class="form-control mt-1" id="name" name="name" placeholder="Enter Your Name">
                        @error('name') <p class="text-danger">{{$message}}</p> @enderror
                    </div>
                    <div class="form-group col-md-6 mb-3">
                        <label for="inputemail">Email</label>
                        <input type="email" class="form-control mt-1" id="email" name="email" placeholder="Enter Your Email">
                        @error('email') <p class="text-danger">{{$message}}</p> @enderror

                    </div>
                </div>
                <div class="mb-3">
                    <label for="mobile">Mobile Number</label>
                    <input type="number" class="form-control mt-1" id="mobile" name="mobile" placeholder="Enter Your Mobile Number">
                    @error('mobile') <p class="text-danger">{{$message}}</p> @enderror

                </div>
                <div class="mb-3">
                    <label for="comment">Comment</label>
                    <textarea class="form-control mt-1" id="Comment" name="comment" placeholder="Enter Your Comment" rows="8"></textarea>
                    @error('comment') <p class="text-danger">{{$message}}</p> @enderror

                </div>
                <div class="row">
                    <div class="col text-end mt-2">
                        <button type="submit" class="btn btn-success btn-lg px-3">Contact Us</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- End Contact -->
   

@endsection