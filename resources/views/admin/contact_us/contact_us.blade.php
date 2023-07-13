@extends('layout.master')
@section("title", "Admin Contact Us")
@section("content")
    <main id="main" class="main">

        <div class="pagetitle">
            <h1 class="d-inline">Contact Us</h1>
            <!-- Button trigger modal -->
            <!-- <button type="button" class="btn btn-primary btn-sm float-end" data-bs-toggle="modal" data-bs-target="#exampleModal">
              create
            </button> -->
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Create Contact Us</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="#">
                            @csrf
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Enter Your Name">
                                @error("name") <div class="text-danger"> {{$message}} </div> @enderror
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="Enter Your email">
                                @error("email") <div class="text-danger"> {{$message}} </div> @enderror
                            </div>
                            <div class="form-group">
                                <label for="mobile">Mobile</label>
                                <input type="number" name="mobile" id="mobile" class="form-control" placeholder="Enter Your Mobile Number">
                                @error("mobile") <div class="text-danger"> {{$message}} </div> @enderror
                            </div>
                            <div class="form-group">
                                <label for="comment">Comment</label>
                                <textarea name="comment" id="comment" class="form-control" cols="10" rows="2"></textarea>
                                @error("comment") <div class="text-danger"> {{$message}} </div> @enderror
                            </div>
                            <div class="form-group mt-2">
                                <input type="submit" value="Create ContactUs" class="btn btn-primary btn-sm fw-bold">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>


        </div><!-- End Page Title -->
        <section class="category-table mt-4">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>Comment</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($contact_us))
                    @foreach($contact_us as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->mobile }}</td>
                            <td>{{ $item->comment}}</td>
                            <td>{{ $item->created_at }}</td>
                            <td><!-- a data-bs-toggle="modal" data-bs-target="#exampleModal_{{$item->id}}" class="btn btn-info btn-sm">update</a>
                                 --><a href="{{route('admin.deleteContactUs',$item->id)}}" class="btn btn-danger btn-sm ms-2">Delete</a></td>
                        </tr>
                        <section class="modal_section">
                            <div class="modal fade" id="exampleModal_{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Update Category</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" action="#">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="cat_name">Category Name</label>
                                                    <input type="text" value="{{$item->name}}" name="name" id="name" class="form-control" placeholder="Enter Your Name">
                                                    @error("cat_name") <div class="text-danger"> {{$message}} </div> @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="email">Email</label>
                                                     <input type="email" value="{{$item->email}}" name="email" id="email" class="form-control" placeholder="Enter Your Email">
                                                    @error("email") <div class="text-danger"> {{$message}} </div> @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="mobile">Mobile</label>
                                                     <input type="number" value="{{$item->mobile}}" name="mobile" id="mobile" class="form-control" placeholder="Enter Your Mobile Number">
                                                    @error("mobile") <div class="text-danger"> {{$message}} </div> @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="comment">Comment</label>
                                                    <textarea name="comment" value="{{$item->comment}}" id="comment" class="form-control" cols="10" rows="2">{{$item->comment}}</textarea>
                                                    @error("comment") <div class="text-danger"> {{$message}} </div> @enderror
                                                </div>
                                                <div class="form-group mt-2">
                                                    <input type="submit" value="Update ContactUs" class="btn btn-primary btn-sm fw-bold">
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    @endforeach
                    @endif
                </tbody>
            </table>
            {{$contact_us->links()}}
        </section>
        
    </main>
@endsection