<!-- barcodegenerator.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laravel Barcode Generator Tutorial With Example </title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>
<body>
{{--<h2>Laravel Barcode Generator Tutorial With Example</h2><br/>--}}
<div class="container text-center">
{{--    <h2>One-Dimensional (1D) Barcode Types</h2><br/>--}}
{{--    0101001002228828901808001000000006--}}
    <div>{!!DNS1D::getBarcodeSVG('0101001002228828901808001000000006', 'I25',1,33)!!}</div></br>

{{--    <div>{!!DNS1D::getBarcodeHTML('0101001002228828901808001000000006', 'I25')!!}</div></br>--}}
{{--    <div>{!!DNS1D::getBarcodeHTML('0101001002228828901808001000000006', 'MSI+')!!}</div></br>--}}
{{--    <div>{!!DNS1D::getBarcodeHTML('0101001002228828901808001000000006', 'POSTNET')!!}</div></br>--}}
    <br/>
    <br/>
{{--    <h2>Two-Dimensional (2D) Barcode Types</h2><br/>--}}
{{--    <div>{!!DNS2D::getBarcodeHTML(335553, 'QRCODE')!!}</div></br>--}}
{{--    <div>{!!DNS2D::getBarcodeHTML(142535, 'PDF417')!!}</div></br>--}}
{{--    <div>{!!DNS2D::getBarcodeHTML(646, 'DATAMATRIX')!!}</div></br>--}}
</div>
</body>
</html>
