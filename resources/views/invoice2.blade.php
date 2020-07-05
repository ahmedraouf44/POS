@extends("include")

@section("body")
    <div class="main-inv">
        <!-- <div class="inv-head">
            <div class="hd-lt">
              <p>APPLY CREDIT</p>
              <p>Enter the amount to apply</p>
            </div>
            <div class="hd-rt">
              <p>10.00 EGP</p>
              <input type="text" placeholder="10.00"><button>Apply Credit</button>
            </div>
        </div> -->
        <div class="inv-ico">
            <a href="#" onclick="window.print()"><i class="fas fa-print"></i>Print</a> <a href="#" onclick="window.open()" ><i class="far fa-file-pdf"></i> PDF</a>
        </div>
        <div class="inv-main">
            <div class="main-lt">
                <h3>فاتورة بيع</h3>
                <!-- <p>
                  Lorem ipsum dolor sit amet dolor sit amet
                </p> -->
            </div>
            <div class="main-rt">

                <h1>فاتورة #{{$lastorderMasterAfterUpdate->order_number}}</h1>
                <div class="inv-date">
                    <p><i class="far fa-calendar"></i>تاريخ الفاتورة</p> <span>{{$lastorderMasterAfterUpdate->order_date}}</span>
                </div>
                <div class="inv-date">
                    <!-- <p><i class="far fa-calendar"></i> Due Date</p> <span>08/03/2020</span> -->
                </div>
            </div>
            <div class="clear-fix"></div>
            <div class="inv-mid" style="     margin-top:0px;">
                <table class="table table-bordered">
                    <tr>
                        <th>الكود</th>
                        <th>الكود المرجعي </th>
                        <th>السعر</th>
                        <th>السعر الكلي</th>
                        <th>الكمية</th>
                        <th>الطول</th>
                        <th>العرض</th>
                        <th>الخصم</th>

                    </tr>
                    @foreach($allDetails as $details)
                        <tr>
                            <td >{{$details->item_code}}</td>
                            <td >{{$details->ref_code}}</td>
                            <td >{{$details->item_price}}</td>
                            <td >{{$details->total_price}}</td>
                            <td >{{$details->item_quantity}}</td>
                            <td >{{$details->item_width}}</td>
                            <td >{{$details->item_length}}</td>
                            <td >{{$details->discount}}</td>

                        </tr>
                    @endforeach
                </table>
            </div>
            <div class="clear-fix"></div>
            <div class="inv-mid-2">

                <div class="mid-2-content-rt">
                    <div>
                        @if($discountWay==1)
                            <p style="font-weight: bold; color: #551646;">الخصم</p> <span>{{$lastorderMasterAfterUpdate->discount}} %</span>
                        @else
                            <p style="font-weight: bold; color: #551646;">الخصم</p> <span>{{$lastorderMasterAfterUpdate->discount}} EGP</span>
                        @endif
                    </div>
                    <div>
                        <p style="font-weight: bold; color: #551646;">الضريبة</p> <span>{{$lastorderMasterAfterUpdate->tax_amount}} %</span>
                    </div>
                    <div class="mid-end">
                        <p>الاجمالي</p> <span>{{$lastorderMasterAfterUpdate->net_amount}} EGP</span>
                    </div>
                </div>
            </div>

            <div class="mid-2-content-rt" style="margin-left: 318px;">
                <div>
                    <p style="font-weight: bold; color: #551646;">اسم العميل</p> <span>{{$lastorderMasterAfterUpdate->customer_name}}</span>
                </div>
                <div>
                    <p style="font-weight: bold; color: #551646;">رقم موبايل العميل</p> <span>{{$lastorderMasterAfterUpdate->customer_phone}}</span>
                </div>

            </div>
            <div class="clear-fix"></div>

        </div>
    </div>

@endsection
