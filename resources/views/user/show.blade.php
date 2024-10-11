<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('User Details') }} &nbsp; <a href="{{ route('users') }}" type="button" class="btn btn-primary btn-sm"><< Back to users </a>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
              <div class="card">
                <div class="card-body">
                  <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Prefix Name</label>
                    <div class="col-sm-4">
                      {{ $user->prefixname }}
                    </div>
                  </div>
                  <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Username</label>
                    <div class="col-sm-4">
                    {{ $user->username }}
                    </div>
                  </div>
                  <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-4">
                    {{ $user->email }}
                    </div>
                  </div>
                  <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">First Name</label>
                    <div class="col-sm-4">
                    {{ $user->firstname }}
                    </div>
                  </div>
                  <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Middle Name</label>
                    <div class="col-sm-4">
                    {{ $user->middlename }}
                    </div>
                  </div>
                  <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Last Name</label>
                    <div class="col-sm-4">
                    {{ $user->lastname }}
                    </div>
                  </div>
                  <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Suffix Name</label>
                    <div class="col-sm-4">
                    {{ $user->suffixname }}
                    </div>
                  </div>
                  <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Avatar</label>
                    <div class="col-sm-4">
                      <img src="{{ asset('storage/' . $user->photo) }}" style="width:25%;"/>
                    </div>
                  </div>                      
                </div>
              </div>
            </div>
        </div>
    </div>
</x-app-layout>
