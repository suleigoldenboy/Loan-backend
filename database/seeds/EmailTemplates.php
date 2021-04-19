<?php

use App\System\EmailTemplate;
use Illuminate\Database\Seeder;

class EmailTemplates extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EmailTemplate::create([
            'name' => 'guarantor',
            'subject' => 'You are use as a Guarantor',
            'message' => 'You are the Guarantor to '
        ]);
    }
}
