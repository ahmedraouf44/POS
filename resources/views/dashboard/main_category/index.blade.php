<section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <div class="box box-primary" style="padding: 15px">
                    <div class="box-header with-border">
                        <h3 class="box-title">All Project Info</h3>
                        <a href="" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Add New Project </a>
                    </div>
                    @include('dashboard.layouts.messages')
                    <!-- /.box-header -->
                    <!-- form start -->
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                      
                        <tr>
                            <th>id</th>
                            <th>Name</th>
                            <th>image</th>
                           
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                        <th>id</th>
                            <th>Name</th>
                            <th>image</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @if($all_Main)
                            @foreach($all_Main as $main)
                                <tr>
                                    <td>{{$main->id}}</td>
                                    <td>{{$main->name}}</td>
                                    <td>{{$main->image}}</td>
                                    <td><img src="{{$main->image ? asset($main->image) : asset('dashboard/img/picture.png')}}" style="width: 50px" alt="slide image" > </td>
                                   
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>

                 
                </div>
            </div>
        </div>
    </section>
  
<script type="text/javascript">
      var table5 = $('#example1').DataTable();
</script>