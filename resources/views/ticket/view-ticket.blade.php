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
                        <!-- Table with stripped rows -->
                        @if ($users[0] != '2')
                            <div class="row">
                                <div class="m-2">
                                    <a href="{{ route('create-ticket') }}" class="float-end"><button
                                            class="btn btn-sm btn-primary"><i class="fa-solid fa-plus"
                                                aria-hidden="true"></i>&nbsp;Create</button></a>
                                </div>
                            </div>
                        @endif
                        <div class="row">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover text-center">
                                    <!-- class="datatable" -->
                                    <thead>
                                        <tr>
                                            <th scope="col">Sr. #</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Image</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($tickets as $key => $ticket)
                                    {{-- {{dd(is_null($ticket->assigned_to))}}
                                        @if ($users[0] == '2' && $ticket->assigned_to == 'null')
                                            {!! $message !!}
                                        @endif --}}
                                            <tr>
                                                <th>{{ $key + 1 }}</th>
                                                <td>{{ $ticket->name }}</td>
                                                </td>
                                                <td class="d-flex justify-content-center">
                                                    <img src="/ticket_uploads/{{ $ticket->image }}"
                                                        style="width:70px; height:40px; object-fit:cover" alt="Tickets"
                                                        class="rounded img-fluid img-thumbnail">
                                                </td>

                                                <td>
                                                    @if ($users[0] == '1' || $users[0] == '2')
                                                        <a href="{{ route('edit-ticket', ['id' => $ticket->id]) }}"><button
                                                                class="btn btn-warning btn-sm"><i
                                                                    class="fa fa-solid fa-edit"></i></button></a>
                                                    @endif
                                                    @if ($users[0] == '1')
                                                        <a href="{{ route('delete-ticket', ['id' => $ticket->id]) }}"><button
                                                                class="btn btn-danger btn-sm"
                                                                onclick="return confirm('Are you sure you want to delete?')"><i
                                                                    class="fa fa-solid fa-trash"
                                                                    aria-hidden="true"></i></button></a>
                                                    @endif
                                                    <button class="btn btn-primary btn-sm" data-toggle="modal"
                                                        data-target="#ticketModal_{{ $ticket->id }}">
                                                        <i class="fa-solid fa-circle-info"></i>
                                                    </button>

                                                    <div class="modal fade" id="ticketModal_{{ $ticket->id }}">
                                                        <div class="modal-dialog modal-dialog-centered modal-lg">
                                                            <div class="modal-content ">

                                                                <!-- Modal Header -->
                                                                <div class="modal-header">
                                                                    <h2 class="modal-title text-center">Ticket Information
                                                                    </h2>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal">&times;</button>
                                                                </div>

                                                                <!-- Modal body -->
                                                                <div class="modal-body">
                                                                    <div class="AJAX_message_{{$ticket->id}}"></div>
                                                                    <div class="row">
                                                                        @if ($users[0] == '1')
                                                                            <div class="mr-3">
                                                                                <select id="assignToAgent_{{$ticket->id}}"
                                                                                    onchange="assignTo({{$ticket->id}})"
                                                                                    class="dropdown border rounded float-end myAgent_{{$ticket->id}}">
                                                                                    <option class="dropdown-item" selected value="Assign To">
                                                                                        Assign To</option>
                                                                                    @foreach ($agents as $agent)
                                                                                        <option class="dropdown-item"
                                                                                            {{-- name="assignToAgent" --}}
                                                                                            {{-- id="assignToAgentb_{{$agent->id}}" --}}
                                                                                            value="{{ $agent->id }}"
                                                                                            {{-- onclick="assignTo({{$agent->id}})" --}}
                                                                                            >
                                                                                            {{ $agent->name }}
                                                                                        </option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                        @endif
                                                                    </div>
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
                                                                                <td> {{ $ticket->categories->name }} </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="col" style="width: 30%">
                                                                                    Created At</th>
                                                                                <td> {{ $ticket->created_at }} </td>
                                                                            </tr>
                                                                        </table>
                                                                    </div>
                                                                    {{-- <div class="display-4 mb-4">Image</div> --}}
                                                                    <div class="d-flex justify-content-center">
                                                                        <img src="/ticket_uploads/{{ $ticket->image }}"
                                                                            alt="Tickets" class="img-fluid img-thumbnail">
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


@endsection


@section('scripts')
<script>
    // console.log(assignToAgent());

    const assignTo = (ticketId) => {   // Get Ticket Id and Use it to extract agent id from dropdown list
        // console.log(agent);
        // $('.myagent').val();
        var getAgent = $(`.myAgent_${ticketId}`).val(); // Getting agent id
        // console.log(getAgent);
        $.ajax({
            url: '{{ route("assign-to-agent") }}',
            method: 'POST',
            data: {
                '_token': "{{ csrf_token() }}",
                'ticketId': ticketId,
                'getAgent': getAgent
            },
            success: function (result) {
                $(`.AJAX_message_${result[0]}`).html(result[1]); // Getting data from controller and seprate it accordingly
            }
        });
    }
</script>
@endsection
