function check(id) {
    // console.log('asdadqwqwd');
    var inputid = $('#item'+id).val();
    var existid = $('#serial'+id).text();
    // console.log(inputid,existid);
    // alert(inputid);
    // alert(existid);
    if (inputid == existid) {
        $('#append'+id).empty();
        $('#append'+id).append('<i class="text-success fas fa-check-circle"></i>');
        $('#checked'+id).val("1");
        // $('#append').append('<input type="checkbox" hidden required></input>');
    }else{
        $('#append'+id).empty();
        $('#append'+id).append('<i class="fas fa-times"></i>');
        $('#checked'+id).val(null);
        // $('#append').append('<input type="checkbox" hidden required></input>');
    }
}


