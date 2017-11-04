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
                    <div class="panel-heading">Users
                        <a class="btn btn-info btn-xs pull-right"
                           href="{{route('users.create')}}">Add new</a>
                    </div>

                    <div class="panel-body">
                        <div class="table-responsive">
                            <table id="templates_table" class="table table-bordred table-striped">
                                <thead>
                                <th style="width: 5%;">ID</th>
                                <th style="width: 30%;">Name</th>
                                <th style="width: 30%;">Email</th>
                                <th style="width: 10%;">Role</th>
                                <th style="width: 10%;">Edit</th>
                                </thead>
                                <tbody>
                                @foreach ($data as $user)
                                    <tr>
                                        <td>{{$user->id}}</td>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>
                                            @foreach($user->roles as $role)
                                                {{$role->name}}
                                            @endforeach
                                        </td>
                                        <td><a class="btn btn-xs btn-info"
                                               href="{!! route('users.edit',$user->id)!!}" target="_blank">Edit</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="clearfix"></div>
                            {!! $data->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
