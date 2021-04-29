<?php
namespace App\Helpers;
use Illuminate\Support\Facades\Http;

class FlutterWave {
    private $trn_ref;
    private $recurrentPayment = 'https://api.flutterwave.com/v3/tokenized-charges' ;
    private $body;
    private $secret_key = 'FLWSECK-8974c2ee3f2cd771a540437819656a9e-X';

    public function __construct($body){
        $this->body = $body;
    }
    public function recurrentPayment(){
        try {
         $response = Http::withToken($this->secret_key)->post($this->recurrentPayment,$this->body);
         return $response->json();
        } catch (\Throwable $th) {
           dd("err");
        }
       
    }
}
