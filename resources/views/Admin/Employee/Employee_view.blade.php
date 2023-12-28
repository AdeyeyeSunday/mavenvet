

 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/idCard.css')}}">
    <title>ID Card</title>
</head>
<body>
        <div class="container">
            <div class="padding">
                <div class="font">

                    <div class="top">
                        <h5 style="text-align: center;padding: 13px; color:white; font-size:19px;" >Maven Veterinary Consult</h5>
                        {{-- <img src="{{asset('storage/'.$employee_view->image)}}"> --}}
                        <img src="{{asset('image/DSC_4815.jpg')}}" alt="">

                    </div>

                    <div class="bottom">
                        <p>{{$employee_view->user->name}}</p>
                        <p class="desi">{{$employee_view->position}}</p><br><br>
                        <p style="font-size: 18px; margin-right: 79px">Staff No: {{$employee_view->staff_no}}</p><br>
                        <p style="font-size: 18px; margin-right: 15px"> Number: {{$employee_view->number}}</p>
                        {{-- <p class="no">{{$employee_view->address}}</p> --}}
                    </div>

                </div>
            </div>

            <div class="back">
                <h1 class="Details">Information</h1>
                <hr class="hr">
                <div class="details-info">
                    <p><b>Head Office Email : </b></p>
                    <p>chrisoceanel@gmail.com.</p><br>
                    <p><b>Head Office Mobile No: </b></p>
                    <p>08036909584.</p><br>
                    <p><b>Head Office Address:</b></p>
                    <p class="mb-0">Maven Veterinary consult shop 3 4,5Tricia plaza anwii/Government house road beside bank interbau flyover Delta Asaba.
                    </div><br>
                    <div class="logo">
                        {{-- @php
                        $generatorPNG = new Picqer\Barcode\BarcodeGeneratorPNG();
                    @endphp
                <center> <img src="data:image/png;base64, {{ base64_encode($generatorPNG->getBarcode('Maven', $generatorPNG::TYPE_CODE_128)) }}" style="30px;"></center> --}}
                    </div>
                    <hr>
                </div>
            </div>
        </div>
</body>
</html>

    {{-- @endsection
 </x-admin-master> --}}
