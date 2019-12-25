@component('mail::message')
# Regards

<p>Thank you {{ $user['name'] }}, you are now subscribed to our newsletter.</p>
<p>Title: {{ $user['title'] }}</p>
<p>Email: {{ $user['email'] }}</p>

<p>If you want to unsubscribe, please click on this button.</p>

@component('mail::button', ['url' => 'http://127.0.0.1:8000/unsubscribed/' . $user['id']])
Unsubscribe
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
