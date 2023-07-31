@extends('layouts.app')

@section('content')

    <div class="pagetitle">
        <h1>Agents</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">New Agent</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Register Agent</h5>

                            <div class="form ">
                                <form action="new-agent" method="post" role="form">
                                    @csrf
                                    <input type="hidden" name="role_id" value="2">
                                    <div class="form-group mt-3 col-6">
                                        <input type="text" class="form-control rounded" name="name" id="name"
                                            placeholder="Name" required>
                                    </div>
                                    <div class="form-group mt-3 col-6">
                                        <input type="email" class="form-control rounded" name="email" id="email"
                                            placeholder="Email" required>
                                    </div>

                                    <div class="form-group mt-3 col-6">
                                        <input type="password" class="form-control rounded" name="password" id="password"
                                            placeholder="Password" required>
                                    </div>

                                    {{-- <div class="form-group mt-3 col-6">
                                        <select name="user_role" id="user_role" class="rounded" required>
                                            <option selected value="">Select Role</option>
                                            <option value="agent">Agent</option>
                                        </select>
                                    </div> --}}

                                    <div class="mt-3"><button class="'inline-flex items-center px-4 py-2 bg-gray-800  border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-gray-700 focus:bg-gray-700 dark:focus:bg-gray-400 active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150'" type="submit">Register</button></div>
                                </form>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
