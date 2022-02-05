@extends('layouts.app')

@section('content')
<div class="container mx-auto  flex justify-center align-center  mt-32">
        <div class="w-96 bg-gray-800 p-10 rounded-md">
            <div class="card" style="direction: ltr">
                <div class="card-body">
                    <p class=" text-lg m-0 text-gray-300 uppercase text-center">FastFood Application</p>
                    <p class=" mb-10 text-xs text-gray-400 text-center" style="direction: ltr">developed by <Span class="text-blue-300">&lt;alien code/&gt;</Span></p>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="relative">
                            <label for="email" class="text-blue-500 pl-3 pt-2 uppercase absolute text-xs">{{ __('E-Mail Address') }}</label>
                                <input id="email" type="email" class="w-full rounded-md bg-blue-800 p-3 text-gray-300 outline-none focus:bg-blue-700 pt-8 @error('email') is-invalid @enderror" name="email" placeholder="your email" value="{{ old('email') }}"  autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="text-red-400">{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="relative mt-6">
                            <label for="password" class="text-blue-500 pl-3 pt-2 uppercase text-xs absolute">{{ __('Password') }}</label>
                                <input id="password" type="password" class="w-full p-3 pt-8 bg-blue-800 outline-none text-gray-300 focus:bg-blue-700 rounded-md  @error('password') is-invalid @enderror" name="password"  autocomplete="current-password" placeholder="your password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="text-red-400">{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="mt-4">
                            <div class="text-white">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="mt-6 w-full">
                                <button type="submit" class="bg-blue-500 text-gray-300 focus:outline-none font-bold p-1 outline-none border-none rounded w-full">
                                    {{ __('Login') }}
                                </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</div>
@endsection
