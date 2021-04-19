<?php
namespace App\User\Customer\Traits;

use Carbon\Carbon;
use Exception;

trait CustomerFunction {

    /**
     * Generate A Token for Customer
     * @return App\User\Customer\Customer
     *
    */
    public function phoneVerification(){
        $this->verification()->delete();
        $this->verification()->create([
            'token' => generateToken(4),
        ]);
        return $this;
    }
    /**
     * Get a users token base on their phone number
     * @param Int $phone
     * @return Int $token
     */
    public function getUserToken(Int $phone):int{
        return $this->where('phone_number', $phone)->first()->verification->token;
    }

    public function validateToken(){
        $this->verification()->update([
            'validated' => true,
            'validated_at' => Carbon::now()
        ]);
        return $this;
    }

    public function hasGuarantor()
    {
        return $this->guarantors()->first();
    }

    /**
     * Get A User By a particular Field
     * @param string $filed
     * @param string $value
     * @return Object $this
     */
    public static function  getUserBy(String $filed, String $value):Object{
        return self::where($filed, $value)->first();
    }

    /**
     * Get verifies a User using their BVN
     * @param int $bvn_number
     */
    public function VerifyBvn($bvn_number){
        $bvn_payLoad = curl()->getAsJson(config('api.paystack.bvn_url').$bvn_number, config('api.paystack.header.auth'));
        if($bvn_payLoad->message === "BVN resolved"){
            if($this->first_name == $bvn_payLoad->data->first_name && $this->last_name == $bvn_payLoad->data->last_name){
                $this->update([
                    'name_is_verified' => true,
                    'bvn_verified' => true,
                    'bvn_phone_number' => $bvn_payLoad->data->mobile,
                    'date_of_birth' => $bvn_payLoad->data->formatted_dob,
                ]);
            }
            return true;
        }
        return false;
    }

    public function VerifyCard($bin)
    {
        $bin_payLoad = curl()->getAsJson(config('api.paystack.bin_url').$bin, config('api.paystack.header.auth'));
        if(property_exists($bin_payLoad, 'data')){
            // Payment Card is Verified.
            return true;
        }
        return false;
    }

    public function ValidateAccount(Int $account_number, Float $bank_code)
    {
        $account_number_payload = curl()->getJsonData(config('api.paystack.account_number'),['account_number' => $account_number, 'bank_code' => $bank_code], config('api.paystack.header.auth'));
        if (property_exists($account_number_payload, 'data')) {
            // Bank Verified Verify Name
            return true;
        }
        return false;
    }

    public function verifyTransaction($ref)
    {
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => config('api.paystack.verifyTransaction').$ref,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "Authorization: ".config('api.paystack.header.auth'),
                "Cache-Control: no-cache",
            ],
        ]);
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $response['authorization'];
        }
        /**$transaction = curl()->getJsonData(config('api.paystack.verifyTransaction').$ref,[], config('api.paystack.header.auth'));
        if (property_exists($transaction, 'data')) {
            return $transaction->data->authorization;
        }**/
        throw new Exception("Error Processing Request", 1);
    }

    public static function findByHash($uuid){
        foreach (self::all() as  $user) {
            if(hashId($user->id) == $uuid){
                return $user;
            }
        }
    }
}
