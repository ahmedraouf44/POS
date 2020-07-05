@extends("include")




@section("body")
    <div class="main-cont impo">
        <div class="new-pur">
            <h6>التحويلات الواردة الغير مستلمة</h6>
            <hr>
            <table id="example1" class="table table-striped table-bordered" style="width:100%">
                <thead>
                <tr>
                    <th>رقم التحويل</th>
                    <th>تاريخ التحويل</th>
                    <th>من فرع</th>
                    <th>التقاصيل</th>
                </tr>
                </thead>
                <tbody>
                @foreach($pending as $doc)
                    <tr>
                        <td>{{$doc->stock_doc_id}}</td>
                        <td>{{$doc->stock_doc_date}}</td>
                        <td>{{$doc->branchfrom->branch_name}}</td>
                        <td>
                            <!-- Button trigger modal -->

                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#view{{$doc->stock_doc_id}}">
                                عرض التحويل
                            </button>
                            <!-- Modal -->
                            <div class="modal fade bd-example-modal-lg" id="compare{{$doc->stock_doc_id}}"
                                 tabindex="-1" role="dialog"
                                 aria-labelledby="exampleModalLabel" aria-hidden="true" style="z-index: 100000;">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">مطابقة التحويل</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{url('/accept'.'/'.$doc->id)}}" method="get">
                                            @csrf
                                            <div class="modal-body">
                                                <form>
                                                <div class="row">
                                                    <div class="col">
                                                        <input class="form-control" type="text" id="findserial3{{$doc->id}}" onchange="confirmSerial({{$doc->details}},{{$doc->id}})" placeholder="Enter a serial">
                                                    </div>

                                                    <div class="col"><p>الرقم التسلسلي</p></div>
                                                </div>
                                                </form>
                                                <table class="table">
                                                    <thead>
                                                    <tr>
                                                        <th>رقم المنتج</th>
                                                        <th>الكمية</th>
                                                        <th>العرض</th>
                                                        <th>الطول</th>
                                                        <th>مطابقة</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($doc->details as $item)
                                                        <tr id="i{{$item->stock_doc_details_id}}" style="display: none;">
                                                            <td id="serial{{$item->stock_doc_details_id}}">{{$item->item_serial}}</td>
                                                            <td>{{$item->item_quantity}}</td>
                                                            <td>{{$item->item_width}}</td>
                                                            <td>{{$item->item_length}}</td>
                                                            <td>
{{--                                                                <input onchange="check({{$item->stock_doc_details_id}})" type="text" id="item{{$item->stock_doc_details_id}}" name="item[{{$item->stock_doc_details_id}}]" readonly>--}}
                                                                <input id="checked{{$item->stock_doc_details_id}}" name="checked{{$item->stock_doc_details_id}}" type="text" hidden required>
                                                                <span id="append{{$item->stock_doc_details_id}}"></span>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="modal-footer">
                                                <div class="form-group col-md-1">
                                                    <a  class="btn btn-primary" href="{{url('/accept'.'/'.$doc->id)}}">قبول</a>
                                                </div>
                                                <div class="form-group col-md-1">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                    اغلاق
                                                </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="modal" id="view{{$doc->stock_doc_id}}">

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
                                                        <th>الجودة</th>
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
                                                            <td>{{$item->itemMaster->quality}}</td>
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
                                                        <th>الجودة</th>
                                                        <th>الكمية</th>
                                                        <th>الطول</th>
                                                        <th>العرض</th>
                                                        <th>رقم التسلسل</th>
                                                        {{--                        <th style="display:none">المخزون</th>--}}


                                                    </tr>
                                                    </tfoot>
                                                </table>
                                            </form>



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
                                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                                        data-target="#compare{{$doc->stock_doc_id}}">
                                                    مطابقة
                                                </button>


                                            </div>
                                            <div class="form-group col-md-4">
                                                <a class="btn btn-success" href="{{url('/accept'.'/'.$doc->id)}}">استلام الكل</a>
                                            </div>

                                            <div class="form-group col-md-4">
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
                @endforeach

                </tbody>
                <tfoot>
                <tr>
                    <th>رقم التحويل</th>
                    <th>تاريخ التحويل</th>
                    <th>من فرع</th>
                    <th>التقاصيل</th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <div class="main-cont impo">
        <div class="new-pur">
            <h6>التحويلات الواردة</h6>
            <hr>
            <table id="example2" class="table table-striped table-bordered" style="width:100%">
                <thead>
                <tr>
                    <th>رقم التحويل</th>
                    <th>تاريخ التحويل</th>
                    <th>من فرع</th>
                    <th>اجمالي الكمية</th>
{{--                    <th>اجمالي المتر المربع</th>--}}
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
                        <td>{{$doc->branchfrom->branch_name}}</td>
                        <td>{{$totalQuantity}}</td>
{{--                        <td>{{$totalSquare}}</td>--}}
                        <td>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#importview{{$doc->id}}">
                                التفاصيل
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal{{$doc->id}}" tabindex="-1" role="dialog"
                                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">تفاصيل االاذن</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <table class="table">
                                                <thead>
                                                <tr>
                                                    <th>رقم المنتج</th>
                                                    <th>الكمية</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($doc->details as $item)
                                                    <tr>
                                                        <td>{!!DNS1D::getBarcodeSVG($item->item_serial, 'I25',1,33)!!}</td>
                                                        <td>{{$item->item_quantity}}</td>
                                                        {{--                                                                <td>{{$item->branch_number}}</td>--}}
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close
                                            </button>
                                            {{--                                                    <button type="button" class="btn btn-primary">Save changes</button>--}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal" id="importview{{$doc->id}}">

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
                                                وارد
                                            </div>
                                            <div class="form-group col-md-2">
                                                <label for="docnumber">رقم التحويل:</label>
                                                {{$doc->stock_doc_id}}
                                            </div>
                                            <div class="form-group col-md-2">
                                                <label for="docnumber">حاله التحويل:</label>
                                             تم الاستلام


                                            </div>
                                        </div>
                                        <!-- start -->

                                        <form action="{{url('/transfer')}}" method="post" id="send">
                                            @csrf

                                            <br>


                                            <table id="details{{$doc->stock_doc_id}}" class="table table-striped table-bordered"
                                                   style="width:100%" dir="ltr">
                                                <thead>
                                                <tr>
                                                    <th>كود السعر</th>
                                                    <th>كود المنتج</th>
                                                    <th>الجودة</th>
                                                    <th>الدرجة</th>
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
                                                    <th>الجودة</th>
                                                    <th>الدرجة</th>
                                                    <th>الكمية</th>
                                                    <th>الطول</th>
                                                    <th>العرض</th>
                                                    <th>رقم التسلسل</th>
                                                    {{--                        <th style="display:none">المخزون</th>--}}


                                                </tr>
                                                </tfoot>
                                            </table>
                                        </form>



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
                    <th>من فرع</th>
                    <th>اجمالي الكمية</th>
{{--                    <th>اجمالي المتر المربع</th>--}}
                    <th>التفاصيل</th>
                </tr>
                </tfoot>
            </table>

        </div>

    </div>




    {{--    eeeeeeeeeeeee--}}


    <!-- add adress popup -------------------------------------------------------------------------->

    <!-- Main Section ------------------------------------------------------------------------------->







    <script type="text/javascript">

        $(document).ready(function () {
            var table = $('#example1').DataTable();

            $('#example1 tbody ').on('click', 'tr', function () {
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
<script type="text/javascript" src="{{asset('Js/check.js')}}"></script>
@endsection
