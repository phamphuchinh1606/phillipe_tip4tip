<?php
use App\Common\Utils;
use App\Common\Common;
?>
@extends('layouts.master')
@section('title', 'Error Page')
@section('content')
    <div class="box box-danger">
        <div class="box-body text-center">
            <p>
                <b>{{$messageError}}</b>
            </p>
        </div>
    </div>
@endsection