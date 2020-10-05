@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <form action="{{ route('role.update', ['role' => $role->id ]) }}" method="post">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-10">
                        <label for="name">Nombre</label>
                        <input type="text"
                               id="name"
                               name="name"
                               class="form-control"
                               value="{{ $role->name }}"
                               required
                        >
                    </div>
                </div>
                @foreach($permissions as $permission)
                    <div class="form-check">
                        <input type="checkbox"
                               name="permissions[]"
                               id="permissions"
                               class="form-check-input"
                               value="{{ $permission->name }}"
                               {{  $role->hasPermissionTo($permission->name) ? 'checked' : ''}}
                        >
                        <label for="permissions[]">{{ $permission->name }}</label>
                    </div>
                @endforeach

                <div class="form-row pt-3">
                    <div class="form-group">
                        <input type="submit" class="btn btn-success" value="Actualizar">
                    </div>
                </div>

            </form>
        </div>
    </div>
@endsection
