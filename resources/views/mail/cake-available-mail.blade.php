@component('mail::message')
# {{__('cake.hello',    ['lead'     => $lead->name])}}

{{__('cake.name',       ['name'     => $cake->name])}}<br />
{{__('cake.weight',     ['weight'   => $cake->weight])}}<br />
{{__('cake.price',      ['price'    => $cake->price])}}<br />
{{__('cake.amount',     ['amount'   => $cake->amount])}}<br />

{{__('mail.visit')}}<br />
<br>
{{ config('app.name') }}, {{__('mail.end')}}.<br />
@endcomponent
