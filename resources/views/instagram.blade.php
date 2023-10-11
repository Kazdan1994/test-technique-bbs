@extends('layouts.app')

@section('title')
    @if(isset($userToken))
        Get your Instagram posts.
    @else
        Connect with Instagram
    @endif
@endsection

@section('content')
    <div class="bg-gray-100 min-h-screen flex items-center justify-center">
        <div class="text-center">
            <div class="flex justify-between items-center">
                <img height="100" width="100" src="{{URL::asset('/images/instagram.png')}}" alt="Instagram"/>
                <h1 class="text-3xl font-semibold text-gray-800"> Instagram</h1>
            </div>
            @if(isset($userToken) && isset($username))
                <p class="mt-4 text-gray-600">Click the button below to get the instagram posts of
                    <a
                        href="https://www.instagram.com/jacquemin.arthur/"
                        class="text-blue-500 active:text-blue-600"
                        target="_blank"
                        rel="noopener noreferrer"
                    >
                        {{ $username }}
                    </a>.</p>
                <a href="{{ route('instagram.instagramFetchPost', ['username' => $username]) }}"
                   class="mt-6 bg-blue-500 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-full inline-block transition duration-300 ease-in-out">
                    Get Instagram posts
                </a>
            @else
                <p class="mt-4 text-gray-600">Click the button below to connect your Instagram account.</p>
                <a href="{{ route('instagram.login') }}"
                   class="mt-6 bg-blue-500 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-full inline-block transition duration-300 ease-in-out">
                    Connect with Instagram
                </a>
            @endif
        </div>
    </div>
@endsection
