<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class CrudRole extends Mailable
{
    use Queueable, SerializesModels;

    private $role;
    private $type_crud;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Role $role, $type_crud)
    {
        $this->type_crud = $type_crud;
        $this->role = $role;
    }

    /**
     * Build the message.
     *
     * @return $this
     */

    public function build()
    {
        $user_auth = Auth::user();
        $admin_user = User::role('Admin')->first();

        return $this->to($admin_user->email, $admin_user->name )->cc($user_auth->email, $user_auth->name)->view('emails.roles')->with([
            'type' => $this->type_crud,
            'email_auth' =>  $user_auth->email,
            'rol_name' => $this->role->name,
        ]);
    }
}
