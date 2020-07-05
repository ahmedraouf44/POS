

    <section class="content-header">
        <h1>
            Projects
            <small>Add Project</small>
        </h1>
        <ol class="breadcrumb">
            <!-- <li><a href=""><i class="fa fa-dashboard"></i> Home</a></li> -->
            <li><a href="">color</a></li>
            <li class="active">Add color</li>
        </ol>
    </section>



    <section class="content">
        @include('dashboard.layouts.messages')
        <form  action="{{route('createSubCategory')}}" enctype="multipart/form-data" method="post">
            
          
           
          
            <div class="row">
                <!-- English Side -->
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                        <h3 class="box-title">Add color Info</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <div class="box-body">
                        <div class="form-group">
                  
               
                 

                            <div class="col-lg-6">
                                <label for="exampleInputEmail1"> Project Images</label>
                                <input type="text" class="form-control" name="name"  id="exampleInputEmail1" placeholder="">
                                <p class="help-block">choose color </p>
                            </div>

                            <div class="col-lg-6">
                                <label for="exampleInputEmail1"> Project Images</label>
                               
                                <select  name="main_category_id"  id="exampleInputEmail1" placeholder="">
                                @foreach($all_Main as $main)
                                <option value="{{$main->id}}">{{$main->name}}</option>
                                @endforeach
                                </select>
                                <p class="help-block">choose color </p>
                            </div>
                       



                          

                        </div>
                    </div>
                    <div class="box-footer">
                        <div class="col-lg-6">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                    </div>
                </div>

            </div>
        </form>
    </section>



