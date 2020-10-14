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
