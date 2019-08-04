<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('partials/header')
</head>
  <body>
      <div id="app">
        @include('partials/navbar')
        <main class="mt-2">
          @include('partials/notification')
          @yield('content')
        </main>
      </div>
      @include('partials/scripts')
  </body>
</html>



