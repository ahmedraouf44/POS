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
                            <th>color</th>
                           
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                        <th>id</th>
                            <th>color</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @if($colors)
                            @foreach($colors as $color)
                                <tr>
                                    <td>{{$color->id}}</td>
                                    <td>{{$color->name}}</td>
                                 
                                   
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