@extends("include")




@section("body")

    <div class="main-cont">
        <div class="new-pur">
            <h6>التحويلات الصادرة</h6>
            <hr>
            {{--<div class="links">--}}
            {{--<a class="add-row" href="#"><i class="far fa-plus-square"></i> Add User</a>--}}
            {{--</div>--}}
            @csrf
            <table id="example" class="table table-striped table-bordered" style="width:100%" dir="rtl">
                <thead>
                <tr>
                    <th>رقم التحويل</th>
                    <th>تاريخ التحويل</th>
                    <th>نوع التحويل</th>
                    <th>الي فرع</th>
                    <th>اجمالي الكمية</th>
{{--                    <th>اجمالي المتر المربع</th>--}}
                    <th>الحاله</th>
                    <th>التفاصيل</th>
                </tr>
                </thead>
                <tbody>
                @foreach($docs as $doc)
                    @if(count($doc->details)>0)
                        @php
                            $totalQuantity=0;
                            $totalSquare=0;
                            foreach ($doc->details as $item){
                                $totalQuantity=$totalQuantity+$item->item_quantity;
                                $totalSquare=$totalSquare+($item->item_width*$item->item_length);
                            }
                        @endphp
                    <tr>
                        <td>{{$doc->stock_doc_id}}</td>
                        <td>{{$doc->stock_doc_date}}</td>
                        <td>صادر</td>
                        <td>{{$doc->branchto->branch_name}}</td>
                        <td>{{$totalQuantity}}</td>
{{--                        <td>{{$totalSquare}}</td>--}}
                        <td>{{$doc->stock_doc_status == 1 ? "تم تأكيده":"بانتظار التأكيد"}}</td>
                        <td>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#exampleModal{{$doc->stock_doc_id}}">
                                عرض التحويل
                            </button>

                            <!-- Modal -->

                            <div class="modal" id="exampleModal{{$doc->stock_doc_id}}">

                                <div class="modal-content">

                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">تفاصيل التحويل</h5>

                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>

                                    <!-- Modal body -->
                                    <div class="modal-body">
                                        <div class="form-row">
                                            <div class="form-group col-md-3">
                                                <label for="exampleFormControlSelect1">من مخزن:</label>
                                                {{$doc->branchfrom->branch_name}}
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="exampleFormControlSelect1">الى مخزن:</label>
                                                {{$doc->branchto->branch_name}}

                                            </div>
                                            <div class="form-group col-md-2">
                                                <label for="export">نوع الاذن:</label>
                                                صادر
                                            </div>
                                            <div class="form-group col-md-2">
                                                <label for="docnumber">رقم التحويل:</label>
                                                {{$doc->stock_doc_id}}
                                            </div>
                                            <div class="form-group col-md-2">
                                                <label for="docnumber">حاله التحويل:</label>
                                                {{$doc->stock_doc_status == 1 ? "تم تأكيده":"بانتظار التأكيد"}}


                                            </div>
                                        </div>
                                        <!-- start -->
                                        @if($doc->stock_doc_status == 1)
                                            <table id="table{{$doc->stock_doc_id}}"
                                                   class="table table-striped table-bordered" style="width:100%"
                                                   dir="ltr">
                                                <thead>
                                                <tr>
                                                    <th>كود السعر</th>
                                                    <th>كود المنتج</th>
                                                    <th>اسم الصنف</th>
                                                    <th>الدرجة</th>
                                                    <th>الكمية</th>
                                                    <th>الطول</th>
                                                    <th>العرض</th>
                                                    <th>رقم التسلسل</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($doc ->details as $item)
                                                    <tr>
                                                        <td>{{$item->ref_code}}</td>
                                                        <td>{{$item->item_code}}</td>
                                                        <td>{{$item->itemMaster->quality}}</td>
                                                        <td>{{$item->itemMaster->grade}}</td>
                                                        <td>{{$item->item_quantity}}</td>
                                                        <td>{{$item->item_width}}</td>
                                                        <td>{{$item->item_length}}</td>
                                                        <td>{{$item->item_serial}}</td>
                                                        {{--                                                                <td>{{$item->branch_number}}</td>--}}
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                                <tfoot>
                                                <tr>
                                                    <th>كود السعر</th>
                                                    <th>كود المنتج</th>
                                                    <th>اسم الصنف</th>
                                                    <th>الدرجة</th>
                                                    <th>الكمية</th>
                                                    <th>الطول</th>
                                                    <th>العرض</th>
                                                    <th>رقم التسلسل</th>
                                                </tr>
                                                </tfoot>
                                            </table>
                                        @else
                                            <form action="{{url('/transfer')}}" method="post" id="send">
                                                @csrf

                                                <br>
                                                <div class="row">
                                                    <div class="col">
                                                        <input type="hidden" name="update" value="226" >
                                                        <input type="hidden" name="docid" value="{{$doc->stock_doc_id}}" >
                                                        <input type="hidden" name="branchnumber" value=" {{$doc->branchfrom->branch_number}}" >
                                                        <input class="form-control" type="text" id="itemserial{{$doc->stock_doc_id}}"
                                                               onchange="finditem()"

                                                               placeholder="الرجاء ادخل السيريال">
                                                    </div>

                                                    <div class="col"><p>الرقم التسلسلي</p></div>
                                                </div>
                                                <input value="حذف" class="btn btn-primary" id="removeitem{{$doc->stock_doc_id}}"
                                                       style="clear: both;">

                                                <table id="details{{$doc->stock_doc_id}}" class="table table-striped table-bordered"
                                                       style="width:100%" dir="ltr">
                                                    <thead>
                                                    <tr>
                                                        <th>كود السعر</th>
                                                        <th>كود المنتج</th>
                                                        <th>الكمية</th>
                                                        <th>الطول</th>
                                                        <th>العرض</th>
                                                        <th>رقم التسلسل</th>
                                                        {{--                        <th style="display:none">المخزون</th>--}}


                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    @foreach($doc ->details as $item)
                                                        <tr>

                                                            <td>{{$item->ref_code}}<input type="hidden" name="oldids[]" value="{{$item->stock_doc_details_id}}"></td>
                                                            <td>{{$item->item_code}}</td>
                                                            <td>{{$item->item_quantity}}</td>
                                                            <td>{{$item->item_width}}</td>
                                                            <td>{{$item->item_length}}</td>
                                                            <td>{{$item->item_serial}}</td>
                                                            {{--                                                                <td>{{$item->branch_number}}</td>--}}
                                                        </tr>
                                                    @endforeach
                                                    </tbody>


                                                    <tfoot>
                                                    <tr>
                                                        <th>كود السعر</th>
                                                        <th>كود المنتج</th>
                                                        <th>الكمية</th>
                                                        <th>الطول</th>
                                                        <th>العرض</th>
                                                        <th>رقم التسلسل</th>
                                                        {{--                        <th style="display:none">المخزون</th>--}}


                                                    </tr>
                                                    </tfoot>
                                                </table>
                                            </form>
                                    @endif


                                    <!-- end -->
                                        <script type="text/javascript">
                                            $(document).ready(function () {
                                                var table{{$doc->stock_doc_id}} = $('#table{{$doc->stock_doc_id}}').DataTable();

                                                $('#button').click(function () {
                                                    alert(table{{$doc->stock_doc_id}}.rows('.selected').data().length + ' row(s) selected');
                                                });
                                            });
                                        </script>

                                    </div>

                                    <!-- Modal footer -->
                                    <div class="modal-footer">
                                        <div class="row">
                                            <div class="form-group col-md-4">
                                                @if($doc->stock_doc_status == 1)
                                                @else
                                                    <button type="submit" id="sub" class="btn btn-primary"  >
                                                        تأكيد
                                                    </button>
                                                @endif

                                            </div>
                                            <div class="form-group col-md-2">
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">
                                                    اغلاق
                                                </button>
                                            </div>


                                        </div>


                                    </div>


                                </div>
                            </div>
                        </td>
                    </tr>
                    @endif
                @endforeach

                </tbody>
                <tfoot>
                <tr>
                    <th>رقم التحويل</th>
                    <th>تاريخ التحويل</th>
                    <th>نوع التحويل</th>
                    <th>الي فرع</th>
                    <th>اجمالي الكمية</th>
{{--                    <th>اجمالي المتر المربع</th>--}}
                    <th>الحاله</th>
                    <th>التفاصيل</th>
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
        function finditem()
        {
            // $("#serial").change(function(){
            var item_serial=document.getElementById("itemserial{{$doc->stock_doc_id}}").value;

            $.ajax({
                url: '/itemBySerial',
                type: "GET",
                data:{'serial': item_serial},
                contentType: 'application/json; charset=utf-8',
                success: function (data) {
                    var runners=[100222882,100222884,100222890,100222892,100222900,100222901,100222907,100222908,100222917,100214366,100222727,100222729,100222730,100218359,100214367,100222731,100222732,100222745,100219310,100214359,100214368,100222746,100222747,100216376,100216378,100216380,100216375,100216382,100216383,100216384,100214193,100214192,100214191
                        ,100216366
                        ,100216367
                        ,100216368
                        ,100216370
                        ,100216371
                        ,100216372
                        ,100222899
                        ,100222918
                        ,100219309
                        ,100214358
                        ,100222744
                        ,100216392
                        ,100216374
                        ,100216379
                        ,100216389
                        ,100222919
                        ,100214357
                        ,100222893
                        ,100222909
                        ,100222885
                        ,100222916];

                    console.log(data);
                    var exist = runners.includes( data['item_code']);
                    console.log(exist);
                    var details{{$doc->stock_doc_id}} = $('#details{{$doc->stock_doc_id}}').DataTable();
                    if(exist)
                    {
                        details{{$doc->stock_doc_id}}.row.add([
                            data['ref_code'],
                            data['item_code'],
                            data['item_quantity'],

                            '<td>  <input style="width: 132px;" step="any" type="number" id="SelectedLength" name="length['+data['item_stock_id']+']" value="'+data['item_length']+'" min="0"  max="'+data['item_length']+'"></td>',
                            data['item_width'],
                            data['item_serial'],

                        ]).draw(false);
                    }
                    else if(data['item_serial'] != "not found")
                    {
                        details{{$doc->stock_doc_id}}.row.add([
                            data['ref_code']+'<input  type="hidden" id="newids" name="newids['+data['item_stock_id']+']" value="'+data['item_quantity']+'" >',
                            data['item_code'],
                            data['item_quantity'],
                            data['item_width'],
                            data['item_length'],
                            data['item_serial'],
                        ]).draw(false);
                    }
                    else
                    {
                        alert('هذا المنتج غير موجود');
                    }

                    // table.row.add([
                    //
                    //     data['ref_code'],
                    //     // data['item_quantity'],
                    //     '<td>  <input style="width: 132px;" step="any" type="number" id="Selectedquantity" name="quantity['+data['item_stock_id']+']" value="'+data['item_quantity']+'" readonly></td>',
                    //     data['item_code'],
                    //     data['item_length'],
                    //     // '<td>  <input style="width: 132px;" step="any" type="number" id="SelectedLength" name="length[]" value="'+data['item_length']+'" min="'+data['item_length']+'"  max="'+data['item_length']+'"></td>',
                    //
                    //     data['item_serial'],
                    //
                    // ]).draw(false);


                    document.getElementById("itemserial{{$doc->stock_doc_id}}").value = "";
                    document.getElementById("itemserial{{$doc->stock_doc_id}}").focus();
                }



            });

        }
        $(document).ready(function () {
            $( "#sub" ).click(function() {
                $( "#send" ).submit();
            });
            var details{{$doc->stock_doc_id}} = $('#details{{$doc->stock_doc_id}}').DataTable();
            $('#details{{$doc->stock_doc_id}} tbody').on('click', 'tr', function () {
                if ($(this).hasClass('selected')) {
                    $(this).removeClass('selected');
                } else {
                    details{{$doc->stock_doc_id}}.$('tr.selected').removeClass('selected');
                    $(this).addClass('selected');
                }
            });
            $('#removeitem{{$doc->stock_doc_id}}').click(function () {
                details{{$doc->stock_doc_id}}.row('.selected').remove().draw(false);
            });

            var table = $('#example').DataTable();

            $('#example tbody ').on('click', 'tr', function () {
                $(this).toggleClass('selected');
                var checkbox = $(this).find("input[type='checkbox']");
                checkbox.prop('checked', !checkbox.prop("checked"));


            });

            $('#button').click(function () {
                alert(table.rows('.selected').data().length + ' row(s) selected');
            });
        });


        $(document).ready(function () {

            var table = $('#example2').DataTable();

            $('#example tbody ').on('click', 'tr', function () {
                $(this).toggleClass('selected');
                var checkbox = $(this).find("input[type='checkbox']");
                checkbox.prop('checked', !checkbox.prop("checked"));


            });

            $('#button').click(function () {
                alert(table.rows('.selected').data().length + ' row(s) selected');
            });
        });

    </script>

@endsection
