<?php

use Illuminate\Database\Seeder;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use App\Lead;
use App\Note;
use App\User;
use App\RoleUser;

class UpdateLeadNotesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $getLeadNote = Lead::whereNotNull('notes')->get();
        $getAdminId = RoleUser::leftjoin('users','role_user.user_id','users.id')->where('role_user.role_id',4)->first();        foreach($getLeadNote as $val){
            $note = new Note();
            $note->notes = $val->notes;
            $note->user_id = $getAdminId->id;
            $note->type = 1;
            $note->type_id = $val->id;
            $note->note_date = ($val->updated_at != '')?$val->updated_at:$val->created_at;
            $note->save();
        }
    }
}
