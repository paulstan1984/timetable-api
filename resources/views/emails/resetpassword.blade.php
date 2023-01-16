<x-mail::message>
# Reset your password

In order to reset your password please follow the link below: {{$resetPasswordLink}}

<x-mail::button :url="$resetPasswordLink">
Reset Password
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
