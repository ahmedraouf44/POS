@extends("include")



@section("body")


<!--  -->

<div class="main-cont">
        <div class="new-pur">
            <h6> التوريدات</h6>
            <hr>
            <div  data-addui='tabs'>
            <form action="/makeExport" method="post">
                     @csrf
                <input type="date" style="    width: 20%;" onchange="getExportsByDate(this.value)" class="form-control" name="order_date" id="inputDateOrder">
<input type="hidden" value="{{$branch_number}}" name="branch_number">
                
                <hr>
                <div role='contents'>

                    <div class="tab1">
                  
                        <!-- <form  method="post">
                            @csrf -->
                            <table id="exampleexportsofDay" class="table table-striped table-bordered" style="width:100%  ">
                                <thead>
                                <tr>
                                <!-- <th style="text-align:center"  >total price</th> -->
                                   
                                   <!-- <th> width</th> -->
                                   <!-- <th>item width</th> -->
                                   <th> السعر الكلي</th>
                                   <th> صافي المبلغ</th>
                                   <th>الخصم</th>
                                   <th>الضريبه</th>
                                   <th style="text-align:center">رقم الفاتورة</th>
                                  <th style="display:none"></th>
                                 
                                   
                                </tr>
                                </thead>
                                <tbody>
                             
                                    <tr >
                                      
                                  
                                    <td> </td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>

       
        </tr>
                                </tbody>
                                <tfoot>
                                <tr>
                                <th> السعر الكلي</th>
                                   <th> صافي المبلغ</th>
                                   <th>الخصم</th>
                                   <th>الضريبه</th>
                                   <th>رقم الفاتورة</th>
                                </tr>
                                </tfoot>
                      
                            </table>
                            <div class="inv-mid-2">
          
          <div class="mid-2-content-rt">
            <div>
            <p  style="font-weight: bold; color: #551646; display: block;">اجمالي اليوم</p>
              <p id="total" style="font-weight: bold; color: #551646;"> 0</p>
           
            </div>
            </div>
            </div>
          
              
                        </form>
<!-- 
                            <input type="submit" name="submit">
                        </form> -->

                    </div>

                </div>
            </div>
        </div>


    </div>



{{--    eeeeeeeeeeeee--}}


            <!-- add adress popup -------------------------------------------------------------------------->

        <!-- Main Section ------------------------------------------------------------------------------->



<script type="text/javascript">
    $(document).ready(function() {

        document.getElementById("exportButton").style.display='none';

        var table = $('#exampleexportsofDay').DataTable();

        $('#exampleexportsofDay tbody ').on( 'click','tr', function () {
            // $(this).toggleClass('selected');
            var checkbox =  $(this).find("input[type='checkbox']");
                checkbox.prop('checked',!checkbox.prop("checked"));


        } );

        $('#button').click( function () {
            alert( table.rows('.selected').data().length +' row(s) selected' );
        } );
    } );



</script>



@endsection

