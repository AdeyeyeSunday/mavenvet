<x-admin-master>
    @section('content')
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div class="header-title">
                                <h6 class="card-title">Registration list</h6>
                            </div>


                            <div class="header-title">
                                <a href="{{ route('Admin.Clinic.Clinic') }}"><button class="btn sidebar-bottom-btn btn-lg">Add
                                        new pet</button></a>
                            </div>
                        </div>
                        <div class="card-body">

                            <div class="table-responsive">
                                <table id="datatable" class="table data-table table-striped">
                                    <thead>
                                        <tr class="">
                                            <th>Pat name</th>
                                            <th>Pet parent</th>
                                            <th>Contact number.</th>
                                            <th>Registered by</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($clinic as $clinic)
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div>
                                                        {{ $clinic->Pet_name }}
                                                        <p class="mb-0"> Card no.: {{ $clinic->Pet_Card_Number }}</p>
                                                        <p class="mb-0">Breed: {{ $clinic->Breed }} </p>
                                                        <p class="mb-0">Color: {{ $clinic->Color }}</p>
                                                        @php
                                                        $birthdate = \Carbon\Carbon::parse($clinic->Age);
                                                        $age = $birthdate->age;
                                                        $months = $birthdate->diffInMonths(\Carbon\Carbon::now()) % 12;
                                                        $years = floor($birthdate->diffInMonths(\Carbon\Carbon::now()) / 12);
                                                        @endphp
                                                        <p class="mb-0">Age: {{ $years }} years and {{ $months }} months</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $clinic->Name_Of_Pet_Owner }}</td>
                                            <td>{{ $clinic->Owner_Phone_Number }}</td>
                                            <td>{{ $clinic->Veterinarian }}</td>
                                            <td>
                                                <button class="btn sidebar-bottom-btn btn-sm dropdown-toggle" type="button"
                                                    id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                    <i class="fas fa-caret-down"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right"
                                                    aria-labelledby="dropdownMenuButton">
                                                  <center> <p> <a style="color: black" href="{{ route("Admin.Clinic.encounter",$clinic->id) }}">Begin encounter</a></p>
                                                  <p>  <a style="color: black"  href="#">Pat history</a></p></center>
                                                </div>

{{--
                                        <div class="d-flex align-items-center list-action">
                                            <a class="badge badge-info mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="View"
                                                href="{{route('Admin.Clinic.Clinic_view',$clinic->id)}}"><i class="ri-eye-line mr-0"></i></a>
                                            <a class="badge bg-success mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"
                                                href="{{route('Admin.Clinic.Clinic_edit',$clinic->id)}}"><i class="ri-pencil-line mr-0"></i></a>
                                            <a class="badge bg-warning mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"
                                                href="{{route('Admin.Clinic.destory',$clinic->id)}}"><i class="ri-delete-bin-line mr-0"></i></a> --}}
                                        </div>
                                            </td>
                                            </tr>
                                    </tbody>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        </div>
    @endsection
</x-admin-master>
