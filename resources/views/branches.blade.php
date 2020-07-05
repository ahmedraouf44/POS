@extends("include")

@section("body")

    <!-- Main Section ------------------------------------------------------------------------------->
   <style>
        .over-divs-2 {
            width: 100%;
            height: 100vh;
            position: fixed;
            z-index: 999;
            background-color: #242833dc;
            display: none
        }
        .pop-up {
            width: 65%;
            height: 480px;
            position: absolute;
            top: -600px;
            right: 280px;
            background-color: #FFF;
            padding: 30px;
            overflow-y: scroll;
        }

        .pop-up span {
            color: red
        }

        .pop-up input {
            display: block;
            width: 220px;
            margin-bottom: 12px;
            padding: 3px
        }

        .pop-up h4 {
            margin-bottom: 20px;
            direction: rtl;
            float: right
        }

        .pop-up ul {
            list-style: none;
        }

        .pop-up textarea,
        .txt-ar ul {
            float: right;
            display: inline-block;
        }
        .pop-up textarea {
            margin-right: 20px
        }

        .pop-up .pop-up-prt1 {
            float: right;
            margin-top: 20px;
            direction: rtl;
            text-align:right
        }

        .pop-up .pop-up-prt2 {
            float: right;
            margin-top: 20px;
            direction: rtl;
            text-align: right
        }

        .pop-up-prt1 ul {
            float: right;
            list-style: none;
            margin-right: 10px;
        }

        .pop-up-prt1 .inpu {
            float: left;
        }

        .pop-up-prt2 ul {
            float: right;
            list-style: none;
            margin-right: 205px;
        }

        .pop-up-prt2 .inpu {
            float: left;
        }

        .pop-up ul li {
            margin-bottom: 17px;
            padding: 3px
        }
        .pop-up button {
            float: right;
            width: 100px;
            height: 35px;
            text-transform: uppercase;
            border-style: none;
            margin: 1px 5px;
            border-radius: 3px;
            cursor: pointer;
        }
        .show-pop {
            float: right;
            margin-bottom: 15px
        }
        .pop-cls {
            width: auto !important;
            float: left !important;
            padding: 0px 10px !important;
            background-color: transparent !important;
            color: red;
            font-size: 14px;
            font-weight: bold;
        }
    </style>
    <!-- popup -->
    <div class="over-divs-2">
        <div class="pop-up">
            <h4>إضافة فرع</h4>
            <button class="pop-cls">x</button>
            <div class="clear-fix"></div>
            <hr>
            <form action="{{url('/addbranch')}}" method="post">
                @csrf
                <div class="form-group row">
                    <label for="staticEmail" class="col-2 col-form-label">اسم الفرع</label>
                    <div>
                        <input class="form-control" type="text" name="branch_name" placeholder="ادخل اسم الفرع">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" class="col-2 col-form-label">رقم الهاتف</label>
                    <div>
                        <input class="form-control" type="number" name="branch_phone"  placeholder="ادخل رقم الهاتف">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" class="col-2 col-form-label">نوع الفرع</label>
                    <div>
                        <select class="form-control" name="branch_type">
                            <option value="12">فرع عادي</option>
                            <option value="2">وكالات</option>
                        </select>

                        {{--                                        <input type="text" name="item_group" class="form-control" placeholder="item_group">--}}
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" class="col-2 col-form-label">البريد الالكترونى</label>
                    <div>
                        <input class="form-control" type="email" name="branch_email" placeholder=" البريد الالكترونى"/>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" class="col-2 col-form-label">العنوان</label>
                    <div>
                        <input class="form-control" type="text" name="branch_address" placeholder="العنوان"/>
                    </div>
                </div>
                <hr>
                <button class="btn-cls-2">إغلاق</button>
                <button type="submit" class="btn-sv">حفظ</button>
            </form>
        </div>
    </div>
    <!-- end popup -->
    <!-- popup -->

    <!-- end popup -->

    <div class="main-cont">
        <div class="new-pur">
            <h6>قائمة الفروع</h6>
            <!----start herr ---->

            <button class="show-pop"><i class="fas fa-plus"></i></button>

            <table id="example5" class="table table-striped table-bordered" style="width:100%" dir="ltr">
                <thead>
                <tr>
                    <th></th>
                    <th></th>
                    <th>نوع الفرع</th>
                    <th>الايميل</th>
                    <th>رقم التليفون</th>
                    <th>اسم الفرع</th>
                    <th>كود الفرع</th>


                </tr>
                </thead>
                <tbody>

                @foreach($AllBranches as $branches)
                    <tr>
                        <td>
                            <div class="modal fade bd-example-modal-lg" id="editbracnch{{$branches->branch_id}}" tabindex="-1" role="dialog"
                                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">تعديل الفرع</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{url('/editbranch'.'/'.$branches->branch_id)}}" method="post">
                                                @csrf
                                                <div class="form-group row">
                                                    <label for="staticEmail" class="col-2 col-form-label">اسم الفرع</label>
                                                    <div>
                                                        <input class="form-control" type="text" name="branch_name" value="{{$branches->branch_name}}" placeholder="ادخل اسم الفرع">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="staticEmail" class="col-2 col-form-label">رقم الهاتف</label>
                                                    <div>
                                                        <input class="form-control" type="number" name="branch_phone" value="{{$branches->branch_phone}}" placeholder="ادخل رقم الهاتف">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="staticEmail" class="col-2 col-form-label">نوع الفرع</label>
                                                    <div>
                                                        <select class="form-control" name="branch_type">
                                                            @if($branches->type == 12)
                                                                <option value="12" selected>فرع عادي</option>
                                                                <option value="2">وكالات</option>
                                                            @else
                                                                <option value="12">فرع عادي</option>
                                                                <option value="2" selected>وكالات</option>
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="staticEmail" class="col-2 col-form-label">البريد الالكترونى</label>
                                                    <div>
                                                        <input class="form-control" type="email" name="branch_email" value="{{$branches->branch_email}}" placeholder=" البريد الالكترونى"/>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="staticEmail" class="col-2 col-form-label">العنوان</label>
                                                    <div>
                                                        <input class="form-control" type="text" name="branch_address" value="{{$branches->branch_address}}" placeholder="العنوان"/>
                                                    </div>
                                                </div>
                                                <button class="float-right" type="submit" class="btn-sv btn-primary" value="">حفظ</button>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--  -->
                            <a style="width:41%" href="{{url('/deletebranch'.'/'.$branches->branch_id)}}" onclick="return confirm('هل أنت متأكد من حذف هذا العنصر ؟');" class="btn btn-danger">حذف الفرع</a>
                            <a style="width:41%; color: #FFF;" type="button" class="btn btn-primary" data-toggle="modal"
                               data-target="#editbracnch{{$branches->branch_id}}">تعديل الفرع
                            </a>
                        </td>
                        <td>
                            <!-- The Modal -->
                            <div class="modal" id="cust{{$branches->branch_id}}">

                                <div class="modal-content">

                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title">العملاء</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>

                                    <!-- Modal body -->
                                    <div class="modal-body">

                                        <!-- start -->


                                        <table id="tablecust{{$branches->branch_id}}" class="table table-striped table-bordered"
                                               style="width:100% ">
                                            <thead>
                                            <tr>
                                                <th>الفرع</th>
                                                <th>النوع</th>
                                                <th> العنوان</th>
                                                <th> التليفون</th>
                                                <th>الاسم</th>
                                                <th>رقم العميل</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($branches->customers as $customer)
                                                <tr>
                                                    <td>{{$customer->branch->branch_name}}</td>
                                                    <td>{{$customer->type->type_master_name}}</td>
                                                    <td>{{$customer->customer_address}}</td>
                                                    <td>{{$customer->customer_phone}}</td>
                                                    <td>{{$customer->customer_name}}</td>
                                                    <td>{{$customer->customer_number}}</td>
                                                </tr>
                                            @endforeach


                                            </tbody>
                                            <tfoot>

                                            <th>الفرع</th>
                                            <th>النوع</th>

                                            <th> العنوان</th>

                                            <th> الفون</th>

                                            <th>الاسم</th>
                                            <th>رقم العميل</th>

                                            </tfoot>

                                        </table>

                                        <!-- <button style="width: 19%;" class="btn-sv" name="Confirm" value="confirm">Confirm</button>
                                        <button style="width: 19%;" class="btn-sv" name="partial" value="partial">partial</button> -->


                                        <!-- end -->

                                        <script type="text/javascript">
                                            $(document).ready(function () {
                                                var tablecust{{$branches->branch_id}} = $('#tablecust{{$branches->branch_id}}').DataTable();

                                                $('#button').click(function () {
                                                    alert(tablecust{{$branches->branch_id}}.rows('.selected').data().length + ' row(s) selected');
                                                });

                                            });
                                        </script>
                                    </div>

                                    <!-- Modal footer -->
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">اغلاق</button>
                                    </div>


                                </div>
                            </div>
                            <div class="modal" id="stock{{$branches->branch_id}}">

                                <div class="modal-content">

                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title">المخزون</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>

                                    <!-- Modal body -->
                                    <div class="modal-body">

                                        <!-- start -->


                                        <table id="table{{$branches->branch_id}}" class="table table-striped table-bordered" style="width:100%" dir="ltr">
                                            <thead>
                                            <tr>

                                                <th>الفرع</th>
                                                <th>تاريخ الادخال</th>
                                                <th>الفئه</th>
                                                <th>الطول</th>
                                                <th>العرض</th>
                                                <th>الكميه</th>
                                                <th>السيريال</th>
                                                <th>الكود التسعيرى</th>
                                                <th>الكود المرجعى</th>


                                            </tr>
                                            </thead>
                                            <tbody>

                                            @foreach($branches->stock as $stock )
                                            @if($stock->item_quantity > 0)
                                                <tr>
                                                    <td>{{$stock->branch_number}}</td>
                                                    <td>{{$stock->post_date}}</td>
                                                    <td>{{$stock->item_class}}</td>
                                                    <td>{{$stock->item_length}}</td>
                                                    <td>{{$stock->item_width}}</td>
                                                    <td>{{$stock->item_quantity}}</td>
                                                    <td>{{$stock->item_serial}}</td>
                                                    <td>{{$stock->ref_code}}</td>
                                                    <td>{{$stock->item_code}}</td>
                                                </tr>
                                            @endif
                                            @endforeach
                                            </tbody>
                                            <tfoot>
                                            <th>الفرع</th>
                                            <th>تاريخ الادخال</th>
                                            <th>الفئه</th>
                                            <th>الطول</th>
                                            <th>العرض</th>
                                            <th>الكميه</th>
                                            <th>السيريال</th>
                                            <th>الكود التسعيرى</th>
                                            <th>الكود المرجعى</th>
                                            </tfoot>

                                        </table>

                                        <!-- <button style="width: 19%;" class="btn-sv" name="Confirm" value="confirm">Confirm</button>
                                        <button style="width: 19%;" class="btn-sv" name="partial" value="partial">partial</button> -->


                                        <!-- end -->
                                        <script type="text/javascript">
                                            $(document).ready(function () {
                                                var table{{$branches->branch_id}} = $('#table{{$branches->branch_id}}').DataTable();

                                                $('#button').click(function () {
                                                    alert(table{{$branches->branch_id}}.rows('.selected').data().length + ' row(s) selected');
                                                });





                                            });
                                        </script>

                                    </div>

                                    <!-- Modal footer -->
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">اغلاق</button>
                                    </div>


                                </div>
                            </div>

                            <!--  -->

                            <button style="width:41%" type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#cust{{$branches->branch_id}}">العملاء
                            </button>
{{--                            <a style="width:41%" type="button" class="btn btn-info" href="{{url('/branchStock')}}">المخزون</a>--}}
                            <button style="width:41%" type="button" class="btn btn-primary" data-toggle="modal" data-target="#stock{{$branches->branch_id}}">المخزون</button>

                        </td>
                        <td>{{$branches->branch_type}}</td>
                        <td>{{$branches->branch_email}}</td>
                        <td>{{$branches->branch_phone}}</td>
                        <td>{{$branches->branch_name}}</td>
                        <td>{{$branches->branch_number}}</td>

                    </tr>
                @endforeach

                </tbody>


                <tfoot>
                <tr>
                    <th></th>
                    <th></th>
                    <th>نوع الفرع</th>
                    <th>الايميل</th>
                    <th>رقم التليفون</th>
                    <th>اسم الفرع</th>
                    <th>كود الفرع</th>


                </tr>
                </tfoot>
            </table>


        </div>
    </div>

    <script type="text/javascript">

        $(document).ready(function () {
            //start inline edit

            // pop-up trigger
            $('.show-pop').on('click', function (e) {
                e.preventDefault();
                $('.over-divs-2').fadeIn(500);
                //$('.sel-ord').hide(100);
                $('.pop-up').animate({
                    top: '90px'
                }, 500).delay(500);
            });
            $('.btn-cls-2,.pop-cls').on('click', function(e) {
                e.preventDefault();
                $('.over-divs-2').hide();
            });
        });
    </script>
@endsection





