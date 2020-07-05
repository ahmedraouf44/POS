@extends("include")
@section("body")
<div class="main-cont">
        <div class="new-pur">
            <h6>Orders</h6>
            <hr>
            <div  data-addui='tabs'>
                <div class="tabs" role='tabs'>


                </div>
                <hr>
                <div role='contents'>

                    <div class="tab1">



                     <form action="/create_order" method="post">
                     @csrf

                     <input type="text" name="customer_name" placeholder="Enter a Customer Name">
                        <!-- <input type="text"  name="customer_number" placeholder="Enter a Customer number"> -->
                        <input type="text"  name="customer_phone" placeholder="Enter a Customer phone">
                        <input type="text" name="customer_address" placeholder="Enter a Customer address">
                        <input type="text" name="customer_branch_number" value="{{$branch_number}}" readonly="readonly" placeholder="Enter a Customer branch number">
                        <input type="number" min="0" name="discount" value="0"  placeholder="Enter a Discount">
                        <input type="number" min="0" name="Tax_amount" value="0"  placeholder="Enter a Tax Amount">
                        <input type="text" id="serial" onchange="getItemStock()"  placeholder="Enter a serial">
                        <!-- <input type="number" name="Net_amount" value=""  placeholder="Enter a Net Amount"> -->
                        <input type="hidden" name="created_by" value="{{$created_by}}"  >
                       <!-- type_master -->
                       <br>
                        <select name="customer_type">
                        <option value="5">تاجر</option>
                        <option value="6">عميل عام</option>

                        </select>

                        <select name="order_type">
                        <option value="9">	بيع</option>
                        <option value="10"> مرتجع</option>

                        </select>

                        <select name="payment_type">
                        <option value="13">	نقدى</option>
                        <option value="14"> فيزا</option>

                        </select>
                        <br>
                            <table id="example2" class="table table-striped table-bordered" style="width:100%">
                            <thead>


                                <tr>



                                    <th>item code</th>

                                    <th> width</th>
                                    <!-- <th>item width</th> -->
                                    <th> Length</th>
                                    <th>item length</th>
                                    <th>quantity</th>
                                    <!-- <th>item quantity</th> -->
                                    <th>item price</th>

                                    <th>Action</th>

                                </tr>
                                </thead>
                                <tbody>
                        @foreach($all_item_stock as $item)
                        <tr>
                            <td>
                            {{$item->item_code}}
                            </td>

                            <td>
                            {{$item->item_width}}
                            </td>
                            <!-- <td>  <input style="width: 132px;"  step="any" type="number" id="Selectedwidth" name="width[]" value="0" min="0"  max="{{$item->item_width}}"></td> -->
                            <td>
                            {{$item->item_length}}
                            </td>
                            <td>  <input style="width: 132px;" step="any" type="number" id="SelectedLength" name="length[]" value="0" min="0"  max="{{$item->item_length}}"></td>
                             <td>
                            {{$item->item_quantity}}
                            </td>
                           <!-- <td>  <input style="width: 132px;" step="any" type="number" id="SelectedQuantity" name="quantity[]" value="0" min="0"  max="{{$item->item_quantity}}"></td> -->
                            <td>
                            {{$item->price->item_price}}
                            </td>
                            <td><input type="checkbox" value="{{$item->item_stock_id}}" name="iditem_stock[]" ></td>
                        </tr>
                        @endforeach
                        </tbody>
                                <tfoot>
                                <tr>
                                <th>item code</th>

                                   <th> width</th>
                                   <!-- <th>item width</th> -->
                                   <th> Length</th>
                                   <th>item length</th>
                                   <th>quantity</th>
                                   <!-- <th>item quantity</th> -->
                                   <th>item price</th>

                                   <th>Action</th>
                                </tr>
                                </tfoot>

                            </table>


                            <button style="width: 19%;" class="btn-sv" name="Draft" value="draft">Draft</button>
                <button style="width: 19%;" class="btn-sv" name="Confirm" value="confirm">Confirm</button>
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


<script type="text/javascript" src="{{asset('Js/ajaxSerial.js')}}"></script>
@endsection

