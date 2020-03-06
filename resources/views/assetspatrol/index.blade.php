@extends('admin.admin_template')
@section('tittle','List Patrol Asset')
@push('header-name')
<h1>
    IT Assets
<small>
    <a class="btn btn-success" href="{{route('assetspatrol.create')}}"> Create New Patrol Asset</a>
    <a class="btn btn-success" href="{{route('assetspatrol.export')}}"> Export Excel</a>
</small>
</h1>

<ol class="breadcrumb">
    
    <li><a href="{{url('dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Patrol Assets</li>
</ol>
@endpush
@section('content')
<div class="box">
    <div class="box-header">


            <div class="box-tools pull-right">

                    <!-- Collapse Button -->
                    <button type="button" class="btn btn-box-tool" data-widget="collapse">
                        <i class="fa fa-minus"></i>
                    </button>
                </div>
                <!-- /.box-tools -->
    </div>
    <div class="box-body">
        <table id="asset-table" class="table table-bordered" style="width:100%">
            <thead>
                <tr>
                    {{-- <th>Id</th> --}}
                    <th>Serial</th>
                    <th>Old Asset</th>
                    <th>New Asset</th>
                    <th>Team</th>
                    <th>Location</th>
                    <th>Pic</th>
                    <th>Action</th>
                    
                </tr>
            </thead>
           <tbody>
               @foreach ($asset as $item)
                   <tr>
                       <td>{{ $item->serial_number}}</td>
                       <td>{{ $item->asset_old}}</td>
                       <td>{{ $item->asset_new}}</td>
                       <td>{{ $item->team}}</td>
                       <td>{{ $item->location}}</td>
                       <td>{{ $item->pic}}</td>
                       <td>
                           
                            <a href="{{route('assetspatrol.show',$item->id)}}" class="btn btn-xs btn-default"><i class="glyphicon glyphicon-eye-open"></i> Detail</a>
                            <a href="{{route('assetspatrol.edit',$item->id)}}" class="btn btn-xs btn-default"><i class="glyphicon glyphicon-edit"></i> Edit</a>
                            {{-- <a href="" class="btn btn-xs btn-default btn-delete"><i class="glyphicon glyphicon-trash"></i> Delete</a> --}}
                            <div class="btn-group">
                            <form method="POST" action="{{route('assetspatrol.destroy',$item->id)}}">
                                {{csrf_field()}}
                                <input type="hidden" name="_method" value="DELETE" />
                                <button type="submit" class="btn btn-xs btn-default"><i class="glyphicon glyphicon-trash"></i> Delete</button>
                            </form> 
                        </div>
                       </td>
                   </tr>
               @endforeach
           </tbody>
        </table>
    </div>
</div>
    @push('script')
    <script>
    var table = $('#asset-table').DataTable({
        paging:   true,
        info:     true,
        searching: true,
        select: true, 
        scrollX:true,
        "bStateSave": true,
        "fnStateSave": function (oSettings, oData) {
        localStorage.setItem('offersDataTables', JSON.stringify(oData));
        },
        "fnStateLoad": function (oSettings) {
        return JSON.parse(localStorage.getItem('offersDataTables'));
        }
          
    });
    
    
//     dom: 'l<"toolbar">frtip',
//      initComplete: function(){
//       $("div.toolbar")
//          .html('<button type="button" id="any_button" class="btn btn-success pull-right btn-addDetail">Add</button>');           
//    }      
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    </script>
    @endpush
@endsection