<?php
use App\Common\Common;
use App\Common\Utils;
$auth = Auth::user();
?>
@extends('layouts.master')
@section('title', 'Edit User')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
    <link rel="stylesheet" href="{{asset('css/admin/intlTelInput.css')}}">
    <link href="{{ asset('css/admin/select2.min.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('javascript')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
    <script src="{{asset('js/admin/intlTelInput.js')}}"></script>
    <script src="{{ asset('js/admin/select2.full.min.js') }}"></script>
    <script>
        $(function () {
            //Add text editor
            $('.select2').select2();
        });
        $(document).ready(function(){
            var date_input=$('input[name="birthday"]'); //our date input has the name "date"
            var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
            date_input.datepicker({
                format: 'dd/mm/yyyy',
                container: container,
                todayHighlight: true,
                autoclose: true,
            });

            $("#phone").intlTelInput({
                allowDropdown: false,
                formatOnDisplay: false,
                preferredCountries: ['vn'],
                separateDialCode: true,
                utilsScript: "{{asset('js/admin/utils.js')}}"
            });
            $("#phone").val({{$user->phone}});
        })
    </script>
@endsection

@section('body.breadcrumbs')
    {{ Breadcrumbs::render('users.edit') }}
@stop

@section('content')
    @if($editAction == false)
        <div class="box box-danger">
            <div class="box-body text-center">
                <p>You do not access to this screen. Please contact to admin.</p>
            </div>
        </div>
    @else
        <div class="row">
            <div class="col-md-4 col-md-push-8">

                <!-- Profile Image -->
                <div class="box box-warning">
                    <div class="box-body box-profile">
                        <div class="upload__area-image">
                        <span>
                            <img id="imgHandle" src="@if($user->avatar){{asset(Utils::$PATH__IMAGE)}}/{{$user->avatar}}@else{{Utils::$PATH__DEFAULT__AVATAR}}@endif">
                            <label for="imgAnchorInput">Upload image</label>
                        </span>
                            <p><small>(Please upload a file of type: jpeg, png, jpg, gif, svg.)</small></p>
                        </div>
                        <div class="form__upload">
                            {!! Form::open(array('route' => 'image.upload.post','files'=>true)) !!}
                            <div class="form-inline-simple">
                                {!! Form::file('image', array('class' => 'form-control', 'id' => 'imgAnchorInput', 'onchange' =>'loadFile(event)')) !!}
                                {{--<button type="submit" class="btn btn-info">Upload</button>--}}
                            </div>
                            <script>
                              var loadFile = function(event) {
                                var output = document.getElementById('imgHandle');
                                output.src = URL.createObjectURL(event.target.files[0]);
                                document.getElementById('imgHandleInput').files = event.target.files;
                              };
                            </script>

                            {!! Form::close() !!}

                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->


            </div>
            <!-- /.col -->
            <div class="col-md-8 col-md-pull-4">
                <!-- create manager form -->
                <div class="box box-warning">
                    <div class="box-header with-border">
                        <h3 class="box-title">@yield('title')</h3>
                        <span class="group__action pull-right">
                            @if($auth->id == $user->id)<a href="{{route('changePassword')}}" class="btn-xs btn-link">Change Your Password</a>@endif
                            <a href="{{route('users.index')}}" class="btn btn-xs btn-default"><i class="fa fa-angle-left"></i> Back to list</a>
                        </span>

                    </div>
                    @if ($errors->any())
                        <div class="box-body">
                            <div class="alert alert-danger">
                                @if (count($errors) > 0)
                                    <strong>Whoops!</strong> There were some problems with your input.
                                @endif
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>@endif
                    <!-- /.box-header -->
                    <form role="form" method="post" action="{{route('users.update', $user->id)}}" enctype = "multipart/form-data">
                        {{csrf_field()}}
                        <input name="_method" type="hidden" value="PATCH">
                        <input id="imgHandleInput" name="avatar" type="file" value="{{$user->avatar}}">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <!-- text input -->
                                <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                                    <label>Username</label>
                                    <input name="username" type="text" class="form-control" value="{{$user->username}}">
                                    @if ($errors->has('username'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('username') }}</strong>
                                            </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group{{ $errors->has('fullname') ? ' has-error' : '' }}">
                                    <label>Full name</label>
                                    <input name="fullname" type="text" class="form-control" value="{{$user->fullname}}" placeholder="Enter ...">
                                    @if ($errors->has('fullname'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('fullname') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Birthday</label>
                                    <input class="form-control" id="date" name="birthday" value="@if(old('birthday')){{old('birthday')}}@else{{$user->birthday}}@endif"
                                           placeholder="dd/mm/yyyyy" type="text" autocomplete="off" required/>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label style="width: 100%">Gender</label>
                                    <div class="radio-inline">
                                        <label><input type="radio" value="0" name="gender" @if($user->gender == 0) checked @endif>
                                            Male
                                        </label>
                                    </div>
                                    <div class="radio-inline">
                                        <label><input type="radio" value="1" name="gender" @if($user->gender == 1) checked @endif>
                                            Female
                                        </label>
                                    </div>

                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label>Email</label>
                                    <input name="email" type="email" class="form-control" value="{{$user->email}}" placeholder="Enter ...">
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Phone</label>
                                    <input name="phone" id="phone" value="" type="tel" class="form-control"
                                           pattern="\d*"  title="Phone number (0912345678)" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Address</label>
                                    <input name="address" type="text" class="form-control" value="{{$user->address}}" placeholder="Enter ...">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Region</label>
                                    <select name="region" class="form-control">
                                        <option value="" disabled selected>Please pick a region</option>
                                        @foreach($regions as $region)
                                            <option value="{{$region->id}}" @if($region->id == $user->region_id) selected @endif>{{$region->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Department</label>
                                    {{--<select class="form-control" name="department">--}}
                                        {{--<option value="" disabled selected>Please pick a department</option>--}}
                                        {{--@foreach($roletypes as $roletype)--}}
                                            {{--<optgroup label="{{$roletype->name}}">--}}
                                                {{--@foreach($roles as $role)--}}
                                                    {{--@if($role->roletype_id == $roletype->id)--}}
                                                        {{--<option value="{{$role->id}}" @if($user->role_id == $role->id) selected @endif>{{$role->name}}</option>--}}
                                                    {{--@endif--}}
                                                {{--@endforeach--}}
                                            {{--</optgroup>--}}
                                        {{--@endforeach--}}
                                    {{--</select>--}}
                                    <select name="department[]" class="mdb-select form-control select2" multiple style="width: 100%;" required autofocus>
                                        <option value="" disabled>Please pick a department</option>
                                        @foreach($roletypes as $roletype)
                                            <optgroup label="{{$roletype->name}}">
                                                @foreach($roles as $role)
                                                    @if($role->roletype_id == $roletype->id)
                                                        <?php
                                                            $checkRoleExit = false;
                                                            foreach ($userRoleIds as $roleId){
                                                                if($role->id == $roleId){
                                                                    $checkRoleExit = true;
                                                                    break;
                                                                }
                                                            }
                                                        ?>
                                                        <option value="{{$role->id}}" @if($checkRoleExit) selected @endif>{{$role->name}}</option>
                                                    @endif
                                                @endforeach
                                            </optgroup>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label style="width: 100%">Status</label>
                                    <div class="radio-inline">
                                        <label>
                                            <input type="radio" value="0" name="status" @if($user->delete_is == 0) checked @endif>
                                            Active
                                        </label>
                                    </div>
                                    <div class="radio-inline">
                                        <label>
                                            <input type="radio" value="1" name="status" @if($user->delete_is == 1) checked @endif>
                                            Non Active
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <a href="{{route('users.index')}}" class="btn btn-default">Cancel</a>
                        <button type="submit" class="btn btn-primary pull-right">Update</button>
                    </div>
                    </form>
                </div>
                <!-- /.box -->
            </div>
        </div>
    @endif
@endsection