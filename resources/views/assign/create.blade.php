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
                    @if (!empty($assignment->id))
                        {!! Form::model($assignment, array('route' => ['assign.update', $assignment->id],'method'=>'PATCH','id' => 'assign-update')) !!}
                    @else
                        {!! Form::open(array('route' => 'assign.store','method'=>'POST','id' => 'assign-create')) !!}
                    @endif
                    <div class="panel-heading">Assign table to user
                        <button type="submit" class="btn btn-info btn-xs pull-right">Save</button>
                    </div>

                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    @if(!empty($users))
                                        <label for="title">User:</label>
                                        {{Form::select('user_id', $users, null, ['class' => 'form-control', 'required' => 'required'])}}
                                    @else
                                        The all waiters are busy
                                        {{Form::hidden('user_id', $assignment->user_id, null)}}
                                    @endif
                                </div>
                                <div class="form-group">
                                    @if(!empty($tables))
                                        <label for="title">Table:</label>
                                        {{Form::select('table_id', $tables, null, ['class' => 'form-control', 'required' => 'required'])}}
                                    @else
                                        The all tables are busy
                                        {{Form::hidden('table_id', $assignment->table_id, null)}}
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="title">Status:</label>
                                    {{Form::select('status', $statuses, null, ['class' => 'form-control', 'required' => 'required'])}}
                                </div>

                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

