@extends('layouts.app')

@section('content')
        <div class="flex w-full justify-between items-center">
            <nav>
                <ul class="flex -space-x-0">
                    <li class="{{ $currentPage <= 0 ? 'hidden' : 'block' }}">
                        <a href="{{ $currentPage == 1 ? '#' : route('manage', ['page' => $currentPage - 1]) }}"
                            class="bg-white border border-gray-300 text-gray-500 hover:bg-gray-100 hover:text-gray-700 ml-0 rounded-l-lg leading-tight py-2 px-3">Previous</a>
                    </li>
                    <li class="{{ $currentPage <= 1 ? 'hidden' : 'block' }}">
                        <a href="{{ route('manage', ['page' => $currentPage - 2]) }}"
                            class="bg-white border border-gray-300 text-gray-500 hover:bg-gray-100 hover:text-gray-700 leading-tight py-2 px-3">{{ $currentPage - 2 }}</a>
                    </li>
                    <li class="{{ $currentPage <= 0 ? 'hidden' : 'block' }}">
                        <a href="{{ route('manage', ['page' => $currentPage - 1]) }}"
                            class="bg-white border border-gray-300 text-gray-500 hover:bg-gray-100 hover:text-gray-700 leading-tight py-2 px-3">{{ $currentPage - 1 }}</a>
                    </li>
                    <li>
                        <a href="#" aria-current="page"
                            class="bg-blue-50 border border-gray-300 text-blue-600 hover:bg-blue-100 hover:text-blue-700  py-2 px-3">{{ $currentPage }}</a>
                    </li>
                    <li class="{{ $numberOfPages - $currentPage <= 0 ? 'hidden' : 'block' }}">
                        <a href="{{ route('manage', ['page' => $currentPage + 1]) }}"
                            class="bg-white border border-gray-300 text-gray-500 hover:bg-gray-100 hover:text-gray-700 leading-tight py-2 px-3">{{ $currentPage + 1 }}</a>
                    </li>
                    <li class="{{ $numberOfPages - $currentPage <= 1 ? 'hidden' : 'block' }}">
                        <a href="{{ route('manage', ['page' => $currentPage + 2]) }}"
                            class="bg-white border border-gray-300 text-gray-500 hover:bg-gray-100 hover:text-gray-700 leading-tight py-2 px-3">{{ $currentPage + 2 }}</a>
                    </li>
                    <li class="{{ $numberOfPages - $currentPage <= 0 ? 'hidden' : 'block' }}">
                        <a href="{{ route('manage', ['page' => $currentPage + 1]) }}"
                            class="bg-white border border-gray-300 text-gray-500 hover:bg-gray-100 hover:text-gray-700 rounded-r-lg leading-tight py-2 px-3">Next</a>
                    </li>
                </ul>
            </nav>
            <a
                class="text-white block flex-initial bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:ring-green-300 dark:focus:ring-green-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2"
                href="{{ route('subscriber.add') }}"
            >Add a subscriber</a>
        </div>
        
        <div class="bg-white shadow-md rounded my-6">
            <table class="min-w-max w-full table-auto">
                <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">Email</th>
                        <th class="py-3 px-6 text-left">Full name</th>
                        <th class="py-3 px-6 text-center">Status</th>
                        <th class="py-3 px-6 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                @foreach($members as $member)            
                    <tr class="border-b border-gray-200 bg-gray-50 hover:bg-gray-100">
                        <td class="py-3 px-6 text-left">
                            <div class="flex items-center">
                                <span class="font-medium">{{ $member['email_address'] }}</span>
                            </div>
                        </td>
                        <td class="py-3 px-6 text-left">
                            <div class="flex items-center">
                                <span>{{ $member['full_name'] }}</span>
                            </div>
                        </td>
                        <td class="py-3 px-6 text-center">
                            <span class="bg-green-200 text-green-600 py-1 px-3 rounded-full text-xs">{{ $member['status'] }}</span>
                        </td>
                        <td class="py-3 px-6 text-center">
                            <div class="flex item-center justify-center">
                                <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                    <a href="{{ route('subscriber.edit', $member['email_address']) }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                        </svg>
                                    </a>
                                </div>
                                <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                    <a href="{{ route('subscriber.delete', $member['email_address']) }}" class="delete">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
@endsection