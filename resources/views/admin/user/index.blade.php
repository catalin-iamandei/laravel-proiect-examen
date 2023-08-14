<x-app-layout>
    <x-slot name="header">
      <div class="flex justify-between align-center">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Users') }}
        </h2>
        <div>
          <a href="{{url('admin/user/create')}}">
            <button type="button" class="block rounded-md bg-indigo-500 px-3 py-2 text-center text-sm font-semibold text-white hover:bg-indigo-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">
              Add user
            </button>
          </a>
        </div>
      </div>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-900">
                <div class="mx-auto max-w-7xl">
                  <div class="bg-gray-900 py-3">
                    <div class="mt-8 flow-root">
                      <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                          <table class="min-w-full divide-y divide-gray-700">
                            <thead>
                              <tr>
                                <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-white sm:pl-0">Name</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-white">Email</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-white">Group</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-white">Created at</th>
                                <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-0">
                                  <span class="sr-only">Edit</span>
                                </th>
                                <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-0">
                                  <span class="sr-only">View</span>
                                </th>
                              </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-800">
                              @foreach ($users as $user)
                                  <tr>
                                      <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-white sm:pl-0">{{ $user->name }}</td>
                                      <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-300">{{ $user->email }}</td>
                                      <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-300">{{ $user->group->name }}</td>
                                      <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-300">{{ date('d.m.Y H:m', strtotime($user->created_at)) }}</td>
                                      <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-0">
                                          <a href="{{url('admin/users/' . $user->id)}}" class="text-indigo-400 hover:text-indigo-300">View</a>
                                      </td>
                                      <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-0">
                                        <a href="{{route('users.edit', $user->id)}}" class="text-indigo-400 hover:text-indigo-300">Edit</a>
                                      </td>
                                      <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-0">
                                        <form method="post" action="{{route('users.destroy', $user->id)}}">
                                          @method('delete')
                                          @csrf
                                          <button type="submit" class="btn btn-danger btn-sm text-indigo-400 hover:text-indigo-300">Delete</button>
                                        </form>
                                      </td>
                                  </tr>
                              @endforeach
                            </tbody>
                          </table>
                          <div class="row mt-5">
                              <div class="col-md-12">
                                  {{ $users->links() }}
                              </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
        </div>
    </div>
</x-app-layout>