@extends('master')

@section('content')
    @push('title')
        <title>Assign Vehicle and Parker</title>
    @endpush
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title float-left">Unit No: UNIT-{{ $unit->unit_no }}</h4>
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="{{ route('index') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active"><a href="{{ route('unit.index') }}">unit list</a></li>
                            <li class="breadcrumb-item active">Assign</li>
                        </ol>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card-box">
                        {{-- <h4 class="header-title">Unit No: UNIT-{{ $unit->unit_no }}</h4> --}}

                        <h2>Assign Landlord</h2>
                        <form method="POST" action="{{ route('assign.store', $unit->id) }}">
                            @csrf
                            {{-- unit id --}}
                            <input type="hidden" name="unit_id" value="{{ $unit->id }}">

                            <div class="form-group">
                                <label for="landlord">Select Landlord</label>
                                <select class="form-control" id="landlord" name="landlord_id">
                                    <option value="">Select Landlord</option>
                                    @foreach ($landlords as $landlord)
                                        <option value="{{ $landlord->id }}">{{ $landlord->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn submitbtn">Assign</button>
                        </form>

                        <h5 class="mt-5">Assigned Landlords</h5>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Landlord Name</th>
                                    <th>Landlord Email</th>
                                    <th>Landlord Phone</th>
                                    <th>Landlord Image</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($assignments->isEmpty())
                                    <tr>
                                        <td colspan="5" class="text-center">No Landlord Assigned</td>
                                    </tr>
                                @else
                                    @foreach ($assignments as $assignment)
                                        <tr>
                                            <td>{{ $assignment->landlord->name ?? 'N/A' }}</td>
                                            <td>{{ $assignment->landlord->email ?? 'N/A' }}</td>
                                            <td>{{ $assignment->landlord->phone ?? 'N/A' }}</td>
                                            <td>
                                                @if ($assignment->landlord && $assignment->landlord->image)
                                                    <img src="{{ asset($assignment->landlord->image) }}"
                                                        alt="Landlord Image" width="50">
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                            <td>
                                                {{-- <button type="button" class="btn btn-info" data-toggle="modal" data-target="#landlordModal{{ $assignment->landlord->id }}">
                                                Show Info
                                                </button> --}}
                                                <a class="dropdown-item" href="#"
                                                    onclick="confirmDelete('{{ route('landlord.remove', $assignment->id) }}')"><i
                                                        class="mdi mdi-delete m-r-10 text-muted font-18 vertical-middle"></i>
                                                    Delete
                                                </a>
                                                <!-- Hidden form for deletion -->
                                                <form id="delete-form"
                                                    action="{{ route('landlord.remove', $assignment->id) }}" method="GET"
                                                    style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
