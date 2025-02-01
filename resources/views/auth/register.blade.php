@extends('layouts.auth')

@section('title', 'Login')

@section('content')
    <div class="bg-white rounded p-6 border-2 shadow lg:w-[340px]">
        <h1 class="font-bold text-xl mb-6">Register</h1>

        <form action="" method="POST" class="mb-4">
            @csrf

            <div class="flex flex-col mb-4">
                <label for="username" class="text-sm font-semibold mb-1">Username</label>
                <input type="text" id="username" name="username" placeholder="Masukkan username" class="px-4 py-2 border rounded outline-none">
            </div>

            <div class="flex flex-col mb-4">
                <label for="password" class="text-sm font-semibold mb-1">Password</label>
                <input type="text" id="password" name="password" placeholder="* * * * * * * *" class="px-4 py-2 border rounded outline-none">
            </div>

            <div class="flex flex-col mb-4">
                <label for="password" class="text-sm font-semibold mb-1">Password Confirmation</label>
                <input type="text" id="password_confirmation" name="password_confirmation" placeholder="* * * * * * * *" class="px-4 py-2 border rounded outline-none">
            </div>

            <button type="submit" class="px-4 py-2 w-full bg-blue-500 text-white rounded">Register</button>
        </form>

        <h6 class="text-sm">Sudah punya akun? <a href="{{route('login')}}" class="font-semibold text-sm text-blue-500">Login</a></h6>
    </div>
@endsection

@push('scripts')
    
@endpush