@extends("include")

@section("body")
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
        <!-- add contact popup -------------------------------------------------------------------------->
            <div class="add-cont">

                <form action="{{route('adduser')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">الاسم</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" name="name" aria-describedby="emailHelp" placeholder="ادخل اسم المستخدم">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">البريد الالكتروني</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" name="email" aria-describedby="emailHelp" placeholder="ادخل البريد الالكتروني">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">رقم الهاتف</label>
                        <input type="number" class="form-control" id="exampleInputEmail1" name="phone" aria-describedby="emailHelp" placeholder="ادخل رقم الهاتف">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">كلمة المرور</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="ادخل كلمة المرور">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">تأكيد كلمة المرور </label>
                        <input type="password" class="form-control" id="exampleInputPassword1" name="password_conf" placeholder="تأكيد كلمة المرور">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">اسم الفرع: </label>
                        <select name="branches" class="form-control">
                            @foreach($branches as $branch)
                                <option value="{{$branch->id}}">{{$branch->title}}</option>
                            @endforeach

                        </select>
                    </div>
{{--                    <div class="form-check">--}}
{{--                        <input type="checkbox" class="form-check-input" id="exampleCheck1">--}}
{{--                        <label class="form-check-label" for="exampleCheck1">Check me out</label>--}}
{{--                    </div>--}}
                    <button type="submit" class="btn btn-primary">اضافة</button>
                    <button class="btn-cls">اغلاق</button>
                    
                </form>

            </div>
        <!-- add adress popup -------------------------------------------------------------------------->
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
        </div>


      <div class="main-cont">
            <div class="new-pur">
                <h6>قائمة المستخدمين</h6>
                <hr>
                <div class="links">
                    <a class="add-row" href="#"><i class="far fa-plus-square"></i> إضافة مستخدم</a>
                </div>
                 <table class="tab1-tab">
                     <thead>
                        <tr>
                            <th><i class="fas fa-cog fa-lg"></i> ID</th>
                            <th>الاسم</th>
                            <th>الايميل</th>
                            <th>رقم الهاتف</th>
                            <th> </th>
                        </tr>
                     </thead>
                     <tbody>
                     @foreach($users as $user)
                         <tr>
                             <th>{{$user->id}} </th>
                             <th>{{$user->name}}</th>
                             <th>{{$user->email}}</th>
                             <th>{{$user->phone}}</th>

                             <th>
                             <p>
                                <a class="btn btn-primary" data-toggle="collapse" href="#collapse{{@$user->id}}"  aria-expanded="false" aria-controls="collapseExample">
                                         تعديل
                                </a>
                                 </p>
                                 <a class="btn btn-danger" href="{{url('deleteuser'.'/'.@$user->id)}}">مسح</a>
                                 
                             </th>
                         </tr>
                         <form action="{{route('updateuser')}}" method="POST">
                             @csrf
                             <tr class="collapse" id="collapse{{@$user->id}}">

                                 <th>
                                     <div class="input-group mb-3">
                                         <input type="text" name="id" class="form-control" placeholder="{{@$user->id}}" value="{{@$user->id}}" aria-label="Username" aria-describedby="basic-addon1"  readonly>
                                     </div>
                                 </th>
                                 <th>
                                     <div class="input-group mb-3">
                                         <input type="text" name="name" class="form-control" placeholder="{{@$user->title}}" value="{{@$user->name}}" aria-label="Username" aria-describedby="basic-addon1">
                                     </div>
                                 </th>
                                 <th>
                                     <div class="input-group mb-3">
                                         <input type="text" name="email" class="form-control" placeholder="{{@$user->sub_title}}" value="{{@$user->email}}" aria-label="Username" aria-describedby="basic-addon1">
                                     </div>

                                 </th>
                                 <th>
                                     <div class="input-group mb-3">
                                         <input type="text" name="phone" class="form-control" placeholder="{{@$user->phone}}" value="{{@$user->phone}}" aria-label="Username" aria-describedby="basic-addon1">
                                     </div>

                                 </th>

                                 <th>
                                     <div class="input-group mb-3">
                                         <button type="submit" class="btn btn-primary">Update</button>
                                     </div>

                                 </th>

                             </tr>
                         </form>
                     @endforeach
                     </tbody>
{{--                      <tfoot>--}}
{{--                        <tr>--}}
{{--                            <td colspan="4">Total</td>--}}
{{--                            <td colspan="4">0</td>--}}
{{--                            <td>0.0</td>--}}
{{--                        </tr>--}}
{{--                      </tfoot>--}}
                    </table>

