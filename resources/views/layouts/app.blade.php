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
                              <div x-data="{showDialog : false}" class="relative">
                                  <button class="relative" @click.prevent="showDialog = true">
                                      <svg class="h-8 w-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                          <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                      </svg>
                                      <div class="absolute top-0 -right-1 rounded-full bg-red text-white w-5 h-5">5</div>
                                  </button>
                                  <ul @click.outside.window="showDialog = false" x-show="showDialog" x-cloak x-transition
                                      class="top-9 -left-52 absolute w-70 md:w-80 max-h-128 bg-white shadow-lg rounded-xl py-3 z-20 overflow-y-auto">
                                          <li class="text-left hover:bg-gray-100 transition duration-150 py-2">
                                              <a href="" class="px-5 inline-block flex space-x-4">
                                                  <img class="rounded-full w-12 h-12" src="{{auth()->user()->avatar()}}" alt="picture">
                                                  <div class="flex flex-col space-y-3">
                                                      <div>
                                                          <span class="font-semibold">Huy</span> comment on
                                                          <span class="font-semibold">Test idea title</span>:
                                                          <span class="line-clamp-3">"Idea comment content sdsfa dasd asdasd Idea comment content sdsfa dasd asdasd Idea comment content sdsfa dasd asdasd Idea comment content sdsfa dasd asdasd
                                                              Idea comment content sdsfa dasd asdasd
                                                              Idea comment content sdsfa dasd asdasd
                                                              Idea comment content sdsfa dasd asdasd"</span>
                                                      </div>
                                                      <span class="text-gray-400 text-xs">2 weeks ago</span>
                                                  </div>
                                              </a>
                                          </li>
                                      <li class="text-left hover:bg-gray-100 transition duration-150 py-2">
                                          <a href="" class="px-5 inline-block flex space-x-4">
                                              <img class="rounded-full w-12 h-12" src="{{auth()->user()->avatar()}}" alt="picture">
                                              <div class="flex flex-col space-y-3">
                                                  <div>
                                                      <span class="font-semibold">Huy</span> comment on
                                                      <span class="font-semibold">Test idea title</span>:
                                                      <span>"Idea comment content sdsfa dasd asdasd"</span>
                                                  </div>
                                                  <span class="text-gray-400 text-xs">2 weeks ago</span>
                                              </div>
                                          </a>
                                      </li>
                                      <li class="text-left hover:bg-gray-100 transition duration-150 py-2">
                                          <a href="" class="px-5 inline-block flex space-x-4">
                                              <img class="rounded-full w-12 h-12" src="{{auth()->user()->avatar()}}" alt="picture">
                                              <div class="flex flex-col space-y-3">
                                                  <div>
                                                      <span class="font-semibold">Huy</span> comment on
                                                      <span class="font-semibold">Test idea title</span>:
                                                      <span>"Idea comment content sdsfa dasd asdasd"</span>
                                                  </div>
                                                  <span class="text-gray-400 text-xs">2 weeks ago</span>
                                              </div>
                                          </a>
                                      </li>
                                      <li class="text-left hover:bg-gray-100 transition duration-150 py-2">
                                          <a href="" class="px-5 inline-block flex space-x-4">
                                              <img class="rounded-full w-12 h-12" src="{{auth()->user()->avatar()}}" alt="picture">
                                              <div class="flex flex-col space-y-3">
                                                  <div>
                                                      <span class="font-semibold">Huy</span> comment on
                                                      <span class="font-semibold">Test idea title</span>:
                                                      <span>"Idea comment content sdsfa dasd asdasd"</span>
                                                  </div>
                                                  <span class="text-gray-400 text-xs">2 weeks ago</span>
                                              </div>
                                          </a>
                                      </li>
                                      <li class="text-left hover:bg-gray-100 transition duration-150 py-2">
                                          <a href="" class="px-5 inline-block flex space-x-4">
                                              <img class="rounded-full w-12 h-12" src="{{auth()->user()->avatar()}}" alt="picture">
                                              <div class="flex flex-col space-y-3">
                                                  <div>
                                                      <span class="font-semibold">Huy</span> comment on
                                                      <span class="font-semibold">Test idea title</span>:
                                                      <span>"Idea comment content sdsfa dasd asdasd"</span>
                                                  </div>
                                                  <span class="text-gray-400 text-xs">2 weeks ago</span>
                                              </div>
                                          </a>
                                      </li>
                                      <li class="text-left hover:bg-gray-100 transition duration-150 py-2">
                                          <a href="" class="px-5 inline-block flex space-x-4">
                                              <img class="rounded-full w-12 h-12" src="{{auth()->user()->avatar()}}" alt="picture">
                                              <div class="flex flex-col space-y-3">
                                                  <div>
                                                      <span class="font-semibold">Huy</span> comment on
                                                      <span class="font-semibold">Test idea title</span>:
                                                      <span>"Idea comment content sdsfa dasd asdasd"</span>
                                                  </div>
                                                  <span class="text-gray-400 text-xs">2 weeks ago</span>
                                              </div>
                                          </a>
                                      </li>
                                      <li class="text-left hover:bg-gray-100 transition duration-150 py-2">
                                          <a href="" class="px-5 inline-block flex space-x-4">
                                              <img class="rounded-full w-12 h-12" src="{{auth()->user()->avatar()}}" alt="picture">
                                              <div class="flex flex-col space-y-3">
                                                  <div>
                                                      <span class="font-semibold">Huy</span> comment on
                                                      <span class="font-semibold">Test idea title</span>:
                                                      <span>"Idea comment content sdsfa dasd asdasd"</span>
                                                  </div>
                                                  <span class="text-gray-400 text-xs">2 weeks ago</span>
                                              </div>
                                          </a>
                                      </li>
                                      <li class="text-left hover:bg-gray-100 transition duration-150 py-2">
                                          <button class="w-full text-center px-2 py-3 ml-2">Mark all as read</button>
                                      </li>
                                  </ul>

                              </div>
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
                   <div class="mt-8">
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
