@extends('layouts.app')

@section('content')
<form method="post" action="{{ route('subscriber.create') }}">
  @csrf
    <div class="flex items-center justify-center h-screen bg-gray-100">
      <div class="bg-white py-6 rounded-md px-10 max-w-lg shadow-md">
        <h1 class="text-center text-lg font-bold text-gray-500">Add a new subscriber</h1>
        <div class="space-y-4 mt-6">
          
          <div class="w-full flex flex-col">
            <input type="email" name="email" value="{{ old('email') }}" placeholder="Email*" class="px-4 py-2 w-64 bg-gray-50 border border-gray-400 rounded-md" />
            @error('email')
                <span class="text-xs text-red-400 px-2">{{ $message }}</span>
            @enderror
          </div>
          <div class="w-full flex flex-col">
            <input type="text" name="fname" value="{{ old('fname') }}" placeholder="First name" class="px-4 py-2 w-64 bg-gray-50 border border-gray-400 rounded-md" />
            @error('fname')
                <span class="text-xs text-red-400 px-2">{{ $message }}</span>
            @enderror
          </div>
          <div class="w-full flex flex-col">
            <input type="text" name="lname" value="{{ old('lname') }}" placeholder="Last name" class="px-4 py-2 w-64 bg-gray-50 border border-gray-400 rounded-md" />
            @error('lname')
                <span class="text-xs text-red-400 px-2">{{ $message }}</span>
            @enderror
          </div>
          
        </div>
        <button class="w-full text-white mt-3 bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:ring-green-300 dark:focus:ring-green-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Register</button>
      </div>
    </div>
  </form>
@endsection