@extends('admin.admin_template')
@section('tittle','Edit Patrol Asset')

@section('content')
<div class="box">
    <div class="box-header">
    <h3 class="box-tittle"> Edit Patrol Asset</h3>
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
                {!! Form::text('serial_number', null, ['class' => 'form-control','placeholder'=>'Serial Number','style' => 'text-transform:uppercase','id'=>'serial_number']) !!}
            </div>
            <div class="form-group">
                <strong>Old Asset:</strong>
                {!! Form::text('asset_old', null, ['class' => 'form-control','placeholder'=>'Old Asset','style' => 'text-transform:uppercase','id'=>'asset_old']) !!}
            </div>
            <div class="form-group">
                <strong>New Asset:</strong>
                {!! Form::text('asset_new', null, ['class' => 'form-control','placeholder'=>'New Asset','style' => 'text-transform:uppercase','id'=>'asset_new']) !!}
            </div>
            <div class="form-group">
                <strong>Team:</strong>
                {{-- {!! Form::text('team', null, ['class' => 'form-control','placeholder'=>'Team','style' => 'text-transform:uppercase','id'=>'team']) !!} --}}
                {!! Form::select('team', $team, null, ['class' => 'form-control','placeholder'=>'Team','style' => 'text-transform:uppercase','id'=>'team']) !!}
            </div>
            <div class="form-group">
                <strong>Location:</strong>
                {!! Form::text('location', null, ['class' => 'form-control','placeholder'=>'Location','style' => 'text-transform:uppercase','id'=>'location']) !!}
            </div>
            <div class="form-group">
                <strong>Pic:</strong>
                {!! Form::text('pic', null, ['class' => 'form-control','placeholder'=>'pic','style' => 'text-transform:uppercase','id'=>'pic']) !!}
            </div>
            <div class="form-group">
                    <strong>IT Security Checking:</strong>
                <div class="form-control">
                   
                <label for="">{!! Form::checkbox('label', 'Active', $asset->label, []) !!} Label</label>
                <label for="">{!! Form::checkbox('ad', 'Active', $asset->ad_join, []) !!} AD</label>
                <label for="">{!! Form::checkbox('drm', 'Active', $asset->drm, []) !!} DRM</label>
                <label for="">{!! Form::checkbox('antivirus', 'Active', $asset->antivirus, []) !!} Antivirus</label>
                <label for="">{!! Form::checkbox('hw', 'Active', $asset->hw, []) !!} H/W</label>
                <label for="">{!! Form::checkbox('power', 'Active', $asset->power, []) !!} Power ON/OFF</label>
            </div>
            </div>
            <div class="form-group">
                <strong>Remarks:</strong>
                {!! Form::textarea('remarks', null, ['class' => 'form-control','placeholder'=>'Remarks','style' => 'text-transform:uppercase','id'=>'remarks']) !!}
            </div>
        </div>
    </div>
</div>
    <div class="box-footer">
        <a href="{{route('assetspatrol.index')}}" class="btn btn-default"> Back</a>
        <button type="submit" class="btn btn-primary pull-right"> Submit</button>
    </div>
</div>
{!! Form::close() !!}
@push('script')

<script src="{{ asset('js/assets.js')}}"></script>
<script>
$('#team').select2({
    allowClear : true,
    tags : true,
    /* Add this */
    placeholder: {
            id: "team",
            placeholder: "Select Team"
        },
    
})
function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
    
            reader.onload = function (e) {
                $('#preview')
                    .attr('src', e.target.result);
            };
    
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endpush
@endsection
