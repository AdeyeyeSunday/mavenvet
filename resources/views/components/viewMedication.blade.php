
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Prescription(s)</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="modal-body">

                            <ul class="list-inline p-0 m-0 w-100">
                                <li>
                                    <div class="row align-items-top">
                                        <div class="col-md-3">

                                            {{-- <h6 class="mb-2">{{ $attribute2 ?? '' }}</h6> --}}
                                        </div>
                                        <div class="col-md-9">
                                            <div class="media profile-media align-items-top">
                                                <div class="profile-dots border-primary mt-1"></div>
                                                <div class="ml-4">
                                                    <h6 class=" mb-1">Prescription & Services
                                                    </h6>
                                                    @if (!$attribute1->isEmpty())
                                                    @foreach ($attribute1 as $r)
                                                        @php
                                                            $cat = App\Models\Medicationcategoty::where('id', $r->med_category ?? '')->first();
                                                        @endphp

                                                        @if ($cat != null)
                                                            <p class="mb-0"><strong>Description:</strong> {!! nl2br(e($cat->med_desc ?? '')) !!}</p>
                                                            <p class="mb-0">{!! nl2br(e($r->medication ?? '')) !!}</p>
                                                            @if ($r->dosage != null)
                                                                <p class="mb-0"><strong>Dosage:</strong> {!! nl2br(e($r->dosage ?? '')) !!}</p>
                                                            @endif
                                                        @else
                                                            <p class="mb-0"><em>No prescription was given to the pet</em></p>
                                                        @endif
                                                    @endforeach
                                                @else
                                                    <p class="mb-0"><em>No prescription was given to the pet</em></p>
                                                @endif

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn sidebar-bottom-btn btn-lg btn-block"
                            data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
