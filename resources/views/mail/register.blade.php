<x-mail::message>
# Introduction

{{ $user->name }} has registered a new account.

<x-mail::button :url="''">
Button Text
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
