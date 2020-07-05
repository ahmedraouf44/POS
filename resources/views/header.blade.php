<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
   
    <link rel="stylesheet" href="{{asset('css/style.css')}}"/>
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('css/all.min.css')}}"/>
    <link rel="stylesheet" href="css/AddTabs.css">
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="Js/jquery.dataTables.min.js"></script>

    <title>PBC - POS</title>
    <style>
* {
  box-sizing: border-box;
}

body {
  font: 16px Arial;
}
/*the container must be positioned relative:*/
.autocomplete {
  position: relative;
  display: inline-block;
}





.autocomplete-items {
  position: absolute;
  border: 1px solid #d4d4d4;
  border-bottom: none;
  border-top: none;
  z-index: 99;
  /*position the autocomplete items to be the same width as the container:*/
  top: 100%;
  left: 0;
  right: 0;
}

.autocomplete-items div {
  padding: 10px;
  cursor: pointer;
  background-color: #fff;
  border-bottom: 1px solid #d4d4d4;
}

/*when hovering an item:*/
.autocomplete-items div:hover {
  background-color: #e9e9e9;
}

/*when navigating through the items using the arrow keys:*/
.autocomplete-active {
  background-color: DodgerBlue !important;
  color: #ffffff;
}
</style>
</head>

 



