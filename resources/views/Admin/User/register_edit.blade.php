<x-admin-master>
    @section('content')


    <div class="row">

    <div class="col-lg-5">

        <form method="post" action="{{ route('Admin.User.register_update', $register_edit->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="form-group">
                <label class="form-label">Name</label>
               <input type="text" name="name" value="{{ $register_edit->name }}" class="form-control" id="">
                @error('name')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror


                 <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="">
                 @error('password')
                     <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                 @enderror
                 <input type="hidden" name="syn_flag" value="0" id="">
                 <label class="form-label">Confirm Password</label>
                 <input type="password_confirmation" name="password_confirmation" class="form-control" id="password_confirmation">
                  @error('password')
                      <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                  @enderror


                <div class="clearfix"></div>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
 </div>
</div>
</div>

</div>

</div-col-lg>

    @endsection
</x-admin-master>
