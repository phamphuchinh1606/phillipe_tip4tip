@foreach($tipsters as $index => $tipster)
    <?php
        $classHide = "hide";
        if(isset($defaultValue)){
            if($tipster->id == $defaultValue){
                $classHide = "";
            }
        }else if($index == 0){
            $classHide = "";
        }
    ?>
    <div class="form-group {{$classHide}} tipster_info" id="{{$tipster->id}}">
        <div class="row">
            <div class="col-md-5">
                <div class="form-group">
                    <label>Phone : {{$tipster->phone}}</label>
                </div>
            </div>
            <div class="col-md-7">
                <div class="form-group">
                    <label>Email : {{$tipster->email}}</label>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-md-5">
                <div class="form-group">
                    <label>Birthday : {{\App\Common\Common::dateFormat($tipster->birthday,'d-M-Y')}}</label>
                </div>
            </div>
            <div class="col-md-7">
                <div class="form-group">
                    <label>Region : {{$tipster->region_name}}</label>
                </div>
            </div>
        </div>
    </div>
@endforeach