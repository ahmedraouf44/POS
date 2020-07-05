function getItemStock() {
    // $("#serial").change(function(){
    var item_serial = document.getElementById("serial").value;
    // alert(item_serial);
    $.ajax({
        url: '/getitemStockBySerial',
        type: "GET",
        data: {'serial': item_serial},
        contentType: 'application/json; charset=utf-8',
        success: function (data) {
            if (data['item_serial'] != "not found") {

                var runners = [100222882, 100222884, 100222890, 100222892, 100222900, 100222901, 100222907, 100222908, 100222917, 100214366, 100222727, 100222729, 100222730, 100218359, 100214367, 100222731, 100222732, 100222745, 100219310, 100214359, 100214368, 100222746, 100222747, 100216376, 100216378, 100216380, 100216375, 100216382, 100216383, 100216384, 100214193, 100214192, 100214191
                    , 100216366
                    , 100216367
                    , 100216368
                    , 100216370
                    , 100216371
                    , 100216372
                    , 100222899
                    , 100222918
                    , 100219309
                    , 100214358
                    , 100222744
                    , 100216392
                    , 100216374
                    , 100216379
                    , 100216389
                    , 100222919
                    , 100214357
                    , 100222893
                    , 100222909
                    , 100222885
                    , 100222916];

                console.log(data);
                var exist = runners.includes(data['item_code']);
                console.log(exist);
                var table = $('#example4').DataTable();
                if (exist) {
                    console.log(data['item_length']);
                    table.row.add([

                        data['ref_code'],
                        data['item_quantity'],
                        data['item_code'],
                        '<td>  <input style="width: 132px;" step="any" type="number" id="SelectedLength" name="length[]" value="0" min="0"  max="' + data['item_length'] + '"></td>',

                        data['item_serial'],
                        ' <td><input type="number" style="width: 207px;" value="0" name="discountValues[]" > </td>',
                        ' <td> <select style=" width: 207px;" name="discount_type1[]"> <option value="1"> نسبة</option><option value="2"> قيمة</option></select></td>',
                        ' <td><input type="hidden" value=" ' + data['item_stock_id'] + '" name="iditem_stock[]" ></td>'


                    ]).draw(false);
                } else {
                    table.row.add([

                        data['ref_code'],
                        data['item_quantity'],
                        data['item_code'],
                        '<td>  <input style="width: 132px;" step="any" type="number" id="SelectedLength" name="length[]" value="' + data['item_length'] + '" min="' + data['item_length'] + '"  max="' + data['item_length'] + '"></td>',

                        data['item_serial'],
                        ' <td><input type="number" style="width: 207px;" value="0" name="discountValues[]" > </td>',
                        ' <td> <select style="width: 207px;" name="discount_type1[]"> <option value="1"> نسبة</option><option value="2"> قيمة</option></select></td>',
                        ' <td><input type="hidden" value=" ' + data['item_stock_id'] + '" name="iditem_stock[]" ></td>',


                    ]).draw(false);
                }

                document.getElementById("serial").value = "";
                document.getElementById("serial").focus();
            } else {
                alert('هذا المنتج غير موجود');
                document.getElementById("serial").value = "";
                document.getElementById("serial").focus();
            }

        }

    });

}

function changeTax() {
    var checkTax = document.getElementById("Tax_amountCheck");
    if (checkTax.checked == false) {
        document.getElementById("Tax_amount").value = 0;
    } else {
        document.getElementById("Tax_amount").value = 14;
    }
}


