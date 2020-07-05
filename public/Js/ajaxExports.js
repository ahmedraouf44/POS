

function create_check()
{

   

    // var token =  document.getElementsByName('csrf-token').value;
    var token =   $('input[name="_token"]').attr('value');

            var form_data = new FormData();
       
    var check_cutomer=document.getElementById('check_cutomer').value;
    var check_number=document.getElementById('check_number').value;
    var bank_name=document.getElementById('bank_name').value;
    var check_value=document.getElementById('check_value').value;
    // var check_image=document.getElementById('check_image').files[0].name;
    var check_date=document.getElementById('check_date').value;
// start trying to send photo to php ajax 
   

form_data.append("check_image", document.getElementById('check_image').files[0]);
form_data.append('_token',token);

form_data.append('check_cutomer',check_cutomer);
form_data.append('check_number',check_number);
form_data.append('bank_name',bank_name);
form_data.append('check_value',check_value);
form_data.append('check_date',check_date);
// end trying to send photo to php ajax 



//   console.log(check_cutomer);
  
    $.ajax({
        url: '/create_check',
        type: "POST",
        data:form_data,
        // contentType: 'application/json; charset=utf-8',
        processData: false,
        contentType: false,
       
        success: function (data) {
           
            document.getElementById('check_id').value=data;
            alert('check created');
        console.log(data);
        document.getElementById("closecheck").click(); 
 
 
        }
 
 
 
 });

}

function getOrdersByDate(SelectedDate){

    
     // var element1=document.getElementById("skill_input");
    // var phone=element1.value;
    console.log(SelectedDate);
    $.ajax({
        url: '/getorderByDate',
        type: "GET",
        data:{'order_date':SelectedDate},
        contentType: 'application/json; charset=utf-8',
        success: function (data) {
          var table = $('#exampleexports').DataTable();
            console.log(data);
            if(data.length>0)
            {
                var total=0;
                for(var i=0;i<data.length;i++)
                {
                    total+= data[i]['net_amount'];

                    table.row.add([
                        data[i]['total_amount'],
                        data[i]['net_amount'],
                        data[i]['discount'],
              
                        data[i]['tax_amount'],
                        
                        data[i]['order_number'],
                        '<input type="hidden" name="idMaster[]" value="'+data[i]['order_master_id']+'">' 
        
        
                    ]).draw(false);
                }
             
                document.getElementById("exportButton").style.display='block';
                document.getElementById("total").innerHTML='<span>'+ total +' EGP</span>';
              console.log(total);
              
          
        }
        else{
            document.getElementById("exportButton").style.display='none';
            
            table.clear().draw();

        }



        }



});
}






function getExportsByDate(SelectedDate){

        // var element1=document.getElementById("skill_input");
   // var phone=element1.value;
   console.log(SelectedDate);
   $.ajax({
       url: '/getExportsByDate',
       type: "GET",
       data:{'order_date':SelectedDate},
       contentType: 'application/json; charset=utf-8',
       success: function (data) {
         var table = $('#exampleexportsofDay').DataTable();
           console.log(data);
           if(data.length>0)
           {
               var total=0;
               for(var i=0;i<data.length;i++)
               {
                   total+= data[i]['net_amount'];

                   table.row.add([
                       data[i]['total_amount'],
                       data[i]['net_amount'],
                       data[i]['discount'],
             
                       data[i]['tax_amount'],
                       
                       data[i]['order_number'],
                       '<input type="hidden" name="idMaster[]" value="'+data[i]['order_master_id']+'">' 
       
       
                   ]).draw(false);
               }
            
               document.getElementById("exportButton").style.display='block';
               document.getElementById("total").innerHTML='<span>'+ total +' EGP</span>';
             console.log(total);
             
         
       }
       else{
        //    document.getElementById("exportButton").style.display='none';
           
           table.clear().draw();

       }



       }



});
}

function discount1()
{
    var elementDiscountType=document.getElementById("discount_type1");
    var discountType=elementDiscountType.value;
    var elementDiscount=document.getElementById("discountId");
    if(discountType==1)
    {
        elementDiscount.max="100"
    }
    else{
        elementDiscount.max=""
    }
}
function saveCustomer()
{

     var element1Name=document.getElementById("customer_name");
    var name=element1Name.value;
    var element1Phone=document.getElementById("skill_input");
    var phone=element1Phone.value;
    var element1Address=document.getElementById("customer_address");
    var address=element1Address.value;
    var element1type=document.getElementById("customer_type");
    var type=element1type.value;
   
    
    $.ajax({
        url: '/saveCustomer',
        type: "GET",
        data:{'phone':phone,'name':name,'address':address,'type':type},
        contentType: 'application/json; charset=utf-8',
        success: function (data) {

            console.log(data.length);
            if(data)
            {
                if(data['exist']==false)
                {
                    $el=document.getElementById("plus");
                    element1Name.value=name;
                    element1Phone.value=phone;
                    element1Address.value=address;
                   $el.innerHTML='<i class="fas fa-check"></i>';
                   $el.classList.remove("btn-primary");
                   $el.classList.add("btn-success");
                    console.log(data);
                }
                else{
                    $el=document.getElementById("plus");
                    element1Name.value=name;
                    element1Phone.value=phone;
                    element1Address.value=address;
                   $el.innerHTML='<i class="fas fa-remove">already exist</i>';
                   $el.classList.remove("btn-primary");
                   $el.classList.add("btn-danger");
                    console.log(data);
                }
             
                
          
        }
        else{
           

        }


        }



});
}


function collect()
{
    var saleButton=document.getElementsByName("Confirm");
    
    saleButton.style.display="none";
    var collectButton=document.getElementsByName("collect");
    
    collectButton.style.display="block";

   
}
function reserved()
{
    var saleButton=document.getElementsByName("Confirm");
    alert(saleButton.value)
    saleButton.style.display="block";
    var collectButton=document.getElementsByName("collect");
    
    collectButton.style.display="none";
    

   
}

function card()
{
    
    
     
    var PayButton=document.getElementById("payment_type");
  
    if(PayButton.value==17)
    {
        
        PayButton.setAttribute("data-toggle", "modal");
        PayButton.setAttribute("data-target", "#neworder");
        var overDiv=document.getElementById('overdiv');
        overDiv.style.position= "unset";
    }
    else
    {       
        PayButton.removeAttribute("data-toggle");
        PayButton.removeAttribute("data-target");
        var overDiv=document.getElementById('overdiv');
        overDiv.style.position= "fixed";
    }
    

}


function closeDiv()
{
var overDiv=document.getElementById('overdiv');
overDiv.style.position= "fixed";

}

