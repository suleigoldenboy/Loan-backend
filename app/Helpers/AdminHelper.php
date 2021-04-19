<?php

namespace App\Http\Helpers;

use App\Models\AuditTrail;
use App\Models\Employee\User;
use App\Models\Settings\LoanConfirmationProcess;
use Auth;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class AdminHelper
{

    public static function printHello()
    {
        return 'Hello Testing';
    }

    public static function audit_trail($type,$note,$action_id)
    {
        $audit_trail = new AuditTrail();
        $audit_trail->user_id = Auth::user()->id;
        $audit_trail->type = $type;
        $audit_trail->action_id = $action_id;
        $audit_trail->note = $note;
        $audit_trail->save();

    }

    public static function getAdminUserName($id)
    {
        $result = App\Models\HRManagement\Employee::where('id',$id)->first();

        return $result->first_name.' '.$result->last_name;
    }
     /**
     * Check if user is the last to confirm a loan proccess (Disbursement)
     *
     */
    public static function check_if_user_is_the_one_to_disburse()
    {

        $max = LoanConfirmationProcess::max('process');
        $user_process = LoanConfirmationProcess::where('user_id',FacadesAuth::user()->id)->first();

        if($user_process == null){
            return false;
        }
        $get_user_process = (int)$user_process->process;
        $max = (int)$max;
        if($get_user_process >= $max){
           return 'active';
        }else{

            return false;
        }
    }
}
