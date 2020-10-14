<div class="row mt-2">
    <div class="card col-md-12 px-0">
        <div class="card-header bg-info text-white">
            Usuarios Asociados A Role {{ $role->name }}
        </div>
        <div class="card-content">
            <div class="card-body mt-2">
                <table class="table table-striped table-bordered">
                    <thead>
                    <tr class="bg-info text-white">
                        <th>Usuario</th>
                        <th>Nombre</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($usersWithRole as $user)
                        <tr>
                            <td>
                                <a href="{{ route('UserEdit', ['id'=> $user->id]) }}">
                                    {{ $user->name }}
                                </a>
                            </td>
                            <td>{{ $user->username }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
