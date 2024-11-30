@component('mail::message')
    Hi <b>{{ $user->name }}</b>,

    <p>ready to start</p>
    <p>click the button to verify the email</p>

    @component('mail::button', ['url' => url('activate/' . base64_encode($user->id))])
        Verify
    @endcomponent

    Thanks,

@endcomponent
