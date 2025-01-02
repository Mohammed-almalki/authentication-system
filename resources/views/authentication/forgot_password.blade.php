@extends('authentication.layout.layout')

@section('head')
    <title>Forgot password</title>
@endsection

@section('body')
    <div class="flex min-h-full items-center justify-center px-4 py-12 sm:px-6 lg:px-8">
        <div class="w-full max-w-sm space-y-10">
            <div class="sm:mx-auto sm:w-full sm:max-w-md flex flex-col items-center">
                <svg height="100" viewBox="0 0 24 24" width="100" xmlns="http://www.w3.org/2000/svg" class="fill-cyan-600">
                    <path clip-rule="evenodd"
                        d="m7.5 7c0-2.48528 2.01472-4.5 4.5-4.5 2.4853 0 4.5 2.01472 4.5 4.5v3.3096c1.2327 1.1829 2 2.847 2 4.6904 0 3.5899-2.9101 6.5-6.5 6.5-3.58985 0-6.5-2.9101-6.5-6.5 0-1.8434.76733-3.5075 2-4.6904zm8 0v2.52182c-1.0103-.64682-2.2114-1.02182-3.5-1.02182s-2.4897.375-3.5 1.02182v-2.52182c0-1.933 1.567-3.5 3.5-3.5s3.5 1.567 3.5 3.5zm-4.2929 7.2929c-.2762 0-.5.2239-.5.5s.2238.5.5.5h1.5858c.2761 0 .5-.2239.5-.5s-.2239-.5-.5-.5z"
                        fill-rule="evenodd"></path>
                </svg>
                <h2 class="mt-10 text-center text-2xl/9 font-bold tracking-tight text-gray-900">Forgot Password !</h2>
            </div>
            <form class="space-y-6" method="POST">
                @csrf
                <div>
                    <div class="col-span-2">
                        <input id="email-address" name="email" type="email" autocomplete="email" required
                            value="{{ old('email') }}" aria-label="Email address"
                            class="block w-full rounded-t-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:relative focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-cyan-600 sm:text-sm/6"
                            placeholder="Email address">
                    </div>
                </div>
                <div>
                    <button type="submit"
                        class="flex w-full justify-center rounded-md bg-cyan-600 px-3 py-1.5 text-sm/6 font-semibold text-white hover:bg-cyan-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-cyan-600">Send</button>
                </div>
            </form>
            <p class="text-center text-sm/6 text-gray-500">
                Changed Mind ?
                <a href="/login" class="font-semibold text-cyan-600 hover:text-cyan-500">Login</a>
            </p>
        </div>
    </div>
@endsection
