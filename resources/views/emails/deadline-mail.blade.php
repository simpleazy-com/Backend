@component('mail::message')
# Reminder from {{ $group_name }}

Please pay cash before deadline <br>
Deadline: {{ $deadline }}

@component('mail::button', ['url' => ''])
Click Here
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
