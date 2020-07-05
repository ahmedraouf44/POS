@extends("include")



@section("body")

    <!-- Main Section ------------------------------------------------------------------------------->

    <div class="main-cont">
        <div class="new-pur mod-titl">
            <h4>المنتجات الرئيسية</h4>


                <a class="btn btn-success" data-toggle="modal" data-target="#addMaster" style="color: #FFF; margin-bottom: 15px">
                    <i class="far fa-plus-square"></i> اضافة منتج
                </a>

            <div class="modal fade bd-example-modal-lg" id="addMaster" tabindex="-1" role="dialog"
                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h5 class="modal-title" id="exampleModalLabel">اضافة منتج</h5>
                        </div>
                        <form action="{{url('/addMaster')}}" method="POST">
                            @csrf
                        <div class="modal-body">

                                <div class="form-group row">
                                    <label for="staticEmail" class="col-form-label" >كود المنتج</label>
                                    <div>
                                        <input type="number" step="any" name="item_code" class="form-control" placeholder="item_code">
                                    </div>

                                    <label for="staticEmail" class="col-form-label">فئة المنتج</label>
                                    <div>
                                        <input type="text" name="item_group" class="form-control" placeholder="item_group">
                                    </div>

                                    <label for="staticEmail" class="col-form-label">سعر المنتج</label>
                                    <div>
                                        <input type="number" step="any" name="item_price" class="form-control" placeholder="item_price">
                                    </div>

                                    <label for="staticEmail" class="col-form-label">الجودة</label>
                                    <div>
                                        <input type="text" name="quality" class="form-control" placeholder="quality">
                                    </div>

                                </div>

                                <div class="form-group row">
                                     <label for="staticEmail" class="col-form-label">الدرجة</label>
                                    <div>
                                        <input type="text" name="grade" class="form-control" placeholder="grade">
                                    </div>

                                    <label for="staticEmail" class="col-form-label">التغليف</label>
                                    <div>
                                        <input type="text" name="backing" class="form-control" placeholder="backing">
                                    </div>

                                    <label for="staticEmail" class="col-form-label">رقم التصميم</label>
                                    <div>
                                        <input type="number" step="any" name="design_no" class="form-control" placeholder="design_no">
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

                                     <label for="staticEmail" class="col-form-label">رقم العينة</label>
                                    <div>
                                        <input type="number" step="any" name="sample_no" class="form-control" placeholder="sample_no">
                                    </div>

                                    <label for="staticEmail" class="col-form-label">الشكل</label>
                                    <div>
                                        <input type="text" name="shape" class="form-control" placeholder="shape">
                                    </div>

                                    <label for="staticEmail" class="col-form-label">اللمسات الأخيرة</label>
                                    <div>
                                        <input type="text" name="finishing" class="form-control" placeholder="finishing">
                                    </div>

                                </div>

                                <div class="form-group row">

                                    <label for="staticEmail" class="col-form-label">اقل مخزون</label>
                                    <div>
                                        <input type="number" step="any" name="min_stock" class="form-control" placeholder="min_stock">
                                    </div>
                                </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق
                            </button>
                            {{--                                                    <button type="button" class="btn btn-primary">Save changes</button>--}}
                            <input type="submit" class="btn btn-success" value="أضف">
                        </div>

                        </form>
                    </div>
                </div>
            </div>

            <hr>
            <table id="example" class="table table-striped table-bordered" style="width:100%" dir="rtl">
            <thead>
                <tr role="row"><th class="sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-sort="ascending" aria-label=" كود المنتج: تفعيل لترتيب العمود تنازلياً" style="width: 79px;"><i class="fas fa-cog fa-lg"></i> كود المنتج</th>
                    <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="كود السعر: تفعيل لترتيب العمود تصاعدياً" style="width: 76px;">كود السعر</th>
                    <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="المجموعة: تفعيل لترتيب العمود تصاعدياً" style="width: 76px;">المجموعة</th>
                    <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="السعر: تفعيل لترتيب العمود تصاعدياً" style="width: 33px;">السعر</th>
                    <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="الدرجة: تفعيل لترتيب العمود تصاعدياً" style="width: 35px;">الدرجة</th>
                    <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="الجودة: تفعيل لترتيب العمود تصاعدياً" style="width: 97px;">اسم الصنف</th>
                    <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="التغليف: تفعيل لترتيب العمود تصاعدياً" style="width: 255px;">الظهر</th>
                    <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="العرض: تفعيل لترتيب العمود تصاعدياً" style="width: 37px;">العرض</th>
                    <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="الطول: تفعيل لترتيب العمود تصاعدياً" style="width: 31px;">الطول</th>
                    <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="رقم التصميم: تفعيل لترتيب العمود تصاعدياً" style="width: 61px;">رقم التصميم</th>
                    <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="رقم العينة: تفعيل لترتيب العمود تصاعدياً" style="width: 49px;">رقم العينة</th>
                    <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="الشكل: تفعيل لترتيب العمود تصاعدياً" style="width: 81px;">الشكل</th>
                    <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="اللمسات الأخيرة: تفعيل لترتيب العمود تصاعدياً" style="width: 40px;">التشطيب</th>
                    <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="اقل مخزون: تفعيل لترتيب العمود تصاعدياً" style="width: 18px;">الحد الادني</th>
                    <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="التحكم: تفعيل لترتيب العمود تصاعدياً" style="width: 79px;overflow: hidden;">التحكم</th>
                 </tr>
                </thead>
                <tbody>
                @foreach(@$items as $item)
                    @if(!empty($item))
                        <tr>
                            <th>{{$item->item_code}}</th>
                            <th>{{$item->ref_code}}</th>
                            <th>{{$item->item_group}}</th>
                            <th>{{$item->item_price}}</th>
                            <th>{{$item->grade}}</th>
                            <th>{{$item->quality}}</th>
                            <th>{{$item->backing}}</th>
                            <th>{{$item->item_width}}</th>
                            <th>{{$item->item_length}}</th>
                            <th>{{$item->design_no}}</th>
                            <th>{{$item->sample_no}}</th>
                            <th>{{$item->shape}}</th>
                            <th>{{$item->finishing}}</th>
                            <th>{{$item->min_stock}}</th>
                            <th>
                                <div class="row" style="margin-right: -3px;">
                                <a class="btn btn-danger" onclick="return confirm('هل أنت متأكد من حذف هذا العنصر ؟');" href="{{url('deleteMaster'.'/'.$item->item_id)}}">حذف</a>

                                <a class="btn btn-primary" data-toggle="modal" data-target="#editMaster{{$item->item_id}}" style="color: #FFF;">
                                    تعديل
                                </a>
                                </div>
                            </th>
                        </tr>

                        <div class="modal fade bd-example-modal-lg" id="editMaster{{$item->item_id}}" tabindex="-1" role="dialog"
                             aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <h5 class="modal-title" id="exampleModalLabel">تعديل منتج</h5>
                                    </div>
                                    <form action="{{url('updateMaster'.'/'.$item->item_id)}}" method="POST">
                                        @csrf
                                    <div class="modal-body">

                                            <input type="text" name="item_id" value="{{@$item->item_id}}" hidden>
                                            <div class="form-group row">
                                                <label for="staticEmail" class="col-form-label" >كود المنتج</label>
                                                <div>
                                                    <input type="number" step="any" name="item_code" class="form-control" value="{{@$item->item_code}}">
                                                </div>

                                                <label for="staticEmail" class="col-form-label">فئة المنتج</label>
                                                <div>
                                                    <input type="text" name="item_group" class="form-control" value="{{@$item->item_group}}">
                                                </div>

                                                <label for="staticEmail" class="col-form-label">سعر المنتج</label>
                                                <div>
                                                    <input type="number" step="any" name="item_price" class="form-control" value="{{@$item->item_price}}">
                                                </div>

                                                <label for="staticEmail" class="col-form-label">الدرجة</label>
                                                <div>
                                                    <input type="text" name="grade" class="form-control" value="{{@$item->grade}}">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="staticEmail" class="col-form-label">الجودة</label>
                                                <div>
                                                    <input type="text" name="quality" class="form-control" value="{{@$item->quality}}">
                                                </div>

                                                <label for="staticEmail" class="col-form-label">التغليف</label>
                                                <div>
                                                    <input type="text" name="backing" class="form-control" value="{{@$item->backing}}">
                                                </div>

                                                <label for="staticEmail" class="col-form-label">رقم التصميم</label>
                                                <div>
                                                    <input type="number" step="any" name="design_no" class="form-control" value="{{@$item->design_no}}">
                                                </div>

                                                <label for="staticEmail" class="col-form-label">العرض</label>
                                                <div>
                                                    <input type="number" step="any" name="item_width" class="form-control" value="{{@$item->item_width}}">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="staticEmail" class="col-form-label">الطول</label>
                                                <div>
                                                    <input type="number" step="any" name="item_length" class="form-control" value="{{@$item->item_length}}">
                                                </div>

                                                <label for="staticEmail" class="col-form-label">رقم العينة</label>
                                                <div>
                                                    <input type="number" step="any" name="sample_no" class="form-control" value="{{@$item->sample_no}}">
                                                </div>

                                                <label for="staticEmail" class="col-form-label">الشكل</label>
                                                <div>
                                                    <input type="text" name="shape" class="form-control" value="{{@$item->shape}}">
                                                </div>

                                                <label for="staticEmail" class="col-form-label">اللمسات الأخيرة</label>
                                                <div>
                                                    <input type="text" name="finishing" class="form-control" value="{{@$item->finishing}}">
                                                </div>

                                            </div>
                                            <div class="form-group row">
                                                <label for="staticEmail" class="col-form-label">اقل مخزون</label>
                                                <div>
                                                    <input type="number" step="any" name="min_stock" class="form-control" value="{{@$item->min_stock}}">
                                                </div>
                                            </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق
                                        </button>

                                        {{--                                                    <button type="button" class="btn btn-primary">Save changes</button>--}}
                                        <input type="submit" class="btn btn-primary" value="تعديل">
                                    </div>

                                    </form>
                                </div>
                            </div>
                        </div>

