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
                    <div class="panel-heading">Products
                        <a class="btn btn-info btn-xs pull-right"
                           href="{{route('products.create')}}">Add new</a>
                    </div>

                    <div class="panel-body">
                        <div class="table-responsive">
                            <table id="templates_table" class="table table-bordred table-striped">
                                <thead>
                                <th style="width: 5%;">ID</th>
                                <th style="width: 40%;">Name</th>
                                <th style="width: 30%;">Price</th>
                                <th style="width: 30%;">Edit</th>
                                </thead>
                                <tbody>
                                @foreach ($data as $product)
                                    <tr>
                                        <td>{{$product->id}}</td>
                                        <td>{{$product->name}}</td>
                                        <td>{{$product->price}} $</td>
                                        <td><a class="btn btn-xs btn-info"
                                               href="{{route('products.edit',$product->id)}}" target="_blank">Edit</a>
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
