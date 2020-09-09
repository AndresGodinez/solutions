@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Lista de Solicitudes</h4>
                </div>
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>No. parte</th>
                                <th>Descripción</th>
                                <th>Status</th>
                                <th>Ing</th>
                                <th>Mat</th>
                                <th>Ven</th>
                                <th>Días</th>
                                <th>Solicitante</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($get_records as $get_records)
                                <tr>
                                    <td>{{ $get_records->id }}</td>
                                    <td>
                                        <a href="{{	url('sustitutos/detalle/'.$get_records->id) }}">
                                            {{ $get_records->np }} - <strong>{{ $get_records->np_sust }}</strong>
                                        </a>
                                    </td>
                                    <td>{{ $get_records->np_sust_descr }}</td>
                                    <td>{{ $get_records->status }}</td>
                                    <td>
                                        @if($get_records->depto_ing == 0)
                                            <box-icon name='x-circle' type='solid' color='#cb2146' ></box-icon>
                                        @else
                                            <box-icon name='check-circle' type='solid' color='#9ebf88' ></box-icon>
                                        @endif
                                    </td>
                                    <td>
                                        @if($get_records->depto_mat == 0)
                                            <box-icon name='x-circle' type='solid' color='#cb2146' ></box-icon>
                                        @else
                                            <box-icon name='check-circle' type='solid' color='#9ebf88' ></box-icon>
                                        @endif
                                    </td>
                                    <td>
                                        @if($get_records->depto_ven == 0)
                                            <box-icon name='x-circle' type='solid' color='#cb2146' ></box-icon>
                                        @else
                                            <box-icon name='check-circle' type='solid' color='#9ebf88' ></box-icon>
                                        @endif
                                    </td>
                                    <td>
                                        <?php
                                        $date_one = new DateTime($get_records->created_at);
                                        $date_two = new DateTime(date("Y-m-d H:i:s"));
                                        $diff = $date_one->diff($date_two);
                                        echo $diff->days;
                                        ?>
                                    </td>
                                    <td>{{ $get_records->usr_request }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/boxicons@latest/dist/boxicons.js"></script>
@endsection
