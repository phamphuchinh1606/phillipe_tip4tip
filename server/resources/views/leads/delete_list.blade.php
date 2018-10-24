<?php use App\Common\Common;?>
@extends('layouts.master')
@section('title', 'List of Leads deleted')

@section('javascript')
    <script src="{{ asset('js/admin/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/admin/dataTables.bootstrap.min.js') }}"></script>
    <script>
        $(function () {
            $('#viewList').DataTable({
                'paging'      : true,
                'lengthChange': false,
                'searching'   : true,
                'ordering'    : true,
                'info'        : true,
                'autoWidth'   : true,
                'order': [],
                'columnDefs': [ { orderable: false, targets: [0]}]
            })
        })

        $(document).ready(function(){
            $('a.restoreLead').on('click',function(){
                let leadName = $(this).attr('data-name');
                let url = $(this).attr('data-url');
                $('.popup-restore .lead-name').html(leadName);
                $('.popup-restore .form-restore').attr('action',url);
            })
        });
    </script>
@stop
@section('body.breadcrumbs')
    {{ Breadcrumbs::render('leadsDeleted') }}
@stop

@section('content')
    <div class="box box-list">
        <div class="box-header">
            <h3 class="box-title">@yield('title')</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            @if (\Session::has('success'))
                <div class="alert alert-success clearfix">
                    <p>{{ \Session::get('success') }}</p>
                </div><br />
            @endif
            <div class="table-responsive">
                <table id="viewList" class="table table-hover table-striped">
                    <thead>
                    <tr>
                        <th>No.</th>
                        <th>Lead</th>
                        <th>Product</th>
                        <th>Tipster</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i= 0; ?>
                    @foreach($leads as $lead)
                        <?php $i++ ?>
                        <tr>
                            <td width="40" align="center">{{$i}}</td>
                            <td>{{$lead->fullname}}</td>
                            <td>{{ $lead->product }}</td>
                            <td>{{ $lead->tipster }}</td>
                            <td>{{ Common::dateFormat($lead->created_at, 'd F Y')}}</td>
                            <td><span class="label-status {{Common::showColorStatus($lead->status)}}">{{ Common::showNameStatus($lead->status) }}</span></td>
                            <td class="actions text-center" style="width: 100px">
                                <a href="{{route('leads.deleteShow', $lead->id)}}" class="btn btn-xs btn-success" title="View"><i class="fa fa-eye"></i></a>
                                <a class="btn btn-xs btn-info restoreLead" title="Restore" data-toggle="modal" data-target="#popup-confirm"
                                   data-name="{{$lead->fullname}}" data-url="{{route('leads.restore', $lead->id)}}">
                                    <i class="fa fa-reply-all" aria-hidden="true"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                    <tfoot>
                    <tr>
                        <th>No.</th>
                        <th>Lead</th>
                        <th>Product</th>
                        <th>Tipster</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->

    <div id="popup-confirm" class="modal popup-confirm popup-restore" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <p>Do you really want restore lead "<span class="lead-name"><span>" ?</p>
                    <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Cancel</button>
                    <form class="inline form-restore" action="" method="post">
                        {{csrf_field()}}
                        <button class="btn btn-sm btn-danger" type="submit">Yes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection