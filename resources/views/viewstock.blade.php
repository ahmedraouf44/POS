@extends("include")




@section("body")

    <div class="main-cont">
        <div class="new-pur">
            <h6>stock</h6>
            <hr>
            <div  data-addui='tabs'>
                <div class="tabs" role='tabs'>
                    <div><i class="fas fa-shopping-cart"></i> own</div>
                    <div><i class="far fa-file-alt"></i> branches</div>

                </div>
                <hr>
                <div role='contents'>
                    <div class="tab1">

                        <form action="/stock2" method="post">
                            @csrf
                            <table id="example" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Total quantity</th>
                                    <th>Branch Name</th>
{{--                                    <th>Request quantity</th>--}}
{{--                                    <th>check box</th>--}}

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($getstockformainbranch as $getbstock)
                                    <tr>
                                        <td>{{$getbstock->products->name}}</td>
                                        <td>{{$getbstock->quntity}}</td>
                                        <td>{{$getbstock->branch->title}}</td>
{{--                                        <td><input type="text" name="quantity[]"></td>--}}
{{--                                        <td><input type="checkbox" value="{{$getbstock->id}}" name="idstock[]" ></td>--}}
                                    </tr>
                                @endforeach



                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Name</th>
                                    <th>Total quantity</th>
                                    <th>Branch Name</th>
{{--                                    <th>Request quantity</th>--}}
{{--                                    <th>check box</th>--}}
                                </tr>
                                </tfoot>
                            </table>
                            <input type="submit">
                        </form>

                    </div>{{-- //main category--}}
{{--                   ccccccccccc--}}

                    <div class="tab1">

                        <form action="/stock2" method="post">
                            @csrf
                            <table id="example2" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Total quantity</th>
                                    <th>Branch Name</th>
{{--                                    <th>Request quantity</th>--}}
{{--                                    <th>check box</th>--}}

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($allstockforallbranches as $allstockforallbranches)
                                    <tr>
                                        <td>{{$allstockforallbranches->products->name}}</td>
                                        <td>{{$allstockforallbranches->quntity}}</td>
                                        <td>{{$allstockforallbranches->branch->title}}</td>
{{--                                        <td><input type="text" name="quantity[]"></td>--}}
{{--                                        <td><input type="checkbox" value="{{$getbstock->id}}" name="idstock[]" ></td>--}}
                                    </tr>
                                @endforeach



                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Name</th>
                                    <th>Total quantity</th>
                                    <th>Branch Name</th>
{{--                                    <th>Request quantity</th>--}}
{{--                                    <th>check box</th>--}}
                                </tr>
                                </tfoot>
                            </table>
                            <input type="submit">
                        </form>

                    </div>{{-- //main category--}}
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

