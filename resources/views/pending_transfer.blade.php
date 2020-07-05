@extends("include")




@section("body")

    <div class="main-cont">
        <div class="new-pur">
            <h6>All Products</h6>
            <hr>
            {{--<div class="links">--}}
            {{--<a class="add-row" href="#"><i class="far fa-plus-square"></i> Add User</a>--}}
            {{--</div>--}}
            <form action="{{url('/transfer')}}" method="post">
                @csrf
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Package Name</th>
                        <th>From</th>
                        <th>To</th>
                        <th>Total Quantity</th>
                        <th>Action</th>

                    </tr>
                    </thead>
                    <tbody>
                    {{--                                @foreach($allstockforallbranches as $getbstock)--}}
                    {{--                                    <tr>--}}
                    {{--                                        <td>{{$getbstock->products->name}}</td>--}}
                    {{--                                        <td>{{$getbstock->quntity}}</td>--}}
                    {{--                                        <td>{{$getbstock->branch->title}}</td>--}}
                    {{--                                        <td><input type="text" name="quantity[]"></td>--}}
                    {{--                                        <td><input type="checkbox" value="{{$getbstock->id}}" name="idstock[]" ></td>--}}
                    {{--                                    </tr>--}}
                    {{--                                @endforeach--}}
                    {{--                        <tbody>--}}
                    @foreach(@$pending as $transfer)
                        <tr>
                            <td>{{@$transfer->id}}</td>
                            <td>{{@$transfer->package->name}}</td>
                            <td>{{@$transfer->from_branch->title}}</td>
                            <td>{{@$transfer->to_branch->title}}</td>
                            <td>{{@$transfer->quantity}}</td>
                            <td>{{@$transfer->quantity}}</td>
{{--                            <td><input type="text" name="quantity[{{$getbstock->products->id}}]"></td>--}}

                        </tr>
                    @endforeach



                    </tbody>


                    <tfoot>
                    <tr>
                        <th>Name</th>
                        <th>Total quantity</th>
                        <th>Branch Name</th>
                        <th>Request quantity</th>
                        <th>check box</th>
                    </tr>
                    </tfoot>
                </table>
                <input type="submit">
            </form>


            </form>

        </div>{{-- //main category--}}
        {{--                   ccccccccccc--}}


        {{--                    end cccccccc--}}

    </div>
    </div>
    </div>


    </div>




    {{--    eeeeeeeeeeeee--}}


    <!-- add adress popup -------------------------------------------------------------------------->

    <!-- Main Section ------------------------------------------------------------------------------->







    <script type="text/javascript">
        $(document).ready(function() {
            var table = $('#example').DataTable();

            $('#example tbody ').on( 'click','tr', function () {
                $(this).toggleClass('selected');
                var checkbox =  $(this).find("input[type='checkbox']");
                checkbox.prop('checked',!checkbox.prop("checked"));



            } );

            $('#button').click( function () {
                alert( table.rows('.selected').data().length +' row(s) selected' );
            } );
        } );


        $(document).ready(function() {
            var table = $('#example2').DataTable();

            $('#example tbody ').on( 'click','tr', function () {
                $(this).toggleClass('selected');
                var checkbox =  $(this).find("input[type='checkbox']");
                checkbox.prop('checked',!checkbox.prop("checked"));



            } );

            $('#button').click( function () {
                alert( table.rows('.selected').data().length +' row(s) selected' );
            } );
        } );
    </script>

@endsection

