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
        <div class="container">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Create Ticket</h5>
                            <div class="card">
                                <div class="card-body border rounded">
                                    <form enctype="multipart/form-data" role="form" method="post"
                                        @if (isset($ticket)) action="{{ route('update-ticket', ['id' => $ticket->id]) }}"
                                        method="put"
                                    @else
                                        action="{{ route('store-ticket') }}" @endif>
                                        @csrf
                                        <div class="form-group mt-3 col-md-12 col-lg-8 col-sm-12">
                                            <label for="name" class="form-label">Ticket Name</label>
                                            <input type="text" class="form-control border-secondary rounded"
                                                name="name" id="name" placeholder="Name"
                                                value="{{ isset($ticket->name) ? $ticket->name : '' }}">
                                            @error('name')
                                                <div class="text-danger mt-2">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group mt-3 col-md-12 col-lg-8 col-sm-12">
                                            <label for="message" class="form-label">Your Message</label>
                                            <textarea name="message" id="message" class="form-control border-secondary rounded" placeholder="Enter Your Message"
                                                required>{{ isset($ticket->message) ? $ticket->message : 'Enter Your Message' }} </textarea>
                                            @error('message')
                                                <div class="text-danger mt-2">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group mt-3 col-md-12 col-lg-8 col-sm-12">
                                            <label for="label" class="form-label">Labels</label><br>
                                            @foreach ($labels as $label)
                                                <label for="{{ $label->name }}" class="ml-3">{{ $label->name }}</label>
                                                <input type="radio" class="form-control rounded" name="label"
                                                    id="{{ $label->name }}" value="{{ $label->id }}">
                                            @endforeach
                                            @error('label')
                                                <div class="text-danger mt-2">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group mt-3 col-md-12 col-lg-8 col-sm-12">
                                            <label for="category" class="form-label">Categories</label><br>
                                            @foreach ($categories as $category)
                                                <label for="{{ $category->name }}"
                                                    class="ml-3">{{ $category->name }}</label>
                                                <input type="radio" class="form-control rounded" name="category"
                                                    id="{{ $category->name }}" value="{{ $category->id }}">
                                            @endforeach
                                            @error('category')
                                                <div class="text-danger mt-2">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        @if ($users[0] != '3')
                                            <div class="form-group mt-3 col-md-12 col-lg-8 col-sm-12">
                                                <label for="priority" class="form-label">Priority</label>
                                                <select name="priority" class="custom-select form-control border-secondary">
                                                    <option value="high">High</option>
                                                    <option selected value="medium">Medium</option>
                                                    <option value="low">Low</option>
                                                </select>
                                            </div>
                                        @endif

                                        <div class="form-group mt-3 col-md-12 col-lg-8 col-sm-12">
                                            <label for="label" class="form-label">Attach Files</label><br>
                                            <input type="file" name="image" id="image"
                                                class="form-control-file border rounded border-secondary w-100 p-1"
                                                accept=".jpg , .png , .jpeg" multiple>
                                            @error('image')
                                                <div class="text-danger mt-2">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="mt-3">
                                            <button
                                                class="'inline-flex items-center px-4 py-2 bg-gray-800  border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-gray-700 focus:bg-gray-700 dark:focus:bg-gray-400 active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150'"
                                                type="submit">
                                                Create
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
