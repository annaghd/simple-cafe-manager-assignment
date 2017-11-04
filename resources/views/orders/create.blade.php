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
                    @if (!empty($order->id))
                        {!! Form::model($order, array('route' => ['orders.update', $order->id],'method'=>'PATCH','id' => 'order-update')) !!}
                    @else
                        {!! Form::open(array('route' => 'orders.store','method'=>'POST','id' => 'order-create')) !!}
                    @endif
                    <div class="panel-heading">Order for table id {{$table_id}}
                        <button type="submit" class="btn btn-info btn-xs pull-right">Save</button>
                    </div>

                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="title">Status:</label>
                                    {{Form::select('status', $statuses, null, ['class' => 'form-control', 'required' => 'required'])}}
                                </div>
                                <div class="form-group">
                                    <label for="title">Products:</label>
                                    @foreach($products as $product_id => $product_name)
                                        <div class="row form-group">
                                            <div class="col-md-6">
                                                {{Form::checkbox('product_id[]', $product_id, (in_array($product_id, array_keys($order_products)) ? 1 : null), ['id' => 'product_id_' .  $product_id])}}
                                                <label for="product_id_{{$product_id}}">{{$product_name}}</label>
                                            </div>
                                            <div class="col-md-6">
                                                {{Form::number('quantity' . $product_id, (in_array($product_id, array_keys($order_products)) ? $order_products[$product_id] : 1), ['placeholder' => 'Quantity', 'class' => 'form-control', 'required' => 'required', 'min' => 1])}}
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    {{Form::hidden('table_id', $table_id, null)}}
                    {{Form::hidden('user_table_id', $user_table_id, null)}}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

