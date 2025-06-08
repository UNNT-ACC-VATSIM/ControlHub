@extends('layouts.app')

@section('title', __('Региональный центр Новосибирск | VATSIM'))

@section('content')
<style>
.under-construction-home-button {
    display: inline-block;
    padding: 12px 30px;
    background-color: #1e90ff; /* насыщенный синий */
    color: white;
    text-decoration: none;
    font-weight: 600;
    border-radius: 6px;
    box-shadow: 0 4px 8px rgba(30, 144, 255, 0.4);
    transition: background-color 0.3s ease, box-shadow 0.3s ease, transform 0.2s ease, color 0.3s ease, font-weight 0.3s ease;
}

.under-construction-home-button:hover,
.under-construction-home-button:focus {
    background-color: #005bbb; /* темнее синий */
    box-shadow: 0 6px 12px rgba(0, 91, 187, 0.6);
    text-decoration: none;
    outline: none;
    transform: scale(1.05);
    color: white;
    font-weight: 700; /* жирный текст */
}
</style>

<div style="
    position: fixed; 
    top: 0; left: 0; right: 0; 
    height: 99vh; 
    background: url('/images/fon.png') center center / cover no-repeat; 
    background-attachment: fixed;
    z-index: -2;
"></div>

<div style="
    position: fixed; 
    top: 0; left: 0; right: 0;
    height: 99vh;
    background-color: rgba(0, 48, 102, 0.75); /* синий с прозрачностью */ 
    z-index: -1;
"></div>

<div class="under-construction-content" style="position: relative; z-index: 1;">
    <div class="under-construction-message-box" style="background: transparent; box-shadow: none; color: white;">
        <h1 style="color: #a9d1ff;">Пожалуйста, авторизуйтесь через VATSIM</h1>

        <a href="{{ $auth_url }}" class="under-construction-home-button">Войти через VATSIM</a>

        @if(session('success'))
            <p style="color: #b7e3a8; margin-top: 20px;">{{ session('success') }}</p>
        @endif

        @if($errors->any())
            <ul style="color: #ffb3b3; margin-top: 20px; list-style: none; padding-left: 0;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
    </div>
</div>
@endsection
