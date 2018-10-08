{{--
    Responsive image
    @param {Image} $image Default image.
    @param {[Image,string][]} $responsiveImages Images for additional media queries (optional).
    @param {string} $color Image color placeholder.
    @param {string} $title Image title.
    @param {string} $class Root element class.
--}}
<div
    class="oe-image {{ $class ?? '' }}"
    style="padding-top: {{ 100 * $image->height / $image->width }}%; background-color: #{{ $color }}"
>
    <img
        class="oe-image__content"
        alt="{{ $title }}"
        @isset($responsiveImages)
            srcset="
                @foreach ($responsiveImages as [$img])
                    {{ $img->uri }} {{ $img->width }}w,
                @endforeach
                {{ $image->uri }} {{ $image->width }}w
            "
            sizes="
                @foreach ($responsiveImages as [$img, $query])
                    ({{ $query }}) {{ $img->width }}px,
                @endforeach
                {{ $image->width }}px
            "
        @else
            width="{{ $image->width }}"
            height="{{ $image->height }}"
            src="{{ $image->uri }}"
        @endisset
    />
</div>
