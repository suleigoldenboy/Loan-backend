<!DOCTYPE html>
<html>
<head>
  <title>Offer Letter</title>
  <link href="{{ asset('plugins/animate/animate.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/plugins.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/scrollspyNav.css') }}" rel="stylesheet" type="text/css" />
     <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/plugins.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/components/custom-modal.css') }}" rel="stylesheet" type="text/css" />

</head>
<body>
<div class="row" style="background-color:#FFF;">
     <div class="col-md-12">
      <img src="{{ asset('https://ukdiononline.com/assets/images/maxer.jpg')}}" class="img-responsive">
      </div>
    
    <div class="col-md-12" style="margin-top:70px; padding-top:72px;">
      
      <h4 class="text-primary" style="text-align:center;">Loan Application Form</h4> 
      
      <div class="row">
          <div class="col-md-4">
              <div class="avatar avatar-xl">
                <img alt="avatar" style="width:100px; hieght:100px;" src="{{ asset('customerfiles/profilepicture')}}/{{$letter->customer->avatar}}" class="rounded" />
             </div>
         </div>
          <p style="text-align:right;">
              Loan Officer:
              <b> {{$letter->loan_officer->first_name}}
                {{$letter->loan_officer->last_name}}
                {{$letter->loan_officer->other_name}}</b>
          </p> 
    </div>
         <!-- Start Head -->
          <div class="row">
          <table>
               <tr>
                 <td width="200">
                     <b>First Name:</b> {{$letter->customer->first_name}}<br>
                     <b>Other Name:</b> {{$letter->customer->other_name}}<br>
                     <b>Last Name:</b>  {{$letter->customer->last_name}}<br>
                     <b>Phone Number:</b>  {{$letter->customer->phone_number}}<br>
                     <b>Email Address:</b>  {{$letter->customer->email}}<br>
                     <b>Gender:</b> {{$letter->customer->gender}}<br>
                 </td>
                 <td width="200">
                     <b>Marital Status:</b> {{$letter->customer->marital_status}}<br>
                     <b>Occupation:</b>{{$letter->customer->occupation}}<br>
                     <b>Date of Birth:</br>{{$letter->customer->date_of_birth}}<br>
                     <b>Religion:</b>{{$letter->customer->religion}}<br>
                     <b>ID Card Type:</b>{{$letter->customer->id_card_type}}<br>
                     <b>ID Card Number:</b>{{$letter->customer->id_card_number}}
                 </td>
                 <td>
                     <b>Branch:</b>  {{$letter->branch->title}}-{{$letter->branch->state}}<br>
                      <b>Product:</b> {{$letter->product->name}}<br>
                      <b class="text-danger">Loan Amount:</b> N{{number_format($letter->principal,2)}}<br>
                      <b>Loan Purpose:</b> {{$letter->loan_purpose}}
                 </td>
               </tr>
              <tr style="background-color:#dee2e6; padding: 9px; margin-top:9px;">
               <td width="200">
                   <p class="text-primary" style="text-align:center;">Employement Status: {{$letter->customer->employment->employment_status}}</p> 
                  
              </td>
              <td width="200">
                   <p class="text-danger" style="text-align:center;">BVN: {{$letter->customer->employment->bvn}}</p>
              </td>
               <td width="200">
              </td>
              </tr>
              
               <tr>
                <td width="200">
                    <b>Monthly Gross Salary:</b> {{$letter->customer->employment->monthly_gross_salary}} <br>
                     <b>Monthly Net Pay:</b> {{$letter->customer->employment->monthly_net_pay}}<br>
                     <b>Pay Day:</b> {{$letter->customer->employment->salary_pay_day}}
                </td>
                <td width="200">
                  <b>Salary Bank Name:</b> {{$letter->customer->employment->salary_bank_name}}<br> 
                  <b>Account Name:</b> {{$letter->customer->employment->salary_account_name}}<br>
                  <b>Account Number:</b> {{$letter->customer->employment->salary_account_number}}
                 
                </td>
                <td width="200">
                    <b class="text-info">Employer Info</b><br> 
                  <b>Phone Number:</b> {{$letter->customer->employment->employer_phone_number}}<br>
                  <b>Email Address:</b> {{$letter->customer->employment->employer_email}}
                </td>
              </tr>
         

          </table>
           
         
          
         </div>
         <!--End Head -->
      
    </div>
    

</div>
</body>
</html>