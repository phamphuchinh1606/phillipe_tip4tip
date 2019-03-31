<?php 
    use App\Common\Common; 
    use App\Common\Utils;
?>
@extends('layouts.master')
@section('title', 'Dashboard')
@section('body.breadcrumbs')
    {{ Breadcrumbs::render('dashboard') }}
@stop
@section('styles')
    <link href="{{asset('css/jquery.scrollbar.css')}}" rel="stylesheet" type="text/css">
@stop
@section('javascript')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.bundle.min.js"></script>
    <script src="{{asset('js/jquery.scrollbar.js')}}"></script>
<script>
  var ctx = document.getElementById("pieChartLeads").getContext('2d');
  var pieChartLeads = new Chart(ctx, {
    type: 'doughnut',
    data: {
      labels: ["{{$newPersen}}% New", "{{$assignPersen}}% Assign", "{{$callPersen}}% Call", "{{$quotePersen}}% Quote", "{{$winPersen}}% Win", "{{$lostPersen}}% Lost"],
      datasets: [{
        label: '# of Votes',
        data: [{{$new}},{{$assign}} , {{$call}}, {{$quote}}, {{$win}}, {{$lost}}],
        backgroundColor: [
          '{{Common::colorStatus(0)}}',
          '{{Common::colorStatus(5)}}',
          '{{Common::colorStatus(1)}}',
          '{{Common::colorStatus(2)}}',
          '{{Common::colorStatus(3)}}',
          '{{Common::colorStatus(4)}}'
        ],
        borderColor: [
          '{{Common::colorStatus(0)}}',
          '{{Common::colorStatus(5)}}',
          '{{Common::colorStatus(1)}}',
          '{{Common::colorStatus(2)}}',
          '{{Common::colorStatus(3)}}',
          '{{Common::colorStatus(4)}}'
        ],
        borderWidth: 1
      }]
    },
    options: {
      cutoutPercentage: 80,
      responsive: true,
      legend: false,
      legendCallback: function(chart) {
        var legendHtml = [];
        legendHtml.push('<ul class="chart-legend clearfix">');
        var item = chart.data.datasets[0];
        for (var i=0; i < item.data.length; i++) {
          legendHtml.push('<li>');
          legendHtml.push('<span class="chart-legend-icon" style="color:'+ item.backgroundColor[i] +'"><i class="fa fa-circle-o"></i></span>');
          legendHtml.push('<span class="chart-legend-label-text"> '+chart.data.labels[i]+'</span>');
          legendHtml.push('</li>');
        }

        legendHtml.push('</ul>');
        return legendHtml.join("");
      },
      title: {
        display: true,
        text: ''
      },
      animation: {
        animateScale: true,
        animateRotate: true
      }
    }
  });
  $('#pieChart-legend-con').html(pieChartLeads.generateLegend());

  jQuery(document).ready(function(){
    jQuery('.scrollbar-macosx').scrollbar({
      "showArrows": true,
      "scrollx": "advanced",
      "scrolly": "advanced"
    });
  });
