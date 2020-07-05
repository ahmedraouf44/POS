<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>

    <title>Mail</title>
    <style>
      body {
        background-color: #ddd
      }
      .mail {
        width: 50%;
        height: 130px;
        margin: 55px auto;
        background-color: #FFF;
    }
      .mail-head {
        width: 100%;
        background-color: #eee;
        padding: 30px;
        text-align: center
    }
    .mail-body {
      background-color: #fff;
      padding: 30px
    }
    .mail-body p {
      width: 80%;
      margin: 20px auto
    }
    .mail-body button {
      background-color: #852c70;
      border: 1px solid #852c70;
      padding: 10px 13px;
      color: #fff;
      width: 200px;
      cursor: pointer;
      margin: 20px 10px;
    }
    .mail-fot {
      width: 100%;
      background-color: #333;
      padding: 30px;
    }
    .mail-fot {
      color: #fff
    }
    .mail-fot span {
      margin-right: 30px;
     }
     .soc {
      width: 100%;
      background-color: #222;
      padding: 30px;
     }

    </style>
</head>
  <body>
      <div class="mail">
          <div class="mail-head">
              <img src="{{asset('image/logo.jpg')}}" alt="pbc">
          </div>
          <div class="mail-body">
              <h4>Hello, {{$toUser->branch_name}}</h4>

              <table id="example" class="table table-striped table-bordered" style="width:100%">
                  <thead>
                  <tr>
                      <th>رقم الاذن</th>
                      <th>تاريخ الاذن</th>
                      <th>اسم الاذن</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($data as $doc)
                      <tr>
                          <td>{{$doc->stock_doc_id}}</td>
                          <td>{{$doc->stock_doc_date}}</td>
                          <td>{{$doc->doc_name}}</td>
                      </tr>
                  @endforeach

                  </tbody>
                  <tfoot>
                  <tr>
                      <th>رقم الاذن</th>
                      <th>تاريخ الاذن</th>
                      <th>اسم الاذن</th>
                  </tr>
                  </tfoot>
              </table>
            <hr>
              <div class="modal fade" id="exampleModal{{$doc->stock_doc_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                      <div class="modal-content">
                          <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">تفاصيل االاذن</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                              </button>
                          </div>
                          <div class="modal-body">
                              <table class="table">
                                  <thead>
                                  <tr>
                                      <th>رقم المنتج</th>
                                      <th>الكمية</th>
                                  </tr>
                                  </thead>
                                  <tbody>
                                  @foreach($data[0]->details as $item)
                                      <tr>
                                          <td>{{$item->item_serial}}</td>
                                          <td>{{$item->item_quantity}}</td>
                                      </tr>
                                  @endforeach
                                  </tbody>
                              </table>
                          </div>
                          <div class="modal-footer">

                          </div>
                      </div>
                  </div>
              </div>

{{--              <button>Link No.1</button>--}}
{{--              <button>Link No.2</button>--}}
{{--              <button>Link No.3</button>--}}
          </div>
          <div class="mail-fot">
              <p>Contact us</p>
{{--              <span>Tel: 0123456789</span>--}}
              <span>Email: pos@pbc-egy.com</span>
              <span>Website: pbc-egy.com</span>
          </div>
          <div class="soc">

          </div>
      </div>

