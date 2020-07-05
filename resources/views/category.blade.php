@extends("include")

@section("body")

        <!-- add contact popup 1 -------------------------------------------------------------------------->
        <div class="over-divs">
            <div class="add-cont">

                <h4>إضافة تصنيف</h4>
                <hr>
                <form action="{{URL::to('createMainCategory')}}" method="post">
                <div class="add-cont-prt1">
                    <ul>
                        <li>الاسم</li>
                        <li>الصورة</li>

                    </ul>
                    <div class="add-cont-inpu">
                        <input type="text" name="name">
                        <input type="file" name="image">


                    </div>
                </div>

                <div class="clear-fix"></div>

                <hr>
                <button class="btn-cls">اغلاق</button>
                <button class="btn-sv">اضافة</button>
                </form>
            </div>


{{--            popup2--}}

        <!-- add contact popup -------------------------------------------------------------------------->
            <div class="add-cont-subCategory">
                <h4>اضافة تصنيف فرعي</h4>
                <hr>
                <form action="{{URL::to('createSubCategory')}}" method="post">
                    <div class="add-cont-prt1">
                        <ul>
                            <li>الاسم</li>
                            <li>التصنيف الرئيسي</li>

                        </ul>
                        <div class="add-cont-inpu">
                            <input type="text" name="name">
                            <select name="main_category_id">
                                @foreach(@$all_main_category as $result)
                                    <option value="{{$result->id}}">{{$result->name}}</option>
                                @endforeach
                            </select>


                        </div>
                    </div>

                    <div class="clear-fix"></div>

                    <hr>
                    <button class="btn-cls">اغلاق</button>
                    <button class="btn-sv">اضافة</button>
                </form>
            </div>
{{--            end popup2--}}

{{--  popup3--}}

        <!-- add contact popup -------------------------------------------------------------------------->
            <div class="add-cont-room">
                <h4>اضافة نوع غرفة</h4>
                <hr>
        <form action="{{URL::to('createRoomType')}}" method="post">

                <div class="add-cont-prt1">
                    <ul>
                        <li>نوع الغرفة</li>
                        <li>نوع الغرفة</li>
                        <li>صورة</li>


                    </ul>
                    <div class="add-cont-inpu">
                        <input type="text" name="room_type">
                        <input type="text" name="room_type_ar">
                        <input type="file" name="image">

                    </div>
                </div>

                <div class="clear-fix"></div>
                <p>الوصف</p>
                <textarea name="description" id="" cols="95" rows="3"></textarea>
                <hr>
                <button class="btn-cls">اغلاق</button>
                <button type="submit" name="submit" class="btn-sv">اضافة</button>
</form>
            </div>

{{--            end pop3--}}



