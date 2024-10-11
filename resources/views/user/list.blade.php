<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Users') }} &nbsp; <a href="{{ route('user.create') }}" type="button" class="btn btn-primary btn-sm">Create New User</a>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
              <table class="table table-striped table-hover">
                <thead>
                  <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Username</th>
                    <th scope="col">First</th>
                    <th scope="col">Last</th>
                    <th scope="col">Email</th>
                    <th scope="col">Updated At</th>
                    <th scope="col">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($users as $user)
                    <tr>
                      <th scope="row">{{ $user->id }}</th>
                      <td><a href="{{ route('user.show', $user->id) }}">{{ $user->username }}</a> </td>
                      <td>{{ $user->firstname }}</td>
                      <td>{{ $user->lastname }}</td>
                      <td>{{ $user->email }}</td>
                      <td>{{ $user->updated_at }}</td>
                      <td>
                        <a href="{{ route('user.edit', $user->id) }}" type="button" class="btn btn-primary btn-sm">Edit</a>&nbsp;
                        <form action="{{ route('user.destroy', $user->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Are you sure you want to delete this item?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                      </td>
                    </tr>
                  @endforeach
                  <tr>
                    <td colspan="7">
                      {{ $users->links() }}
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
        </div>
    </div>
</x-app-layout>
