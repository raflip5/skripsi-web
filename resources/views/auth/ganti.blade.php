@extends('layouts.app')

@section('title', 'ganti')

@section('content')
<div class="flex items-center justify-center min-h-screen">
    <div class="bg-white rounded p-4">
        <h1 class="font-bold text-xl mb-6">Change Password</h1>
        <form action="">
            <div class="flex flex-col mb-4">
                <label for="password" class="text-sm font-semibold mb-1">Password</label>
                <input type="text" id="password" name="password" placeholder="* * * * * * * *" class="px-4 py-2 border rounded outline-none">
            </div>
            <div class="flex flex-col mb-4">
                <label for="password" class="text-sm font-semibold mb-1">Password Confirmation</label>
                <input type="text" id="password_confirmation" name="password_confirmation" placeholder="* * * * * * * *" class="px-4 py-2 border rounded outline-none">
            </div>
        </form>
    </div>
</div>
@endsection