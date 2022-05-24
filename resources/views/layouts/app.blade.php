<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans text-gray-900 text-sm bg-gray-background">
      <header class="flex items-center justify-between px-8 py-4">
          <a href=""><img src="{{asset('images/logo.svg')}}" alt=""></a>
          <div class="flex items-center">
              @if (Route::has('login'))
                  <div class="px-6 py-4">
                      @auth
                          <div class="flex items-center">
                              <a href="{{ url('/dashboard') }}" class="mr-2 text-sm text-gray-700 dark:text-gray-500 underline">Dashboard</a>
                              <form action="{{route('logout')}}" id="logoutForm" method="post">
                                  @csrf
                              </form>
                              <a href="" onclick="event.preventDefault();document.getElementById('logoutForm').submit()" class="text-sm text-gray-700 dark:text-gray-500 underline">Logout</a>
                          </div>
                      @else
                          <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

                          @if (Route::has('register'))
                              <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                          @endif
                      @endauth
                  </div>
              @endif
              <a href="">
                  <img src="{{asset('images/avatar.png')}}" class="w-10 h-10 rounded-full" alt="">
              </a>
          </div>
      </header>
           <main class="container mx-auto max-w-custom flex">
               <div class="w-70 mr-5">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. A accusamus, alias autem consectetur cum, dolor enim id itaque iure nulla, odio quam quasi quia recusandae repellat repellendus soluta temporibus voluptas? Ad aliquam asperiores consequatur, deleniti dicta dolor dolore dolorem ducimus eaque eius error eum explicabo illum in incidunt ipsa iste mollitia necessitatibus neque non numquam officia recusandae similique suscipit tempore totam voluptatibus! Adipisci amet beatae consectetur, delectus dolores eius, enim facere ipsa, iste iusto magni mollitia neque reiciendis velit voluptate voluptates voluptatum. A delectus ea necessitatibus reprehenderit temporibus! Atque ducimus earum itaque maiores nemo praesentium reprehenderit sed vel vitae voluptatem.

               </div>
               <div class="w-175">
                   <nav class="flex items-center justify-between text-xs ">
                       <ul class="flex uppercase font-semibold space-x-10 border-b-4 pb-3">
                           <li><a href="" class="border-b-4 border-blue pb-3">All ideas (87)</a></li>
                           <li><a href="" class="text-gray-400 transition duration-75 ease-in border-b-4 pb-3 hover:border-blue">All ideas (87)</a></li>
                       </ul>
                   </nav>
                   <div class="mt-8">
                       {{$slot}}
                   </div>
               </div>
           </main>
    </body>
</html>
