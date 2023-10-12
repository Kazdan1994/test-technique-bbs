<x-app-layout>
    <div class="bg-gray-100 flex full-height items-center justify-center">
        <div class="text-center">
            <div class="flex justify-center items-center">
                <img class="mr-4" height="100" width="100" src="{{URL::asset('/images/instagram.svg')}}" alt="Instagram"/>
                <h1 class="text-3xl font-semibold text-gray-800">Instagram</h1>
            </div>
            @if(isset($username))
                <p class="mt-4 text-gray-600">Click the button below to get the instagram posts of
                    <a
                        href="https://www.instagram.com/{{ $username }}/"
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
</x-app-layout>
