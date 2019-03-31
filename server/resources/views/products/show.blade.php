<?php use App\Common\Utils; ?>
@extends('layouts.master')
@section('title', 'Product Information')
@section('body.breadcrumbs')
    {{ Breadcrumbs::render('products.show') }}
@stop
@section('content')
    <div class="row">
        <!-- /.col -->
        <div class="col-md-8">
            <!-- create manager form -->

            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">@yield('title')</h3>
                    <span class="group__action pull-right">
                        <a href="{{route('products.index')}}" class="btn btn-xs btn-default"><i class="fa fa-angle-left"></i> Back to list</a>
                        <a href="{{route('products.edit', $product->id)}}" class="btn btn-xs btn-info"><i class="fa fa-pencil"></i> Edit</a>
                        @if($deleteAction == true)<a data-toggle="modal" data-target="#popup-confirm" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> Delete</a>@endif
                    </span>

                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    @if($product->delete_is == 1)
                        <div class="alert alert-danger clearfix">
                            <p>This item was delete.</p>
                        </div>
                    @endif
                    <p class="text-muted">
                        <strong><i class="fa fa-shield margin-r-5"></i> Product name: </strong>
                        {{$product->name}}
                    </p>

                    <hr>

                    <p class="text-muted">
                        <strong><i class="fa fa-sort-numeric-asc"></i> Sort num: </strong>
                        {{$product->sort_num}}
                    </p>

                    <hr>

                    <p class="text-muted">
                        <strong><i class="fa fa-info-circle margin-r-5"></i> Description:</strong>
                        {{$product->description}}

                    </p>

                    <hr>


                    <p class="text-muted">
                        <strong><i class="fa fa-folder-open margin-r-5"></i> Category:</strong>
                        {{$product->category}}
                    </p>

                    <!-- <hr> -->
                    <!-- <p class="text-muted">
                        <strong><i class="fa fa-money margin-r-5"></i> Price:</strong>
                        {{$product->price}}
                    </p>
                    <hr>
                    <p class="text-muted">
                        <strong><i class="fa fa-cubes margin-r-5"></i> Quality:</strong>
                        {{$product->quality}}
                    </p> -->


                </div>
                <!-- /.box-body -->
            </div>

            <!-- /.box -->
        </div>
        <div class="col-md-4">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Product Image</h3>
                </div>
                <div class="box-body text-center">
                    <p>@if(!empty($product->thumbnail))
                            <img id="imgHandle" src="{{asset(Utils::$PATH__IMAGE)}}/{{$product->thumbnail}}">
                        @else
                            <img id="imgHandle" src="{{ asset('images/no_image_available.jpg') }}">
                        @endif</p>
                </div>
            </div>
        </div>
    </div>
        @if($deleteAction == true)
    {{--popup confirm--}}
    <div id="popup-confirm" class="modal popup-confirm" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <p>Do you really want to delete this item?</p>
                    <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Cancel</button>
                    <form id="formHolder" class="inline" action="{{route('products.destroy', $product->id)}}" method="post">
                        {{csrf_field()}}
                        <input name="_method" type="hidden" value="DELETE">
                        <button class="btn btn-sm btn-danger" type="submit">Yes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif
@endsection