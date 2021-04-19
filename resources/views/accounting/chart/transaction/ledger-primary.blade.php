 <?php
  use App\Http\Controllers\Account\AccountsController;
?>
<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
        <div class="ac_chart">
          
          <div class="reports-breads">
            <h4 class="text-info">
            Transaction Report From 
            <span class="filter-txt-highligh">
              <?php  
                    $d_fromDate = new \DateTime($fromDate);
                    $get_fromDate =  $d_fromDate->format('D M d, Y');

                    $d_toDate = new \DateTime($toDate);
                    $get_toDate =  $d_toDate->format('D M d, Y');
                    
                ?>
              (

              {{$get_fromDate}} - {{$get_toDate}}

             ) </span>
                For the 
            <span class="filter-txt-highligh"> ({{$tranRec->name}}) Account </span>
            
          </h4>
          </div>

          <div class="col-sm-1">
           
          </div>

             <table class="table table-striped table-bordered">
              <tr>
                <th width="90">Tran ID</th>
                <th>Account Name</th>
                <th>Code</th>
                <th>Tran Date</th>
                <th>Item</th>
                <th>Description</th>
                <th>Debit</th>
                <th>Credit</th>
                <th>Balance</th>
              </tr>
         
              <?php $sumTotal = 0;  $total_sumDebit = 0; $total_sumCredit = 0;  ?>
           @foreach($tranRec->children as $subacc)
           
              <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td style="text-align: center;"><b style="color: blue;">{{$subacc->name}}</b></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
              <?php $transActionID = 1; $sum = 0; $sumDebit = 0; $sumCredit = 0;  $checkBalanceCount = 0; $displayBalnce =0; $mainBalance = 0; $sumMainTotal = 0; ?>

              @if($checkBalanceCount == 0)
                  
                  <tr>
                  <td>00{{$transActionID}}</td>
                  <td>{{$subacc->name}}</td>
                  <td>{{$subacc->code}}</td>
                  <td>
                    {{$get_fromDate}}
                  </td>
                  <td></td>
                  <td></td>
                  <td>0</td>
                  <td>0</td>
                 
                  <td>
                    
                    <?php 

                      $the_cur_balance = AccountsController::getCurrentAccountBalance($subacc->id,$fromDate); 
                     // AccountsController::setAddBalance("lastBalance",$the_cur_balance,$tran->credit_amount);

                      $mainBalance += $the_cur_balance;
                    ?>

                      <b>₦{{number_format($mainBalance)}}</b>

                    
                  </td>
                </tr>

                <?php 
                    $sum = AccountsController::getAddBalance(); 
                    $checkBalanceCount = 1; 
                    $transActionID += 1; 
                  ?>
                 @endif


              @foreach(AccountsController::getAccTransHistory($subacc->id,$subacc->code,$fromDate,$toDate) as $tran)
                

                <tr>
                  <td>00{{$transActionID}}</td>
                  <td>{{$subacc->name}}</td>
                  <td>{{$subacc->code}}</td>
                  <td>
                    <?php  
                        $reportDate = str_replace("/","-",$tran->transaction_date);
                        $a_dcdate = new \DateTime($tran->transaction_date);
                        $Ac_tualDueDate =  $a_dcdate->format('D M d, Y');
                        echo $Ac_tualDueDate;
                   ?>
                   <br>
                   <a href="{{ url('accounting/transaction/history/'.$tran->transactionID) }}">Journal History</a>
                  </td>
                  <td>{{$tran->item}}</td>
                  <td>{{$tran->description}}</td>
                   <td>
                  
                   @if($tran->transaction_type == "Debit")

                      ₦{{number_format($tran->credit_amount)}}

                      <?php //$sumDebit += $tran->credit_amount; ?>

                    @endif

                 </td>
                  <td>
                    
                    
                     @if($tran->transaction_type == "Credit")

                      <b style="color: #F00;">₦-{{number_format($tran->credit_amount)}}</b>

                      <?php 

                         $sumCredit -= $tran->credit_amount; 

                         //$sumCredit -= $sumCredit;

                      ?>
                    @else
                    
                    @endif
                  </td>
                 
                  <td>
                   
                      <?php 


                      $displayBalnce = AccountsController::getAddBalance();

                        

                        if($tran->transaction_type == "Credit"){

                         $mainBalance = intval(-$tran->credit_amount) + $sumMainTotal;

                        }else if($tran->transaction_type == "Debit"){
                          
                          $mainBalance = intval($tran->credit_amount) + $sumMainTotal;
                        }
                      
                        

                       ?>

                      @if($tran->transaction_type == "Credit")
                         <b style="color: #F00;">₦{{number_format($mainBalance)}}</b>

                          <?php $sumMainTotal = $mainBalance; ?>
                      @else
                      
                      <b>₦{{number_format($mainBalance)}}</b>

                       <?php $sumMainTotal = $mainBalance; ?>

                      @endif
                     
                    
                     
                  </td>
                </tr>

               
              @endforeach
             
        
              
             <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td><h4 style="float: right; color: #F00;"></h4></td>
                <td><h4 style="color: green;">₦{{number_format($sumMainTotal)}}</h4></td>
              </tr>

          @endforeach
              
           

          </table>

        </div>
      </div>