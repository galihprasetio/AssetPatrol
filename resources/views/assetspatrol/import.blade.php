@extends('admin.admin_template')
@section('tittle','Import Asset')

@section('content')
<div class="box">
    <div class="box-header">
    <h3 class="box-tittle"> Import Asset</h3>
    <div class="box-tools pull-right">

        <!-- Collapse Button -->
        <button type="button" class="btn btn-box-tool" data-widget="collapse">
            <i class="fa fa-minus"></i>
        </button>
    </div>
</div>
    
    <div class="box-body">
        
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <form action="{{ route('assetspatrol.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="file" class="form-control">
                    <br>
                    
                    
               
            </div>
        </div>
    </div>
    <div class="box-footer">
        <a href="{{route('assetspatrol.index')}}" class="btn btn-default"> Back</a>
        <button class="btn btn-success pull-right">Import Data Assets</button>
    </form>
    </div>
</div>

@endsection
