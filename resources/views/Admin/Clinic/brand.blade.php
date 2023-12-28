<x-admin-master>
    @section('content')

    <div class="container-fluid">
        <div class="row">
           <div class="col-sm-12 col-lg-4 col-md-4">
              <div class="card">

                @if (auth()->user()->userHasRole('Admin'))
                 <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                       <h6 class="card-title">Add Brand</h6>
                    </div>
                 </div>

               @endif

              @if (Session::has('message'))
              <center> <div class="alert alert-primary" role="alert">
             <div class="iq-alert-text">{{Session::get('message')}}</div>
            </div>
            </center>
              @endif

                 <div class="card-body">
                      <form action="{{route('Admin.Clinic.brand_store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="input-group mb-4">
                       <input type="text" name="brand" class="form-control" required >

                    </div>
                 <center>  <button class="btn btn-primary" type="submit">Submit</button></center>
                </form>
                 </div>
              </div>




           </div>
           <div class="col-sm-12 col-lg-6 col-md-6">
              <div class="card">
                 <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                       <h6 class="card-title">All Brand</h6>
                    </div>
                 </div>
                 <table class="table">
                    <thead>
                       <tr class="ligth">
                          <th scope="col">#</th>

                          <th scope="col">Name</th>
                          <th scope="col">Delete</th>
                       </tr>
                    </thead>
                    <tbody>
                        @foreach ($brand as $key=>$item)


                       <tr>
                          <th scope="row">{{$key+1}}</th>
                          <td>{{$item->brand}}</td>

                          <form action="{{route('Admin.Clinic.brand_destory',$item->id)}}" method="post" enctype="multipart/form-data">
                              @csrf
                              @method('DELETE')
                          <td> <a href="{{route('Admin.Clinic.brand_destory',$item->id)}}"><button class="btn btn-danger">  Delete</button></td></a>
                        </form>
                       </tr>

                       @endforeach

                    </tbody>
                 </table>


                 </div>
              </div>






           </div>
        </div>
     </div>

    @endsection
</x-admin-master>
