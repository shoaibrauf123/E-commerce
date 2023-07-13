@extends('layout.master')
@section("title", "Admin User Details")
@section("content")
    <main id="main" class="main">

        <div class="pagetitle">
            <h1 class="d-inline">User Records</h1>
        </div>

    


        </div><!-- End Page Title -->
        <section class="category-table mt-4">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($users))
                    @foreach($users as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->username }}</td>
                            <td>{{ $item->email }}</td> 
                            <td>{{ $item->created_at }}</td>
                            <td><a href="{{route('admin.deleteUser',$item->id)}}" class="btn btn-danger btn-sm ms-2">Delete</a></td>
                        </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
            {{$users->links()}}
        </section>
        
    </main>
@endsection