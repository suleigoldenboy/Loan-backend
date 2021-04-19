<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use App\Models\Admin\Permissions;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //factory(App\User::class, 20)->create();
        
        // create Loan permissions
        Permission::create(['name' => 'uCreate Loan']);
        Permission::create(['name' => 'uUpdate Loan']);
        Permission::create(['name' => 'uDelete Loan']);
        Permission::create(['name' => 'uView Loan']);
        Permission::create(['name' => 'View Loan Request']);
        Permission::create(['name' => 'View Loan Decline']);
        Permission::create(['name' => 'Reactivate Loan']);

        // create Customer permissions
        Permission::create(['name' => 'uCreate Customer']);
        Permission::create(['name' => 'uUpdate Customer']);
        Permission::create(['name' => 'uDelete Customer']);
        Permission::create(['name' => 'uView Customer']);

         // create Employee permissions
         Permission::create(['name' => 'uCreate Employee']);
         Permission::create(['name' => 'uUpdate Employee']);
         Permission::create(['name' => 'uDelete Employee']);
         Permission::create(['name' => 'uView Employee']);

         // create Designation permissions
         Permission::create(['name' => 'Create Designation']);
         Permission::create(['name' => 'Update Designation']);
         Permission::create(['name' => 'Delete Designation']);
         Permission::create(['name' => 'View Designation']);

         // create Department permissions
         Permission::create(['name' => 'Create Department']);
         Permission::create(['name' => 'Update Department']);
         Permission::create(['name' => 'Delete Department']);
         Permission::create(['name' => 'View Department']);

         // create Branch permissions
         Permission::create(['name' => 'Create Branch']);
         Permission::create(['name' => 'Update Branch']);
         Permission::create(['name' => 'Delete Branch']);
         Permission::create(['name' => 'View Branch']);

         // create Product permissions
         Permission::create(['name' => 'uCreate Product']);
         Permission::create(['name' => 'uUpdate Product']);
         Permission::create(['name' => 'uDelete Product']);
         Permission::create(['name' => 'uView Product']);

          // create Disbursement permissions
          Permission::create(['name' => 'uCreate Disbursement']);
          Permission::create(['name' => 'uUpdate Disbursement']);
          Permission::create(['name' => 'uDelete Disbursement']);
          Permission::create(['name' => 'uView Disbursement']);

          //create Borrower Management permissions
          Permission::create(['name' => 'uCreate Borrower Management']);
          Permission::create(['name' => 'uUpdate Borrower Management']);
          Permission::create(['name' => 'uDelete Borrower']);
          Permission::create(['name' => 'uView Borrower Management']);

          //create Confirmation Process permissions
          Permission::create(['name' => 'uCreate Confirmation Process']);
          Permission::create(['name' => 'uUpdate Confirmation Process']);
          Permission::create(['name' => 'uDelete Confirmation Process']);
          Permission::create(['name' => 'uView Confirmation Process']);

         // create Offer Letter permissions
         Permission::create(['name' => 'uCreate Offer Letter']);
         Permission::create(['name' => 'uUpdate Offer Letter']);
         Permission::create(['name' => 'uDelete Offer Letter']);
         Permission::create(['name' => 'uView Offer Letter']);

          // create Account permissions
          Permission::create(['name' => 'uCreate Account']);
          Permission::create(['name' => 'uUpdate Account']);
          Permission::create(['name' => 'uDelete Account']);
          Permission::create(['name' => 'uView Account']);
          Permission::create(['name' => 'uView Ledger']);
          Permission::create(['name' => 'uView Balance Sheet']);
          Permission::create(['name' => 'uView Disburse Report']);
          Permission::create(['name' => 'uView Income Report']);
          Permission::create(['name' => 'uView Expense Report']);
          Permission::create(['name' => 'uView Repayment Report']);
   
          // create other permissions
          Permission::create(['name' => 'uView Settings']);

    }
}
