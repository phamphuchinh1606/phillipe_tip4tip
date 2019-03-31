@extends('layouts.master')
@section('title', 'Region detail')
@section('body.breadcrumbs')
    {{ Breadcrumbs::render('regions.edit') }}
@stop

@section('javascript')
    <script>
        function dataDeletePopup() {
            $('.anchorClick').each(function () {
                $(this).on('click', function () {
                    var $url = $(this).attr('data-url');
                    $('#formHolder').attr('action', $url);
                });
            });

        }

        $(document).ready(function () {
            dataDeletePopup();
        })
    </script>
@endsection

@section('content')
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">@yield('title')</h3>
            <span class="group__action pull-right">
                <a href="{{route('regions.index')}}" class="btn btn-xs btn-default"><i class="fa fa-angle-left"></i> Back to list</a>
                <a href="{{route('regions.edit', $region->id)}}" class="btn btn-xs btn-info"><i class="fa fa-pencil"></i> Edit</a>
                @if($deleteAction == true)
                    <a data-toggle="modal" data-target="#popup-confirm" data-url="{{route('regions.destroy',$region->id)}}" class="btn btn-xs btn-danger anchorClick">
                        <i class="fa fa-trash"></i> Delete</a>
                @endif

            </span>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-lg-10 col-lg-12">
                    <p class="text-muted">
                        <strong><i class="fa fa-shield margin-r-5"></i> Region name: </strong>
                        {{$region->name}}
                    </p>

                    <hr>

                    <p class="text-muted">
                        <strong><i class="fa fa-info-circle margin-r-5"></i> Region code:</strong>
                        {{$region->code}}

                    </p>
                </div>
            </div>
        </div>
    </div>
    <!-- /.box -->
    @if($deleteAction == true)
        {{--popup confirm--}}
        <div id="popup-confirm" class="modal popup-confirm" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <p>Do you really want to delete this item?</p>
                        <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Cancel</button>
                        <form id="formHolder" class="inline" action="" method="post">
                            {{csrf_field()}}
                            <input name="_method" type="hidden" value="DELETE">
                            <button class="btn btn-sm btn-danger" type="submit"> Yes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection