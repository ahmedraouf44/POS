@extends("include")



@section("body")

    <!-- Main Section ------------------------------------------------------------------------------->

    <div class="main-cont">
        <div class="new-pur mod-titl">
            <h4>منتجات الفرع</h4>
            <div class="clear-fix"></div>
{{--            <b>{{count($items)}}</b>--}}


                <a class="btn btn-success" data-toggle="modal" data-target="#addMaster" style="color: #FFF; margin-bottom: 15px">
                    <i class="far fa-plus-square"></i> اضافة منتج
                </a>
            <div class="float-right">العدد الكلي: <b> {{count($items)}}</b></div>

            @php
                $totalQuantity=0;
                foreach ($items as $item){
                    $totalQuantity=$totalQuantity+$item->item_quantity;
                }
            @endphp
            <div class="float-right" style="margin-right: 60px">اجمالي الكمية: <b> {{count($items)}} م<sup>2</sup></b></div>

            <div class="modal fade bd-example-modal-lg" id="addMaster" tabindex="-1" role="dialog"
                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content pro-stck">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h5 class="modal-title" id="exampleModalLabel">اضافة منتج</h5>
                        </div>
                        <div class="modal-body">
                            <form action="{{url('/addBranchStock')}}" method="POST">
                                @csrf
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-form-label" >كود المنتج</label>
                                    <div>
                                        <select class="form-control" name="item_code">
                                            <option value="0">item_code</option>
                                            @foreach($codes as $code)
                                                <option value="{{$code}}">{{$code}}</option>
                                            @endforeach
                                        </select>
{{--                                        <input type="number" step="any" name="item_code" class="form-control" placeholder="item_code">--}}
                                    </div>

                                    <label for="staticEmail" class="col-form-label">كود السعر</label>
                                    <div>
                                        <select class="form-control" name="ref_code">
                                            <option value="0">ref_code</option>
                                            @foreach($refs as $ref)
                                                <option value="{{$ref}}">{{$ref}}</option>
                                            @endforeach
                                        </select>

