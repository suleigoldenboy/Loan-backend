<?php

use Ramsey\Uuid\Uuid;
use App\System\BankList;
use App\Models\Customer\Customer;
use Illuminate\Support\Facades\DB;
use App\HelperFunction\CurlRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use App\Models\HRManagement\Employee;
use App\User\Customer\Customer as User;
use App\Models\HRManagement\Designation;
use App\User\Loan\LoanManagerRelationship;
use Illuminate\Support\Facades\Notification;
use App\Notifications\Employee\RecoveryNotification;

if (!function_exists('curl')) {
    /**
     * Make Curl Request.
     *
     * @param  null
     * @return object
     */
    function curl()
    {
        return new CurlRequest();
    }
}

function site_url()
{
    return (env('APP_ENV') !== 'local') ? env('APP_URL') : env('APP_DEV_URL');
}

/**
 * Generate 10 Characters, 7 Random Number and
 * 2 Fixed Integer to be use as Bank Account Number
 * @return integer
 */
function generateRandomNumber()
{
    return ('06' . rand(1000, 9999));
}

/**
 * Create a Unique Signature for the User using his Name
 * @param object @user
 * @return string a hash $short
 */
function signature($user)
{
    $short = substr(hash('sha256', (encrypt($user->name))), 12);
    return str_limit($short, 24, '');
}

if (!function_exists('jsonResponse')) {
    /**
     * Return a Json response
     *
     * @param  array $body
     * @param int $code
     * @return object
     */
    function jsonResponse($body = [], $code = 200)
    {
        return response()->json($body, $code);
    }
}

if (!function_exists('LoanUuid')) {
    /**
     * Generate A random Hash
     * Return a String response
     *
     * @param string $type
     * @return object
     */
    function LoanUuid($type)
    {
        return uniqid((string)$type);
    }
}

if (!function_exists('message')) {
    /**
     * Helper to grab the application messages.
     *
     * @return mixed
     */
    function message($value)
    {
        return config($value);
    }
}

if (!function_exists('user')) {
    /**
     * User function go get the logged in user through the
     * request object of by an email or given parameter
     */
    function user($email = null, $id = null, $username = null)
    {
        if (!($email && $id && $username) && request()->user()) {
            return request()->user();
        }
        if ($email && User::where('email', $email)->first() !== null) {
            return User::where('email', $email)->first();
        }

        if ($id && User::where('id', $id)->first() !== null) {
            return User::where('id', $id)->first();
        }

        if ($username && User::where('username', $username)->first() !== null) {
            return User::where('username', $username)->first();
        }
    }
}


if (!function_exists('invalidRequest')) {
    /**
     * Returns Error message with the given message
     * the user to withdraw from said table
     * @param String $message to be returned
     * @return Object Illuminate\Response
     */
    function invalidRequest($message)
    {
        return jsonResponse([
            'message' => $message
        ], 500);
    }
}

if (!function_exists('generateTransferId')) {
    /**
     * This generate A unique Id base on the time unix
     * @return String uniqid()
     */
    function generateTransferId(): string
    {
        return uniqid(true);
    }
}

if (!function_exists('getUserById')) {
    /**
     * This get a user by Id
     * @param Int $uuid
     * @return Object \App\User
     */
    function getUserById(Int $uuid): object
    {
        return User::findOrFail($uuid);
    }
}

if (!function_exists('generateUuid')) {
    function generateUuid(): string
    {
        return Uuid::uuid1()->toString();
    }
}

if (!function_exists('format_number')) {
    function format_number($value)
    {
        return number_format((float)$value, 2, '.', ',');
    }
}

if (!function_exists('getEmailMessage')) {
    function getEmailMessage($value)
    {
        $query = DB::select('select * from email_templates where name = ?', [$value]);
        return  $query;
    }
}
/**
 * Generate Random Number base on Length
 * @param Int $length
 * @return Int $token
 */
if (!function_exists('generateToken')) {
    function generateToken(Int $length): Int
    {
        return rand(1000, 9999);
    }
}

if (!function_exists('appRedirect')) {
    function appRedirect(array $data, String $route, array $message, Object $request)
    {
        if (!$request->ajax()) {
            $request->session()->flash($message[0], $message[1]);
            return redirect()->route($route)->with(array_merge($data, $message));
        }
        return jsonResponse(array_merge($data, $message));
    }
}

