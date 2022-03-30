<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <title>Shopify PHP App</title></head>
<body>

<div id="app" data-shop="{{$shop}}" data-host="{{$host}}" data-api-key="{{$apiKey}}" data-domain="{{$appDomain}}"></div>
<script src="{{ asset('js/app.js') }}"></script>

</body>
</html>
