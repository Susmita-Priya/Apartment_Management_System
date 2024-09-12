@extends('master')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box text-capitalize">
                        <h4 class="page-title float-left">{{ $page_title }}</h4>

                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="#">Admin</a></li>
                            <li class="breadcrumb-item"><a href="#">{{ $page_title }}</a></li>
                            <li class="breadcrumb-item active">{{ $page_title }} list</li>
                        </ol>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <a href="#" class="btn btn-primary rounded" id="click_print">
                        <i class="fa fa-print"></i>
                        Print
                    </a>
                </div>
                <div class="col-12">
                    <div class="card-box" id="print_body">

                        <style>
                            th{
                                text-transform: capitalize;
                                width:80px;
                                white-space: nowrap;
                            }
                        </style>

                        @if (!empty($tenant))
                            <div>
                                <div>
                                    <div class="text-center">
                                        <h4>Byte Care Limited</h4>
                                        <p>Makka tower(7th floor), kakrail, dhaka, bangladesh</p>
                                        <h5 class=" text-capitalize">{{ $page_title }}</h5>
                                    </div>
                                   
                                </div>
                            </div>

                            <div class="mt-4">
                                <table class="table m-0 tickets-list table-actions-bar dt-responsive nowrap table-bordered"
                                    cellspacing="0" width="100%">
                                        <tr>
                                            <th>name</th>
                                            <td>{{ $tenant->r_name ?? '' }}</td>

                                            <th>father's name</th>
                                            <td>{{ $tenant->father ?? '' }}</td>

                                            <th>Total family member</th>
                                            <td>{{ $tenant->total_family_member ?? '' }}</td>
                                         
                                        </tr>
                                        <tr>
                                            <th>birthday</th>
                                            <td>{{ $tenant->birthday ?? '' }}</td>

                                            <th>marital_status</th>
                                            <td>{{ $tenant->marital_status ?? '' }}</td>

                                            <th>r_phone</th>
                                            <td>{{ $tenant->r_phone ?? '' }}</td>
                                         
                                        </tr>
                                        <tr>
                                            <th>r_email</th>
                                            <td>{{ $tenant->r_email ?? '' }}</td>

                                            <th>per_address</th>
                                            <td>{{ $tenant->per_address ?? '' }}</td>

                                            <th>occupation</th>
                                            <td>{{ $tenant->occupation ?? '' }}</td>
                                         
                                        </tr>
                                        <tr>
                                            <th>company</th>
                                            <td>{{ $tenant->company ?? '' }}</td>

                                            <th>religion</th>
                                            <td>{{ $tenant->religion ?? '' }}</td>

                                            <th>qualification</th>
                                            <td>{{ $tenant->qualification ?? '' }}</td>
                                        </tr>
                                        <tr>
                                            <th>r_nid</th> 
                                            <td>{{ $tenant->r_nid ?? '' }}</td>

                                            <th>religion</th>
                                            <td>{{ $tenant->religion ?? '' }}</td>

                                            <th>qualification</th>
                                            <td>{{ $tenant->qualification ?? '' }}</td>
                                        </tr>
                                    
                                </table>
                            </div>

                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@push('js')
    @include('payroll.print_js_code')

    <script type="text/javascript">
        $('#click_print').click(function() {
            $('#print_body').printThis();
        });
    </script>

@endpush
