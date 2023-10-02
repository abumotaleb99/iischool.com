@component('mail::message')
Hello {{ $user->name }},

<p>We understand that you've requested to reset your password.</p>

<p>If you didn't make this request, you can safely ignore this email. Your account security is important to us.</p>

@component('mail::button', ['url' => url('reset/' . $user->remember_token)])
Reset Password
@endcomponent

<p>If you encounter any issues while resetting your password or need further assistance, please don't hesitate to reach out to our support team.</p>

<p>Support Email: support@iischool.com</p>

Thanks, <br>
{{ config('app.name') }}

@endcomponent
