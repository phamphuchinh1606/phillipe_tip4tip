@extends('layouts.master')
@section('title', 'Edit product category')
@section('body.breadcrumbs')
    {{ Breadcrumbs::render('productcategories.edit') }}
@stop
@section('content')
 <div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">@yield('title')</h3>
        <a href="{{route('productcategories.index')}}" class="btn btn-xs btn-default pull-right"><i class="fa fa-angle-left"></i> Back to list</a>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-sm-6 col-sm-push-3">
                <form role="form" method="post" action="{{route('productcategories.update',$category->id)}}">
                    {{ csrf_field() }}
                    <input name="_method" type="hidden" value="PATCH">
                    <div class="box-body">
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label>Category name</label>
                            <input name="name" type="text" class="form-control" value="{{ $category->name }}" required>
                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" rows="5" class="form-control">{{$category->description}}</textarea>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <a href="{{route('productcategories.index')}}" class="btn btn-default">Cancel</a>
                        <button type="submit" class="btn btn-primary pull-right">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection