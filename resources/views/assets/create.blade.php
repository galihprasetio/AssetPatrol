@extends('admin.admin_template')
@section('tittle','Create Asset')
@section('content')
<div class="box">
    <div class="box-header">
        <h3 class="box-tittle">Create New Asset</h3>
        <div class="box-tools pull-right">

                <!-- Collapse Button -->
                <button type="button" class="btn btn-box-tool" data-widget="collapse">
                    <i class="fa fa-minus"></i>
                </button>
            </div>
    </div>
    {{-- @if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif --}}
    <div class="box-body">
        {!! Form::open(array('route'=>'assets.store','method'=>'POST','enctype'=>'multipart/form-data')) !!}
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
                        <strong>Status:</strong>
                        {!! Form::text('status', null, ['class' => 'form-control','placeholder'=>'New Asset','style' => 'text-transform:uppercase','id'=>'status']) !!}
                    </div>
                <div class="form-group">
                    <strong>Team:</strong>
                    {!! Form::text('team', null, ['class' => 'form-control','placeholder'=>'Team','style' => 'text-transform:uppercase','id'=>'team']) !!}
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
                    <label for=""><input type="checkbox" id="label" name="label" value="Active"> Label</label>
                    <label for=""><input type="checkbox" id="ad" name="ad" value="Active"> Ad Join</label>
                    <label for=""><input type="checkbox" id="drm" name="drm" value="Active"> DRM</label>
                    <label for=""><input type="checkbox" id="antivirus" name="antivirus" value="Active"> Antivirus</label>
                    <label for=""><input type="checkbox" id="hw" name="hw" value="Active"> H/W</label>
                    <label for=""><input type="checkbox" id="power" name="power" value="Active"> Power ON/OFF</label>
                </div>
                <div class="form-group">
                    <strong>Remarks:</strong>
                    {!! Form::textarea('remarks', null, ['class' => 'form-control','placeholder'=>'Remarks','style' => 'text-transform:uppercase','id'=>'remarks']) !!}
                </div>
            </div>
        </div>
    </div>
    <div class="box-footer">
        <a href="{{ route('assets.index')}}" class="btn btn-default"> Back</a>
        <button type="submit" class="btn btn-primary pull-right"> Submit</button>
    </div>
</div>
{!! Form::close() !!}
@push('script')

<script src="{{ asset('js/assets.js')}}"></script>
<script>
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