function replaceString(String $needle, array $replaceWith, String $string): String
{
    return \Str::replaceArray($needle, $replaceWith, $string);
}

if (!function_exists('generateEmpCode')) {
    function generateEmpCode()
    {
        return 'UKD' . rand(1000, 9999);
    }
}

if (!function_exists('employeeFormFields')) {
    function employeeFormFields()
    {
        return [
            'formFields' => [
                'first_name' => (object)[
                    'name' => 'first_name',
                    'label' => 'First Name',
                    'type' => 'text'
                ],
                'last_name' => (object)[
                    'name' => 'last_name',
                    'label' => 'Last Name',
                    'type' => 'text',
                ],
                'other_name' => (object)[
                    'name' => 'other_name',
                    'label' => 'Other Name',
                    'type' => 'text'
                ],
                'username' => (object)[
                    'name' => 'username',
                    'label' => 'User Name',
                    'type' => 'text'
                ],
                'email' => (object)[
                    'name' => 'email',
                    'label' => 'Email Address',
                    'type' => 'email'
                ],
                'gender' => (object)[
                    'name' => 'gender',
                    'label' => 'Gender',
                    'type' => 'select',
                    'options' => [
                        'Male' => 'Male',
                        'Female' => 'Female'
                    ]
                ],
                'password' => (object)[
                    'name' => 'password',
                    'label' => 'Strong Password',
                    'type' => 'password'
                ],
                'phone_number' => (object)[
                    'name' => 'phone_number',
                    'label' => 'Phone Number',
                    'type' => 'number',
                ],
                'religion' => (object)[
                    'name' => 'religion',
                    'label' => 'Religion',
                    'type' => 'select',
                    'options' => [
                        'Christain' => 'Christain',
                        'Muslim'  => 'Muslim'
                    ]
                ],
                'employee_code' => (object)[
                    'name' => 'employee_code',
                    'label' => 'Employee Code',
                    'type' => 'text'
                ],
                'marital_status' => (object)[
                    'name' => 'marital_status',
                    'label' => 'Marital Status',
                    'type' => 'text'
                ],
                'employment_type' => (object)[
                    'name' => 'employment_type',
                    'label' => 'Employment Type',
                    'type' => 'select',
                    'options' => [
                        'Full Time' => 'Full Time',
                        'Part Time' => 'Part Time',
                        'Contract' => 'Contract'
                    ]
                ],
                'joined_on' => (object)[
                    'name' => 'joined_on',
                    'label' => 'Joined On',
                    'type' => 'date'
                ],
                'leaving_date' => (object)[
                    'name' => 'leaving_date',
                    'label' => 'Date of Birth',
                    'type' => 'date'
                ]
            ],
            'contactFormFields' => [
                'father_name' => (object)[
                    'name' => 'father_name',
                    'label' => 'Father\'s Name',
                    'type' => 'text'
                ],
                'mother_name' => (object)[
                    'name' => 'mother_name',
                    'label' => 'Mother\'s Name',
                    'type' => 'text',
                ],
                'local_government' => (object)[
                    'name' => 'local_government',
                    'label' => 'Local Government',
                    'type' => 'text'
                ],
                'state_of_origin' => (object)[
                    'name' => 'state_of_origin',
                    'label' => 'State Of Origin',
                    'type' => 'text'
                ],
                'nationality' => (object)[
                    'name' => 'nationality',
                    'label' => 'Nationality',
                    'type' => 'text'
                ],
                'present_address' => (object)[
                    'name' => 'present_address',
                    'label' => 'Present Address',
                    'type' => 'textarea'
                ],
                'permanent_address' => (object)[
                    'name' => 'permanent_address',
                    'label' => 'Permanent Address',
                    'type' => 'textarea'
                ],
            ],
            'salaryFormFields' => [
                'salary_type' => (object)[
                    'name' => 'salary_type',
                    'label' => 'Salary\'s Type',
                    'type' => 'text',
                    'readonly' => false
                ],
                'gross' => (object)[
                    'name' => 'gross',
                    'label' => 'Gross',
                    'type' => 'number',
                    'readonly' => false
                ],
                'basic_salary' => (object)[
                    'name' => 'basic_salary',
                    'label' => 'Basic Salary',
                    'type' => 'number',
                    'readonly' => true,
                ],
                'accommodation_allowance' => (object)[
                    'name' => 'accommodation_allowance',
                    'label' => 'Accommodation Allowance',
                    'type' => 'number',
                    'readonly' => true,
                ],
                'percentage_to_achieved' => (object)[
                    'name' => 'percentage_to_achieved',
                    'label' => 'Percentage To Be Achieve',
                    'type' => 'number',
                    'readonly' => false,
                ],
                'house_rent_allowance' => (object)[
                    'name' => 'house_rent_allowance',
                    'label' => 'House Rent Allowance',
                    'type' => 'number',
                    'readonly' => true,
                ],
                'transportation_allowance' => (object)[
                    'name' => 'transportation_allowance',
                    'label' => 'Transportation Allowance',
                    'type' => 'number',
                    'readonly' => true,
                ],
                'monthly_target' => (object)[
                    'name' => 'monthly_target',
                    'label' => 'Monthly Target',
                    'type' => 'number',
                    'readonly' => false,
                ],
                'smart_saver_date' => (object)[
                    'name' => 'smart_saver_date',
                    'label' => 'Smart Saver Date',
                    'type' => 'date',
                    'readonly' => false,
                ],
                'account_number' => (object)[
                    'name' => 'account_number',
                    'label' => 'Account Number',
                    'type' => 'number',
                    'readonly' => false
                ]
            ]
        ];
    }
}

