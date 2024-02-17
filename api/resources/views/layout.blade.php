<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <style>
        *{
            margin: 0px;
            padding: 0px;
        }
        .line{
            height: 1.5px;
            width: 100%;
            background: black;
            margin-top: 5px
        }
    </style>

</head>
<body>
    <header class="p-2" style="padding: 10px">
        <div class="flex-ku" >
            <div class="" style="width: 20%;float: left;">
                <img src="data:image/svg+xml;base64,<?php echo base64_encode(file_get_contents(base_path('public/img/headerimg.png'))); ?>" width="80px">
            </div>
            <div class="" style="width: 80%">
                <h1 class="text-center  " style="font-weight: bold;text-align: center;margin:0px;">RT.002/ RW.007</h1>
                <p class=" text-center" style="margin:0px; text-align: center;font-size: 12px">KELURAHAN CIKETING UDIK - KECAMATAN BANTAR GEBANG</p>
                <p class=" text-center" style="margin:0px; text-align: center;font-size: 12px">Jalan Pangkalan 6 RW 007 Kelurahan Ciketing Udik - Bantar Gebang</p>
                <div class="line"></div>
            </div>
        </div>
    </header>

    <div class="container">
        @yield('content')
    </div>

    <footer>
    </footer>
</body>
</html>
