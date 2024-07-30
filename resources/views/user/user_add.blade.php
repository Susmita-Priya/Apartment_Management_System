@extends('master')

@section('content')
@push('title')
    <title>Add User</title>
@endpush

    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">
          <div class="col-md-12">
    <div class="card-box">
        <h1 class="d-flex justify-content-center mt-4">Add User</h1>
        <form action = "{{url('/')}}/user/create" enctype="multipart/form-data" method = "POST">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="name" class="col-form-label">Full Name</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Enter Full Name">
                    <span class="text-danger">
                        @error('name')
                            {{ $message }}
                        @enderror
                    </span>
                </div>
                <div class="form-group col-md-6">
                    <label for="email" class="col-form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email">
                    <span class="text-danger">
                        @error('email')
                            {{ $message }}
                        @enderror
                    </span>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="phn" class="col-form-label">Phone Number</label>
                    <input type="text" class="form-control" name="phn" id="phn" placeholder="Enter Phone Number">
                    <span class="text-danger">
                        @error('phn')
                            {{ $message }}
                        @enderror
                      </span>
                </div>
                <div class="form-group col-md-6">
                    <label for="email" class="col-form-label">Identity No/Passport</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                    <span class="text-danger">
                        @error('email')
                            {{ $message }}
                        @enderror
                      </span>
                </div>
            </div>
            <div class="form-group">
                <label for="inputAddress" class="col-form-label">Address</label>
                <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
            </div>
            <div class="form-group">
                <div class="form-check">
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Sign in</button>
        </form>
    </div>
</div>  


        </div> <!-- container -->

    </div> <!-- content -->

</div>





@endsection