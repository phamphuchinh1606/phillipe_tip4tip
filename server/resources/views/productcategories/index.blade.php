@extends('layouts.master')
@section('title', 'List of Product Categories')
@section('body.breadcrumbs')
    {{ Breadcrumbs::render('productcategories') }}
@stop
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
    </script>
@stop

@section('content')
    <div class="box box-list">
        <div class="box-header">
            <h3 class="box-title">@yield('title')</h3>
             @if($createAction == true)
                <a href="{{ route('productcategories.create') }}" class="btn btn-md btn-primary pull-right"><i class="fa fa-plus"></i> New Category</a>
            @endif
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            @if (\Session::has('success'))
                <div class="alert alert-success clearfix">
                    <p>{{ \Session::get('success') }}</p>
                </div><br />
            @endif
            @if (\Session::has('error'))
                <div class="alert alert-danger clearfix">
                    <p>{{ \Session::get('error') }}</p>
                </div><br />
            @endif
            <div class="table-responsive">
                <table id="viewList" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>No.</th>
                        <th>Category name</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i= 0; ?>
                    @foreach($categories as $category)
                        <?php $i++ ?>
                        <tr>
                            <td width="40" align="center"><?php echo $i?></td>
                            <td>{{$category->name}}</td>
                            <td>{{$category->description}}</td>
                            <td class="actions text-center" style="width: 100px">
                                <a href="{{route('productcategories.show', $category->id)}}" class="btn btn-xs btn-success" title="View"><i class="fa fa-eye"></i></a>
                                @if($editAction == true)
                                    <a href="{{route('productcategories.edit', $category->id)}}" class="btn btn-xs btn-info" title="Edit">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                    <tfoot>
                    <tr>
                        <th>No.</th>
                        <th>Category name</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <!-- /.box-body -->
    </div>

@endsection