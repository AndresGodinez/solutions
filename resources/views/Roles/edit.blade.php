@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="card">
                <div class="card-header bg-info text-white">
                    Permisos Asociados A Role {{ $role->name }}
                </div>
                <div class="card-content">
                    <div class="card-body pt-2">
                        <table class="table table-striped table-bordered">
                            <thead>
                            <tr class="bg-info text-white">
                                <th>Id</th>
                                <th>Nombre</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($rolePermissions))
                                @foreach($rolePermissions as $permission)
                                    <tr>
                                        <td>{{ $permission->id }}</td>
                                        <td>{{ $permission->name }}</td>
                                    </tr>
                                @endforeach
                            @endif

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="card col-md-12 px-0">
                <div class="card-header bg-info text-white">
                    Actuzalizar Permisos Asociados A Role {{ $role->name }}
                </div>
                <div class="card-content">
                    @include('Roles.partials.groupedEditPermissions')
                </div>
            </div>
        </div>

    </div>

@endsection
