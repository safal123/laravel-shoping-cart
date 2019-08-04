@component('mail::message')
# Order received

Thanks for your order.

**Order Id:** {{ $order->id }}<br>
**Order Email:** {{ $order->billing_email }}<br>
**Order Name:** {{ $order->billing_name }}<br>
**Order Total:** {{ $order->billing_total }}

You can get further details about your order by logging into our website.
@component('mail::button', ['url' => config('app.url'), 'color' =>'green' ])
  Go to website
@endcomponent

Thanks for choosing us.<br>
{{ config('app.name') }}
@endcomponent