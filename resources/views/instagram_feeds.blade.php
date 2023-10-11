@extends('layouts.app')

@section('content')
    <div class="bg-gray-100">
        <div class="text-center p-10">
            <h1 class="font-bold text-4xl mb-4">Latest 5 Instagram Posts</h1>
        </div>
        <section id="Projects" class="w-fit mx-auto grid grid-cols-1 lg:grid-cols-3 md:grid-cols-2 justify-items-center justify-center gap-y-10 gap-x-6 mt-10 mb-5">
            @foreach ($instagram_posts as $post)
                <div class="bg-white rounded-lg shadow-md hover:shadow-xl transition-transform transform hover:scale-105">
                    <a href="{{ $post->permalink }}" target="_blank" rel="noopener noreferrer">
                        <img src="{{ $post->path }}" alt="Instagram Post" class="w-72 h-72 object-cover rounded-t-lg" />
                        <div class="px-4 py-3">
                            <span class="text-gray-600 text-sm">{{ $post->caption }}</span>
                        </div>
                    </a>
                </div>
            @endforeach
        </section>
    </div>
@endsection
