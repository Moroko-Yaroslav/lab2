
@extends('layouts.app')

@section('title', 'Каталог — StyleRent')

@section('content')

<section class="section">

    <div class="section__heading">
        <div>
            <p class="section__eyebrow">Оренда одягу</p>
            <h1 class="section__title">Каталог образів</h1>
        </div>

        <span>Усього: {{ $items->total() }}</span>
    </div>

    <form
        action="{{ route('catalog.index') }}"
        method="GET"
        class="catalog-filters"
    >

        <input
            type="search"
            name="q"
            class="catalog-filters__input"
            placeholder="Пошук за назвою..."
            value="{{ $filters->q }}"
            maxlength="100
        >

        <select
            name="category"
            class="catalog-filters__select">
        >
            <option value="">Усі категорії</option>

            @foreach($categories as $category)
                <option
                    value="{{ $category->name }}"
                    @selected($filters->category === $category->name)
                >
                    {{ $category->name }}
                </option>
            @endforeach
        </select>

        <select
            name="operation"
            class="catalog-filters__select">
        >
            <option value="">Усі операції</option>

            <option value="Оренда" @selected($filters->operation === 'Оренда')>
                Оренда
            </option>

            <option value="Продаж" @selected($filters->operation === 'Продаж')>
                Продаж
            </option>
        </select>

        <select
            name="sort"
            class="catalog-filters__select">
        >
            <option value="newest" @selected($filters->sort === 'newest')>
                Спочатку нові
            </option>

            <option value="price_asc" @selected($filters->sort === 'price_asc')>
                Ціна: від дешевих
            </option>

            <option value="price_desc" @selected($filters->sort === 'price_desc')>
                Ціна: від дорогих
            </option>
        </select>

        <select
            name="per_page"
            class="catalog-filters__select">
        >
            <option value="9" @selected($filters->perPage === 9)>
                9 товарів
            </option>

            <option value="12" @selected($filters->perPage === 12)>
                12 товарів
            </option>

            <option value="24" @selected($filters->perPage === 24)>
                24 товари
            </option>
        </select>

        <button type="submit" class="button">
            Застосувати
        </button>

        <a href="{{ route('catalog.index') }}" class="catalog-filters__reset">
            Скинути
        </a>
    </form>

    @if($items->isEmpty())

        <div style="text-align: center; padding: 50px 20px;">
            <h2>Нічого не знайдено</h2>

            <p>
                Спробуйте змінити параметри пошуку або фільтрації.
            </p>

            <a href="{{ route('catalog.index') }}" class="button">
                Показати всі товари
            </a>
        </div>

    @else

        <div class="catalog-grid">
            @foreach($items as $item)
                <x-catalogcard :item="$item" />
            @endforeach
        </div>

        @if($items->hasPages())
            <nav
                aria-label="Сторінки каталогу"
                style="display: flex; gap: 10px; justify-content: center; align-items: center; flex-wrap: wrap; margin-top: 32px;"
            >
                @if($items->onFirstPage())
                    <span>← Назад</span>
                @else
                    <a
                        class="section__link"
                        href="{{ $items->previousPageUrl() }}"
                    >
                        ← Назад
                    </a>
                @endif

                @for($page = 1; $page <= $items->lastPage(); $page++)
                    <a
                        href="{{ $items->url($page) }}"
                        class="section__link"
                        @if($items->currentPage() === $page)
                            aria-current="page"
                            style="font-weight: bold; text-decoration: underline;"
                        @endif
                    >
                        {{ $page }}
                    </a>
                @endfor

                @if($items->hasMorePages())
                    <a
                        class="section__link"
                        href="{{ $items->nextPageUrl() }}"
                    >
                        Далі →
                    </a>
                @else
                    <span>Далі →</span>
                @endif
            </nav>
        @endif

    @endif

</section>

@endsection
