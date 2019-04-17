<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, minimal-ui">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black">
  <link rel="apple-touch-icon" href="/images/icon-app.png" />
  <link rel="apple-touch-startup-image" href="/images/icon-app.png">
  <link rel="manifest" href="/manifest.webmanifest">
  <link rel="shortcut icon" href="https://meeracle.com.my/img/favicon.png">
   {{-- <link rel="apple-touch-icon" sizes="57x57" href="http://meeracle.com.my/image/favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="http://meeracle.com.my/image/favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="http://meeracle.com.my/image/favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="http://meeracle.com.my/image/favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="http://meeracle.com.my/image/favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="http://meeracle.com.my/image/favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="http://meeracle.com.my/image/favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="http://meeracle.com.my/image/favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="http://meeracle.com.my/image/favicon/apple-icon-180x180.png"> --}}
    {{-- <link rel="icon" type="/image/png" sizes="192x192"  href="https://meeracle.com.my/image/favicon/android-icon-192x192.png"> --}}
    {{-- <link rel="icon" type="/image/png" sizes="32x32" href="https://meeracle.com.my/image/favicon/favicon-32x32.png">
    <link rel="icon" type="/image/png" sizes="96x96" href="https://meeracle.com.my/image/favicon/favicon-96x96.png">
    <link rel="icon" type="/image/png" sizes="16x16" href="https://meeracle.com.my/image/favicon/favicon-16x16.png"> --}}
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Meeracle Agent System') }}</title>

  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}" defer></script>

  <!-- Fonts -->
  <link rel="dns-prefetch" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

  <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/vuetify/dist/vuetify.min.css" rel="stylesheet">
  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
  <index></index>
</div>
</body>
</html>
