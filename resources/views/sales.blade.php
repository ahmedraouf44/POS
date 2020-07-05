@extends("include")

@section("body")



    <div class="main-cont">
        <div class="new-pur">
            <h6> المبيعات</h6>
            <hr>

            @csrf
            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                <tr>
                <th> اسم العميل</th>
                <th> تليفون العميل </th>
                    <th> تاريخ البيع</th>

                    <th>الخصم</th>
                    <th>الضريبه</th>
                    <th> صافي البيع</th>
                    <th>  نوع العملية</th>
                    <th>  التحصيل</th>
                    <th> السعر الكلي</th>
                   

                    <th style="text-align:center">رقم الفاتورة</th>
                </tr>
                </thead>
                <tbody>

                @foreach($allSales as $order)
                    <tr>
                    <td>{{$order->customer_name}} </td>
                        <td>{{$order->customer_phone}} </td>
                        <td>{{$order->order_date}} </td>
                        <td>{{$order->discount}}</td>

                        <td>{{$order->tax_amount}} </td>
                        <td>{{$order->net_amount}} </td>
                        <td> @if($order->order_status==0)
                        <a style="width:41%" data-toggle="modal" data-target="#{{$order->order_number}}" class="btn btn-warning"   href="">محجوز </a>
                        @else
                        <p style="width:41%"  class="btn btn-primary"  >مباع </p>
                        @endif</td>
                        <td> 
                        @if($order->collect==0 )
                        @if( $order->order_status==0)
                        <a style="width:57%" data-toggle="modal" onclick="collect()"  class="btn btn-warning"  >لم يتم التحصيل </a>
                        @else
                        <a style="width:57%" data-toggle="modal" onclick="collect()" data-target="#{{$order->order_number}}" class="btn btn-warning"  href="">لم يتم التحصيل </a>
                         @endif
                       
                        @else
                        <p style="width:57%"  class="btn btn-primary"  >تم التحصيل </p>
                        @endif
                        </td>



                        <td>
                        {{$order->total_amount}}
                        <!-- The Modal -->
                            <div class="modal" id="{{$order->order_number}}">

                                <div class="modal-content">

                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title"> امر بيع</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>

                                    <!-- Modal body -->
                                    <div class="modal-body">

                                        <!-- start -->


                                        <form action="/confirmReservedOrder/{{$order->order_number}}" method="post">
                                            @csrf
                                            <table id="table{{$order->order_number}}" class="table table-striped table-bordered"
                                                   style="width:100% ">
                                                <thead>
                                                <tr>

                                                    <th>الكود</th>
                                                    <th>الرقم التسلسلي</th>
                                                    <th>الصنف</th>
                                                    <th> اسم الصنف</th>

                                                    <th>العرض</th>

                                                    <th> الطول</th>

                                                    <th> الكمية</th>
                                                    <!-- <th>item quantity</th> -->
                                                    <th>السعر</th>
                                                    <th>صافي المبلغ</th>


                                                </tr>
                                                </thead>
                                                <tbody>

                                                @foreach($order->details as $orderdetails)
                                                    <tr>
                                                        <td>{{$orderdetails->item_code}}</td>
                                                        <td>{{$orderdetails->item_serial}}</td>
                                                        <td>{{$orderdetails->item_class}}</td>
                                                        <td>{{$orderdetails->itemmaster->quality}}</td>
                                                        <td>{{$orderdetails->item_width}}</td>
                                                        <td>{{$orderdetails->item_length}}</td>
                                                        <td>{{$orderdetails->item_quantity}}</td>
                                                        <td>{{$orderdetails->item_price}}</td>
                                                        <td>{{$orderdetails->total_price}}</td>


                                                    </tr>
                                                @endforeach
                                                </tbody>

                                            </table>
                                            <input type="hidden" name="branch_number" value="{{$order->branch_number}}">
                                            <input type="hidden" name="order_number" value="{{$order->order_number}}">
                                            @if($order->order_status==0)
                                            <button style="width: 19%;" class="btn-sv" name="Confirm"  value="confirm">تأكيد بيع</button>
                                            @endif
                                          
                                            @if($order->collect==0 && $order->order_status==1 )
                                            <button style="width: 19%;" class="btn-sv"  name="collect" value="collect">تحصيل </button>
                                            @endif
                                            <!-- <button style="width: 19%;" class="btn-sv" name="Confirm" value="confirm">Confirm</button>
                                            <button style="width: 19%;" class="btn-sv" name="partial" value="partial">partial</button> -->
                                        </form>


                                        <!-- end -->

                                        <script type="text/javascript">
                                            $(document).ready(function () {
                                                var table{{$order->order_number}} = $('#table{{$order->order_number}}').DataTable();

                                                $('#button').click(function () {
                                                    alert(table{{$order->order_number}}.rows('.selected').data().length + ' row(s) selected');
                                                });

                                            });
                                        </script>

                                    </div>

                                    <!-- Modal footer -->
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">اغلاق</button>
                                    </div>


                                </div>
                                <!--  -->

                        </td>
                        <td>
                            <button style="width:41%" type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#{{$order->order_number}}">  {{$order->order_number}}</button>

                                   <a style="width:41%"  class="btn btn-primary"  href="{{ route('invoiceGet',$order->order_number) }}">الفاتورة </a>
                        </td>
                    </tr>



                @endforeach


                </tbody>
                <tfoot>
                <tr>
                <th> اسم العميل</th>
                <th> تليفون العميل </th>
                    <th> تاريخ البيع</th>

                    <th>الخصم</th>
                    <th>الضريبه</th>
                    <th> صافي البيع</th>
                    <th>  نوع العملية</th>
                    <th>  التحصيل</th>
                    <th> السعر الكلي</th>
                    <th style="text-align:center">رقم الفاتورة</th>
                </tr>
                </tfoot>
            </table>

        </div>

    </div>
    </div>
    </div>


    </div>




    {{--    eeeeeeeeeeeee--}}


    <!-- add adress popup -------------------------------------------------------------------------->

    <!-- Main Section ------------------------------------------------------------------------------->







    <script type="text/javascript">
        $(document).ready(function () {
            var table = $('#example').DataTable();

            $('#button').click(function () {
                alert(table.rows('.selected').data().length + ' row(s) selected');
            });




        });
    </script>

@endsection
