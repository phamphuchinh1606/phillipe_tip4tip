<?php use \App\Common\Utils; ?>
@extends('layouts.master')
@section('title', 'Create User')

@section('styles')
    <link href="{{ asset('css/admin/bootstrap3-wysihtml5.min.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
    <link rel="stylesheet" href="{{asset('css/admin/intlTelInput.css')}}">

    <!-- Bootstrap WYSIHTML5 -->
    <link href="{{ asset('css/admin/select2.min.css') }}" rel="stylesheet" type="text/css">
@stop

@section('javascript')
    <!-- Bootstrap WYSIHTML5 -->
    <script src="{{ asset('js/admin/bootstrap3-wysihtml5.all.min.js') }}"></script>
    <script src="{{ asset('js/admin/select2.full.min.js') }}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
    <script src="{{asset('js/admin/intlTelInput.js')}}"></script>
    <!-- Bootstrap WYSIHTML5 -->
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
                localizedCountries: {'de': 'Deutschland' },
                preferredCountries: ['vn', 'jp'],
                separateDialCode: true,
                utilsScript: "{{asset('js/admin/utils.js')}}"
            });
            $("#phone").val({{old('phone')}});
        })
    </script>
@stop

@section('body.breadcrumbs')
    {{ Breadcrumbs::render('users.create') }}
@stop
@section('content')
    @if($createAction == false)
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
                            <img id="imgHandle" src="{{asset(Utils::$PATH__IMAGE)}}/no_image_available.jpg">
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
            </div>
            <!-- /.box -->


        </div>
        <!-- /.col -->
        <div class="col-md-8 col-md-pull-4">
            <!-- create manager form -->
            <div class="box box-warning">
                <div class="box-header with-border">
                    <h3 class="box-title">@yield('title')</h3>
                    <a href="{{route('users.index')}}" class="btn btn-xs btn-default pull-right"><i class="fa fa-angle-left"></i> Back to list</a>
                </div><!-- /.box-header -->
                    <form role="form" method="post" action="{{route('users.store')}}" enctype = "multipart/form-data">
                        {{ csrf_field() }}
                        <div class="box-body">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    @if (count($errors) > 0)
                                        <strong>Whoops!</strong> There were some problems with your input.
                                    @endif
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div><br />
                            @endif
                            @if (\Session::has('success'))
                                <div class="alert alert-success">
                                    <p>{{ \Session::get('success') }}</p>
                                </div>
                            @endif
                                <input id="imgHandleInput" name="avatar" type="file" value="">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                                        <label>Username</label>
                                        <input name="username" value="{{old('username')}}" type="text" class="form-control" placeholder="Enter ..." required>
                                        @if ($errors->has('username'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('username') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                        <label>Password</label>
                                        <input name="password" type="password" class="form-control" placeholder="Enter ..." required>
                                        @if ($errors->has('password'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Password confirm</label>
                                        <input name="password_confirmation" type="password" class="form-control" placeholder="Enter ..." required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                        <label>Full name</label>
                                        <input name="fullname" value="{{old('fullname')}}" type="text" class="form-control" placeholder="Enter ..." required>
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
                                        <input class="form-control" id="date" name="birthday" value="{{old('birthday')}}"
                                               placeholder="dd/mm/yyyyy" type="text" autocomplete="off"/>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label style="width: 100%">Gender</label>
                                        <div class="radio-inline">
                                            <label>
                                                <input type="radio" value="0" name="gender" checked>
                                                Male
                                            </label>
                                        </div>
                                        <div class="radio-inline">
                                            <label>
                                                <input type="radio" value="1" name="gender">
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
                                        <input name="email" value="{{old('email')}}" type="email" class="form-control" placeholder="Enter ..." required>
                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                                        <label>Phone</label>
                                        <input name="phone" id="phone" value="" type="tel" class="form-control"
                                               pattern="\d*"  title="Phone number (0912345678)" required>
                                        @if ($errors->has('phone'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('phone') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Address</label>
                                        <input name="address" value="{{old('address')}}" type="text" class="form-control" placeholder="Enter ...">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group{{ $errors->has('region') ? ' has-error' : '' }}">
                                        <label>Region</label>
                                        <select name="region" class="form-control" required>
                                            <option value="" disabled selected>Please pick a region</option>
                                            @foreach($regions as $region)
                                                <option value="{{$region->id}}" @if( old('region') == $region->id) selected @endif >{{$region->name}}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('region'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('region') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group{{ $errors->has('department') ? ' has-error' : '' }}">
                                        <label>Department</label>
                                        {{--<select name="department" class="form-control" required>--}}
                                            {{--<option value="" disabled selected>Please pick a department</option>--}}
                                            {{--@foreach($roletypes as $roletype)--}}
                                                {{--<optgroup label="{{$roletype->name}}">--}}
                                                    {{--@foreach($roles as $role)--}}
                                                        {{--@if($role->roletype_id == $roletype->id)--}}
                                                            {{--<option value="{{$role->id}}" @if( old('department') == $role->id) selected @endif>{{$role->name}}</option>--}}
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
                                                            <option value="{{$role->id}}" @if( old('department') == $role->id) selected @endif>{{$role->name}}</option>
                                                        @endif
                                                    @endforeach
                                                </optgroup>
                                            @endforeach
                                        </select>

                                        @if ($errors->has('department'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('department') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <a href="{{route('users.index')}}" class="btn btn-default">Cancel</a>
                            <button type="submit" class="btn btn-primary pull-right">Create</button>
                        </div>
                    </form>



            </div>

            <!-- /.box -->
        </div>
        @endif
    </div>

@endsection