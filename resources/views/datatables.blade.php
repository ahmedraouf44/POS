@extends("include")

@section("body")

    <!-- Main Section ------------------------------------------------------------------------------->


    <!-- end popup -->
    <!-- popup -->

    <!-- end popup -->

    <div class="main-cont">
        <div class="new-pur">
            <h6>قائمة الفروع</h6>
<form>
    <input>
     @csrf
</form>
            <input type="file" name="file" id="file">
            @csrf
{{--            <input id="csrfToken" name="csrfToken" value="@csrf" type="hidden">--}}
            <button onclick="sendfile()" name="send" value="send">send</button>
            <!----start herr ---->
        </div>
    </div>
@endsection
<script type="text/javascript">
    function  sendfile() {

    var token =  $('input[name="_token"]').attr('value');

    var formData = new FormData();
    formData.append('file', $('#file')[0].files[0]);
    formData.append('_token', token);
    $.ajax({
        url : '/datatables',
        type : 'post',
        data : formData,
        processData: false,  // tell jQuery not to process the data
        contentType: false,  // tell jQuery not to set contentType
        success : function(data) {
            console.log(data);
            alert(data);
        }
    });
    }
</script>








