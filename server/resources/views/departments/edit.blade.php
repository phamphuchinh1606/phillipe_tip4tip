@extends('layouts.master')
@section('title', 'Edit Department')
@section('body.breadcrumbs')
    {{ Breadcrumbs::render('regions.edit') }}
@stop
@section('content')
    {{--@if($createAction == false)
        <div class="box box-danger">
            <div class="box-body text-center">
                <p>You do not access to this screen. Please contact to admin.</p>
            </div>
        </div>
    @else--}}
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">@yield('title')</h3>
            <a href="{{route('departments.index')}}" class="btn btn-xs btn-default pull-right"><i class="fa fa-angle-left"></i> Back to list</a>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-sm-6 col-sm-push-3">
                    <form role="form" method="post" action="{{route('departments.update', $role->id)}}">
                        {{ csrf_field() }}
                        <input name="_method" type="hidden" value="PATCH">
                        @if (\Session::has('success'))
                            <div class="alert alert-success">
                                <p>{{ \Session::get('success') }}</p>
                            </div>
                        @endif
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label>Department Name</label>
                            <input name="name" value="{{ $role->name }}" type="text" class="form-control" placeholder="Enter ..." required>
                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('code') ? ' has-error' : '' }}">
                            <label>Department Code</label>
                            <input name="code" value="{{ $role->code }}" type="text" class="form-control" placeholder="Enter ..." required>
                            @if ($errors->has('code'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('code') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('role_type_id') ? ' has-error' : '' }}">
                            <label>Role</label>
                            <select name="role_type_id" class="form-control">
                                <option value="" disabled>Please pick a role</option>
                                @foreach($roleTypes as $roleType)
                                    <option value="{{$roleType->id}}" @if($role->roletype_id == $roleType->id) selected @endif>{{$roleType->name}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('role_type_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('role_type_id') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-action">
                            <a href="{{route('departments.index')}}" class="btn btn-default">Cancel</a>
                            <button type="submit" class="btn btn-primary pull-right">Update</button>
                        </div>
                        <!-- /.box-body -->
                    </form>
                </div>
            </div>
        </div>
        <!-- /.col -->

    </div>
{{--@endif--}}
@endsection