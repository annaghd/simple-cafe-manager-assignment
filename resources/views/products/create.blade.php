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
                        {!! Form::model($data, array('route' => ['products.update', $product->id],'method'=>'PATCH','id' => 'user-update')) !!}
                    @else
                        {!! Form::open(array('route' => 'products.store','method'=>'POST','id' => 'user-create')) !!}
                    @endif
                    <div class="panel-heading">Product
                        <button type="submit" class="btn btn-info btn-xs pull-right">Save</button>
                    </div>

                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="title">Product name:</label>
                                    {!! Form::text('name', null, array('placeholder' => 'Product name','class' => 'form-control', 'required' => 'required')) !!}
                                </div>
                                <div class="form-group">
                                    <label for="title">Product price:</label>
                                    {!! Form::text('price', null, array('placeholder' => 'Product price','class' => 'form-control', 'required' => 'required')) !!}
                                </div>
                                <div class="form-group">
                                    <label for="slug">Product description:</label>
                                    {!! Form::textarea('description', null, array('placeholder' => 'Product description','class' => 'form-control')) !!}
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