</script>
@stop
@section('content')
    <!-- Main row -->
    <div class="row dashboard">
        <div class="col-sm-12 col-lg-6">
            <!-- LEADS LIST -->
            <div class="box box-default" style="height:445px">
                <div class="box-header with-border">
                    <h3 class="box-title">Recent Leads(5 Leads)</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <ul class="ul__users lead__list clearfix">
                            @foreach($recentleads as $recentlead)
                            <li>
                                <span class="lead__box">
                                    <span class="lead__create-at">{{$recentlead->created_date}}</span>
                                    <a class="lead__info" href="{{route('leads.show', $recentlead->id)}}">
                                        <span class="lead__name">{{$recentlead->fullname}}
                                            <span class="lead__status" style="color:{{ $recentlead->status_color }}" >{{$recentlead->status_text}}</span>
                                        </span>
                                        <span class="lead__product">{{$recentlead->product}}</span>
                                    </a>
                                </span>

                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <!-- /.row -->
                </div>
                <div class="box-footer text-center">
                    <a href="{{route('leads.index')}}" class="uppercase">View More Leads &#8594;</a>
                </div>
            </div>
            <!-- /.box -->
            <!--/.box -->
        </div>
        <div class="col-sm-12 col-lg-6">
            <!-- LEADS LIST -->
            <div class="box box-default" style="height:445px">
                <div class="box-header with-border">
                    <h3 class="box-title">Latest status (5 last Leads)</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="chart-responsive" style="width: 650px;height:312px;">
                                <canvas id="pieChartLeads" ></canvas>
                            </div>
                            <!-- ./chart-responsive -->
                        </div>
                        <!-- /.col -->
                        <div class="col-xs-12">
                            <div id="pieChart-legend-con"></div>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <div class="box-footer text-center">
                    <a href="{{route('leads.index')}}" class="uppercase">View More Leads &#8594;</a>
                </div>
            </div>
            <!-- /.box -->
            <!--/.box -->
        </div>
    </div>
    @if(!$isLoginTipster)
    <div class="row dashboard">
        <div class="col-sm-12 col-lg-6">
            <!-- Tipster LIST -->
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">Most active Tipsters( 5 Tipsters)</h3>
                    <a class="box-title pull-right home-lead-sort" href="{{route('dashboard')}}?lead_sort={{$lead_sort == 'asc' ? 'desc' : 'asc'}}">
                        Lead sort
                        @if($lead_sort == 'asc')
                            <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>
                        @else
                            <i class="fa fa-sort-numeric-desc" aria-hidden="true"></i>
                        @endif

                    </a>
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                    <ul class="users-list ul__users clearfix">
                        @foreach($mostactivetipsters as $mostactivetipster)
                            <li>
                                <a href="{{route('tipsters.show', $mostactivetipster->id)}}">
                                    <span class="users-list-avatar">
                                        <img src="{{asset(Utils::$PATH__IMAGE) }}/{{$mostactivetipster->avatar}}" alt="{{$mostactivetipster->username}}">
                                    </span>
                                    <span class="users-list-info">
                                        <span class="users-list-name">
                                            {{$mostactivetipster->username}}
                                        </span>
                                        <span class="users-list-fullname">{{$mostactivetipster->fullname}}</span>

                                    </span>
                                    <span class="users-list-status">
                                        <span class="users-list-status-ttl">Leads: {{$mostactivetipster->countStatus}}</span>
                                        <span class="users-list-status-detail">{!! $mostactivetipster->strStatusLead !!}</span>
                                    </span>
                                    <span class="users-list-points">{{$mostactivetipster->point}} <small>points</small></span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                    <!-- /.users-list -->
                </div>
                <!-- /.box-body -->
                <div class="box-footer text-center">
                    <a href="{{route('tipsters.index')}}" class="uppercase">View More Tipsters &#8594;</a>
                </div>
                <!-- /.box-footer -->
            </div>
            <!--/.box -->
        </div>
        <div class="col-sm-12 col-lg-6">
            <!-- CONSULTANT LIST -->
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">Latest Activities (5 Activities)</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                    <ul class="activities">
                        @foreach($logActivities as $logActivity)
                            <li class="activity">

                                <span class="activity__detail">
                                    <span class="activity__time">{!! Common::dateFormatText($logActivity->created_at) !!}</span>
                                    <span class="activity__info">
                                        <span class="activity__user-name">
                                            <a href="{{route('users.show', $logActivity->user_id)}}" title="{{$logActivity->fullname}}">{{$logActivity->user_name}}</a>
                                        </span>
                                        <span class="activity__description">{{$logActivity->description}}</span>
                                    </span>


                                </span>

                            </li>
                        @endforeach
                    </ul>

                </div>
                <!-- /.box-body -->
                <div class="box-footer text-center">
                    <a href="{{route('activities.index')}}" class="uppercase">View More Activities &#8594;</a>
                </div>
                <!-- /.box-footer -->
            </div>
            <!--/.box -->
        </div>
    </div>
    @endif
    <!-- /.row -->
@endsection