<!--
            <form action="">
                <div class="n-p-1">
                    <div class="label">
                        <p>Supplier<span> *</span></p>
                        <p>Contact</p>
                        <p>Phone</p>
                        <p>Vendor Adress</p>
                    </div>
                    <div class="inputs">
                        <input type="text" list="sup" placeholder="   type to search..."/>
                        <datalist id="sup">
                        <option value="Value No 1"></option>
                        <option value="Value No 2"></option>
                        <option value="Value No 3"></option>
                        <option value="Value No 4"></option>
                        </datalist>
                        <button class="show-over"><i class="fas fa-plus"></i></button>
                        <br>
                        <input type="text" list="sup" placeholder="   choose..."/>
                        <datalist id="sup">
                        <option value="Value No 1"></option>
                        <option value="Value No 2"></option>
                        <option value="Value No 3"></option>
                        <option value="Value No 4"></option>
                        </datalist>
                        <button class="show-cont"><i class="fas fa-plus"></i></button>
                        <br>
                        <input type="text" placeholder="   write..."/>
                        <br>
                        <input type="text" list="sup" placeholder="   choose..."/>
                        <datalist id="sup">
                        <option value="Value No 1"></option>
                        <option value="Value No 2"></option>
                        <option value="Value No 3"></option>
                        <option value="Value No 4"></option>
                        </datalist>
                        <button class="show-adrs"><i class="fas fa-plus"></i></button>
                        <br>
                        <input type="text" list="sup" placeholder="   choose..."/>
                        <datalist id="sup">
                        <option value="Value No 1"></option>
                        <option value="Value No 2"></option>
                        <option value="Value No 3"></option>
                        <option value="Value No 4"></option>
                        </datalist>
                    </div>
                </div>
-->
<!--
                <div class="n-p-2">
                    <div class="label">
                        <p>Input Method:</p>
                        <p>Terms</p>
                        <p>Required by</p>
                        <p>Tax Rule <span>*</span></p>
                        <p>Tax Inclusive <span>*</span></p>
                        <p>Inventory account</p>
                    </div>
                    <div class="inputs">
                        <input type="radio" value="srock"/> Stock First
                        <input type="radio" value="invoice"/> invoice First
                        <br>
                        <input type="text" placeholder="   30 days"/>
                        <button class="show-term"><i class="fas fa-plus"></i></button>
                        <br>
                        <div class='cal'>
                        <input class="date" type="txt" placeholder="   choose..."><i class="far fa-calendar-alt"></i>
                        </div>
                        <br>
                        <input type="text" list="sup" placeholder="   Tax on purchases"/>
                        <datalist id="sup">
                        <option value="Value No 1"></option>
                        <option value="Value No 2"></option>
                        <option value="Value No 3"></option>
                        <option value="Value No 4"></option>
                        </datalist>
                        <br>
                        <input type="checkbox" value="tax"/>
                        <br>
                        <input type="text" list="sup" placeholder="   1400:Inventory"/>
                        <datalist id="sup">
                        <option value="Value No 1"></option>
                        <option value="Value No 2"></option>
                        <option value="Value No 3"></option>
                        <option value="Value No 4"></option>
                        </datalist>
                    </div>
                </div>
-->
<!--
                <div class="n-p-3">
                    <div class="label">
                        <p>Blind Receipt</p>
                        <p>Date</p>
                        <p>Location<span> *</span></p>
                        <p>Ship To</p>
                        <p>Shipping Adresses</p>
                    </div>
                    <div class="inputs">
                        <input type="checkbox" value="tax"/>
                        <br>
                        <div class='cal'>
                            <input class="date" type="txt" placeholder="   choose..."><i class="far fa-calendar-alt"></i>
                        </div>
                        <br>
                        <input type="text" placeholder="   30 days"/>
                        <button class="show-loc"><i class="fas fa-plus"></i></button>
                        <br>
                        <input type="text" list="sup" placeholder="   Tax on purchases"/>
                        <datalist id="sup">
                        <option value="Value No 1"></option>
                        <option value="Value No 2"></option>
                        <option value="Value No 3"></option>
                        <option value="Value No 4"></option>
                        </datalist>
                        <br>
                        <input type="checkbox" value="tax"/> Different Company
                        <br>
                        <input type="text" list="sup" placeholder="   1400:Inventory"/>
                        <datalist id="sup">
                        <option value="Value No 1"></option>
                        <option value="Value No 2"></option>
                        <option value="Value No 3"></option>
                        <option value="Value No 4"></option>
                        </datalist>
                        <button class="show-adrs"><i class="fas fa-plus"></i></button>
                        <br>
                        <input type="text" placeholder="   Default City and state"/>
                    </div>
                </div>
                <label for="note">Note</label>
                <textarea name="note" id="note" cols="30" rows="10" placeholder="Write your note here..."></textarea>
            </form>
-->
            </div>

@endsection
