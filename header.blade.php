<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css"/>
    <link rel="stylesheet" href="css/bootstrap.min.css"/>
    <link rel="stylesheet" href="css/all.min.css"/>
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
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>

    <title>PBC - POS</title>
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
                          {{\Illuminate\Support\Facades\Auth::user()->name}}
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="/viewstock">View stock</a>
                            <a class="dropdown-item" href="#">Another action</a>
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
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            @foreach(@$nots as $not)
                            <a class="dropdown-item" href="{{url('/nots'.'/'.$not->notifications_id)}}">{{$not->notification_text}}</a>
                            @endforeach
                        </div>
                        </div>
                    </li>
                    <li class="tex-det"><p>1</p></li>
                    <li>Text Content</li>
                </ul>
            </div>
        </div>
        <!-- over-divs ----------------------------------------------------------------------------------->
        <div class="over-divs">
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
        <div class="sel-ord">
            <h4>أمر بيع</h4>
            <hr>
            <form action="">
                <div class="sell-pt-1">
                    <div class="top-p-1">
                        <p>الاسم</p>
                        <p>رقم الهاتف</p>
                        <p>العنوان</p>
                        <p>رقم الفرع</p>
                        <p>الخصم</p>
                    </div>
                    <div class="top-inp-1">
                        <input type="text" name="customer_name" placeholder="Enter a Customer Name">
                        <!-- <input type="text"  name="customer_number" placeholder="Enter a Customer number"> -->
                        <input type="text"  name="customer_phone" placeholder="Enter a Customer phone">
                        <input type="text" name="customer_address" placeholder="Enter a Customer address">
                        <input type="text" name="customer_branch_number"  readonly="readonly" placeholder="Enter a Customer branch number">
                        <input type="number" min="0" name="discount" value="0"  placeholder="Enter a Discount">
                    </div>
                </div>
                <div class="sell-pt-2">
                    <div class="top-p-2">
                        <p>الضرائب</p>
                        <p>الرقم التسلسلي</p>
                        <p>نوع العميل</p>
                        <p>نوع العملية</p>
                        <p>طريقة الدفع</p>
                    </div>
                    <div class="top-inp-2">
                            <input type="number" min="0" name="Tax_amount" value="0"  placeholder="Enter a Tax Amount"> 
                            <input type="text" name="seria"  placeholder="Enter a serial">
                            <!--  <input type="number" name="Net_amount" value=""  placeholder="Enter a Net Amount"> -->
                           <!--  <input type="hidden" name="created_by"   > -->
                        <!-- type_master -->
                            <select name="customer_type">
                            <option value="5">تاجر</option>
                            <option value="6">عميل عام</option>
                            </select>
                            <select name="order_type">
                            <option value="9">  بيع</option>
                            <option value="10"> مرتجع</option>
                            </select>
                            <select name="payment_type">
                            <option value="13"> نقدى</option>
                            <option value="14"> فيزا</option>
                            </select>
                    </div>
                </div>
            </form>
            <div class="clear-fix"></div>
            <table>
                
            </table>
            <hr>
            <button class="btn-cls">اغلاق</button>
            <button class="btn-sv">حفظ</button>
        </div>
        </div>
        <!-- Side Menu ----------------------------------------------------------------------------------->
        <div class="menu">
            <div class="icons">
            <ul>
                <li class="ico-home"><i class="fas fa-home fa-lg"></i></li>
                <li><i class="fas fa-shopping-cart fa-lg"></i></li>
                <li><i class="fas fa-tag fa-lg"></i></li>
                <li><i class="fas fa-chart-line fa-lg"></i></li>
                <li><i class="fas fa-warehouse fa-lg"></i></li>
                <li><i class="fas fa-coins fa-lg"></i></li>
                <li><i class="fas fa-chart-area fa-lg"></i></li>
            </ul>
            </div>
            <div class="items">
            <ul>
                <li><a href="/branches">الرئيسية</a></li>
                <li>الأذونات<i class="fas fa-chevron-left"></i></li>
                <li>الفروع<i class="fas fa-chevron-left"></i></li>
                <li>المنتجات<i class="fas fa-chevron-left"></i></li>
                <li><i class="fas fa-chevron-left"></i><a href="{{url('/category')}}">المخزون الرئيسي</a></li>
                <li>المخزون على الفروع<i class="fas fa-chevron-left"></i></li>
                <li>الاشعارات<i class="fas fa-chevron-left"></i></li>
                <li>المبيعات<i class="fas fa-chevron-left"></i></li>
                <li>التقارير<i class="fas fa-chevron-left"></i></li>
                <li>العملاء<i class="fas fa-chevron-left"></i></li>
                <li>تسجيل الخروج<i class="fas fa-chevron-left"></i></li>
            </ul>
            </div>
            <div class="purchase">
            <ul>
                <li><a href="{{url('/exportDocs')}}"> اذن صادر</a></li>
                <li><a href="{{url('/importDocs')}}">اذن وارد</a></li>
                <li><a href="{{url('/stock')}}">اضافة اذن صادر</a></li>
            </ul>
            </div>
            <div class="sale">
                <ul>
                    <li><a href="{{url('/branches')}}">العملاء</a></li>
                    <li><a href="{{url('/branches')}}"> الفروع</a></li>
                    {{--<li>Add Branch</li>--}}
                </ul>
            </div>
            <div class="pro">
                <ul>
                    <li class="bac-ord">امر بيع</li>
                    <li>مرتجع</li>
                </ul>
            </div>
            </div>
   <body>