if (!function_exists('hashId')) {
    function hashId($id)
    {
        return hash('sha256', $id);
    }
}

if (!function_exists('getDataFromHash')) {
    function getDataFromHash($id, $class)
    {
        foreach ($class->get() as $classInfo) {
            if (hashId($classInfo->id) == $id) {
                return $classInfo;
            }
        }
        return 'No Data Found';
    }
}

if (!function_exists('getBanks')) {
    function getBanks()
    {
        return DB::table('bank_lists')->get();
    }
}

if (!function_exists('insertBanks')) {
    function insertBanks($banks)
    {
        foreach ($banks->data as $key => $bank) {
            BankList::create([
                'bank_name' => $bank->name,
                'bank_code' => $bank->code,
                'long_code' => $bank->longcode
            ]);
        }
    }
}

if (!function_exists('getLessLoanAssignManager')) {
    function getNextLoanManager($loanEvent)
    {
        $loanManager = LoanManagerRelationship::latest()->first();
        $designationId = Designation::where('title', 'LIKE', '%account officer%')->first();
        $employee  = Employee::where([[
            'id', '>', ($loanManager != null) ? $loanManager->loan_manager_id : 1
        ], [
            'designation_id', '=',  ($designationId != null) ? $designationId->id : 1
        ], [
            'branch_id', '=', $loanEvent->customer->branch_id
        ]])->first();
        if ($employee  !== null) {
            return $employee;
        }
        return Employee::where([
            [
                'designation_id', '=',  ($designationId != null) ? $designationId->id : 1
            ], [
                'branch_id', '=', $loanEvent->customer->branch_id
            ]
        ])->first();
    }
}
/**
 * queryPayment
 *
 * @param Array $data
 */
if (!function_exists('queryPayment')) {
    function queryPayment($loan)
    {
        $instrument = $loan->getRepaymentInstrument();
        if ($instrument == 'Card') {
            $amount = ($loan->disbursed_amount !== null) ? $loan->disbursed_amount : $loan->principal;
            $loan->customer->cardInstrument->gateway == null ?
                runCardPayment($loan->customer_id, $amount, $loan) : flutterChargeToken($loan->customer_id, $amount, $loan);
        } elseif ($instrument == 'Card') {
            Notification::send($loan->loan_officer(), new RecoveryNotification($loan, config('message.maturePayment')));
            Notification::send(Employee::recoveryOfficer(), new RecoveryNotification($loan, config('message.maturePayment')));
        }
    }
}
/**
 * notifyUser
 *
 * @param Array $data
 */
if (!function_exists('notifyUser')) {
    function notifyUser($loan)
    {
        $user = $loan->customer()->first();
        Notification::send($user, new RecoveryNotification($loan, config('message.close_to_payment_date')));
    }
}
/**
 * latePayment
 *
 * @param Array $data
 */
