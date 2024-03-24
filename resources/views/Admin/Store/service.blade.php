<x-admin-master>
    @section('content')
    <div class="container-fluid add-form-list">
        <div class="row">
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h6 class="card-title">Add Service</h6>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{route('Admin.Store.service_store')}}" method="post" data-toggle="validator">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Service </label>
                                        <input type="text" class="form-control" name="service" placeholder="Enter service" required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Amount </label>
                                        <input type="number" class="form-control" name="amount" placeholder="Enter amount" required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn sidebar-bottom-btn mt-4 btn-lg btn-block">Add service</button>
                        </form>
                    </div>

                </div>
            </div>


            <div class="col-sm-12 col-lg-6">
                <div class="card">
                   <div class="card-header d-flex justify-content-between">
                      <div class="header-title">
                         <h6 class="card-title">All Service</h6>
                      </div>
                   </div>
                   <div class="card-body">
                      <div class="card-body">

                          <div class="table-responsive">
                              <table class="data-table table mb-0 tbl-server-info">
                                  <thead class="bg-white text-uppercase">
                                      <tr class="ligth ligth-data">
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Amount</th>
                                      </tr>
                                  </thead>
                                  <tbody class="ligth-body">
                                    @foreach ($service as $item)
                                      <tr>

                                            <td>{{$item->id}}</td>
                                            <td>{{$item->service}}</td>
                                            <td>{{$item->amount}}</td>

                                      </tr>
                                  </form>
                                      </tr>
                                      @endforeach
                                  </tbody>
                              </table>
                      </table>
                   </div>
                </div>
            </div>
        </div>




        <!-- Page end  -->
    </div>

      </div>

    </div>

    @endsection
</x-admin-master>
