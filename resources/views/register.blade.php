@extends("homeLayout.master")
@section("title", "User Register")
@section("content")

<div class="container">
    <div class="row">
        <div class="col-md-5 mx-auto my-4">
            <div class="card">
                <div class="card card-header bg-secondary">
                    <h2 class="text-center  text-white">User Register</h2>
                </div>
                <div class="card card-body">
                    <form action="{{ route('user-register')}}" method="POST" class="px-4 py-3">
                        @csrf
                        <div class="form-group">
                            <label for="username" class="form-label">Username</label>
                            <input type="username" name="username" id="username" class="form-control" placeholder="Enter Your Username">
                            @error('username')
                                <div class="text-danger">{{ $message }}</div>                               
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Enter Your Email">
                            @error('email')
                                    <div class="text-danger">{{ $message }}</div>                               
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="phone_number" class="form-label">Phone Number</label>
                            <input type="number" name="phone_number" id="phone_number" class="form-control" placeholder="Enter Your Phone Number">
                            @error('phone_number')
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
                            <input type="submit"  class="btn btn-primary w-100" value="User Register">
                        </div>
                        <br>
                        <hr>
                            <p class="text-center">Already Register <a href="{{route('user-login-form')}}" class="text-decoration-none fw-normal fs-5"> Sign In</a></p>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
    
@endsection