{{--                            <tr class="collapse" id="collapse0{{$item->item_id}}">--}}
{{--                                <form action="{{url('updateMaster'.'/'.$item->item_id)}}" method="POST">--}}
{{--                                    @csrf--}}

{{--                                    <input type="text" name="item_id" value="{{@$item->item_id}}" hidden>--}}
{{--                                <th>--}}
{{--                                    <div class="input-group mb-3">--}}
{{--                                        <input type="text" name="item_code" class="form-control" placeholder="{{@$item->item_code}}"--}}
{{--                                               value="{{@$item->item_code}}" aria-label="Username"--}}
{{--                                               aria-describedby="basic-addon1">--}}
{{--                                    </div>--}}
{{--                                </th>--}}
{{--                                <th>--}}
{{--                                    <div class="input-group mb-3">--}}
{{--                                        <input type="text" name="item_group" class="form-control"--}}
{{--                                               placeholder="{{@$item->item_group}}" value="{{@$item->item_group}}"--}}
{{--                                               aria-label="Username" aria-describedby="basic-addon1">--}}
{{--                                    </div>--}}
{{--                                </th>--}}
{{--                                <th>--}}
{{--                                    <div class="input-group mb-3">--}}
{{--                                        <input type="text" name="item_price" class="form-control" placeholder="{{@$item->item_price}}"--}}
{{--                                               value="{{@$item->item_price}}" aria-label="Username" aria-describedby="basic-addon1">--}}
{{--                                    </div>--}}

{{--                                </th>--}}
{{--                                <th>--}}
{{--                                    <div class="input-group mb-3">--}}
{{--                                        <button type="submit" class="btn btn-primary">Update</button>--}}
{{--                                    </div>--}}

{{--                                </th>--}}
{{--                                </form>--}}
{{--                            </tr>--}}

                    @endif
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th><i class="fas fa-cog fa-lg"></i> كود المنتج</th>
                    <th>كود السعر</th>
                    <th>المجموعة</th>
                    <th>السعر</th>
                    <th>الدرجة</th>
                    <th>اسم الصنف</th>
                    <th>الظهر</th>
                    <th>العرض</th>
                    <th>الطول</th>
                    <th>رقم التصميم</th>
                    <th>رقم العينة</th>
                    <th>الشكل</th>
                    <th>التشطيب</th>
                    <th>الحد الادني</th>

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


    </script>
@endsection
