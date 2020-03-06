@extends('admin.admin_template')
@section('tittle','Show Patrol Asset')

@section('content')
<div class="box">
    <div class="box-header">
    <h3 class="box-tittle"> Show Patrol Asset</h3>
    <div class="box-tools pull-right">

        <!-- Collapse Button -->
        <button type="button" class="btn btn-box-tool" data-widget="collapse">
            <i class="fa fa-minus"></i>
        </button>
    </div>
</div>
    
    <div class="box-body">
        {!! Form::model($asset, ['method'=>'PATCH','route'=>['assetspatrol.update',$asset->id]]) !!}
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Serial Number:</strong>
                    {!! Form::text('serial_number', null, ['class' => 'form-control','placeholder'=>'Serial Number','style' => 'text-transform:uppercase','id'=>'serial_number','readonly']) !!}
                </div>
                <div class="form-group">
                    <strong>Old Asset:</strong>
                    {!! Form::text('asset_old', null, ['class' => 'form-control','placeholder'=>'Old Asset','style' => 'text-transform:uppercase','id'=>'asset_old','readonly']) !!}
                </div>
                <div class="form-group">
                    <strong>New Asset:</strong>
                    {!! Form::text('asset_new', null, ['class' => 'form-control','placeholder'=>'New Asset','style' => 'text-transform:uppercase','id'=>'asset_new','readonly']) !!}
                </div>
                <div class="form-group">
                    <strong>Team:</strong>
                    {!! Form::text('team', null, ['class' => 'form-control','placeholder'=>'Team','style' => 'text-transform:uppercase','id'=>'team','readonly']) !!}
                </div>
                <div class="form-group">
                    <strong>Location:</strong>
                    {!! Form::text('location', null, ['class' => 'form-control','placeholder'=>'Location','style' => 'text-transform:uppercase','id'=>'location','readonly']) !!}
                </div>
                <div class="form-group">
                    <strong>Pic:</strong>
                    {!! Form::text('pic', null, ['class' => 'form-control','placeholder'=>'pic','style' => 'text-transform:uppercase','id'=>'pic','readonly']) !!}
                </div>
                <div class="form-group">
                        <strong>IT Security Checking:</strong>
                    <div class="form-control">
                        
                    <label for="">{!! Form::checkbox('label', 'Active', $asset->label, ['disabled' =>'true']) !!} Label</label>
                    <label for="">{!! Form::checkbox('ad', 'Active', $asset->ad_join, ['disabled' =>'true']) !!} AD</label>
                    <label for="">{!! Form::checkbox('drm', 'Active', $asset->drm, ['disabled' =>'true']) !!} DRM</label>
                    <label for="">{!! Form::checkbox('antivirus', 'Active', $asset->antivirus, ['disabled' =>'true']) !!} Antivirus</label>
                    <label for="">{!! Form::checkbox('hw', 'Active', $asset->hw, ['disabled' =>'true']) !!} H/W</label>
                    <label for="">{!! Form::checkbox('power', 'Active', $asset->power, ['disabled' =>'true']) !!} Power ON/OFF</label>
                    </div>
                </div>
                <div class="form-group">
                    <strong>Remarks:</strong>
                    {!! Form::textarea('remarks', null, ['class' => 'form-control','placeholder'=>'Remarks','style' => 'text-transform:uppercase','id'=>'remarks','readonly']) !!}
                </div>
            </div>
        </div>
    </div>
    <div class="box-footer">
        <a href="{{route('assetspatrol.index')}}" class="btn btn-default"> Back</a>
       
    </div>
</div>
{!! Form::close() !!}
@endsection
