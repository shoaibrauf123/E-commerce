@extends("layout.master")
@section("title", "Admin Login Form")
@section("content")

<div class="container">
    <div class="row">
        <div class="col-md-5 mx-auto mt-5">
            <div class="card">
                <div class="card card-header bg-secondary">
                    <h2 class="text-center  text-light">Admin Login</h2>
                </div>
                <div class="card card-body">
                    <form action="{{ route("admin.login") }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Enter Your Email">
                            @error('email')
                                    <div class="text-danger">{{ $message }}</div>                               
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Enter Your Password">
                            @error('password')
                                    <div class="text-danger">{{ $message }}</div>                               
                            @enderror
                        </div>
                        <div class="form-group mt-2">
                            <input type="submit"  class="btn btn-primary w-100" value="Admin Login">
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
    
@endsection