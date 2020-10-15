<div class="card-body">
    <form action="{{ route('role.update', [ 'role' => $role->id ]) }}" method="post">
        @csrf
        <div class="form-row">
            <div class="form-group">
                <label for="name">Nombre de role</label>
                <input type="text"
                       id="name"
                       name="name"
                       class="form-control"
                       value="{{ $role->name }}"
                >
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-12">
                @foreach($groupedPermissions as $permission)
                    <div class="card mt-3 col-md-6 px-0">
                        <div class="card-header bg-info text-white">
                            <div class="card-title">
                                {{ $permission->name }}
                            </div>
                        </div>
                        @if(!is_null($permission->subItems))
                            <div class="card-content">
                                <div class="card-body">
                                    @foreach($permission->subItems as $item)
                                        <div class="form-check">
                                            <input name="permissions[]"
                                                   class="form-check-input"
                                                   type="checkbox"
                                                   value="{{$item->name}}"
                                                {{ $role->hasPermissionTo($item->name) ? 'checked' : '' }}
                                            >
                                            <label class="form-check-label">
                                                {{$item->name}}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
        <div class="form-group">
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Actualizar">
            </div>
        </div>

    </form>
</div>
