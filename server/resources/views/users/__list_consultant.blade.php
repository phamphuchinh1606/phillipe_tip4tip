<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">List Consultant</h3>
    </div>
    <div class="box-body">
        <div class="table-responsive">
            <table id="viewList" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>No.</th>
                    <th>Username</th>
                    <th>Fullname</th>
                    <th>Email</th>
                    <th>Department</th>
                    <th>Status</th>
                </tr>
                </thead>
                <tbody>
                @foreach($consultants as $index => $consultant)
                    <tr>
                        <td>{{$index+1}}</td>
                        <td>{{ $consultant->username }}</td>
                        <td>{{$consultant->fullname}}</td>
                        <td>{{ $consultant->email }}</td>
                        <td>@if(!empty($consultant->role) && !empty($consultant->roletype))
                                {{$consultant->role}}-{{$consultant->roletype}}
                            @endif
                        </td>
                        <td>@if($consultant->delete_is == 0)<label class="label label-success">Active</label>@else <label class="label label-danger">Non active</label> @endif</td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>


