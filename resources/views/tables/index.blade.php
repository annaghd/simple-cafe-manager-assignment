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
                    <div class="panel-heading">Tables
                        <a class="btn btn-info btn-xs pull-right"
                           href="{{route('tables.create')}}">Add new</a>
                    </div>

                    <div class="panel-body">
                        <div class="table-responsive">
                            <table id="templates_table" class="table table-bordred table-striped">
                                <thead>
                                <th style="width: 5%;">ID</th>
                                <th style="width: 40%;">Number</th>
                                <th style="width: 30%;">Edit</th>
                                </thead>
                                <tbody>
                                @foreach ($data as $table)
                                    <tr>
                                        <td>{{$table->id}}</td>
                                        <td>{{$table->number}}</td>
                                        <td><a class="btn btn-xs btn-info"
                                               href="{{route('tables.edit',$table->id)}}" target="_blank">Edit</a>
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

