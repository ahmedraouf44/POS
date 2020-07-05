@extends("include")
@section("body")

    <div class="main-cont">
        <div class="new-pur">
            <h6>All Products</h6>
            <hr>
            {{--<div class="links">--}}
            {{--<a class="add-row" href="#"><i class="far fa-plus-square"></i> Add User</a>--}}
            {{--</div>--}}

            <div class="row">
                <!-- <input type="text" name="serial" id="serial"> -->
            </div>
            <br>
            <!-- <input value="find item" class="btn btn-primary" id="getitem"> -->
            <input type="text" id="serial" onchange="getItemStock()"  placeholder="Enter a serial">
            <input value="remove item" class="btn btn-primary" id="removeitem">
            <div id="data">
            <form action="/create_order" method="post">
                     @csrf

                     <input type="text" name="customer_name" placeholder="Enter a Customer Name">
                        <!-- <input type="text"  name="customer_number" placeholder="Enter a Customer number"> -->
                        <input type="text"  name="customer_phone" placeholder="Enter a Customer phone">
                        <input type="text" name="customer_address" placeholder="Enter a Customer address">
                        <input type="text" name="customer_branch_number" value="{{$branch_number}}" readonly="readonly" placeholder="Enter a Customer branch number">
                        <input type="number" min="0" name="discount" value="0"  placeholder="Enter a Discount">
                        <input type="number" min="0" name="Tax_amount" value="0"  placeholder="Enter a Tax Amount">
                        <!-- <input type="text" id="serial" onchange="getItemStock()"  placeholder="Enter a serial"> -->
                        <!-- <input type="number" name="Net_amount" value=""  placeholder="Enter a Net Amount"> -->
                        <input type="hidden" name="created_by" value="{{$created_by}}"  >
                       <!-- type_master -->
                       <br>
                        <select name="customer_type">
                        <option value="5">تاجر</option>
                        <option value="6">عميل عام</option>
                        
                        </select>

                        <select name="order_type">
                        <option value="9">	بيع</option>
                        <option value="10"> مرتجع</option>
                        
                        </select>

                        <select name="payment_type">
                        <option value="13">	نقدى</option>
                        <option value="14"> فيزا</option>
                        
                        </select>
                        <br>
                <table id="example" class="table table-striped table-bordered" style="width:100%" dir="ltr">
                    <thead>
                    <tr>
                        <th>ref code</th>
                        <th>item quantity</th>
                        <th>item code</th>
                        <th>item length</th>
                        <th>item serial</th>
                        <th style="display:none" >item stock</th>



                    </tr>
                    </thead>
                    <tbody>


                    </tbody>


                    <tfoot>
                    <tr>
                        <th>ref code</th>
                        <th>item quantity</th>
                        <th>item code</th>
                        <th>item length</th>
                        <th>item serial</th>
                   


                    </tr>
                    </tfoot>
                </table>


                <button style="width: 19%;" class="btn-sv" name="Draft" value="draft">Draft</button>
                <button style="width: 19%;" class="btn-sv" name="Confirm" value="confirm">Confirm</button>
                        </form>
            </div>


        </div>


@endsection

