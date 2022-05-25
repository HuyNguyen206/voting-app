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
      <header class="flex flex-col lg:flex-row items-center justify-between px-8 py-4">
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
           <main class="container mx-auto max-w-custom lg:flex-row flex flex-col">
               <div>
                   <div class="w-70 lg:mr-5 mx-auto bg-gray-background px-2 py-4 lg:sticky lg:top-9">
                       <form action="" class="bg-white px-2 py-4 rounded-xl shadow-md">
                           <div class="text-center">
                               <h4 class="font-semibold text-xl">Add an idea</h4>
                               <p class="mt-2">Let us know what you would like and we will tak a look over!</p>
                           </div>
                           <div class="space-y-4 mt-6">
                               <input placeholder="Your idea" class="w-full px-2 px-4 placeholder-gray-700 bg-gray-100 rounded-xl border-none" type="text" name="" id="">
                               <select class="w-full px-2 py-4 placeholder-gray-700 bg-gray-100 rounded-xl border-none" name="" id="">
                                   <option value="">Category</option>
                                   <option value="1">Check 1</option>
                                   <option value="2">Check 1</option>
                                   <option value="3">Check 1</option>
                               </select>
                               <textarea placeholder="Describe your idea" class="w-full px-2 px-4 placeholder-gray-700 bg-gray-100 rounded-xl border-none" name="" id="" cols="30" rows="10"></textarea>
                               <div class="flex items-center justify-between">
                                   <input type="file" name="" style="display: none" id="attachFile">
                                   <label for="attachFile" class="flex items-center cursor-pointer px-6 py-4 bg-gray-100 rounded-xl"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                           <path stroke-linecap="round" stroke-linejoin="round" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                                       </svg><span>Attach</span></label>
                                   <button class="px-6 py-4 placeholder-gray-700 bg-gray-100 rounded-xl bg-blue text-white">Submit</button>
                               </div>
                           </div>

                       </form>

                   </div>
               </div>

               <div class="lg:w-175 w-full">
                   <nav class="hidden lg:flex items-center justify-between text-xs ">
                       <ul class="flex uppercase font-semibold space-x-10 border-b-4 pb-3">
                           <li><a href="" class="border-b-4 border-blue pb-3">All ideas (87)</a></li>
                           <li><a href="" class="text-gray-400 transition duration-75 ease-in border-b-4 pb-3 hover:border-blue">Considering (87)</a></li>
                           <li><a href="" class="text-gray-400 transition duration-75 ease-in border-b-4 pb-3 hover:border-blue">In Progress (87)</a></li>
                       </ul>

                       <ul class="flex uppercase font-semibold space-x-10 border-b-4 pb-3">
                           <li><a href="" class="border-b-4 border-blue pb-3">Implemented (87)</a></li>
                           <li><a href="" class="text-gray-400 transition duration-75 ease-in border-b-4 pb-3 hover:border-blue">Closed (87)</a></li>
                       </ul>
                   </nav>
                   <div class="mt-8">
                       {{$slot}}
                   </div>
               </div>
           </main>
    </body>
</html>
