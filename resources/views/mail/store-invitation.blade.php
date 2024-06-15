<x-mail::message>
# Welcome to dayzshop.

We would like to welcome you and your store in our platform.

<x-mail::button :url="$invite->url">
Click here to use your invitation.
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
