@extends('layouts.app')

@section('content')
    <div class="pagetitle">
        <h1>Permission</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">View Permission </li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-header">
                        <h3 class="text-center">Permission </h3>
                    </div>
                    <div class="card-body">
                        <!-- Table with stripped rows -->
                        <div class="table-responsive mt-3">
                            <div id="responseToAJAX"></div>
                            <table class="table table-striped table-bordered table-hover text-center">
                                <thead>
                                    <tr>
                                        <th scope="col">Sr. #</th>
                                        <th scope="col">Permissions</th>
                                        @foreach ($roles as $role)
                                            <th scope="col" class="text-uppercase">{{ $role->name }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($permissions as $key => $permission)
                                        <tr>
                                            <th>{{ $key + 1 }}</th>
                                            <td>{{ $permission->name }}</td>
                                            @foreach ($roles as $key => $role)
                                                <td class="text-capitalize">
                                                    <input type="checkbox" class="form-control rounded"
                                                        name="permission_role"
                                                        @php
                                                            $getPermission = getRoleChecked($role); @endphp
                                                        @if (in_array($permission->id, $getPermission))
                                                            @checked(true) @endif
                                                        id="check_permission_{{ $role->id }}_{{ $permission->id }}"
                                                        onchange="assignRolesToPermission({{ $role->id }} , {{ $permission->id }})">
                                                </td>
                                            @endforeach
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

@section('scripts')
    <script>
        function assignRolesToPermission(role_id, permission_id) {
            // console.log($('#check_permission_' + role_id + '_' + permission_id).is(':checked'));
            var check_permission = $('#check_permission_' + role_id + '_' + permission_id).is(':checked');
            $.ajax({
                url: "{{ route('admin.update-permission') }}",
                type: "POST",
                data: {
                    'role_id': role_id,
                    'permission_id': permission_id,
                    'check_permission': check_permission,
                    '_token': "{{ csrf_token() }}"
                },
                success: function(result) {
                    $('#responseToAJAX').html(result);
                }
            });
        }
    </script>
@endsection
