@extends('layouts.app')
@section('content')
    <div class="container">
        @can('crear roles')
            <div class="row">
                <div class="my-3 ">
                    <a href="{{ route('role.create') }}" class="btn btn-success">Crear Role</a>
                </div>
            </div>
        @endcan

        <section id="basic-datatable">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        Roles
                    </h4>
                </div>
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <table class="table table-striped table-responsive table-bordered complex-headers dataTable">
                            <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Permisos</th>
                                <th colspan="2">Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($nRoles as $role)
                                <tr>
                                    <td>
                                        {{ ucfirst($role->name) }}
                                    </td>
                                    <td>
                                        {{ implode(", ", $role->permissionsText->pluck('text')->toArray()) }}
                                    </td>
                                    <td>
                                        @can('editar roles')
                                            <a href="{{ route('role.edit', ['role' => $role->id]) }}"
                                               class="btn btn-info">Editar</a>
                                        @endcan
                                    </td>
                                    <td>
                                        @can('eliminar roles')
                                            <form action="{{route('role.destroy', ['role' => $role->id])}}"
                                                  method="post">
                                                @csrf
                                                <input type="submit" class="btn btn-danger" value="Eliminar">
                                            </form>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
