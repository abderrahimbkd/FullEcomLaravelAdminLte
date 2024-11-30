@component('mail::message')
    Hi <b>{{ $user->name }}</b>,

    <p>ready to start</p>
    <p>Forgot Password</p>

    @component('mail::button', ['url' => url('reset/' . $user->remember_token)])
        Reset Your Password
    @endcomponent

    Thanks,

@endcomponent
