@extends('layouts.app')

@section('content')
    <div class="pagetitle">
        <h1>Label</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">Add Label</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Add Label</h5>
                        <p>Add Label here.</p>
                        {{-- @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif --}}
                        <div class="form ">
                            <form method="POST"
                                @if (isset($label)) action="{{ route('admin.update-label', ['id' => $label->id]) }}"
                                @else
                                action="{{ route('admin.store-label') }}" @endif>
                                @if (isset($label))
                                    @method('put')
                                @endif
                                @csrf
                                <div class="form-group mt-3 col-6">
                                    <input type="text" class="form-control rounded border-dark" name="name"
                                        id="name" placeholder="Enter Label Name"
                                        value="{{ isset($label->name) ? $label->name : '' }}">
                                    @error('name')
                                        <div class="text-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group mt-3 col-6">
                                    <textarea class="form-control rounded border-dark" name="description" id="description" cols="30" rows=""
                                        placeholder="Enter Description Here">{{ isset($label->description) ? $label->description : '' }}</textarea>
                                    @error('description')
                                        <div class="text-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mt-3">
                                    <button
                                        class="'inline-flex items-center px-4 py-2 bg-gray-800  border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-gray-700 focus:bg-gray-700 dark:focus:bg-gray-400 active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150'"
                                        type="submit">Create</button>
                                    {{-- <button class="btn border-primary" type="reset">Reset</button> --}}
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
