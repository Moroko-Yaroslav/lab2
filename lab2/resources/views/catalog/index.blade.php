@extends('layouts.app')
@section('title', 'Каталог — StyleRent')
@section('content')
<section class="section"><div class="section__heading"><div><p class="section__eyebrow">Оренда одягу</p><h1 class="section__title">Каталог образів</h1></div><span>Усього: {{ count($items) }}</span></div><div class="catalog-grid">@foreach($items as $item)<x-catalogcard :item="$item" />@endforeach</div></section>
@endsection
