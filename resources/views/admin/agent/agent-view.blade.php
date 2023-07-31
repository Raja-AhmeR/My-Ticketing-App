@extends('layouts.app')

@section('content')
    <div class="pagetitle">
        <h1>Agent</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">View Agent</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-header">
                        <h3 class="text-center">Agents</h3>
                    </div>
                    <div class="card-body">
                        <!-- Table with stripped rows -->
                        <div class="table-responsive">
                            <div class="m-1 float-end">
                                <a href="{{ route('admin.create-agent') }}"><button class="btn btn-primary btn-sm"><i class="fa-solid fa-plus" aria-hidden="true"></i>&nbsp;Add</button></a>
                            </div>
                            <table class="table table-striped table-bordered table-hover text-center">
                                <thead>
                                    <tr>
                                        <th scope="col">Sr. #</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $key => $user)
                                        <tr>
                                            <th scope="row">{{ $key + 1 }}</th>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                <a href=""><button class="btn btn-warning btn-sm"><i class="fa fa-solid fa-edit"></i></button></a>
                                                <a href="{{ route('admin.delete-agent', ['id' => $user->id]) }}"><button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete?')"><i class="fa fa-solid fa-trash" aria-hidden="true"></i></button></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- End Table with stripped rows -->

                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
