@extends('layouts.app')

@section('title', 'داشبورد')

@section('content')
    <h2>داشبورد</h2>

    <p>شما با موفقیت وارد شده‌اید ✅</p>
@endsection


<a href="{{ route('force.logout') }}" style="color:red">
    خروج سراسری (برای تست)
</a>
