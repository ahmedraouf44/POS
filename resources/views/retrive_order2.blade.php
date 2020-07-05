

@extends("include")

@section("body")


<!--  -->

<div class="main-cont">
        <div class="new-pur">
            <h6> المبيعات</h6>
            <hr>
            <div  data-addui='tabs'>
                <div class="tabs" role='tabs'>


                </div>
                <hr>
                <div role='contents'>

                    <div class="tab1">
                   
                        <!-- <form  method="post">
                            @csrf -->
                            <table id="example" class="table table-striped table-bordered" style="width:100%  ">
                                <thead>
                                <tr>
                                <!-- <th style="text-align:center"  >total price</th> -->
                                   
                                   <!-- <th> width</th> -->
                                   <!-- <th>item width</th> -->
                                   <th> السعر الكلي</th>
                                   <th> صافي المبلغ</th>
                                   <th>الخصم</th>
                                   <th>الضريبه</th>
                                   <th style="text-align:center">رقم الفاتورة</th>
                                  
                                 
                                   
                                </tr>
                                </thead>
                                <tbody>
                               @foreach($allConfirmedOrders as $order)
                                    <tr >
                                      
                                  
                                    <td>{{$order->total_amount}} </td>
                            <td>{{$order->net_amount}}</td>
                            <td>{{$order->discount}}</td>
                      
                            <td>
                            {{$order->tax_amount}}
                            <!-- The Modal -->
<div class="modal" id="{{$order->order_number}}">

<div class="modal-content">

<!-- Modal Header -->
<div class="modal-header">
  <h4 class="modal-title">Modal Heading</h4>
  <button type="button" class="close" data-dismiss="modal">&times;</button>
</div>

<!-- Modal body -->
<div class="modal-body">

<!-- start -->



<form action="/retrive_order/{{$order->order_number}}" method="post">
             @csrf
<table id="example3" class="table table-striped table-bordered" style="width:100% ">
                        <thead>
                        <tr >
                        
                        <th>الكود</th>
                        <th>الرقم التسلسلي</th>
                        <th>الصنف</th>
                        <th> اسم الصنف</th>
                        <th>العرض</th>
                           
                           <th> الطول</th>
                          
                           <th>الكمية</th>
                           <!-- <th>item quantity</th> -->
                           <th>السعر</th>
                           <th>اجمالي السعر</th>
                           <th>اختار</th>
                          
                        </tr>
                        </thead>
                        <tbody>
                      
                        @foreach($order->details as $orderdetails)
                        <tr >
                        <td>{{$orderdetails->item_code}}</td>
                        <td>{{$orderdetails->item_serial}}</td>
                        <td>{{$orderdetails->item_class}}</td>
                        <td>{{$orderdetails->itemmaster->quality}}</td>
                        <td>{{$orderdetails->item_width}}</td>
                        <td>{{$orderdetails->item_length}}</td>
                        <td>{{$orderdetails->item_quantity}}</td>
                        <td>{{$orderdetails->item_price}}</td>
                        <td>{{$orderdetails->total_price}}</td>
                        <td><input type="checkbox" value="{{ $orderdetails->order_details_id}}" name="iditem_details[]" ></td>
                       
                        </tr>
                        @endforeach
                        </tbody>
                        </table>
                        <input type="hidden" name="branch_number" value="{{$order->branch_number}}">
                        <button style="width: 19%;" class="btn-sv" name="Confirm" value="confirm">مرتجع كلي</button>
                        <button style="width: 19%;" class="btn-sv" name="partial" value="partial">مرتجع جزئي</button>
                        </form>



<!-- end -->
 


</div>

<!-- Modal footer -->
<div class="modal-footer">
  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
</div>


</div>
<!--  -->

                            </td>
                            <td  >        
        <button style="width:41%" type="button" class="btn btn-primary" data-toggle="modal" data-target="#{{$order->order_number}}">  {{$order->order_number}}</button>
        </td> </tr>
        
        
</td>
</tr>

                                @endforeach


                                </tbody>
                                <tfoot>
                                <tr>
                                <th> السعر الكلي</th>
                                   <th> صافي المبلغ</th>
                                   <th>الخصم</th>
                                   <th>الضريبه</th>
                                   <th>رقم الفاتورة</th>
                                </tr>
                                </tfoot>
                      
                            </table>

<!-- 
                            <input type="submit" name="submit">
                        </form> -->

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

       


//modal checkbox



// td:nth-child(odd)
// $( "#example2 #he tr:even" ).hide();
// var rows = document.querySelectorAll('#example  tr:nth-child(even) td '); /* or even */
// for(var r = 0; r < (rows.length); r++){
//     rows[r].style.display = 'none';
// }
// $('#example tr td:nth-child(6)').show();


// $('#example2 tr td:nth-child(6)').hide();
// $('#example2 tr:nth(2) td:nth-child(1)').hide();
// $('#example2 tr th:nth-child(2)').hide();

        var table = $('#example').DataTable();

        $('#example tbody ').on( 'click','tr', function () {
            // $(this).toggleClass('selected');
        


        } );

        $('#button').click( function () {
            alert( table.rows('.selected').data().length +' row(s) selected' );
        } );
  

 


        var table2 = $('#example3').DataTable();

$('#example3 tbody ').on( 'click','tr', function () {
    // $(this).toggleClass('selected');
    // $(this).toggleClass('selected');
   


} );

$('#button').click( function () {
    alert( table2.rows('.selected').data().length +' row(s) selected' );
} );

} );

</script>



@endsection

