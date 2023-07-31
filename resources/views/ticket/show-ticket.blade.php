@extends('layouts.app')
@section('content')
    <div class="pagetitle">
        <h1>Ticket</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">View Ticket</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-center">Tickets</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="m-2">
                                <select class="dropdown border rounded float-end ml-2" name="aa" id="aa">
                                    <option class="dropdown-item" selected>Assign To</option>
                                    <option class="dropdown-item" value="">AAA</option>
                                    <option class="dropdown-item" value="">DDD</option>
                                    <option class="dropdown-item" value="">CCC</option>
                                    <option class="dropdown-item" value="">WSWS</option>
                                    <option class="dropdown-item" value="">WWQQ</option>
                                </select>
                            </div>
                        </div>
                        <!-- Table with stripped rows -->
                        <div class="row table-responsive">
                            <table class="table table-striped table-bordered table-hover text-center mt-3 mb-3">
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
                                    <td> {{ $ticket->categories->name }} </td>
                                </tr>
                                <tr>
                                    <th scope="col">Created At</th>
                                    <td> {{ $ticket->created_at }} </td>
                                </tr>
                            </table>
                        </div>
                        <h3><b>Image:</b></h3>
                        <div class="d-flex justify-content-center">
                            <img src="/ticket_uploads/{{ $ticket->image }}" alt="Tickets" class="img-fluid img-thumbnail"
                                width="300" height="300">
                        </div>
                        <div class="row">
                            <div class="m-2">
                                <a href="{{ route('view-ticket') }}" class="float-start"><button
                                        class="btn btn-primary"><i class="fa-solid fa-arrow-left-long"></i></button></a>
                            </div>
                        </div>
                        <!-- End Table with stripped rows -->
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
