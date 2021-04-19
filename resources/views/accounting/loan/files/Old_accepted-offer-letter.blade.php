<div class="modal fade bd-example-modal-accepted-offer-letter" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="myLargeModalLabel">Signed Offer Letter</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                      <svg aria-hidden="true" xmlns="#" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                     @if (ltrim(strstr($letter_info->img_offer_letter, '.'), '.') == "pdf")
                                                    <iframe src="{{ asset('customerfiles/offerletters')}}/{{$letter_info->img_offer_letter}}" style="width:100%;height:700px;"></iframe>
                                                    @else
                                                    <img src="{{ asset('customerfiles/offerletters')}}/{{$letter_info->img_offer_letter}}" class="img-responsive" style="width:100%;">
                                                    @endif
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                                                    <button type="button" class="btn btn-primary">Save</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>