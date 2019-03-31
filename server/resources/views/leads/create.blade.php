<?php use App\Common\Utils; ?>
@extends('layouts.master')
@section('title', 'Create Lead')
@section('body.breadcrumbs')
    {{ Breadcrumbs::render('leads.create') }}
@stop
@section('styles')
    <link rel="stylesheet" href="{{asset('css/admin/intlTelInput.css')}}">
@endsection

@section('javascript')
    <script src="{{asset('js/admin/intlTelInput.js')}}"></script>
    <script>
        $("#phone").intlTelInput({
            allowDropdown: false,
            // autoHideDialCode: false,
            // autoPlaceholder: "of",
            // dropdownContainer: "body",
            // excludeCountries: ["us"],
            // formatOnDisplay: false,
            // geoIpLookup: function(callback) {
            //   $.get("http://ipinfo.io", function() {}, "jsonp").always(function(resp) {
            //     var countryCode = (resp && resp.country) ? resp.country : "";
            //     callback(countryCode);
            //   });
            // },
            // hiddenInput: "full_number",
            // initialCountry: "auto",
            localizedCountries: {'de': 'Deutschland' },
            // nationalMode: true,
            // onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
            // placeholderNumberType: "MOBILE",
            preferredCountries: ['vn', 'jp'],
            separateDialCode: true,
            utilsScript: "{{asset('js/admin/utils.js')}}"
        });
        // $("#phone").on("countrychange", function(e, countryData) {
        //     console.log(e);
        //     console.log(countryData.dialCode);
        //     // $('#phone').val();
        // });
        $("select[name=tipster]").on('change',function(){
            var tipsterId = $(this).val();
            $('div.tipster_info').addClass('hide');
            $('div#'+tipsterId).removeClass('hide');
        });
    </script>
@endsection

@section('content')
    @if($createAction == false)
        <div class="box box-danger">
            <div class="box-body text-center">
                <p>You do not access to this screen. Please contact to admin.</p>
            </div>
        </div>
    @else
        <form role="form" method="post" action="{{route('leads.create')}}">
            {{ csrf_field() }}
            {{--@include('layouts.partials._input_history_user',--}}
                        {{--['affectedValue' => Utils::$LOG_AFFECTED_OBJECT_LEAD ,--}}
                        {{--'actionValue' => Utils::$LOG_ACTION_CREATE,--}}
                        {{--'nameObjectValue' => 'fullname'])--}}
            <div class="row">
                <div class="col-md-8">
                    <!-- create manager form -->
                    <div class="box box-success">
                        <div class="box-header with-border">
                            <h3 class="box-title">@yield('title')</h3>
                            <a href="{{route('leads.index')}}" class="btn btn-xs btn-default pull-right"><i class="fa fa-angle-left"></i> Back to list</a>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @if (\Session::has('success'))
                                <div class="alert alert-success">
                                    <p>{{ \Session::get('success') }}</p>
                                </div>
                            @endif
                            <div class="row">
                                <div class="col-xs-6">
                                    <!-- text input -->
                                    <div class="form-group{{ $errors->has('fullname') ? ' has-error' : '' }}">
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
                                <div class="col-xs-6">
                                    <div class="form-group group__gender">
                                        <label style="width: 100%">RelationShip</label>
                                        <div class="radio-inline">
                                            <label>
                                                <input type="radio" value="family" name="Relationship" checked>
                                                Family
                                            </label>
                                        </div>
                                        <div class="radio-inline">
                                            <label>
                                                <input type="radio" value="acquaintance" name="Relationship">
                                                Acquaintance
                                            </label>
                                        </div>
                                        <div class="radio-inline">
                                            <label>
                                                <input type="radio" value="stranger" name="Relationship">
                                                Stranger
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="form-group group__gender">
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
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label>Phone</label>
                                        <input name="phone" id="phone" value="{{old('phone')}}" type="tel" class="form-control"
                                               pattern="\d*"  title="Phone number (0912345678)">
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input name="email" value="{{old('email')}}" type="email" class="form-control" placeholder="Enter ...">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6">
                                    <div class="form-group{{ $errors->has('region') ? ' has-error' : '' }}">
                                        <label>Region</label>
                                        <select name="region" class="form-control" required>
                                            <option value="" disabled selected>Please pick a region</option>
                                            @foreach($regions as $region)
                                                <option value="{{$region->id}}" @if(old('region') == $region->id) selected @endif>{{$region->name}}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('region'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('region') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="form-group{{ $errors->has('product') ? ' has-error' : '' }}">
                                        <label>Product</label>
                                        <select name="product" class="form-control" required>
                                            <option value="" disabled selected>Please pick a product</option>
                                            @foreach(\App\Model\Product::getAllProduct() as $product)
                                                <option value="{{$product->id}}" @if(old('product') == $product->id) selected @endif>{{$product->name}}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('product'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('product') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label>Notes</label>
                                        <textarea name="notes" class="form-control" placeholder="URGENT - PLEASE CONTACT ASAP" rows="5"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <a href="{{route('leads.index')}}" class="btn btn-default">Cancel</a>
                            <button type="submit" class="btn btn-primary pull-right">Create</button>
                        </div>
                    </div>

                    <!-- /.box -->
                </div>
                <div class="col-md-4">
                    <div class="box box-success">
                        <div class="box-header with-border">
                            <h3 class="box-title">Actions</h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label>Tipster reference</label>
                                <select name="tipster" class="form-control">
                                    {{--<option  value="" disabled selected>Please pick a tipster</option>--}}
                                    @foreach($tipsters as $tipster)
                                        <option value="{{$tipster->id}}" @if(Auth::user()->id == $tipster->id) selected @endif>
                                            {{$tipster->fullname}} - {{$tipster->username}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @include('leads.__tipster_info',['tipsters' => $tipsters])
                        </div>
                        <!-- /.box-body -->
                    </div>
                </div>

            </div>
        </form>
@endif
@endsection