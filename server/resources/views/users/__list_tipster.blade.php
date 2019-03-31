<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">List Tipster</h3>
    </div>
    <div class="box-body">
        <div class="table-responsive">
            <table id="viewListTipster" class="table table-bordered table-striped tbsty">
                <thead>
                <tr>
                    <th width="30">No.</th>
                    <th>Tipster</th>
                    <th width="50">Points</th>
                    <th>Email</th>
                    <th>Level</th>
                    <th>Status</th>
                </tr>
                </thead>
                <tbody>
                @foreach($tipsters as $index => $tipster)
                    <tr>
                        <td>{{$index+1}}</td>
                        <td>{{ $tipster->username }}<span class="label-small">{{$user->fullname}}</span></td>
                        <td>{{$tipster->point}}</td>
                        <td>{{ $tipster->email }}</td>
                        <td> {{\App\Model\Role::getNameRoleByID($tipster->role_id)}}</td>
                        <td>@if($tipster->delete_is == 0)<label class="label label-success">Active</label>@else <label class="label label-danger">Non active</label> @endif</td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    $(function () {
        $('#viewListTipster').DataTable({
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
    $(document).ready(function() {
        $('input[type=search]').keyup(function(){
            $('div.alert-success').remove();
        });
    });
</script>