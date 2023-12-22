@component('mail::message')
# Introduction

Percobaan Pengiriman Email dari Laravel

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