function autocomplete(inp, arr) {
    // console.log(arr[0]['customer_phone']);
    /*the autocomplete function takes two arguments,
    the text field element and an array of possible autocompleted values:*/
    var currentFocus;
    /*execute a function when someone writes in the text field:*/
    inp.addEventListener("input", function (e) {
        var a, b, i, val = this.value;
        /*close any already open lists of autocompleted values*/
        closeAllLists();
        if (!val) {
            return false;
        }
        currentFocus = -1;
        /*create a DIV element that will contain the items (values):*/
        a = document.createElement("DIV");
        a.setAttribute("id", this.id + "autocomplete-list");
        a.setAttribute("class", "autocomplete-items");
        /*append the DIV element as a child of the autocomplete container:*/
        this.parentNode.appendChild(a);
        /*for each item in the array...*/
        for (i = 0; i < arr.length; i++) {
            /*check if the item starts with the same letters as the text field value:*/
            if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
                /*create a DIV element for each matching element:*/
                b = document.createElement("DIV");
                //b.setAttribute("onfocusout", "getcustomerData();");
                //onfocusout="getcustomerData()"
                /*make the matching letters bold:*/
                b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
                b.innerHTML += arr[i].substr(val.length);
                /*insert a input field that will hold the current array item's value:*/
                b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
                /*execute a function when someone clicks on the item value (DIV element):*/
                b.addEventListener("click", function (e) {

                    /*insert the value for the autocomplete text field:*/
                    inp.value = this.getElementsByTagName("input")[0].value;
                    getcustomerData(this.getElementsByTagName("input")[0].value);
                    /*close the list of autocompleted values,
                    (or any other open lists of autocompleted values:*/
                    closeAllLists();
                });
                a.appendChild(b);
            }
        }
    });
    /*execute a function presses a key on the keyboard:*/
    inp.addEventListener("keydown", function (e) {
        var x = document.getElementById(this.id + "autocomplete-list");
        if (x) x = x.getElementsByTagName("div");
        if (e.keyCode == 40) {
            /*If the arrow DOWN key is pressed,
            increase the currentFocus variable:*/
            currentFocus++;
            /*and and make the current item more visible:*/
            addActive(x);
        } else if (e.keyCode == 38) { //up
            /*If the arrow UP key is pressed,
            decrease the currentFocus variable:*/
            currentFocus--;
            /*and and make the current item more visible:*/
            addActive(x);
        } else if (e.keyCode == 13) {
            /*If the ENTER key is pressed, prevent the form from being submitted,*/
            e.preventDefault();
            if (currentFocus > -1) {
                /*and simulate a click on the "active" item:*/
                if (x) x[currentFocus].click();
            }
        }
    });

    function addActive(x) {
        /*a function to classify an item as "active":*/
        if (!x) return false;
        /*start by removing the "active" class on all items:*/
        removeActive(x);
        if (currentFocus >= x.length) currentFocus = 0;
        if (currentFocus < 0) currentFocus = (x.length - 1);
        /*add class "autocomplete-active":*/
        x[currentFocus].classList.add("autocomplete-active");
    }

    function removeActive(x) {
        /*a function to remove the "active" class from all autocomplete items:*/
        for (var i = 0; i < x.length; i++) {
            x[i].classList.remove("autocomplete-active");
        }
    }

    function closeAllLists(elmnt) {
        /*close all autocomplete lists in the document,
        except the one passed as an argument:*/
        var x = document.getElementsByClassName("autocomplete-items");
        for (var i = 0; i < x.length; i++) {
            if (elmnt != x[i] && elmnt != inp) {
                x[i].parentNode.removeChild(x[i]);
            }
        }
    }

    /*execute a function when someone clicks in the document:*/
    document.addEventListener("click", function (e) {
        closeAllLists(e.target);
    });
}

function auto() {
    // $("#serial").change(function(){
    var item_serial = document.getElementById("serial").value;

    $.ajax({
        url: '/getcustomers',
        type: "GET",

        contentType: 'application/json; charset=utf-8',
        success: function (data) {

            var numeric_array = [];
            for (var item in data) {
                numeric_array.push(data[item]['customer_phone'].toString());
            }
            console.log(numeric_array[0]);
            var element1 = document.getElementById("skill_input");
            autocomplete(element1, numeric_array);


        }


    });


}

function getcustomerData(phone) {

    // var element1=document.getElementById("skill_input");
    // var phone=element1.value;
    // console.log(element1.value);
    $.ajax({
        url: '/getcustomerByPhone',
        type: "GET",
        data: {'phone': phone},
        contentType: 'application/json; charset=utf-8',
        success: function (data) {

            console.log(data['customer_id']);
            if (data) {
                var iputCustomerName = document.getElementById("customer_name");
                // var cutomerid = document.getElementById("cutomerid");
                // cutomerid.value = data['customer_id'];
                iputCustomerName.value = data['customer_name'];
                var iputCustomerAddress = document.getElementById("customer_address");
                iputCustomerAddress.value = data['customer_address'];


                $idinput = document.getElementById("customer_id");
                $idinput.value = data['customer_id'];

            } else {
                iputCustomerName.value = "";
                iputCustomerAddress.value = "";
                console.log(data);

            }


        }


    });


}


