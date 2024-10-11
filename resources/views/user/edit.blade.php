<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit User') }} &nbsp; <a href="{{ route('users') }}" type="button" class="btn btn-primary btn-sm"><< Back to users </a>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
              <div class="card">
                <div class="card-header">
                  @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                  @endif
                  @if ($errors->any())
                    <div class="alert alert-danger">
                      <ul>
                        @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                        @endforeach
                      </ul>
                    </div>
                  @endif
                </div>
                <div class="card-body">
                  <form action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                      @csrf
                      @method('PUT')
                      <div class="mb-3 row">
                        <label class="col-sm-2 col-form-label">Prefix Name (required)</label>
                        <div class="col-sm-4">
                          <select class="form-select" id="prefixname" name="prefixname" value="{{ $user->prefixname }}">
                            <option value="">Select Prefix</option>
                            <option value="Mr">Mr</option>
                            <option value="Mrs">Mrs</option>
                            <option value="Ms">Ms</option>
                          </select>
                        </div>
                      </div>
                      <div class="mb-3 row">
                        <label class="col-sm-2 col-form-label">Username (required)</label>
                        <div class="col-sm-4">
                          <input class="form-control" type="text" id="username" name="username" value="{{ $user->username }}" required/>
                        </div>
                      </div>
                      <div class="mb-3 row">
                        <label class="col-sm-2 col-form-label">Email (required)</label>
                        <div class="col-sm-4">
                          <input class="form-control" type="email" id="email" name="email" value="{{ $user->email }}" required/>
                        </div>
                      </div>
                      <div class="mb-3 row">
                        <label class="col-sm-2 col-form-label">Password (required)</label>
                        <div class="col-sm-4">
                          <input class="form-control" type="text" id="password" name="password"/>
                        </div>
                      </div>
                      <div class="mb-3 row">
                        <label class="col-sm-2 col-form-label">First Name</label>
                        <div class="col-sm-4">
                          <input class="form-control" type="text" id="firstname" name="firstname" value="{{ $user->firstname }}"/>
                        </div>
                      </div>
                      <div class="mb-3 row">
                        <label class="col-sm-2 col-form-label">Middle Name</label>
                        <div class="col-sm-4">
                          <input class="form-control" type="text" id="middlename" name="middlename" value="{{ $user->middlename }}"/>
                        </div>
                      </div>
                      <div class="mb-3 row">
                        <label class="col-sm-2 col-form-label">Last Name</label>
                        <div class="col-sm-4">
                          <input class="form-control" type="text" id="lastname" name="lastname" value="{{ $user->lastname }}"/>
                        </div>
                      </div>
                      <div class="mb-3 row">
                        <label class="col-sm-2 col-form-label">Suffix Name</label>
                        <div class="col-sm-4">
                          <input class="form-control" type="text" id="suffixname" name="suffixname" value="{{ $user->suffixname }}"/>
                        </div>
                      </div>
                      <div class="mb-3 row">
                        <label class="col-sm-2 col-form-label">Avatar</label>
                        <div class="col-sm-4">
                          <input class="form-control" type="file" id="photo" name="photo">
                        </div>
                      </div>                      
                      <button type="submit" class="btn btn-primary">Update</button>
                  </form>
                </div>
              </div>
            </div>
        </div>
    </div>
</x-app-layout>
