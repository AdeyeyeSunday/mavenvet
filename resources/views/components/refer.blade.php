 {{-- this section is for refer --}}
 <div class="modal fade" id="exampleModalCenter3" tabindex="-1" role="dialog"
 aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
 <div class="modal-dialog modal-dialog-centered" role="document">
     <div class="modal-content">
         <div class="modal-header">
             <h6 class="modal-title" id="exampleModalCenterTitle">Last recommendation</h6>
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
             </button>
         </div>
         <div class="modal-body">
             <ul class="list-inline p-0 m-0 w-100">
                 <li>
                     <div class="row align-items-top">
                         <div class="col-md-3">
                             <h6 class="mb-2">{{ $refer->date ?? '' }}</h6>
                         </div>
                         <div class="col-md-9">
                             <div class="media profile-media align-items-top">
                                 <div class="profile-dots border-primary mt-1"></div>
                                 <div class="ml-4">
                                     <h6 class=" mb-1">Tranfer to
                                     </h6>
                                     <h6 class="mb-0 font-size-15">{!! nl2br(e($refer->clinic_name ?? '')) !!}</h6>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </li>
                 <li>
                     <div class="row align-items-top">
                         <div class="col-md-3">

                         </div>
                         <div class="col-md-9">
                             <div class="media profile-media align-items-top">
                                 <div class="profile-dots border-primary mt-1"></div>
                                 <div class="ml-4">
                                     <h6 class=" mb-1">Practitioner name</h6>
                                     <p class="mb-0 font-size-15">{{ $refer->practitioner_name ?? '' }}
                                     </p>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </li>
                 <li>
                     <div class="row align-items-top">
                         <div class="col-3">

                         </div>
                         <div class="col-9">
                             <div class="media profile-media pb-0 align-items-top">
                                 <div class="profile-dots border-primary mt-1"></div>
                                 <div class="ml-4">
                                     <h6 class=" mb-1">Purpose</h6>
                                     <p class="mb-0 font-size-15">{!! nl2br(e($refer->purpose_of_referral ?? '')) !!}</p>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </li>
                 <li>
                     <div class="row align-items-top">
                         <div class="col-9">
                             <div class="media profile-media pb-0 align-items-top">
                                 <div class="profile-dots border-primary mt-1"></div>
                                 <div class="ml-4">
                                     <h6 class=" mb-1">Veterinary Doctor</h6>
                                     @php
                                         $username = App\Models\User::where(
                                             'id',
                                             $refer->user_id ?? '',
                                         )->first();
                                     @endphp
                                     <p class="mb-0 font-size-15">{!! nl2br(e($username->name ?? '')) !!}</p>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </li>
             </ul>
         </div>
         <div class="modal-footer">
             <button type="button" class="btn sidebar-bottom-btn btn-lg btn-block"
                 data-dismiss="modal">Close</button>
         </div>
     </div>
 </div>
</div>