<div class="container-fluid mg-0 pd-0">
        <div class="nav">
            <div class="logo">
                <img src="image/PBC-Logo.png" alt="logo">
            </div>
            <div class="nav-ico">
                <ul>
                <li class="prof">
                    <div class="dropdown">
                    <i class="fas fa-user"></i>
                        <button class="dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          {{@\Illuminate\Support\Facades\Auth::user()->name}}
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
{{--                            <a class="dropdown-item" href="/viewstock">التحويلات الصادره</a>--}}
{{--                            <a class="dropdown-item" href="#">Another action</a>--}}
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="dropdown-item" type="submit">Logout</button>
                            </form>
                            {{--<a class="dropdown-item" href="{{ route('logout') }}">Logout</a>--}}
                        </div>
                        </div>
                    </li>
                    <li>
                        <div class="dropdown">
                       <i class="fas fa-bell"><span class="radius bg-danger">{{count($nots)}}</span></i>
                  <div class="dropdown-menu noti" aria-labelledby="dropdownMenuButton">
                           @foreach(@$nots as $not)
                         <a class="dropdown-item" href="{{url('/nots'.'/'.$not->notifications_id)}}">{{$not->notification_text}}</a>
                          @endforeach
                       </div>
                        </div>
                    </li>
                    <li class="tex-det">{{@$branch_name}}</li>
{{--                    <li>Text Content</li>--}}
                </ul>
            </div>
        </div>
        <!-- over-divs ----------------------------------------------------------------------------------->
        <div class="over-divs" id="overdiv">
        <!-- add supplier popup -------------------------------------------------------------------------->
            <div class="add-sup">
                <h4>Add a Supplier</h4>
                <hr>
                <div class="add-sup-prt1">
                    <ul>
                        <li>Name <span>*</span></li>
                        <li>Payment Term <span>*</span></li>
                        <li>Tax Rule <span>*</span></li>
                        <li>Discount</li>
                    </ul>
                    <div class="inpu">
                        <input type="text" placeholder="Enter a Supplier Name">
                        <input type="text" value="30 days">
                        <input type="text" list="sup" />
                        <datalist id="sup">
                        <option value="Auto Look Up"></option>
                        <option value="Sales Tax on Imports"></option>
                        <option value="Tax Exempt"></option>
                        <option value="Tax on Purchases"></option>
                        </datalist>
                        <input type="text" >
                    </div>
                </div>
                <div class="add-sup-prt2">
                    <ul>
                        <li>Currency <span>*</span></li>
                        <li>Account Payable <span>*</span></li>
                        <li>Default Carrier</li>
                        <li>Tax Number</li>
                    </ul>
                    <div class="inpu">
                        <input type="text" list="sup" value="EGP"/>
                        <datalist id="sup">
                        <option value="Value1"></option>
                        <option value="Value2"></option>
                        <option value="value3"></option>
                        <option value="value4"></option>
                        </datalist>
                        <input type="text" value="2000: Accounts Payable"/>
                        <input type="text" value="DEFAULT Carrier" />
                        <input type="text" />
                    </div>
                </div>
                <div class="clear-fix"></div>
                <div class="txt-ar">
                    <ul>
                        <li>Comments</li>
                    </ul>
                    <textarea name="" id="" cols="95" rows="3"></textarea>
                </div>
                <div class="clear-fix"></div>
                <hr>
                <button class="btn-cls">Close</button>
                <button class="btn-sv">SAVE</button>
            </div>
            <div class="add-adrs">
                <h4>Add a Supplier Address</h4>
                <hr>
                <div class="adrs-top">
                    <div class="top-p">
                        <p>&nbsp;</p>
                        <p>Line1 <span>*</span></p>
                        <p>Line2</p>
                    </div>
                    <div class="top-inp">
                        <input type="text" placeholder="Enter an adress name to search"/><button><i class="fas fa-search"></i></button>
                        <input type="text"/>
                        <input type="text"/>
                    </div>
                </div>
                <div class="clear-fix"></div>
                <div class="add-cont-prt1">
                    <ul>
                        <li>City / Suburb</li>
                        <li>State / Province</li>
                        <li>Zip / Postcode</li>
                    </ul>
                    <div class="add-cont-inpu">
                        <input type="text"/>
                        <input type="text"/>
                        <input type="text"/>
                    </div>
                </div>
                <div class="add-cont-prt2">
                    <ul>
                        <li>Country</li>
                        <li>Type</li>
                        <li>Default for Type</li>
                    </ul>
                    <div class="add-cont-inpu">
                        <input type="text" list="sup" value="Billing"/>
                        <datalist id="sup">
                        <option value="Billing"></option>
                        <option value="Business"></option>
                        <option value="Shipping"></option>
                        </datalist>
                        <input type="text" list="sup" value="Egypt"/>
                        <datalist id="sup">
                        <option value="Value1"></option>
                        <option value="Value2"></option>
                        <option value="value3"></option>
                        <option value="value4"></option>
                        </datalist>
                        <div class="slide-switch">
                            <input type="checkbox" id="slide-switch-1" />
                            <label for="slide-switch-1"></label>
                        </div>
                    </div>
                </div>
                <div class="clear-fix"></div>
                <p>Comments</p>
                <textarea name="" id="" cols="95" rows="3"></textarea>
                <hr>
                <button class="btn-cls">Close</button>
                <button class="btn-sv">SAVE</button>
            </div>
        <!-- add terms popup -------------------------------------------------------------------------->
        <div class="add-term">
            <h4>Add a Payment Term</h4>
            <hr>
            <div class="adrs-top">
                <div class="top-p">
                    <p>Name <span>*</span></p>
                    <p>Method <span>*</span></p>
                    <p>Days <span>*</span></p>
                </div>
                <div class="top-inp">
                    <input type="text" />
                    <input type="text" list="term" value="Number of days"/>
                        <datalist id="term">
                        <option value="Number of days"></option>
                        <option value="Day of next month"></option>
                        <option value="Last dayay of next month"></option>
                        <option value="Days since the end of the month"></option>
                        </datalist>
                    <input type="text"/>
                </div>
            </div>
            <div class="clear-fix"></div>
            <hr>
            <button class="btn-cls">Close</button>
            <button class="btn-sv">SAVE</button>
        </div>
        <!-- add location popup -------------------------------------------------------------------------->
        <div class="add-loc">
            <h4>Add a Payment Term</h4>
            <hr>
            <div class="adrs-top">
                <div class="top-p">
                    <p>Location <span>*</span></p>
                </div>
                <div class="top-inp">
                    <input type="text" />
                </div>
            </div>
            <div class="clear-fix"></div>
            <hr>
            <button class="btn-cls">Close</button>
            <button class="btn-sv">SAVE</button>
        </div>
        <!-- add new popup -------------------------------------------------------------------------->
        <div class="sel-ord" id="selorder">
            <h4>أمر بيع</h4>
            <hr>
            <form   action="/create_order" method="post">
                     @csrf
                <div class="sell-pt-1">
                    <div class="top-p-1">
                        <p>الاسم</p>
                        <p> </p>
                        <p>رقم الهاتف</p>
                        <p>العنوان</p>
                        <p>رقم الفرع</p>
                        <p>اسم الفرع</p>
                    </div>
                    <div class="top-inp-1">
                    <input type="text" id="customer_name" name="customer_name" placeholder="ادخل اسم العميل">

                        <!-- <input type="text"  name="customer_number" placeholder="Enter a Customer number"> -->
                        <div class="autocomplete" style="width:266px;">
                        <input type="text" id="skill_input" onkeydown="auto()"  onfocusout="getcustomerData(this.value)" name="customer_phone" placeholder="ادخل رقم موبايل العميل" autocomplete="on">
                        <input type="hidden" id="customer_id" name="customer_id"  value="" >

                       </div>
                       <a class="active btn btn-primary plus-btn" id="plus" onclick="saveCustomer()" style="float: none; background-color: #852c70; border: 1px solid #852c70"><i class="fas fa-plus"></i></a>
                        <input type="text" id="customer_address" name="customer_address" placeholder="ادخل عنوان العميل">
                        <input type="text"  name="customer_branch_number" value="{{@$branch_number}}" readonly="readonly" placeholder="Enter a Customer branch number">
                        <input type="text"  name="branch_name" value="{{@$branch_name}}" readonly="readonly" placeholder="Enter a Customer branch number">
                        <!-- <input type="text" id="serial" onchange="getItemStock()"  placeholder="Enter a serial"> -->
                        <!-- <input type="number" name="Net_amount" value=""  placeholder="Enter a Net Amount"> -->
                        <input type="hidden" name="created_by" value="{{@$created_by}}"  >

                    </div>
                </div>
                <div class="sell-pt-2">
                    <div class="top-p-2">
                        <p>الضرائب</p>
                        <p></p>
                        <p>نوع العميل</p>
                        <p>طريقة الدفع </p>
                        <p>الخصم</p>
                        <p> طريقة الخصم</p>
                    </div>
                    <div class="top-inp-2" style="    margin-right: 6px;">
                    <input  type="checkbox" onchange="changeTax()" checked id="Tax_amountCheck"  name="Tax_amountCheck" style="float: left;    width: 42px;" >
                    <input type="number" min="0" id="Tax_amount" name="Tax_amount" value="14" readonly="readonly"  placeholder="Enter a Tax Amount">


                            <!--  <input type="number" name="Net_amount" value=""  placeholder="Enter a Net Amount"> -->
                           <!--  <input type="hidden" name="created_by"   > -->
                        <!-- type_master -->
                            <select id="customer_type" name="customer_type">
                            <option value="5">تاجر</option>
                            <option value="6">عميل عام</option>
                            </select>
                            <select style="display:none"  name="order_type">
                            <option value="9">  بيع</option>

                            </select>
                            <select id="payment_type" name="payment_type" onchange="card()" >
                            <option value="13"> نقدى</option>
                            <option value="14"> فيزا</option>
                            <option value="15"> تحصيل اولا</option>
                            <option value="16"> فاتورة اجلة</option>
                            <option value="17" > شيك</option>
                            </select>
                            <input onchange="discount1()" type="number" min="0" id="discountId" name="discount" value="0" max="100" min="0"  placeholder="Enter a Discount">
                        <select onchange="discount1()"  name="discount_type" id="discount_type1">
                            <option value="1"> نسبة</option>
                            <option value="2"> قيمة</option>
                            </select>
                    </div>
                </div>
