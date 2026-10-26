
@props(['item'])

<article class="catalog-card {{ $item->status === 'featured' ? 'catalog-card--featured' : '' }}">

    <div class="catalog-card__media">

        <span class="catalog-card__badge">
            {{ $item->category->name }}
        </span>

        <img
            class="catalog-card__image"
            src="{{ asset($item->image) }}"
            alt="{{ $item->title }}"
            loading="lazy"
        >

    </div>

    <div class="catalog-card__body">

        <p class="catalog-card__eyebrow">
            {{ $item->category->name }} · {{ $item->operation }}
        </p>

        <h3 class="catalog-card__title">
            {{ $item->title }}
        </h3>

        <p class="catalog-card__description">
            {{ $item->short_description }}
        </p>

        <div class="catalog-card__footer">

            <strong class="catalog-card__price">
                {{ number_format((float) $item->price, 0, ',', ' ') }}
                {{ $item->currency }}
            </strong>

            <a
                class="catalog-card__link"
                href="{{ route('catalog.show', ['slug' => $item->slug]) }}"
            >
                Переглянути ↗
            </a>

        </div>

    </div>

</article>
