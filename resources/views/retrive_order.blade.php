@extends("include")


<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css
">
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js
"></script>


@section("body")


<!--  -->

<div class="main-cont">
        <div class="new-pur">
            <h6> All Orders</h6>
            <hr>
            <div  data-addui='tabs'>
                <div class="tabs" role='tabs'>


                </div>
                <hr>
                <div role='contents'>

                    <div class="tab1">
                   
                        <!-- <form  method="post">
                            @csrf -->
                            <table id="example2" class="table table-striped table-bordered" style="width:100%  ">
                                <thead>
                                <tr>
                                <th colspan="7">order number</th>
                                   
                                   <!-- <th> width</th> -->
                                   <!-- <th>item width</th> -->
                                   <!-- <th> Length</th>
                                   <th>item length</th>
                                   <th>quantity</th> -->
                                   <!-- <th>item quantity</th> -->
                                   <!-- <th>item price</th>-->
                                 
                                   <th>Action</th> 
                                </tr>
                                </thead>
                                <tbody>
                               @foreach($allConfirmedOrders as $order)
                                    <tr>
                                      
                                        <td colspan="7" >{{$order->order_number}}</td>
                                        <!-- <td>ghg</td>
                                        <td>ghg</td>
                                        <td>ghg</td>
                                        <td>ghg</td>
                                        <td>ghg</td> -->
                     
       <td> <a  data-toggle="collapse" data-target="#{{$order->order_number}}" aria-expanded="true" aria-controls="{{$order->order_number}}">
         Show order Details
        </a>
  
        </td>
                                      
                                    </tr>
                                    <tr>
                                    
                                    <td colspan="7">
                                    <div id="{{$order->order_number}}" class="collapse " aria-labelledby="headingOne">
      <div class="card-body">
      <form action="/retrive_order/{{$order->order_number}}" method="post">
                     @csrf
      <table id="example2" class="table table-striped table-bordered" style="width:100% ">
                                <thead>
                                <tr>
                                
                                <th>item code</th>
                                <th>item serial</th>
                                <th>item class</th>
                                <th>item width</th>
                                   
                                   <th> item Length</th>
                                  
                                   <th> item quantity</th>
                                   <!-- <th>item quantity</th> -->
                                   <th>item price</th>
                                   <th>item total price</th>
                                 
                                   <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                               <input type="hidden" name="branch_number" value="{{$order->branch_number}}">
                                @foreach($order->details as $orderdetails)
                                <tr>
                                <td>{{$orderdetails->item_code}}</td>
                                <td>{{$orderdetails->item_serial}}</td>
                                <td>{{$orderdetails->item_class}}</td>
                                <td>{{$orderdetails->item_width}}</td>
                                <td>{{$orderdetails->item_length}}</td>
                                <td>{{$orderdetails->item_quantity}}</td>
                                <td>{{$orderdetails->item_price}}</td>
                                <td>{{$orderdetails->total_price}}</td>
                                </tr>
                                @endforeach
                                </tbody>
                                </table>
                                <button style="width: 19%;" class="btn-sv" name="Confirm" value="confirm">Confirm</button>

                                </form>
      </div>
    </div>
                                    </td></tr>
                                @endforeach


                                </tbody>
                                <tfoot>
                                <tr>
                                <th>item code</th>
                                <th>item serial</th>
                                <th>item class</th>
                                <th>item width</th>
                                   
                                   <th> item Length</th>
                                  
                                   <th> item quantity</th>
                                   <!-- <th>item quantity</th> -->
                                   <th>item price</th>
                                   <th>item total price</th>
                                 
                                   <th>Action</th>
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

