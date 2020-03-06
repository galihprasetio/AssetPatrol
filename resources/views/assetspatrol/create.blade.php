@extends('admin.admin_template')
@section('tittle','Create Patrol Asset')
@section('content')
<div class="box">
    <div class="box-header">
            
        <h3 class="box-tittle">Create New Patrol Asset</h3>
        <div class="box-tools pull-right">

                <!-- Collapse Button -->
                <button type="button" class="btn btn-box-tool" data-widget="collapse">
                    <i class="fa fa-minus"></i>
                </button>
            </div>
            @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            @include('flash-message')
    </div>
    
    
    <div class="box-body">
        {!! Form::open(array('route'=>'assetspatrol.store','method'=>'POST','enctype'=>'multipart/form-data','name' =>'assets')) !!}
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                
                {{-- <div class="form-group">
                    <strong>Scan Barcode:</strong>
                    <video id="preview" style="width:10%;height:10%;"></video>
                    <div class="form-control">
                    <button class="btn-start">Scan</button>
                    <button class="btn-stop">Stop</button>
                    </div>
                </div> --}}
                <div class="form-group">
                    <strong>Serial Number: </strong>
                    <ul class="codes-list"></ul>
                    <div class="scanner-cam"></div>
                    {!! Form::text('serial_number', null, ['class' => 'form-control','placeholder'=>'Serial Number','style' => 'text-transform:uppercase','id'=>'serial_number','onkeyup' =>'auto_fill()']) !!}

                </div>
                <div class="form-group">
                    <strong>Old Asset:</strong>
                    {!! Form::Number('asset_old', null, ['class' => 'form-control','placeholder'=>'Old Asset','style' => 'text-transform:uppercase','id'=>'asset_old']) !!}
                </div>
                <div class="form-group">
                    <strong>New Asset:</strong>
                    {!! Form::number('asset_new', null, ['class' => 'form-control','placeholder'=>'New Asset','style' => 'text-transform:uppercase','id'=>'asset_new']) !!}
                </div>
                <div class="form-group">
                        <strong>Status:</strong>
                        {{-- {!! Form::text('status', null, ['class' => 'form-control','placeholder'=>'New Asset','style' => 'text-transform:uppercase','id'=>'status']) !!} --}}
                        {!! Form::select('status', $status, null, ['class' => 'form-control','placeholder'=>'Status','style' => 'text-transform:uppercase','id'=>'status']) !!}
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
                    <label for=""><input type="checkbox" id="label" name="label" value="Active"> Label</label>
                    <label for=""><input type="checkbox" id="ad" name="ad" value="Active"> Ad Join</label>
                    <label for=""><input type="checkbox" id="drm" name="drm" value="Active"> DRM</label>
                    
                </div>
                <div class="form-group">
                    <strong>.</strong>  
                    <div class="form-control">
                    <label for=""><input type="checkbox" id="antivirus" name="antivirus" value="Active"> Antivirus</label>
                    <label for=""><input type="checkbox" id="hw" name="hw" value="Active"> H/W</label>
                    <label for=""><input type="checkbox" id="power" name="power" value="Active"> Power ON/OFF</label>
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
        <a href="{{ route('assetspatrol.index')}}" class="btn btn-default"> Back</a>
        <button type="submit" class="btn btn-primary pull-right"> Submit</button>
    </div>
</div>
{!! Form::close() !!}
@push('script')
<script src="{{asset('js/cam/quangga.js')}}"></script>
<script src="{{ asset('js/assets.js')}}"></script>
<script>
//This entire block of script should be in a separate file, and included in each doc in which you want scanner capabilities
function zxinglistener(e){
            localStorage["zxingbarcode"] = "";
            if(e.url.split("\#")[0] == window.location.href){
                window.focus();
                processBarcode(decodeURIComponent(e.newValue));
            }
            window.removeEventListener("storage", zxinglistener, false);
        }
        if(window.location.hash != ""){
            localStorage["zxingbarcode"] = window.location.hash.substr(1);
            self.close();
            window.location.href="about:blank";//In case self.close is disabled
        }else{
            window.addEventListener("hashchange", function(e){
                window.removeEventListener("storage", zxinglistener, false);
                var hash = window.location.hash.substr(1);
                if (hash != "") {
                    window.location.hash = "";
                    processBarcode(decodeURIComponent(hash));
                }
            }, false);
        }
        function getScan(){
            var href = window.location.href.split("\#")[0];
            window.addEventListener("storage", zxinglistener, false);
            zxingWindow = window.open("zxing://scan/?ret=" + encodeURIComponent(href + "#{CODE}"),'_self');
        }
        function processBarcode(b){
                    var d = document.createElement("div");
                    d.innerHTML = b;
                    document.body.appendChild(d);
                }

var serial_number = document.forms["assets"]["serial_number"];    
serial_number.focus();     
$('#team').select2({
    allowClear: true,
    tags:true,
    /* Add this */
    placeholder: {
            id: "team",
            placeholder: "Select Team"
        },
});
$('#status').select2({
    allowClear: true,
    tags:true,
    /* Add this */
    placeholder: {
            id: "status",
            placeholder: "Select Status"
        },
});

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
function auto_fill(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        id = document.getElementById('serial_number').value;
        //alert(id);
            $.ajax({
            url:'{{route('assetspatrol.searchAsset')}}',
            type: "GET",
            dataType: 'json',
            data: "id="+id,
            success:function(data){
               
               $('#asset_old').val(data.asset_old);
               $('#asset_new').val(data.asset_new);
               $('#status').val(data.status).change();
               $('#team').val(data.team).change();
               $('#location').val(data.location);
               $('#pic').val(data.pic);
            //    $("#status").val(data.id_manufacture).change();
            //    $("#id_category").val(data.id_category).change();
            //    $("#id_location").val(data.id_location).change();  
              
               
               
            }
            });
                
      
    }
//InstaScan
//      let scanner = new Instascan.Scanner({
//         //   // Whether to scan continuously for QR codes. If false, use scanner.scan() to manually scan.
//         //   // If true, the scanner emits the "scan" event when a QR code is scanned. Default true.
//         //   continuous: true,

//           video: document.getElementById('preview')
//         //   // Whether to include the scanned image data as part of the scan result. See the "scan" event
//         //   // for image format details. Default false.
//         //   captureImage: false,
//         //   // Only applies to continuous mode. Whether to actively scan when the tab is not active.
//         //   // When false, this reduces CPU usage when the tab is not active. Default true.
//         //   backgroundScan: true,
//         //   // Only applies to continuous mode. The period, in milliseconds, before the same QR code
//         //   // will be recognized in succession. Default 5000 (5 seconds).
//         //   refractoryPeriod: 5000,

//         //   // Only applies to continuous mode. The period, in rendered frames, between scans. A lower scan period
//         //   // increases CPU usage but makes scan response faster. Default 1 (i.e. analyze every frame).
//         //   scanPeriod: 1  
//         });
//       scanner.addListener('scan', function (content) {
//         console.log(content);
//         $('#serial_number').val(content);
//       });

      
// $(".btn-start").click(function(e){
// e.preventDefault();
// Instascan.Camera.getCameras().then(function (cameras) {
//         if (cameras.length > 0) {
//           scanner.start(cameras[0]);
//         } else {
//           console.error('No cameras found.');
//         }
//       }).catch(function (e) {
//         console.error(e);
//       }); 
// });
// $(".btn-stop").click(function(e){
// e.preventDefault();
//     scanner.stop();
// });

   
</script>
@endpush
@endsection