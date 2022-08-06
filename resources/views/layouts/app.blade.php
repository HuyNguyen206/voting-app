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
        @livewireStyles
    </head>
    <body class="font-sans text-gray-900 text-sm bg-gray-background">
      <header class="flex flex-col lg:flex-row items-center justify-between px-8 py-4">
          <a href=""><img src="{{asset('images/logo.svg')}}" alt=""></a>
          <div class="flex items-center">
              @if (Route::has('login'))
                  <div class="px-6 py-4">
                      @auth
                          <div class="flex space-x-2">
                              <div class="flex items-center">
                                  <a href="{{ url('/dashboard') }}" class="mr-2 text-sm text-gray-700 dark:text-gray-500 underline">Dashboard</a>
                                  <form action="{{route('logout')}}" id="logoutForm" method="post">
                                      @csrf
                                  </form>
                                  <a href="" onclick="event.preventDefault();document.getElementById('logoutForm').submit()" class="text-sm text-gray-700 dark:text-gray-500 underline">Logout</a>
                              </div>
                              @php
                                 $user = auth()->user();
                              @endphp
                              <livewire:comment-notification :user="$user"/>
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
           <main class="container mx-auto max-w-custom lg:flex-row flex flex-col lg:space-x-6">
               <div class="bg-gray-background">
                   <div class="bg-white px-2 py-4 rounded-xl shadow-md mt-6 w-70 lg:mr-5 mx-auto px-2 flex flex-col items-center py-4 lg:sticky lg:top-9">
                           <div class="text-center">
                               <h4 class="font-semibold text-xl">Add an idea</h4>
                               @auth
                               <p class="mt-2">Let us know what you would like and we will tak a look over!</p>
                               @else
                               Please login to add idea
                               @endauth
                           </div>
                       @auth
                       <livewire:create-idea/>
                       @else
                           <div class="flex flex-col justify-center">
                               <a style="display: inline-block" class="mt-6 px-6 py-4 placeholder-gray-700 bg-gray-100 rounded-xl bg-blue text-white" href="{{route('login')}}">Login</a>
                               <a style="display: inline-block" class="mt-6 px-6 py-4 placeholder-gray-700 bg-gray-100 rounded-xl bg-blue text-white" href="{{route('register')}}">Register</a>
                           </div>
                       @endauth
                   </div>
               </div>

               <div class="lg:w-175 w-full">
                    <livewire:status-filters/>
                   <div class="mt-4">
                       {{$slot}}
                   </div>
               </div>
           </main>
      @if($message = session('success_message'))
          <x-idea-notification :is-redirect="true" display-notification="{{$message}}"/>
      @endif
      @livewireScripts
    </body>
</html>
