@extends("include")

@section("body")

        <!-- Main Section ------------------------------------------------------------------------------->
      <div class="main-cont">
            <div class="new-pur">
                <h6>Branch List</h6>
                <hr>
                 <table class="tab1-tab">
                        <tr>
                            <th><i class="fas fa-cog fa-lg"></i> Branch Name</th>
                            <th>Comment</th>
                            <th>Supplier sku</th>
                            <th>Unit</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Discount</th>
                            <th>Tax Rule</th>
                            <th>Total</th>
                        </tr>
                      <tfoot>
                        <tr>
                            <td colspan="4">Total</td>
                            <td colspan="4">0</td>
                            <td>0.0</td>
                        </tr>
                      </tfoot>
                    </table>
                    <div class="links">
                        <a class="add-row" href="#"><i class="far fa-plus-square"></i> Add Branch</a>
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
            </div>
        </div>
        <div class="main-cont2">
            <!--
            <div  data-addui='tabs'>
                <div class="tabs" role='tabs'>
                  <div><i class="fas fa-shopping-cart"></i> Order</div>
                  <div><i class="far fa-file-alt"></i> Invoice</div>
                  <div><i class="fas fa-dolly"></i> Stock Received</div>
                  <div><i class="far fa-sticky-note"></i> Credit Note</div>
                  <div><i class="fas fa-dolly"></i>Unstock</div>
                  <div>Manual Journal</div>
                  <div>Logs & Attributes</div>
                </div>
                <hr>
                <div role='contents'>
                  <div class="tab1">
                    <button class="active add-row"><i class="fas fa-plus"></i></button>
                    <button><i class="fas fa-bars"></i> Family</button>
                    <button><i class="fas fa-barcode"></i> Scan</button>
                    <button>Verify an Order</button>
                    <table class="tab1-tab">
                        <tr>
                            <th><i class="fas fa-cog fa-lg"></i> Product</th>
                            <th>Comment</th>
                            <th>Supplier sku</th>
                            <th>Unit</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Discount</th>
                            <th>Tax Rule</th>
                            <th>Total</th>
                        </tr>
                      <tfoot>
                        <tr>
                            <td colspan="4">Total</td>
                            <td colspan="4">0</td>
                            <td>0.0</td>
                        </tr>
                      </tfoot>
                    </table>
                    <div class="links">
                        <a class="add-row" href="#"><i class="far fa-plus-square"></i> Add more items</a>
                        <a class="exp" href="#"><i class="fas fa-sign-out-alt"></i> Export</a>
                        <a class="imp" href="#"><i class="fas fa-sign-in-alt"></i> Import</a>
                    </div>
-->
<!--
                    <div class="down">
                        <div class="text">
                            <p>Purchase Order Memo</p>
                            <textarea name="" id="" cols="40" rows="2" placeholder="write your note here"></textarea>
                        </div>
                        <div class="table-data">
                            <table>
                                <tr>
                                    <th colspan="2">ORDER LINES</th>
                                    <th colspan="2">ADDITIONAL COSTS</th>
                                    <th colspan="2">TOTAL</th>
                                </tr>
                                <tr>
                                    <td>Before Tax</td>
                                    <td>0.00</td>
                                    <td>Before Tax</td>
                                    <td>0.00</td>
                                    <td>Before Tax</td>
                                    <td>0.00</td>
                                </tr>
                                <tr>
                                    <td>Tax</td>
                                    <td>0.00</td>
                                    <td>Tax</td>
                                    <td>0.00</td>
                                    <td>Tax</td>
                                    <td>0.00</td>
                                </tr>
                                <tfoot>
                                    <tr>
                                        <td>Total</td>
                                        <td>0.00</td>
                                        <td>Total</td>
                                        <td>0.00</td>
                                        <td>Total</td>
                                        <td>0.00</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="clear-fix"></div>
                    <table class="last-tbl">
                        <tr>
                            <th><i class="fas fa-cog fa-lg"></i> account</th>
                            <th>reference</th>
                            <th>Date paid</th>
                            <th>amount</th>
                        </tr>
                        <tr>
                            <td colspan="4">You do not have any supplier deposits.</td>
                        </tr>
                        <tfoot>
                            <td colspan="3">Balance Due</td>
                            <td>0.00</td>
                        </tfoot>
                    </table>
                    <div class='clear-fix'></div>
                    <button class="save"><i class="far fa-save"></i> Save</button>

                  </div>
                  <div>
                    <p>Tab 2 Content</p>
                  </div>
                  <div>
                    <p>Tab 3 Content</p>
                  </div>
                  <div>
                    <p>Tab 4 Content</p>
                  </div>
                  <div>
                    <p>Tab 5 Content</p>
                  </div>
                  <div>
                    <p>Tab 6 Content</p>
                  </div>
                  <div>
                    <p>Tab 7 Content</p>
                  </div>
                </div>
              </div>
        </div>
-->
    </div>


@endsection
