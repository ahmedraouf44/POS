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
            <h4>إضافة سعر</h4>
            <button class="pop-cls">x</button>
            <div class="clear-fix"></div>
            <hr>
            <form action="{{url('/addPriceList')}}" method="post">
                @csrf
                <div class="form-group row">
                    <label for="staticEmail" class="col-2 col-form-label">كود السعر</label>
                    <div>
                        <input class="form-control" type="number" name="ref_code" placeholder="كود السعر">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" class="col-2 col-form-label">السعر</label>
                    <div>
                        <input class="form-control" type="number" step="any" name="item_price" placeholder="السعر">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" class="col-2 col-form-label">نوع السعر</label>
                    <div>
                        <select class="form-control" name="type">
                                <option value="12">فرع عادي</option>
                                <option value="2">وكالات</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" class="col-2 col-form-label">يبدأ في</label>
                    <div>
                        <input class="form-control" type="date" name="start_date" placeholder=" يبدأ في"/>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" class="col-2 col-form-label">ينتهي في</label>
                    <div>
                        <input class="form-control" type="date" name="end_date" placeholder="ينتهي في"/>
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
            <h6>قائمة الاسعار</h6>
            <!----start herr ---->

            <button class="show-pop"><i class="fas fa-plus"></i></button>

            <table id="example5" class="table table-striped table-bordered" style="width:100%" dir="ltr">
                <thead>
                <tr>
                    <th></th>
                    <th>كود السعر</th>
                    <th>السعر</th>
                    <th>يبدأ في</th>
                    <th>ينتهي في</th>
                    <th>نوع السعر</th>
                </tr>
                </thead>
                <tbody>

                @foreach($priceLists as $price)
                    <tr>
                        <td>
                            <div class="modal fade bd-example-modal-lg" id="editprice{{$price->price_list_id}}" tabindex="-1" role="dialog"
                                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">تعديل السعر</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{url('/editPriceList'.'/'.$price->price_list_id)}}" method="post">
                                                @csrf
                                                <div class="form-group row">
                                                    <label for="staticEmail" class="col-2 col-form-label">كود السعر</label>
                                                    <div>
                                                        <input class="form-control" type="number" name="ref_code" value="{{$price->ref_code}}" placeholder="كود السعر">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="staticEmail" class="col-2 col-form-label">السعر</label>
                                                    <div>
                                                        <input class="form-control" type="number" step="any" name="item_price" value="{{$price->item_price}}" placeholder="السعر">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="staticEmail" class="col-2 col-form-label">نوع السعر</label>
                                                    <div>
                                                        <select class="form-control" name="type">
                                                            @if($price->type == 12)
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
                                                    <label for="staticEmail" class="col-2 col-form-label">يبدأ في</label>
                                                    <div>
                                                        <input class="form-control" type="date" name="start_date" value="{{$price->start_date}}" placeholder=" يبدأ في"/>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="staticEmail" class="col-2 col-form-label">ينتهي في</label>
                                                    <div>
                                                        <input class="form-control" type="date" name="end_date" value="{{$price->end_date}}" placeholder="ينتهي في"/>
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
                            <a style="width:41%" href="{{url('/deletePriceList'.'/'.$price->price_list_id)}}" onclick="return confirm('هل أنت متأكد من حذف هذا العنصر ؟');" class="btn btn-danger">حذف السعر</a>
                            <a style="width:41%; color: #FFF;" type="button" class="btn btn-primary" data-toggle="modal"
                               data-target="#editprice{{$price->price_list_id}}">تعديل السعر
                            </a>
                        </td>
                        <td>{{$price->ref_code}}</td>
                        <td>{{$price->item_price}}</td>
                        <td>{{$price->start_date}}</td>
                        <td>{{$price->end_date}}</td>
                        @if($price->type==2)
                            <td> وكالات</td>
                        @else
                            <td> فرع عادي</td>
                        @endif

                    </tr>
                @endforeach

                </tbody>


                <tfoot>
                <tr>
                    <th></th>
                    <th>كود السعر</th>
                    <th>السعر</th>
                    <th>يبدأ في</th>
                    <th>ينتهي في</th>
                    <th>نوع السعر</th>


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





