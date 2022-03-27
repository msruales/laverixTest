<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class CrudUser extends Mailable
{
    use Queueable, SerializesModels;

    private $type_crud;
    private $user;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, $type_crud)
    {
        $this->type_crud = $type_crud;
        $this->user = $user;

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

        return $this->to($admin_user->email, $admin_user->name )->cc($user_auth->email, $user_auth->name)->view('emails.users')->with([
            'type' => $this->type_crud,
            'email_auth' =>  $user_auth->email,
            'user_name' => $this->user->name,
            'user_email' => $this->user->email
        ]);
    }
}
