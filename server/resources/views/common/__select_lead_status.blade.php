<?php use App\Common\Common; ?>
<select name="status" class="form-control">
    <option value="" disabled selected>Please pick a status</option>
    <option value="0" @if(0 == $defaultValue) selected @endif>{{Common::showNameStatus(0)}}</option>
    <option value="5" @if(5 == $defaultValue) selected @endif>{{Common::showNameStatus(5)}}</option>
    <option value="1" @if(1 == $defaultValue) selected @endif>{{Common::showNameStatus(1)}}</option>
    <option value="2" @if(2 == $defaultValue) selected @endif>{{Common::showNameStatus(2)}}</option>
    <option value="3" @if(3 == $defaultValue) selected @endif>{{Common::showNameStatus(3)}}</option>
    <option value="4" @if(4 == $defaultValue) selected @endif>{{Common::showNameStatus(4)}}</option>
</select>