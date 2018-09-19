{{--
    Responsive image
    @param {string} $href Image source
    @param {int} $width Image natural width
    @param {int} $height Image natural height
    @param {string} $title Image title
--}}

<div
    class="oe-image {{ $class ?? '' }}"
    style="padding-top: {{ 100 * $height / $width }}%; background-color: #{{ $color }}"
>
    <img
        class="oe-image__content"
        src="{{ $href }}"
        width="{{ $width }}"
        height="{{ $height }}"
        alt="{{ $title }}"
    />
</div>