if (!function_exists('latePayment')) {
    function latePayment($data)
    {
        Log::alert('Query The User To Pay Belated  Payment');
    }
}

if (!function_exists('getRepaymentRate')) {
    function getRepaymentRate($duration)
    {
        function getRepaymentRate($duration, $rate)
        {
            if ($rate == 4) {
                return collect(config('loan.loan_repayment_rate_4'))->get($duration);
            } else if ($rate == 2.5) {
                return collect(config('loan.loan_repayment_rate_2'))->get($duration);
            } else if ($rate == 3.2) {
                return collect(config('loan.loan_repayment_rate'))->get($duration);
            }
        }
    }
}

if (!function_exists('percent')) {
    function percent($rate)
    {
        return $rate / 100;
    }
}

if (!function_exists('runCardPayment')) {
    function runCardPayment($customer_id, $AmountDue, $loan)
    {
        $url = "https://api.paystack.co/transaction/charge_authorization";
        $user = Customer::where('id', $customer_id)->first()->cardInstrument()->latest()->first();
        if ($user != null) {
            $fields = [
                'authorization_code' => $user->authorization_code,
                'email' => $user->email,
                'amount' => $AmountDue * 100
            ];

            $fields_string = http_build_query($fields);
            //open connection
            $ch = curl_init();
            //set the url, number of POST vars, POST data
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                "Authorization: Bearer " . config('api.paystack.secret_key'),
                "Cache-Control: no-cache",
            ));
            //So that curl_exec returns the contents of the cURL; rather than echoing it
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            //execute post
            $result = curl_exec($ch);
            return json_decode($result, true);
        }
        return ['message' => 'this user does not have a valid card'];
    }
}



/**
 * curlRequest Function
 * @param String $verb httpMethod
 * @param String $token Authentication Bearer Token
 * @param String $url the Link to make the request
 * @param Array $body the request body
 * @return Object
 */

if (!function_exists('appRequest')) {
    function appRequest(String $verb = 'get',  String $url, String $token = null, array $body = null)
    {
        if ($token != null && $verb == 'get') {
            return Http::withToken($token)->get($url, $body);
        } else if ($token == null && $verb == 'get') {
            return Http::get($url, $body);
        } elseif ($token != null && $verb == 'post') {
            return Http::withToken($token)->post($url, $body);
        }
        return Http::post($url, $body);
    }
}

if (!function_exists('flutterChargeToken')) {
    function flutterChargeToken($customer_id, $amount, $loan)
    {
        $tokenizeCard = Customer::where('id', $customer_id)->first()->cardInstrument()->latest()->first();
        $user = Customer::where('id', $customer_id)->first();
        $response = appRequest('post', config('api.flutter.charge_token'), config('api.flutter.secret_key'), [
            'token' => $tokenizeCard->authorization_code,
            "currency" => "NGN",
            "country" => "NG",
            "amount" => $amount,
            "email" => $user->email,
            "first_name" => $user->first_name,
            "last_name" => $user->last_name,
            "ip" => request()->ip(),
            "narration" => "Loan Repayment Charge",
            "tx_ref" => generateTransferId()
        ]);
        if ($response->successful()) {
            return checkResponse($customer_id, $amount, $loan, $response->json());
        }
    }
}

if (!function_exists('checkResponse')) {
    function checkResponse($customer_id, $amount, $loan, $response){
        if ($response->status !== 'charge attempted' ){
            // Assume it is insufficient reduce amount by 70 by 30 by 10
            $reduce_by_70 = reduceAmount($amount, 70); $reduce_by_30 = reduceAmount($amount, 30); $reduce_by_10 = reduceAmount($amount, 10);
            if($amount > $reduce_by_70){
                return flutterChargeToken($customer_id, $reduce_by_70, $loan);
            }elseif($amount < $reduce_by_70 && $amount > $reduce_by_30){
                return flutterChargeToken($customer_id, $reduce_by_30, $loan);
            }else{
                return flutterChargeToken($customer_id, $reduce_by_10, $loan);
            }
        }
    }
}

if(!function_exists('reduceAmount')){
    function reduceAmount(Int $amount, Int $percent){
        return $amount- ($amount * ($percent/100));
    }
}
