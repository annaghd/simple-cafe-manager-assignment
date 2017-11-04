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
                    <div class="panel-heading">User Tables
                        @if($roles["is_manager"])
                            <a class="btn btn-info btn-xs pull-right"
                               href="{{route('assign.create')}}">Add new</a>
                        @endif
                    </div>

                    <div class="panel-body">
                        <div class="table-responsive">
                            <table id="templates_table" class="table table-bordred table-striped">
                                <thead>
                                <th style="width: 5%;">ID</th>
                                <th style="width: 30%;">User</th>
                                <th style="width: 30%;">Table</th>
                                <th style="width: 20%;">Status</th>
                                @if( $roles["is_manager"])
                                    <th style="width: 30%;">Edit</th>
                                @elseif($roles["is_waiter"] )
                                    <th style="width: 40%;">Manage order</th>
                                @endif
                                </thead>
                                <tbody>
                                @foreach ($assignments as $assignment)
                                    <tr>
                                        <td>{{$assignment->id}}</td>
                                        <td>{{$assignment->user_name}}</td>
                                        <td>{{$assignment->table_number}}</td>
                                        <td>{{$assignment->status}}</td>
                                        <td>
                                            @if( $roles["is_manager"])
                                                <a class="btn btn-xs btn-info"
                                                   href="{{route('assign.edit',$assignment->id)}}"
                                                   target="_blank">Edit</a>
                                            @elseif($roles["is_waiter"])
                                                @if($assignment->status == "pending")
                                                    {!! Form::open(array('route' => 'orders.create','method'=>'POST','id' => 'order-create')) !!}
                                                    <button
                                                            class="btn btn-xs btn-info">
                                                        Create order
                                                    </button>
                                                    {{Form::hidden('table_id',  $assignment->table_id, null)}}

                                                    {{Form::hidden('user_table_id',  $assignment->id, null)}}
                                                    {!! Form::close() !!}
                                                @endif
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