function ItemStock() {
    // $("#serial").change(function(){
    var item_serial = document.getElementById("serial1").value;

    $.ajax({
        url: '/itemBySerial',
        type: "GET",
        data: {'serial': item_serial},
        contentType: 'application/json; charset=utf-8',
        success: function (data) {
            var runners = [100222882, 100222884, 100222890, 100222892, 100222900, 100222901, 100222907, 100222908, 100222917, 100214366, 100222727, 100222729, 100222730, 100218359, 100214367, 100222731, 100222732, 100222745, 100219310, 100214359, 100214368, 100222746, 100222747, 100216376, 100216378, 100216380, 100216375, 100216382, 100216383, 100216384, 100214193, 100214192, 100214191
                , 100216366
                , 100216367
                , 100216368
                , 100216370
                , 100216371
                , 100216372
                , 100222899
                , 100222918
                , 100219309
                , 100214358
                , 100222744
                , 100216392
                , 100216374
                , 100216379
                , 100216389
                , 100222919
                , 100214357
                , 100222893
                , 100222909
                , 100222885
                , 100222916];

            console.log(data);
            var exist = runners.includes(data['item_code']);
            console.log(exist);
            var table = $('#example5').DataTable();
            if (exist) {
                table.row.add([
                    data['ref_code'],
                    data['item_quantity'],
                    data['master']['quality'],
                    data['master']['grade'],
                    data['item_code'],
                    '<td>  <input style="width: 132px;" step="any" type="number" id="SelectedLength" name="length[' + data['item_stock_id'] + ']" value="' + data['item_length'] + '" min="0"  max="' + data['item_length'] + '"></td>',
                    data['item_width'],
                    data['item_serial'],

                ]).draw(false);
            } else if (data['item_serial'] != "not found") {
                table.row.add([
                    data['ref_code'] + '<input  type="hidden" id="Selectedids" name="quantity[' + data['item_stock_id'] + ']" value="' + data['item_quantity'] + '" >',
                    data['item_quantity'],
                    data['master']['quality'],
                    data['master']['grade'],
                    data['item_code'],
                    data['item_length'],
                    data['item_width'],
                    data['item_serial'],

                ]).draw(false);
            } else {
                alert('هذا المنتج غير موجود');
            }

            // table.row.add([
            //
            //     data['ref_code'],
            //     // data['item_quantity'],
            //     '<td>  <input style="width: 132px;" step="any" type="number" id="Selectedquantity" name="quantity['+data['item_stock_id']+']" value="'+data['item_quantity']+'" readonly></td>',
            //     data['item_code'],
            //     data['item_length'],
            //     // '<td>  <input style="width: 132px;" step="any" type="number" id="SelectedLength" name="length[]" value="'+data['item_length']+'" min="'+data['item_length']+'"  max="'+data['item_length']+'"></td>',
            //
            //     data['item_serial'],
            //
            // ]).draw(false);


            document.getElementById("serial1").value = "";
            document.getElementById("serial1").focus();
        }


    });

}

function confirmSerial(items, id) {
    var find_item_serial = document.getElementById("findserial3" + id).value;

    // var item_serial=$(this).value;


    console.log(find_item_serial);
    console.log(items);

    var result = items.find(({item_serial}) => item_serial === find_item_serial)
    if (result) {
        $('#i'+result['stock_doc_details_id']).css('display','');
                // $('#item'+element['stock_doc_details_id']).val(find_item_serial);

                $('#append'+result['stock_doc_details_id']).empty();
                $('#append'+result['stock_doc_details_id']).append('<i class="text-success fas fa-check-circle"></i>');

                $('#checked'+result['stock_doc_details_id']).val("1");
    }else{
        alert('لم يتم العثور على هذا المنتج');
    }





    document.getElementById("findserial3" + id).value = "";
    document.getElementById("findserial3" + id).focus();
}

// function confirmSerial()
// {
//     // $("#serial").change(function(){
//     var item_serial=document.getElementById("serial2").value;
//
//     $.ajax({
//         url: '/confirmSerial',
//         type: "GET",
//         data:{'serial': item_serial},
//         contentType: 'application/json; charset=utf-8',
//         success: function (data) {
//
//             forEach()
//             console.log(data);
//             var exist = runners.includes( data['item_code']);
//             console.log(exist);
//             var table = $('#example5').DataTable();
//             if(exist)
//             {
//                 table.row.add([
//
//                     data['ref_code'],
//                     data['item_quantity'],
//                     data['item_code'],
//                     '<td>  <input style="width: 132px;" step="any" type="number" id="SelectedLength" name="length['+data['item_stock_id']+']" value="'+data['item_length']+'" min="0"  max="'+data['item_length']+'"></td>',
//
//                     data['item_serial'],
//
//                 ]).draw(false);
//             }
//             else{
//                 table.row.add([
//
//                     data['ref_code'],
//                     // data['item_quantity'],
//                     '<td>  <input style="width: 132px;" step="any" type="number" id="Selectedquantity" name="quantity['+data['item_stock_id']+']" value="'+data['item_quantity']+'" readonly></td>',
//                     data['item_code'],
//                     data['item_length'],
//                     // '<td>  <input style="width: 132px;" step="any" type="number" id="SelectedLength" name="length[]" value="'+data['item_length']+'" min="'+data['item_length']+'"  max="'+data['item_length']+'"></td>',
//
//                     data['item_serial'],
//
//                 ]).draw(false);
//             }
//
//             document.getElementById("serial1").value = "";
//         }
//
//
//
//     });
//
// }
