<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Adaugare utilizator') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <form action="{{ route('users.store') }}" method="POST">
            @csrf
            <div class="space-y-12">          
              <div class="border-b border-white/10 pb-12">
                <h2 class="text-base font-semibold leading-7 text-white">Personal Information</h2>
                <p class="mt-1 text-sm leading-6 text-gray-400">Use a permanent address where you can receive mail.</p>
                @if ($errors->any())
                    <div class="alert alert-danger mt-5">
                        <strong class="text-red-500">Error!</strong> <br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li class="text-red-500">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="mt-10 grid gap-y-8 sm:grid-cols-3">
                  <div class="sm:col-span-3">
                    <label for="name" class="block text-sm font-medium leading-6 text-white">Name</label>
                    <div class="mt-2">
                      <input type="text" name="name" id="name" autocomplete="name" class="block w-full rounded-md border-0 bg-white/5 py-1.5 text-white shadow-sm ring-1 ring-inset ring-white/10 focus:ring-2 focus:ring-inset focus:ring-indigo-500 sm:text-sm sm:leading-6">
                    </div>
                  </div>
          
                  <div class="sm:col-span-4">
                    <label for="email" class="block text-sm font-medium leading-6 text-white">Email address</label>
                    <div class="mt-2">
                      <input id="email" name="email" type="email" autocomplete="email" class="block w-full rounded-md border-0 bg-white/5 py-1.5 text-white shadow-sm ring-1 ring-inset ring-white/10 focus:ring-2 focus:ring-inset focus:ring-indigo-500 sm:text-sm sm:leading-6">
                    </div>
                  </div>
          
                  <div class="col-span-full">
                    <label for="street-address" class="block text-sm font-medium leading-6 text-white">Parola</label>
                    <div class="mt-2">
                      <input type="password" name="password" id="password" class="block w-full rounded-md border-0 bg-white/5 py-1.5 text-white shadow-sm ring-1 ring-inset ring-white/10 focus:ring-2 focus:ring-inset focus:ring-indigo-500 sm:text-sm sm:leading-6">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          
            <div class="mt-6 flex items-center gap-x-6">
              <button type="submit" class="rounded-md bg-indigo-500 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Adauga utilizator</button>
            </div>
          </form>
        </div>
    </div>
</x-app-layout>