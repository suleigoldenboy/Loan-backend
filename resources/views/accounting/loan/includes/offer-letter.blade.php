   <div class="modal fade offerLetterModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="myLargeModalLabel">Loan Offer Letter</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                      <svg aria-hidden="true" xmlns="#" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                                    </button>
                                                </div>
                                                <div class="modal-body" style="background-color:#f1f2f3;">
                                                    <p class="modal-text">
                                                    <?php
                                                      $customer_name = $data->customer->first_name;
                                                      $appied_loan_amount = $data->disbursed_amount ? $data->disbursed_amount : $data->principal;
                                                      $appied_loan_amount = '<b class="text-danger">₦'.number_format($appied_loan_amount,2).'</b>';
                                                      $the_letter =  str_replace("customer",$customer_name, $data->product->offer_letter->letter);
                                                      $the_letter =  str_replace("amount",$appied_loan_amount, $the_letter);
                                                      $the_letter =  str_replace("ddate","Disbursement Date:".$data->release_date, $the_letter);
                                                      $the_letter =  str_replace("mdate","Maturity Date:".$data->maturity_date, $the_letter);

                                                    ?>
                                                    {!!nl2br($the_letter)!!}
                                                    </p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                                                    {{-- <button type="button" class="btn btn-primary">Save</button> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>