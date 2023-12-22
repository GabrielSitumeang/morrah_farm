@component('mail::message')
# Introduction

Kirim Email dan File

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
