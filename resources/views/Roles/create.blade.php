@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row mt-3">
            <div class="card col-md-12 px-0">
                <div class="card-header bg-info text-white">
                    Crear Role
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form action="{{ route('roles.store') }}" method="post">
                            @csrf
                            <div class="form-row mt-3">
                                <div class="form-group col-md-6">
                                    <label for="name">Nombre</label>
                                    <input type="text"
                                           id="name"
                                           name="name"
                                           class="form-control"
                                           value="{{ old('name') }}"
                                    >
                                </div>
                            </div>
                            <div class="form-row">
                                @include('Roles/partials/groupedPermissions')
                            </div>
                            <div class="form-group">
                                <div class="form-group">
                                    <input type="submit" class="btn btn-primary" value="Crear">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
