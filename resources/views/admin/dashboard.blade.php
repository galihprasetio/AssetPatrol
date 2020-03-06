@extends('admin.admin_template')
@section('tittle','Dashboard')
@push('header-name')
<h1>
    Dashboard
{{-- <small><a class="btn btn-success" href="{{route('assets.create')}}"> Create New Asset</a></small> --}}

</h1>

<ol class="breadcrumb">
    <li><a href="{{url('dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Dashboard</li>
</ol>
@endpush

@section('content')
<div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-aqua">
      <div class="inner">
        <h3>{{$originalAsset}}</h3>

        <p>Original Assets</p>
      </div>
     <div class="icon">
        <i class="glyphicon glyphicon-qrcode"></i>
      </div> 
      
      <a href="{{route('assets.index')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
          <div class="inner">
            <h3>{{$prePatrolAsset}}</h3>
    
            <p>Pre Patrol Assets</p>
          </div>
         <div class="icon">
            <i class="glyphicon glyphicon-qrcode"></i>
          </div> 
          
          <a href="{{route('assets.prepatrol')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
  <div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-aqua">
      <div class="inner">
        <h3>{{$patrolAsset}}</h3>

        <p>Patrol Assets</p>
      </div>
     <div class="icon">
        <i class="glyphicon glyphicon-qrcode"></i>
      </div> 
      
      <a href="{{route('assetspatrol.index')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <a href="{{route('assetspatrol.create')}}" style="color:aliceblue;">
    <div class="small-box bg-aqua">
      <div class="inner">
        <h3>:.</h3>

        <p>Create Patrol</p>
      </div>
      <div class="icon">
        <i class="glyphicon glyphicon-edit"></i>
      </div>
      <a href="{{route('assetspatrol.create')}}" class="small-box-footer"> Create<i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </a>
  </div>
    
@endsection
@push('script')
    
@endpush