<br>

<!--  -->
<!-- The Modal -->
<div class="modal" id="neworder">

<div class="modal-content">

    <!-- Modal Header -->
    <div class="modal-header">
        <h4 class="modal-title">  Check</h4>
        <button type="button"   class="close" data-dismiss="modal">&times;</button>
       
    </div>

    <!-- Modal body -->
    <div class="modal-body">

        <!-- start -->

     
        <div class="sell-pt-1">
                    <div class="top-p-1">
                       
                        <p>اسم مالك الشيك</p>
                        <p> رقم الشيك</p>
                        <p>اسم البنك</p>
                    </div>
                    <div class="top-inp-1">
                    <input type="text" id="check_cutomer" name="customer_name" required placeholder="ادخل اسم مالك الشيك">
                        
                        <!-- <input type="text"  name="customer_number" placeholder="Enter a Customer number"> -->
                       @csrf
                    
                        <input type="text" id="check_number" name="check_number" required placeholder="ادخل  رقم الشيك">
                        <input type="text" id="bank_name"  name="bank_name" required  placeholder="ادخل اسم البنك">
                      
                        <!-- <input type="text" id="serial" onchange="getItemStock()"  placeholder="Enter a serial"> -->
                        <!-- <input type="number" name="Net_amount" value=""  placeholder="Enter a Net Amount"> -->
                        <input type="hidden" name="created_by" value="{{@$created_by}}"  >
                        <input type="hidden" name="branch_number" value="{{@$branch_number}}"  >

                        <input type="hidden" id="check_id" name="check_id">
                    </div>
                </div>


                <div class="sell-pt-2">
                    <div class="top-p-2">
                        
                        <p> قيمة الشيك </p>
                        <p>صورة الشيك</p>
                        <p> تاريخ الشيك </p>
                    </div>
                    <div class="top-inp-2" style="    margin-right: 6px;">
                    
                    <input type="text"  id="check_value" name="check_value" required  placeholder="ادخل  قيمة الشيك">
                    <input type="file" id= "check_image" name="check_image"  required  placeholder="ادخل  صورة الشيك">
                    <input type="date" id="check_date"  name="check_date" required  placeholder="ادخل  تاريخ الشيك ">


                            <!--  <input type="number" name="Net_amount" value=""  placeholder="Enter a Net Amount"> -->
                           <!--  <input type="hidden" name="created_by"   > -->
                        <!-- type_master -->
                            
                           
                      
                    </div>
                </div>
        <!-- end -->

       

    </div>

    <!-- Modal footer -->
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" id="closecheck"  onclick="closeDiv()" data-dismiss="modal">اغلاق</button>
        
        <a  onclick="create_check()" class="btn btn-danger" name="submit" value="submit">انشاء شيك</a>
    </div>


