<?php use App\Common\Utils; ?>
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">List of buy able gifts </h3>
    </div>
    <div class="box-body">
        <table class="table table-striped lead__ref viewList">
            <thead>
            <tr>
                <th>No.</th>
                <th>Thumbnail</th>
                <th>Gift name</th>
                <th>Points</th>
                <th>Category</th>
            </tr>
            </thead>
            <tbody>
            @if(!empty($giftsBuyAble))
                @foreach($giftsBuyAble as $index => $gift)
                    <tr>
                        <td width="40" align="center">{{$index+1}}</td>
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
                        <td>{{$gift->category_name}}</td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="3">Do not have any gift.</td>
                </tr>
            @endif
            </tbody>
        </table>
    </div>
</div>