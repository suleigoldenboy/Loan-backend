<?php

namespace Tests\Feature\Loan;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Auth\AuthenticationException;
use Faker\Factory;
use Auth;

class ProductControllerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutExceptionHandling();
    }
   
    public function test_user_can_create_a_product()
    {
       
        $faker = Factory::create();
        $user_id =1;
        $response = $this->json('POST','product/store', [
            'user_id' => 1,
            'name' => $faker->name,
            'minimum_principal' => random_int(1000,2000),
            'maximum_principal' => random_int(1000,2000),
            'interest_method' => "flat_rate",
            'interest_rate' => $faker->randomDigit,
            'loan_duration' => 'month',
            'loan_duration_lenght' => 1,
            'repayment_method' => "monthly",
            'enable_late_repayment_penalty' => $faker->randomDigit,
            'enable_after_maturity_date_penalty' => $faker->randomDigit,
            'late_repayment_penalty_amount' => random_int(10000,20000),
            'after_maturity_date_penalty_amount' => random_int(10000,20000)
            
        ]);
        
         //dd($response);
        $response->assertStatus(201);
       

    }
    
    public function test_can_get_all_products()
    {
       
        $response = $this->json('GET','loan/loan/product');
      
        $response->assertStatus(200);

    }

    public function test_can_get_a_products()
    {
        $product_id = 3;
        $response = $this->json('GET','loan/loan/product/{$product_id}');
      
        $response->assertStatus(200);

    }


    public function test_user_can_update_a_product()
    {
       
        $faker = Factory::create();
        $product_id = 3;
        $response = $this->json('POST','loan/loan/product/{$product_id}/update', [
            'id' => $product_id,
            'name' => $faker->name,
            'minimum_principal' => random_int(10000,20000),
            'maximum_principal' => random_int(10000,20000),
            'interest_method' => "flat_rate",
            'interest_rate' => $faker->randomDigit,
            'loan_duration' => 'month',
            'repayment_method' => "monthly",
            'enable_late_repayment_penalty' => $faker->randomDigit,
            'enable_after_maturity_date_penalty' => $faker->randomDigit,
            'late_repayment_penalty_amount' => random_int(10000,20000),
            'after_maturity_date_penalty_amount' => random_int(10000,20000)
        ]);
        
        // dd($response);
        $response->assertStatus(201);
       
    }
}
