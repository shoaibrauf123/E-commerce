@extends('layout.master')
@section("title", "Admin category")
@section("content")
    <main id="main" class="main">

        <div class="pagetitle">
            <h1 class="d-inline">Category</h1>
        
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary btn-sm float-end" data-bs-toggle="modal" data-bs-target="#exampleModal">
              create
            </button>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Create Category</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{route('admin.addCategory')}}">
                            @csrf
                            <div class="form-group">
                                <label for="cat_name">Category Name</label>
                                <input type="text" name="cat_name" id="cat_name" class="form-control" placeholder="Enter Category Name">
                                @error("cat_name") <div class="text-danger"> {{$message}} </div> @enderror
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="form-select">
                                    <option>Select Category</option>
                                    <option value="1">Active</option>
                                    <option value="0">Not Active</option>
                                </select>
                                @error("status") <div class="text-danger"> {{$message}} </div> @enderror
                            </div>
                            <div class="form-group mt-2">
                                <input type="submit" value="Create Category" class="btn btn-primary btn-sm">
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
                        <th>Category Name</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($category))
                    @foreach($category as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->cat_name }}</td>
                            <td>
                                @if($item->status == 1)
                                    {{'Active'}}
                                    @else
                                    {{'No Active'}}
                                @endif 
                            </td>
                            <td>{{ $item->created_at }}</td>
                            <td><a data-bs-toggle="modal" data-bs-target="#exampleModal_{{$item->id}}" class="btn btn-info btn-sm">update</a><a href="{{route('admin.deleteCategory',$item->id)}}" class="btn btn-danger btn-sm ms-2">Delete</a></td>
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
                                            <form method="POST" action="{{route('admin.updateCategory',$item->id)}}">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="cat_name">Category Name</label>
                                                    <input type="text" value="{{$item->cat_name}}" name="cat_name" id="cat_name" class="form-control" placeholder="Enter Category Name">
                                                    @error("cat_name") <div class="text-danger"> {{$message}} </div> @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="status">Status</label>
                                                    <select name="status" id="status" class="form-select">
                                                        <option>Select Category</option>
                                                        <option value="1" {{$item->status == 1 ? "selected": ""}}>Active</option>
                                                        <option value="0" {{$item->status == 0 ? "selected": ""}}>Not Active</option>
                                                    </select>
                                                    @error("status") <div class="text-danger"> {{$message}} </div> @enderror
                                                </div>
                                                <div class="form-group mt-2">
                                                    <input type="submit" value="Update Category" class="btn btn-primary btn-sm">
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
            {{$category->links()}}
        </section>
        
    </main>
@endsection