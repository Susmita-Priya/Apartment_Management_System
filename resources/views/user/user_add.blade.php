@extends('master')

@section('content')
@push('title')
    <title>Add User</title>
@endpush

    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title float-left">Users</h4>

                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="{{url('/index') }}">Admin</a></li>
                            <li class="breadcrumb-item"><a href="#">Users</a></li>
                            <li class="breadcrumb-item active">Add user</li>
                        </ol>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <!-- end row -->
            <div class="row">
                <div class="col-md-12">

         <form action = "{{url('/')}}/user/create" enctype= "multipart/form-data" method = "POST">   
            @csrf
          <div class="col-md-12">
    <div class="card-box">
        <h1 class="d-flex justify-content-center mt-4">ADD USER</h1>
        
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="fullname" class="col-form-label">Full Name</label>
                    <input type="text" class="form-control" name="fullname" id="fullname" placeholder="Enter Full Name">
                    <span class="text-danger">
                        @error('fullname')
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
                    <input type="text" class="form-control" id="phn" name="phn" placeholder="Enter Phone Number">
                    <span class="text-danger">
                        @error('phn')
                            {{ $message }}
                        @enderror
                      </span>
                </div>
                <div class="form-group col-md-6">
                    <label for="idno" class="col-form-label">Identity No / Passport</label>
                    <input type="text" class="form-control" id="idno" name="idno" placeholder="Enter Identity">
                    <span class="text-danger">
                        @error('idno')
                            {{ $message }}
                        @enderror
                      </span>
                </div>
            </div>
            <div class="form-row">
            <div class="form-group col-md-6">
                <label for="iddoc" class="col-form-label">Identification Document</label>
                <input class="form-control no-border" type="file" id="iddoc" name="iddoc">
                <span class="text-danger">
                  @error('iddoc')
                      {{ $message }}
                  @enderror
              </span>
              </div>
            <div class="form-group col-md-6">
                <label for="address" class="col-form-label">Address</label>
                <input type="text" class="form-control" id="address" name="address" placeholder="Enter Address">
                <span class="text-danger">
                    @error('address')
                        {{ $message }}
                    @enderror
                  </span>
            </div>
            </div>
            {{-- <div class="form-group">
                <div class="form-check">
                </div>
            </div> --}}

      <!-- Gray box as a divider -->
    <div class="bg-light p-1 my-4">
        <h5><i class="fa fa-square"></i>&nbsp;PLACE OF WORK</h5>
    </div>

    <div class="form-row">
       
        <div class="form-group col-md-6">
            <label for="occ_status" class="col-form-label">Occupation Status</label>
            <select id="occ_status" name="occ_status" class="form-control">
                <option selected>Choose</option>
                <option value="employee">Employee</option>
                <option value="employer">Employer</option>
                <option value="others">Others</option>
            </select>
        </div> 
        <div class="form-group col-md-6">
            <label for="occ_place" class="col-form-label">Occupation Place</label>
            <input type="text" class="form-control" id="occ_place" name="occ_place" placeholder="Enter Occupation place">
            <span class="text-danger">
                @error('occ_place')
                    {{ $message }}
                @enderror
              </span>
        </div>
    </div>

    <div class="bg-light p-1 my-4">
        <h5><i class="fa fa-square"></i>&nbsp;INCASE OF EMERGENCY CONTACT</h5>
    </div>

    <div class="form-row">
       
        <div class="form-group col-md-6">
            <label for="emname" class="col-form-label">Name</label>
            <input type="text" class="form-control" id="emname" name="emname" placeholder="Enter Name">
            <span class="text-danger">
                @error('emname')
                    {{ $message }}
                @enderror
              </span>
        </div>
        <div class="form-group col-md-6">
            <label for="emphn" class="col-form-label">Phone Number</label>
            <input type="text" class="form-control" id="emphn" name="emphn" placeholder="Enter phone number">
            <span class="text-danger">
                @error('emphn')
                    {{ $message }}
                @enderror
              </span>
        </div>
    </div>

        {{-- <button type="submit" class="btn btn-primary">ADD</button> --}}
        {{-- <button type="submit" class="btn btn-primary waves-effect waves-light btn-sm" id="sa-success-adduser">ADD</button> --}}
        <button type="submit" class="btn btn-primary waves-effect waves-light btn-sm">ADD</button>
        
    </div>
</div>  

</form>

            </div>
        </div>
<!-- end row -->

        </div> <!-- container -->

    </div> <!-- content -->

</div>





@endsection