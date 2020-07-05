@extends("include")


<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css
">
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js
"></script>


@section("body")

    <div class="main-cont">
        <div class="new-pur">
            <h6>stock</h6>
            <hr>
            <div  data-addui='tabs'>
                <div class="tabs" role='tabs'>
{{--                    <div><i class="fas fa-shopping-cart"></i> own</div>--}}
                    <div><i class="far fa-file-alt"></i> branches</div>

                </div>
                <hr>
                <div role='contents'>

{{--             all packages--}}

                    <div class="tab1">

                        <form action="/stockrequestsubmit" method="post">
                            @csrf
                            <table id="example2" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Total quantity</th>
                                    <th>Branch Name</th>
                                    <th>Request quantity</th>
                                    <th>check box</th>
                                    <th style="display: none">id branch</th>
                                    <th style="display: none">product_id</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($allstockforallbranches as $getbstock)
                                    <tr>
                                        <td>{{$getbstock->products->name}}</td>
                                        <td>{{$getbstock->quntity}}</td>
                                        <td>{{$getbstock->branch->title}}</td>
                                        <td><input type="text" name="quantity[]"></td>
                                        <td><input type="checkbox" value="{{$getbstock->id}}" name="idstock[]" ></td>
                                        <td style="display: none"><input type="hidden" class="x" value="{{$getbstock->branch->id}}" name="branchids[]" ></td>
                                        <td style="display: none"><input type="hidden" class="x" value="{{$getbstock->products->id}}" name="productids[]" ></td>
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
                                <input type="hidden" name="user_id" value="{{$user_id}}">
                            </table>


                            <input type="submit" name="submit">
                        </form>

                    </div>{{-- //main category--}}
{{--                    end all packages--}}

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
            console.log( document.getElementsByName('branchids[]').values());
            console.log( $(this).childNodes[0].className=='x');



        } );

        $('#button').click( function () {
            alert( table.rows('.selected').data().length +' row(s) selected' );
        } );
    } );
</script>



@endsection

