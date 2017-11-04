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
                    @if (!empty($data->id))
                        {!! Form::model($data, array('route' => ['tables.update', $data->id],'method'=>'PATCH','id' => 'table-update')) !!}
                    @else
                        {!! Form::open(array('route' => 'tables.store','method'=>'POST','id' => 'table-create')) !!}
                    @endif
                    <div class="panel-heading">Table
                        <button type="submit" class="btn btn-info btn-xs pull-right">Save</button>
                    </div>

                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="title">Table number:</label>
                                    {!! Form::text('number', null, array('placeholder' => 'Table number','class' => 'form-control', 'required' => 'required')) !!}
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