</div>

</div>
<!--  -->

<!--  -->

<div class="filters" style="margin-top: 230px;">
<!-- <label>الرقم التسلسلي</label> -->
<span style="float: right; margin-left: 15px">الرقم التسلسلي</span>
<input type="text" style="    float: right; padding: 4px; margin-bottom: 0" id="serial" onchange="getItemStock()"  placeholder="Enter a serial">
<input value="حذف عنصر" class="btn btn-primary" id="removeitem" style="display: inline; margin:0; float: right; margin-right: 15px; background-color: #852c70; border: 1px solid #852c70">
</div>
<table id="example4" class="table table-striped table-bordered" style="width:100%; text-align: right;" dir="rtl">
                    <thead>
                    <tr>
                        <th>الكود المرجعي</th>
                        <th>الكمية</th>
                        <th>الكود</th>
                        <th>الطول</th>
                        <th>الرقم التسلسلي</th>
                        <th>الخصم </th>
                        <th>نوع الخصم </th>
                        <th style="display:none" >item stock</th>



                    </tr>
                    </thead>
                    <tbody>


                    </tbody>


                    <tfoot>
                    <tr>
                    <th>الكود المرجعي</th>
                        <th>الكمية</th>
                        <th>الكود</th>
                        <th>الطول</th>
                        <th>الرقم التسلسلي</th>
                        <th>الخصم </th>
                        <th>نوع الخصم </th>



                    </tr>
                    </tfoot>
                </table>




