@extends("include")




@section("body")

    <div class="main-cont">
        <div class="new-pur">
            <h6>تحويل صادر جديد</h6>
            <hr>
            {{--<div class="links">--}}
            {{--<a class="add-row" href="#"><i class="far fa-plus-square"></i> Add User</a>--}}
            {{--</div>--}}
            <form action="{{url('/transfer')}}" method="post" id="send">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="exampleFormControlSelect1">من مخزن</label>
                        <select class="form-control" name="branchFrom" form="send" readonly
                                id="exampleFormControlSelect1">
                            @foreach($branches as $branch)
                                @if($branch->branch_id == $branch_id)
                                    <option value="{{$branch->branch_id}}" selected>{{$branch->branch_name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="exampleFormControlSelect1">الى مخزن</label>
                        <select required class="form-control" name="branchTo" form="send" id="exampleFormControlSelect1">
                            <option value="0">To</option>
                            @foreach($branches as $branch)
                                @if($branch->branch_id != $branch_id)
                                    <option value="{{$branch->branch_id}}">{{$branch->branch_name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="export">نوع الاذن</label>
                        <input class="form-control" type="text" name="name" value="صادر" disabled id="export">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="docnumber">رقم التحويل</label>
                        <input class="form-control" id="docnumber" type="number" name="number" value="{{$docStockId}}" disabled>
                    </div>
                    <div class="form-group col-md-2">


                        <input type="submit" id="sub" class="btn btn-primary"  form="send" value="تحويل"
                               style="background-color: #551646; border: 1px solid #551646">


                    </div>
                </div>








                <br>
                <div class="row">
                    <div class="col">
                        <input class="form-control" type="text" id="serial1" onchange="ItemStock()"

                               placeholder="الرجاء ادخل السيريال">
                    </div>

                    <div class="col"><p>الرقم التسلسلي</p></div>
                </div>
                <input value="حذف" class="btn btn-primary" id="removeitem1" style="clear: both;">

                <table id="example5" class="table table-striped table-bordered" style="width:100%" dir="ltr">
                    <thead>
                    <tr>
                        <th>كود السعر</th>
                        <th>الكمية</th>
                        <th>اسم الصنف</th>
                        <th>الدرجة</th>
                        <th>كود المنتج</th>
                        <th>الطول</th>
                        <th>العرض</th>
                        <th>رقم التسلسل</th>
                        {{--                        <th style="display:none">المخزون</th>--}}


                    </tr>
                    </thead>
                    <tbody>


                    </tbody>


                    <tfoot>
                    <tr>
                        <th>كود السعر</th>
                        <th>الكمية</th>
                        <th>اسم الصنف</th>
                        <th>الدرجة</th>
                        <th>كود المنتج</th>
                        <th>الطول</th>
                        <th>العرض</th>
                        <th>رقم التسلسل</th>
                        {{--                        <th style="display:none">المخزون</th>--}}


                    </tr>
                    </tfoot>
                </table>
            </form>


        </div>
    </div>






    <script type="text/javascript" src="{{asset('Js/ajaxSerial.js')}}"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            var table5 = $('#example5').DataTable();
            $('#example5 tbody').on('click', 'tr', function () {
                if ($(this).hasClass('selected')) {
                    $(this).removeClass('selected');
                } else {
                    table5.$('tr.selected').removeClass('selected');
                    $(this).addClass('selected');
                }
            });
            $('#removeitem1').click(function () {
                table5.row('.selected').remove().draw(false);
            });


            $('#example5 tbody ').on('click', 'tr', function () {
                $(this).toggleClass('selected');
                var checkbox = $(this).find("input[type='checkbox']");
                checkbox.prop('checked', !checkbox.prop("checked"));


            });


        });


    </script>

@endsection