{{--                                        <input type="text" name="item_group" class="form-control" placeholder="item_group">--}}
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="staticEmail" class="col-form-label">رقم التسلسل</label>
                                    <div>

                                        <input type="number" step="any" name="item_serial" class="form-control" placeholder="item_serial">
                                    </div>

                                    <label for="staticEmail" class="col-form-label">العرض</label>
                                    <div>
                                        <input type="number" step="any" name="item_width" class="form-control" placeholder="item_width">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="staticEmail" class="col-form-label">الطول</label>
                                    <div>
                                        <input type="number" step="any" name="item_length" class="form-control" placeholder="item_length">
                                    </div>

                                    <label for="staticEmail" class="col-form-label">الفئة</label>
                                    <div>
                                        <select class="form-control" name="item_class">
                                            <option value="0">item_class</option>
                                            @foreach($classes as $class)
                                                <option value="{{$class}}">{{$class}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="input-group row">

                                </div>

                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق
                            </button>
                            {{--                                                    <button type="button" class="btn btn-primary">Save changes</button>--}}
                            <button type="submit" class="btn btn-success" value="Add">أضف</button>
                        </div>
                    </div>
                </div>
            </div>

            <hr>
            <table id="example" class="table table-striped table-bordered" style="width:100%" dir="rtl">
                <thead>
                <tr>
                    <th><i class="fas fa-cog fa-lg"></i> كود المنتج</th>
                    <th>كود السعر</th>
                    <th>رقم التسلسل</th>
                    <th>العرض</th>
                    <th>الطول</th>
                    <th>الكمية</th>
                    <th>اسم الصنف</th>
                    <th>الدرجة</th>
                    <th>التاريخ</th>

                    <th>التحكم</th>
                </tr>
                </thead>
                <tbody>
                @foreach(@$items as $item)
                    @if(!empty($item))
                        <tr>
                            <th>{{$item->item_code}}</th>
                            <th>{{$item->ref_code}}</th>
                            <th>{{$item->item_serial}}</th>
                            <th>{{$item->item_width}}</th>
                            <th>{{$item->item_length}}</th>
                            <th>{{$item->item_quantity}}</th>
                            <th>{{@$item->master->quality}}</th>
                            <th>{{$item->item_class}}</th>
                            <th>{{$item->post_date}}</th>
                            <th>
                                <div class="row" style="margin-right: -3px;">
                                <a class="btn btn-danger" onclick="return confirm('هل أنت متأكد من حذف هذا العنصر ؟');" href="{{url('deleteBranchStock'.'/'.$item->item_stock_id)}}">حذف</a>

                                <a class="btn btn-primary" data-toggle="modal" data-target="#editMaster{{$item->item_stock_id}}" style="color: #FFF;">
                                    تعديل
                                </a>
                                </div>
                            </th>
                        </tr>

                        <div class="modal fade bd-example-modal-lg" id="editMaster{{$item->item_stock_id}}" tabindex="-1" role="dialog"
                             aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">تعديل منتج</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{url('updateBranchStock'.'/'.$item->item_stock_id)}}" method="POST">
                                            @csrf
                                            <input type="text" name="item_id" value="{{@$item->item_stock_id}}" hidden>
                                            <div class="form-group row">
                                                <label for="staticEmail" class="col-2 col-form-label" >كود المنتج</label>
                                                <div>
                                                    <select class="form-control" name="item_code">
                                                        <option value="0">item_code</option>
                                                        @foreach($codes as $code)
                                                            @if($code ==$item->item_code)
                                                            <option value="{{$code}}" selected>{{$code}}</option>
                                                            @else
                                                            <option value="{{$code}}">{{$code}}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="staticEmail" class="col-2 col-form-label">كود السعر</label>
                                                <div>
                                                    <select class="form-control" name="ref_code">
                                                        <option value="0">ref_code</option>
                                                        @foreach($refs as $ref)
                                                            @if($ref ==$item->ref_code)
                                                                <option value="{{$ref}}" selected>{{$ref}}</option>
                                                            @else
                                                                <option value="{{$ref}}">{{$ref}}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="staticEmail" class="col-2 col-form-label">رقم التسلسل</label>
                                                <div>
                                                    <input type="number" step="any" name="item_serial" class="form-control" value="{{@$item->item_serial}}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="staticEmail" class="col-2 col-form-label">العرض</label>
                                                <div>
                                                    <input type="number" step="any" name="item_width" class="form-control" value="{{@$item->item_width}}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="staticEmail" class="col-2 col-form-label">الطول</label>
                                                <div>
                                                    <input type="number" step="any" name="item_length" class="form-control" value="{{@$item->item_length}}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="staticEmail" class="col-2 col-form-label">الفئة</label>
                                                <div>
                                                    <select class="form-control" name="item_class">
                                                        <option value="0">item_class</option>
                                                        @foreach($classes as $class)
                                                            @if($class ==$item->item_class)
                                                                <option value="{{$class}}" selected>{{$class}}</option>
                                                            @else
                                                                <option value="{{$class}}">{{$class}}</option>
                                                            @endif

                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
{{--daasd--}}

                                            <div class="input-group row">
                                                <input type="submit" class="btn btn-success" value="تعديل">
                                            </div>

                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close
                                        </button>
                                        {{--                                                    <button type="button" class="btn btn-primary">Save changes</button>--}}
                                    </div>
                                </div>
                            </div>
                        </div>

                    @endif
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th><i class="fas fa-cog fa-lg"></i> كود المنتج</th>
                    <th>كود السعر</th>
                    <th>رقم التسلسل</th>
                    <th>العرض</th>
                    <th>الطول</th>
                    <th>الكمية</th>
                    <th>اسم الصنف</th>
                    <th>الدرجة</th>
                    <th>التاريخ</th>

                    <th>التحكم</th>
                </tr>
                </tfoot>
            </table>


        </div>
    </div>


    <script type="text/javascript">

        $(document).ready(function () {


            $('#example').DataTable();

        });

        $(document).ready(function () {
            // $('select').selectize({
            //     sortField: 'text'
            // });

        });
        $(function() {
            $('.selectpicker').selectpicker();
        });

    </script>
@endsection