<!--  -->




            <div class="clear-fix"></div>
            <table>

            </table>
            <hr>
            <button class="btn-cls">اغلاق</button>
            <button style="width: 19%;" class="btn-sv" name="Draft" value="draft">حجز</button>
                <button style="width: 19%;" class="btn-sv" id="confirm" name="Confirm" value="confirm">تأكيد بيع</button>

            <!-- <button class="btn-sv">حفظ</button> -->
            </form>
        </div>
        </div>



        <!-- Side Menu ----------------------------------------------------------------------------------->
        <div class="menu">
            <div class="icons">
            <ul>
                <li class="ico-home"><i class="fas fa-home fa-lg"></i></li>
                <li><i class="fas fa-exchange-alt fa-lg go-trans"></i></li>
                <li><i class="fas fa-code-branch fa-lg go-branch"></i></li>
                <li><i class="fas fa-box-open fa-lg go-pro"></i></li>
                <li><i class="fas fa-warehouse fa-lg go-exp"></i></li>
                <li><i class="fas fa-bell fa-lg go-noti"></i></li>
                <li><i class="fas fa-coins fa-lg go-sales"></i></li>
                <li><i class="fas fa-chart-area fa-lg go-repo"></i></li>
                <li><i class="fas fa-users fa-lg go-user"></i></li>
                <li><i class="fas fa-tag fa-lg"></i></li>
                <li><i class="fas fa-sign-out-alt fa-lg go-exit"></i></li>


            </ul>
            </div>
            <div class="items">
            <ul>
                <li><a href="/dashboard">الرئيسية</a></li>

                <li class="go-trans">التحويلات<i class="fas fa-chevron-left"></i></li>
                <li class="go-branch">الفروع<i class="fas fa-chevron-left"></i></li>
                <li class="go-pro">المنتجات<i class="fas fa-chevron-left"></i></li>
                <li class="go-exp"><i class="fas fa-chevron-left"></i>التوريدات</li>
                <li class="go-noti">الاشعارات<i class="fas fa-chevron-left"></i></li>
                <li class="go-sales">المبيعات<i class="fas fa-chevron-left"></i></li>
                <li class="go-repo">التقارير<i class="fas fa-chevron-left"></i></li>
                <li class="go-user">العملاء<i class="fas fa-chevron-left"></i></li>
                <li class=""><a href="{{url('priceList')}}">الاسعار</a><i class="fas fa-chevron-left"></i></li>
                <li class="go-exit"><a href="{{ route('logout') }}"> تسجيل الخروج</a><i class="fas fa-chevron-left"></i></li>

            </ul>
            </div>
            <div class="purchase">
            <ul>
                <li><a href="{{url('/exportDocs')}}">التحويلات الصادره</a></li>
                <li><a href="{{url('/importDocs')}}">التحويلات الوارده</a></li>
                <li><a href="{{url('/stock')}}">تحويل صادر جديد</a></li>
            </ul>
            </div>
            <div class="sale">
                <ul>

                    <li><a href="{{url('/branches')}}"> الفروع</a></li>
                    {{--<li>Add Branch</li>--}}
                </ul>
            </div>
            <div class="pro">
                <ul>
                    <li class="bac-ord">امر بيع جديد </li>
                    <li><a href="{{url('/orderview')}}">


                        المبيعات
                        </a>
                    </li>
                    <li><a href="{{url('/retrivedorderview')}}">
                        امر مرتجع
                        </a>
                    </li>
                </ul>
            </div>
            <div class="new-sub">
                <ul>
                <li><a href="{{url('/exports')}}">نوريد جديد</a></li>
                </ul>
            </div>
            <div class="pro-sub">
                <ul>
                    <li><a href="{{url('/itemMaster')}}">المنتجات الرئيسية</a></li>
                    <li><a href="{{url('/branchStock')}}">منتجات الفرع</a></li>

                </ul>
            </div>
            <div class="noti-sub">
                <ul>
                    <li><a href="{{url('/exports')}}">new item1</a></li>
                    <li><a href="{{url('/exports')}}">new item 2</a></li>
                </ul>
            </div>
            <div class="repo-sub">
                <ul>
                <li><a href="{{url('/exports')}}">reports item1</a></li>
                <li><a href="{{url('/exports')}}">reports item 2</a></li>
                </ul>
            </div>
            <div class="user-sub">
                <ul>
                <li><a href="{{url('/exports')}}">users item1</a></li>
                <li><a href="{{url('/exports')}}">users item 2</a></li>
                </ul>
            </div>
            </div>



            <script type="text/javascript">


$(document).ready(function () {



    var table4 = $('#example4').DataTable();

    $('#removeitem').click( function () {
        table4.row('.selected').remove().draw( false );
    } );




    $('#example4 tbody ').on('click', 'tr', function () {
        $(this).toggleClass('selected');
        var checkbox = $(this).find("input[type='checkbox']");
        checkbox.prop('checked', !checkbox.prop("checked"));


    });

    $('#button').click(function () {
        alert(table4.rows('.selected').data().length + ' row(s) selected');
    });
   
});


$(document).ready(function () {

    var table5 = $('#example5').DataTable();



    $('#example5 tbody ').on('click', 'tr', function () {
        $(this).toggleClass('selected');
        var checkbox = $(this).find("input[type='checkbox']");
        checkbox.prop('checked', !checkbox.prop("checked"));


    });

    $('#button').click(function () {
        alert(table5.rows('.selected').data().length + ' row(s) selected');
    });
});


    // var element1=document.getElementById("skill_input");
    // element1.autocomplete({
    //     source: "/getcustomers",
    // });








</script>
<script type="text/javascript" src="{{asset('Js/ajaxSerial.js')}}"></script>
<script type="text/javascript" src="{{asset('Js/ajaxExports.js')}}"></script>
<!-- jQuery library -->
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->

<!-- jQuery UI library -->
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>




   <body>

