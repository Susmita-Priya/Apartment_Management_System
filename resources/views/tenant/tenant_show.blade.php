@extends('master')


@push('title')
    <title>Profile</title>
@endpush

@section('content')
    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title float-left">Profile</h4>
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="{{ route('tenants.index') }}">Tenants</a></li>
                            <li class="breadcrumb-item active">Profile</li>
                        </ol>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="profile-bg-picture" style="background-image:url('{{ asset('image/tenant.webp') }}')">
                        <span class="picture-bg-overlay"></span><!-- overlay -->
                    </div>
                    <!-- meta -->
                    <div class="profile-user-box">
                        <div class="row">
                            <div class="col-sm-6">
                                <span class="pull-left m-r-15"><img src="{{ asset('image/person-man.jpg') }}" alt="" class="thumb-lg rounded-circle"></span>
                                <div class="media-body">
                                    <h4 class="m-t-5 m-b-5 font-18 ellipsis">{{ optional($tenant['contact-info'])->full_name ?? 'N/A' }}</h4>
                                    <p class="font-13"> {{ optional($tenant['personal-info'])->occupation ?? 'N/A' }}</p>
                                    <p class="text-muted m-b-0"><small>{{ optional($tenant['contact-info'])->address ?? 'N/A' }}</small></p>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="text-right">
                                    @can('tenant-edit')
                                    <a href="{{ route('tenant.create', ['id' => optional($tenant['contact-info'])->id, 'type' => 'contact-info']) }}" class="btn greenbtn ">
                                        <i class="mdi mdi-account-settings-variant m-r-5"></i>
                                        Edit Profile </a>
                                    @endcan
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/ meta -->
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <!-- Personal-Information -->
                    <div class="card-box ribbon-box">
                        <div class="ribbon ribbon-primary">Personal Information</div>
                        <h4 class="header-title mt-0 m-b-20"></h4>
                        <div class="panel-body">
                           
                            <div class="text-left">
                                <br>
                                <br>
                                <p class="text-muted font-13"><strong>Full Name :</strong> <span class="m-l-15">{{ ucfirst(optional($tenant['contact-info'])->full_name ?? 'N/A') }}</span></p>
                                
                                <p class="text-muted font-13"><strong>Father's Name :</strong> <span class="m-l-15">{{ optional($tenant['personal-info'])->fathers_name ?? 'N/A' }}</span></p>

                                <p class="text-muted font-13"><strong>Mother's Name :</strong> <span class="m-l-15">{{ optional($tenant['personal-info'])->mothers_name ?? 'N/A' }}</span></p>
                                
                                <p class="text-muted font-13"><strong>Mobile :</strong><span class="m-l-15">{{ optional($tenant['contact-info'])->phone ?? 'N/A' }}</span></p>

                                <p class="text-muted font-13"><strong>Email :</strong> <span class="m-l-15">{{ optional($tenant['contact-info'])->email ?? 'N/A' }}</span></p>

                                <p class="text-muted font-13"><strong>National Id :</strong> <span class="m-l-15">{{ optional($tenant['personal-info'])->nid ?? 'N/A' }}</span></p>

                                <p class="text-muted font-13"><strong>Tax Id:</strong> <span class="m-l-15">{{ optional($tenant['personal-info'])->tax_id ?? 'N/A' }}</span></p>

                                <p class="text-muted font-13"><strong>Passport No:</strong> <span class="m-l-15">{{ optional($tenant['personal-info'])->passport_no ?? 'N/A' }}</span></p>

                                <p class="text-muted font-13"><strong>Driving License:</strong> <span class="m-l-15">{{ optional($tenant['personal-info'])->driving_license ?? 'N/A' }}</span></p>

                                <p class="text-muted font-13"><strong>Religion:</strong> <span class="m-l-15">{{ optional($tenant['personal-info'])->religion ?? 'N/A' }}</span></p>

                                <p class="text-muted font-13"><strong>Marital Status:</strong> <span class="m-l-15">{{ optional($tenant['personal-info'])->marital_status ?? 'N/A' }}</span></p>

                                <p class="text-muted font-13"><strong>Gender:</strong> <span class="m-l-15">{{ optional($tenant['personal-info'])->gender ?? 'N/A' }}</span></p>
                                
                                <p class="text-muted font-13"><strong>Date Of Birth :</strong> <span class="m-l-15">{{ optional($tenant['personal-info'])->dob ?? 'N/A' }}</span></p>

                                <p class="text-muted font-13"><strong>Occupation :</strong> <span class="m-l-15">{{ optional($tenant['personal-info'])->occupation ?? 'N/A' }}</span></p>

                                <p class="text-muted font-13"><strong>Address :</strong> <span class="m-l-15">{{ optional($tenant['contact-info'])->address ?? 'N/A' }}</span></p>

                            </div>

                            {{-- <div class="text-right"> --}}

                        </div>
                    </div>


                    <div class="card-box ribbon-box">
                        <div class="ribbon ribbon-primary">Emergency Contact</div>
                        <h4 class="header-title mt-0 m-b-20"></h4>
                        <div class="panel-body">
                            <div class="text-left">
                                <br> <br>
                                
                                <p class="text-muted font-13"><strong>Full Name :</strong> <span class="m-l-15">{{ ucfirst(optional($tenant['emergency-contact'])->full_name ?? 'N/A') }}</span></p>

                                <p class="text-muted font-13"><strong>Relationship :</strong> <span class="m-l-15">{{ optional($tenant['emergency-contact'])->relationship ?? 'N/A' }}</span></p>
                                
                                <p class="text-muted font-13"><strong>Mobile :</strong><span class="m-l-15">{{ optional($tenant['emergency-contact'])->phone ?? 'N/A' }}</span></p>

                                <p class="text-muted font-13"><strong>Email :</strong> <span class="m-l-15">{{ optional($tenant['emergency-contact'])->email ?? 'N/A' }}</span></p>

                                <p class="text-muted font-13"><strong>Address :</strong> <span class="m-l-15">{{ optional($tenant['emergency-contact'])->address ?? 'N/A' }}</span></p>

                            </div>
                            
                        </div>
                    </div>

                    <div class="card-box ribbon-box">
                        <div class="ribbon ribbon-primary">Driver Information</div>
                        <h4 class="header-title mt-0 m-b-20"></h4>
                        <div class="panel-body">
                            <div class="text-left">
                                <br> <br>
                                
                                <p class="text-muted font-13"><strong>Full Name :</strong> <span class="m-l-15">{{ ucfirst(optional($tenant['driver-info'])->full_name ?? 'N/A') }}</span></p>

                                <p class="text-muted font-13"><strong>Mobile :</strong><span class="m-l-15">{{ optional($tenant['driver-info'])->phone ?? 'N/A' }}</span></p>

                                <p class="text-muted font-13"><strong>Email :</strong> <span class="m-l-15">{{ optional($tenant['driver-info'])->email ?? 'N/A' }}</span></p>

                                <p class="text-muted font-13"><strong>Driving License:</strong> <span class="m-l-15">{{ optional($tenant['driver-info'])->driving_license ?? 'N/A' }}</span></p>

                                <p class="text-muted font-13"><strong>Address :</strong> <span class="m-l-15">{{ optional($tenant['driver-info'])->address ?? 'N/A' }}</span></p>

                            </div>
                            
                        </div>
                    </div>
                </div>


            <!-- Units List -->
                @foreach ($units as $unit)
                        <div class="col-md-4 mb-4">
                            <div class="card-box">
                                <h4 class="header-title mt-0 m-b-20">UNIT-{{ $unit->unit_no }}
                                </h4>
                                <div class="panel-body">
                                    <p class="text-muted font-15"><strong>Type:
                                        </strong>{{ ucfirst($unit->type) }} Unit</p>
                                    @can('unit-view')
                                        <button type="button"
                                            onclick="window.location.href='{{ route('unit.show', $unit->id) }}'"
                                            class="btn btn-info m-t-20 btn-rounded btn-bordered waves-effect w-md waves-light btn-sm">
                                            Enter
                                        </button>
                                    @endcan
                                </div>
                            </div>
                        </div>
                @endforeach
            </div>
            </div>
@endsection
