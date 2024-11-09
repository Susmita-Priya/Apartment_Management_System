@extends('master')

@push('title')
    <title>Agreement</title>
@endpush

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title float-left">Lease</h4>

                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="{{ route('index') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Agreement</li>
                        </ol>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row">
                <div class="col-12">
                    <div class="card-box">           
                        <h4 class="header-title m-b-15 m-t-0">Agreement</h4>
                        {{-- <div class="row">
                            <div class="col-sm-12">
                                <div class="text-right m-b-20">
                                    <button type="button" class="btn waves-effect waves-light greenbtn"
                                        onclick="window.location.href='{{ route('tenants.create') }}'">
                                        <i class="mdi mdi-plus m-r-5"></i> Add Tenant
                                    </button>
                                </div>
                            </div>
                        </div> --}}

                        <div class="agreement-container">
                            <h1>Tenant Agreement</h1>
                            <h2>For {{ $tenant->name }}</h2>
                    
                            <div class="agreement-details">
                                <p><strong>Tenant Name:</strong> {{ $tenant->name }}</p>
                                <p><strong>Contact Number:</strong> {{ $tenant->phone }}</p>
                                <p><strong>Email:</strong> {{ $tenant->email }}</p>
                                <p><strong>National ID:</strong> {{ $tenant->nid }}</p>
                                <p><strong>Address:</strong> {{ $tenant->per_address }}</p>
                                {{-- <p><strong>Lease Start Date:</strong> {{ $leaseRequests->start_date }}</p> --}}
                               {{-- <p><strong>Lease End Date:</strong> {{ $lease_end_date }}</p>
                                <p><strong>Monthly Rent:</strong> {{ $unit->rent }}TK</p> --}}
                    
                                <hr>
                   
                                <h3>Terms and Conditions</h3>
                                <p>1. The tenant agrees to pay the rent by the first of every month.</p>
                                <p>2. The tenant is responsible for any damages to the unit beyond normal wear and tear.</p>
                                <p>3. Subletting the unit is prohibited without prior written consent from the landlord.</p>
                                <p>4. Notice of at least 30 days must be given before vacating the unit.</p>
                                <p>5. This agreement is subject to the laws of the applicable jurisdiction.</p>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="acceptConditionsCheckbox">
                                    <label class="form-check-label" for="acceptConditionsCheckbox">Accept All Conditions</label>
                                </div>
                            </div>
                        </div>
                    
                        <div class="button-group">
                            <button class="btn-print" onclick="printAndShowModal()">Print Agreement</button>
                            {{-- <button class="btn-download" onclick="window.location.href='{{ route('agreement.download', ['tenantId' => $tenant->id]) }}'">Download Agreement</button> --}}


                            <!-- Modal Trigger -->
                            <button type="button" class="btn-send" data-toggle="modal" data-target="#sendAgreementModal" style="display:none;" id="sendAgreementButton">Send Agreement</button>

                            <!-- Modal -->
                            <div class="modal fade" id="sendAgreementModal" tabindex="-1" role="dialog" aria-labelledby="sendAgreementModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="sendAgreementModalLabel">Send Agreement</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('agreement.form', ['id' => $tenant->id]) }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="file">File</label>
                                                    <input type="file" class="form-control" id="file" name="file">
                                                </div>
                                                <button type="submit" class="btn btn-primary">Send</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
   
    <script>
        document.getElementById('acceptConditionsCheckbox').addEventListener('change', function() {
            if (this.checked) {
                alert('All conditions have been accepted.');
                // Additional logic for accepting conditions can be added here
            }
        });

        function printAndShowModal() {
            window.print();
            setTimeout(function() {
                document.getElementById('sendAgreementButton').click();
            }, 1000); // Adjust the timeout as needed
        }
    </script>
@endsection
