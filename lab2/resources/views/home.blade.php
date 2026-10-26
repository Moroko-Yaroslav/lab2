
@extends('layouts.app')

@section('title', 'Головна — StyleRent')

@section('content')

<section class="hero">
    <div class="hero__content">
        <p class="hero__eyebrow">StyleRent · оренда одягу</p>

        <h1 class="hero__title">Образ для кожної події</h1>

        <p class="hero__text">
            Святковий, діловий та сценічний одяг в оренду.
            Обирайте свій стиль без зайвих витрат.
        </p>

        <div class="hero__actions">
            <a class="button" href="{{ route('catalog.index') }}">
                Переглянути каталог
            </a>

            <a class="hero__secondary" href="#featured">
                Рекомендовані образи
            </a>
        </div>

        <form action="{{ route('catalog.index') }}" method="GET"
              style="margin-top: 24px; display: flex; gap: 10px; flex-wrap: wrap;">
            <input
                type="search"
                name="q"
                placeholder="Пошук одягу..."
                maxlength="100"
                value="{{ $filters->q }}"
                style="padding: 12px; border-radius: 8px; border: 1px solid #ccc; flex: 1; min-width: 180px;"
            >

            <button class="button" type="submit">
                Знайти
            </button>
        </form>
    </div>
</section>

<section class="section" id="featured">
    <div class="section__heading">
        <div>
            <p class="section__eyebrow">Добірка</p>
            <h2 class="section__title">Рекомендований одяг</h2>
        </div>

        <a class="section__link" href="{{ route('catalog.index') }}">
            Усі 12 оголошень →
        </a>
    </div>

    <div class="catalog-grid catalog-grid--home">
        @foreach($featured as $item)
            <x-catalogcard :item="$item" />
        @endforeach
    </div>
</section>

<section class="partners" aria-labelledby="partners-title">
    <div class="partners__heading">
        <div>
            <p class="partners__eyebrow">Співпраця</p>
            <h2 class="partners__title" id="partners-title">
                Наші партнери
            </h2>
        </div>

        <p class="partners__text">
            Компанії, які допомагають перевіряти пропозиції,
            організовувати отримання та підтримувати якість сервісу.
        </p>
    </div>

    <div class="partners__slider" data-partners-slider>
        <button
            class="partners__control"
            type="button"
            data-action="partners-previous"
            aria-label="Показати попередні логотипи"
            aria-controls="partners-viewport"
            disabled
        >
            <svg viewBox="0 0 24 24" width="22" height="22" aria-hidden="true">
                <path d="m15 5-7 7 7 7"
                      fill="none"
                      stroke="currentColor"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2" />
            </svg>
        </button>

        <div
            class="partners__viewport"
            id="partners-viewport"
            data-partners-viewport
            role="region"
            aria-label="Логотипи партнерів"
            tabindex="0"
        >
            <div class="partners__track">
                @foreach(['nova', 'orbit', 'vector', 'form', 'pulse', 'nexus'] as $partner)
                    <div class="partner-logo">
                        <svg
                            class="partner-logo__icon"
                            width="76"
                            height="76"
                            aria-hidden="true"
                        >
                            <use href="{{ asset('images/partner-logos.svg') }}#logo-{{ $partner }}"></use>
                        </svg>

                        <span class="partner-logo__name">
                            {{ strtoupper($partner === 'form' ? 'FORMA' : $partner) }}
                        </span>
                    </div>
                @endforeach
            </div>
        </div>

        <button
            class="partners__control"
            type="button"
            data-action="partners-next"
            aria-label="Показати наступні логотипи"
            aria-controls="partners-viewport"
        >
            <svg viewBox="0 0 24 24" width="22" height="22" aria-hidden="true">
                <path d="m9 5 7 7-7 7"
                      fill="none"
                      stroke="currentColor"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2" />
            </svg>
        </button>
    </div>
</section>

@endsection
