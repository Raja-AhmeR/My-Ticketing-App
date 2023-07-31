@extends('layouts.app')

@section('content')
    @if ($users[0] == '1')
        <div class="pagetitle">
            <h1>Logs</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Ticket Logs</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-header">
                            <h3 class="text-center">Tickets Logs</h3>
                        </div>
                        <div class="card-body">
                            <!-- Table with stripped rows -->
                            <div class="row">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover text-center">
                                        <!-- class="datatable" -->
                                        <thead>
                                            <tr>
                                                <th scope="col">Sr. #</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Image</th>
                                                <th scope="col">Assigned To</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($tickets as $key => $ticket)
                                            {{-- {{dd($ticket->assigned_to != null)}} --}}
                                                @if ($ticket->assigned_to != null)
                                                    <tr>
                                                        <th>{{ $key + 1 }}</th>
                                                        <td>{{ $ticket->name }}</td>
                                                        </td>
                                                        <td class="d-flex justify-content-center">
                                                            <img src="/ticket_uploads/{{ $ticket->image }}"
                                                                style="width:70px; height:40px; object-fit:cover" alt="Tickets"
                                                                class="rounded img-fluid img-thumbnail">
                                                        </td>
                                                        <td>{{ $ticket->assignedToAgent->name }}</td>
                                                        <td>
                                                            <button class="btn btn-primary btn-sm" data-toggle="modal"
                                                                data-target="#ticketModal_{{ $ticket->id }}">
                                                                <i class="fa-solid fa-circle-info"></i>
                                                            </button>

                                                            <div class="modal fade" id="ticketModal_{{ $ticket->id }}">
                                                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                                                    <div class="modal-content ">

                                                                        <!-- Modal Header -->
                                                                        <div class="modal-header">
                                                                            <h2 class="modal-title text-center">Ticket
                                                                                Information
                                                                            </h2>
                                                                            <button type="button" class="close"
                                                                                data-dismiss="modal">&times;</button>
                                                                        </div>

                                                                        <!-- Modal body -->
                                                                        <div class="modal-body">
                                                                            <div class="row table-responsive m-1">
                                                                                <table
                                                                                    class="table table-striped table-bordered table-hover text-center">
                                                                                    <tr>
                                                                                        <th scope="col">Name</th>
                                                                                        <td>{{ $ticket->name }}</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th scope="col">Message</th>
                                                                                        <td> {{ $ticket->message }} </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th scope="col">Label</th>
                                                                                        <td> {{ $ticket->labels->name }} </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th scope="col">Category</th>
                                                                                        <td> {{ $ticket->categories->name }}
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th scope="col">Assigned To</th>
                                                                                        <td> {{ $ticket->assignedToAgent->name }}
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th scope="col">Priority</th>
                                                                                        <td class="text-capitalize"> {{ $ticket->priority }}
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th scope="col" style="width: 30%">
                                                                                            Created At</th>
                                                                                        <td> {{ $ticket->created_at }} </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th scope="col" style="width: 30%">
                                                                                            Updated At</th>
                                                                                        <td> {{ $ticket->updated_at }} </td>
                                                                                    </tr>
                                                                                </table>
                                                                            </div>
                                                                            {{-- <div class="display-4 mb-4">Image</div> --}}
                                                                            <div class="d-flex justify-content-center">
                                                                                <img src="/ticket_uploads/{{ $ticket->image }}"
                                                                                    alt="Tickets"
                                                                                    class="img-fluid img-thumbnail">
                                                                            </div>
                                                                        </div>

                                                                        <!-- Modal footer -->
                                                                        <div class="modal-footer">
                                                                            <button class="btn btn-danger btn-sm"
                                                                                data-dismiss="modal">Close</button>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Table with stripped rows -->
                </div>
            </div>
        </section>
    @endif

@endsection
