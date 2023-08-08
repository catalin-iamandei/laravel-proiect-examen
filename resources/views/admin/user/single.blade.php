<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __($user->name) }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div>
            <div class="mt-6 border-t border-white/10">
              <dl class="divide-y divide-white/10">
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                  <dt class="text-sm font-medium leading-6 text-white">Name</dt>
                  <dd class="mt-1 text-sm leading-6 text-gray-400 sm:col-span-2 sm:mt-0">{{ $user->name }}</dd>
                </div>
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                  <dt class="text-sm font-medium leading-6 text-white">Email address</dt>
                  <dd class="mt-1 text-sm leading-6 text-gray-400 sm:col-span-2 sm:mt-0">{{ $user->email }}</dd>
                </div>
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                  <dt class="text-sm font-medium leading-6 text-white">Group name</dt>
                  <dd class="mt-1 text-sm leading-6 text-gray-400 sm:col-span-2 sm:mt-0">{{ $user->group ? $user->group->name : '-' }}</dd>
                </div>
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                  <dt class="text-sm font-medium leading-6 text-white">Created at</dt>
                  <dd class="mt-1 text-sm leading-6 text-gray-400 sm:col-span-2 sm:mt-0">{{ date('d.m.Y H:m', strtotime($user->created_at)) }}</dd>
                </div>
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                  <dt class="text-sm font-medium leading-6 text-white">Email verified at</dt>
                  <dd class="mt-1 text-sm leading-6 text-gray-400 sm:col-span-2 sm:mt-0">{{ $user->email_verified_at ? date('d.m.Y H:m', strtotime($user->email_verified_at)) : 'Email neverificat' }}</dd>
                </div>
              </dl>
            </div>
          </div>
        </div>
    </div>
</x-app-layout>