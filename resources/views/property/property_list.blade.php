@extends('master')

@push('title')
    <title>Users</title>
@endpush

@section('content')


<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title float-left">Properties</h4>

                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="#">Adminox</a></li>
                            <li class="breadcrumb-item"><a href="#">Real Estate</a></li>
                            <li class="breadcrumb-item active">Properties</li>
                        </ol>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row">
                <div class="col-sm-4">
                    <a href="{{ route('building.create') }}" class="btn waves-effect waves-light btn-sm" 
                           style="background-color: rgb(100, 197, 177); border-color: rgb(100, 197, 177); color: white; 
                                  position: absolute; right: 10px; top: 50%; transform: translateY(-50%);  text-decoration: none;" ><i class="md md-add"></i> Add Property</a>
                </div><!-- end col -->
                <div class="col-sm-8">
                    <div class="text-right">
                        <ul class="pagination pagination-split mt-0 pull-right">
                            <li class="page-item">
                                <a class="page-link" href="#" aria-label="Previous">
                                    <span aria-hidden="true">«</span>
                                    <span class="sr-only">Previous</span>
                                </a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item active"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">4</a></li>
                            <li class="page-item"><a class="page-link" href="#">5</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#" aria-label="Next">
                                    <span aria-hidden="true">»</span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row">
                <!-- Example of a Property Item -->
                <div class="col-md-4">
                    <div class="card-box">
                        <div class="member-card-alt">
                            <div class="thumb-xl member-thumb m-b-10 pull-left">
                                <img src="assets/images/properties/property-1.jpg" class="img-thumbnail" alt="Property image">
                            </div>

                            <div class="member-card-alt-info">
                                <h4 class="m-b-5 m-t-0 font-18">Luxury Villa</h4>
                                <p class="text-muted">Located in Beverly Hills</p>
                                <p class="text-muted font-13">
                                    A beautiful villa with 4 bedrooms, 3 bathrooms, and a swimming pool.
                                </p>

                                <ul class="social-links list-inline m-t-20">
                                    <li class="list-inline-item">
                                        <a title="View Property" data-placement="top" data-toggle="tooltip" class="tooltips" href="#"><i class="fa fa-eye"></i></a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a title="Edit Property" data-placement="top" data-toggle="tooltip" class="tooltips" href="#"><i class="fa fa-pencil"></i></a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a title="Delete Property" data-placement="top" data-toggle="tooltip" class="tooltips" href="#" class="text-danger"><i class="fa fa-trash"></i></a>
                                    </li>
                                </ul>

                                <button type="button" class="btn btn-primary btn-sm m-t-15 waves-effect waves-light"> Edit </button>
                                <button type="button" class="btn btn-link text-danger btn-sm m-t-15 waves-effect waves-light"> Delete </button>
                            </div>

                        </div>

                    </div>

                </div> <!-- end col -->
                
                <!-- Add more properties similarly -->
            </div>
            <!-- end row -->

        </div> <!-- container -->
    </div> <!-- content -->
</div> <!-- content-page -->


@endsection