{{--            popup4--}}

        {{--  popup2--}}

        <!-- add contact popup -------------------------------------------------------------------------->
            <div class="add-cont-color">
                <h4>اضافة لون</h4>
                <hr>
                <form action="{{URL::to('createColor')}}" method="post">
              @csrf
                    <div class="add-cont-prt1">
                        <ul>
                            <li>اللون</li>



                        </ul>
                        <div class="add-cont-inpu">

                            <input type="color" id="myColor">
                        </div>
                    </div>

                    <div class="clear-fix"></div>

                    <hr>
                    <button class="btn-cls">اغلاق</button>
                    <button type="submit" name="submit" class="btn-sv">اضافة</button>
                </form>
            </div>

        {{--            end pop2--}}
{{--            end popup4--}}
        </div>
        <!-- Main Section ------------------------------------------------------------------------------->
      <div class="main-cont">
            <div class="new-pur">
                <h6>التصنيفات</h6>
                <hr>
                <div  data-addui='tabs'>
                <div class="tabs" role='tabs'>
                  <div><i class="fas fa-shopping-cart"></i> التصنيفات</div>
                  <div><i class="far fa-file-alt"></i> التصنيفات الفرعية</div>
                  <div><i class="fas fa-dolly"></i> نوع الغرفة</div>
                  <div><i class="far fa-sticky-note"></i>اللون</div>
                </div>
                <hr>
                <div role='contents'>
                  <div class="tab1">
                    <button class="active add-row"><i class="fas fa-plus"></i></button>
                    <table class="tab1-tab table">
                        <tr>
                            <th> ID</th>
                            <th> التصنيف</th>
                            <th>الصورة </th>

                        </tr>

                        @foreach(@$all_main_category as $result)
                            <tr>
                                <td>{{$result->id}}</td>


                                <td>{{$result->name}}</td>
                                <td><img src="{{asset($result->image)}}"></td>
                            </tr>
                        @endforeach
                      <tfoot>
                        <tr>
                            <td colspan="4">Total</td>
                            <td colspan="4">0</td>
                            <td>0.0</td>
                        </tr>
                      </tfoot>
                    </table>
                    <div class="links">
                        <a class="add-row" href="#"><i class="far fa-plus-square"></i> اضافة عنصر</a>
                    </div>
                    </div>{{-- //main category--}}
                  <div class="tab1">
                  <button class="active add-row-subCategory"><i class="fas fa-plus"></i></button>
                    <table class="tab1-tab table">
                        <tr>
                            <th> ID</th>
                            <th>التصنيف الفرعي</th>
                            <th>التصنيف الرئيسي</th>

                        </tr>

                        @foreach($all_sub_category as $result)
                            <tr>
                                <td>{{$result->id}}</td>


                                <td>{{$result->name}}</td>
                                <td>{{$result->main_category->name}}</td>
                            </tr>
                        @endforeach
                      <tfoot>
                        <tr>
                            <td colspan="4">Total</td>
                            <td colspan="4">0</td>
                            <td>0.0</td>
                        </tr>
                      </tfoot>
                    </table>
                    <div class="links">
                        <a class="add-row-subCategory" href="#"><i class="far fa-plus-square"></i> اضافة عنصر</a>
                    </div>
                  </div>{{-- //sub category--}}
                  <div class="tab1">
                  <button class="active add-row-room"><i class="fas fa-plus"></i></button>
                    <table class="tab1-tab table">
                        <tr>


                            <th> ID</th>
                            <th>نوع الغرفة</th>
                            <th>نوع الغرفة</th>
                            <th>الصورة</th>
                            <th>الوصف</th>

                        </tr>
                        @foreach($all_room_type as $result)
                        <tr>
                            <td>
                                {{$result->id}}
                            </td>
                            <td>
                                {{$result->room_type}}
                            </td>
                            <td>
                                {{$result->room_type_ar}}
                            </td>
                            <td>
                                <img src="{{asset($result->image)}}">

                            </td>
                            <td>
                                {{$result->description}}
                            </td>
                        </tr>
                        @endforeach
                      <tfoot>
                        <tr>
                            <td colspan="4">Total</td>
                            <td colspan="4">0</td>
                            <td>0.0</td>
                        </tr>
                      </tfoot>
                    </table>
                    <div class="links">
                        <a class="add-row-room" href="#"><i class="far fa-plus-square"></i> اضافة عنصر</a>
                    </div>
                  </div> {{-- //room type--}}
                  <div class="tab1"> {{-- //color--}}

                  <button class="active add-row-color"><i class="fas fa-plus"></i></button>
                    <table class="tab1-tab table">
                        <tr>
                            <th> ID</th>
                            <th>اللون</th>


                        </tr>
                        @foreach($all_color as $result)
                            <tr>
                                <td>{{$result->id}}</td>


                                <td>{{$result->name}}</td>
                            </tr>
                        @endforeach
                      <tfoot>
                        <tr>
                            <td colspan="4">Total</td>
                            <td colspan="4">0</td>
                            <td>0.0</td>
                        </tr>
                      </tfoot>
                    </table>
                    <div class="links">
                        <a class="add-row-color" href="#"><i class="far fa-plus-square"></i> اضافة عنصر</a>
                    </div>
                  </div>{{-- //color--}}
                 </div>
              </div>
        </div>

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
           

@endsection
