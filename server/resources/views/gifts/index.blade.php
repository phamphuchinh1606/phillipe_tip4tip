<?php use App\Common\Utils; ?>
@extends('layouts.master')
@section('title', 'List of gifts')
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
      });
    </script>
@stop
@section('body.breadcrumbs')
    {{ Breadcrumbs::render('gifts') }}
@stop
@section('content')
    <div class="box box-list">
        <div class="box-header clearfix">
            <h3 class="box-title">@yield('title')</h3>
            @if($createAction)<a href="{{route('gifts.create')}}" class="btn btn-md btn-primary pull-right"><i class="fa fa-plus"></i> New Gift</a>@endif
        </div>

        <!-- /.box-header -->
        <div class="box-body">
            @if (\Session::has('success'))
                <div class="alert alert-success clearfix">
                    <p>{{ \Session::get('success') }}</p>
                </div><br />
            @endif
            <div class="table-responsive">
                <table id="viewList" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>No.</th>
                        <th>Thumbnail</th>
                        <th>Gift name</th>
                        <th>Points</th>
                        <th>Description</th>
                        <th>Category</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i= 0; ?>
                    @foreach($gifts as $gift)
                        <?php $i++ ?>
                        <tr>
                            <td width="40" align="center"><?php echo $i?></td>
                            <td width="100px">
                                <span class="thumbnail">
                                    @if(!empty($gift->thumbnail))
                                        <img src="{{asset(Utils::$PATH__IMAGE)}}/{{$gift->thumbnail}}">
                                    @else
                                        <img src="{{asset(Utils::$PATH__IMAGE)}}/no_image_available.jpg" alt="">
                                    @endif
                                </span>
                            </td>
                            <td>{{$gift->name}}</td>
                            <td width="80px">{{$gift->point}}</td>
                            <td style="width:300px;">{{{ strip_tags(str_limit($gift->description, 110)) }}}</td>
                            <td>{{$gift->category}}</td>
                            <td class="actions text-center" style="width: 100px">
                                <a href="{{route('gifts.show', $gift->id)}}" class="btn btn-xs btn-success" title="View"><i class="fa fa-eye"></i></a>
                                @if($editAction ==  true)
                                    <a href="{{route('gifts.edit', $gift->id)}}" class="btn btn-xs btn-info" title="Edit"><i class="fa fa-pencil"></i></a>
                                @endif

                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                    <tfoot>
                    <tr>
                        <th>No.</th>
                        <th>Thumbnail</th>
                        <th>Gift name</th>
                        <th>Points</th>
                        <th>Description</th>
                        <th>Category</th>
                        <th>Actions</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <!-- /.box-body -->
    </div>
@endsection