@extends('layouts.master')
@section('title', 'Create product category')
@section('body.breadcrumbs')
    {{ Breadcrumbs::render('productcategories.create') }}
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
                <form role="form" method="post" action="{{route('productcategories.store')}}">
                    {{ csrf_field() }}
                        <div class="box-body">
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label>Category name</label>
                                <input name="name" type="text" class="form-control" value="{{ old('name') }}" required>
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
                                <textarea name="description" rows="5" class="form-control"></textarea>
                            </div>
                        </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <a href="{{route('productcategories.index')}}" class="btn btn-default">Cancel</a>
                        <button type="submit" class="btn btn-primary pull-right">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection