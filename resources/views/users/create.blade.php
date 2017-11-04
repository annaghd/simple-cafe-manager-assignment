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
                    @if (!empty($user->id))
                        {!! Form::model($user, array('route' => ['users.update', $user->id],'method'=>'PATCH','id' => 'user-update')) !!}
                    @else
                        {!! Form::open(array('route' => 'users.store','method'=>'POST','id' => 'user-create')) !!}
                    @endif
                    <div class="panel-heading">User
                        <button type="submit" class="btn btn-info btn-xs pull-right">Save</button>
                    </div>

                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="title">User name:</label>
                                    {!! Form::text('name', null, array('placeholder' => 'User name','class' => 'form-control', 'required' => 'required')) !!}
                                </div>
                                <div class="form-group">
                                    <label for="title">User email:</label>
                                    {!! Form::text('email', null, array('placeholder' => 'User email','class' => 'form-control', 'required' => 'required')) !!}
                                </div>
                                <div class="form-group">
                                    <label for="slug">User password:</label>
                                    {!! Form::text('password', null, array('placeholder' => 'User password','class' => 'form-control')) !!}
                                </div>
                                <div class="form-group">
                                    <label for="title">User role:</label>
                                    @if($user->role_id)
                                        {{Form::select('role_id', $roles_list, $user->role_id, ['class' => 'form-control', 'required' => 'required', 'disabled' => 'disabled'])}}
                                    @else
                                        {{Form::select('role_id', $roles_list, null, ['class' => 'form-control', 'required' => 'required'])}}
                                    @endif
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

