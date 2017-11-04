@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                @include('layouts.menu')
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Orders</div>

                    <div class="panel-body">
                        <div class="table-responsive">
                            <table id="templates_table" class="table table-bordred table-striped">
                                <thead>
                                <th style="width: 5%;">ID</th>
                                <th style="width: 30%;">User</th>
                                <th style="width: 10%;">Table</th>
                                <th style="width: 10%;">Status</th>
                                <th style="width: 20%;">Edit</th>
                                </thead>
                                <tbody>
                                @foreach ($data as $order)
                                    <tr>
                                        <td>{{$order->id}}</td>
                                        <td>{{$order->user_name}}</td>
                                        <td>{{$order->table_number}}</td>
                                        <td>{{$order->status}}</td>
                                        <td>
                                            @if($order->status == "active")
                                                <a class="btn btn-xs btn-info"
                                                   href="{{route('orders.edit', $order->id)}}">Edit</a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
