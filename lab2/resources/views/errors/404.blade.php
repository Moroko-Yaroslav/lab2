@extends('layouts.app')
@section('title', '404 — Сторінку не знайдено')
@section('content')<section class="hero"><div class="hero__content"><p class="hero__eyebrow">Помилка 404</p><h1 class="hero__title">Сторінку не знайдено</h1><p class="hero__text">Можливо, оголошення більше не доступне або адресу введено неправильно.</p><a class="button" href="{{ route('home') }}">На головну</a></div></section>@endsection
