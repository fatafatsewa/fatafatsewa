{{-- @foreach ($product->attributes as $key => $attributes_data)
    @if (strtolower($attributes_data['option']['name']) === 'color')
        @foreach ($attributes_data['values'] as $value)
            @php
            $color_id = $value['products_attributes_id'];
            @endphp



            <div class="slider-wrapper slider-banner pd2 d-none color--image-{{ $color_id }} color">
                <div class="slider-for">
                    @if (!empty($product->products_video_link))
                        <a class="slider-for__item ex1 fancybox-button iframe">
                            {!! $product->products_video_link !!}
                        </a>
                    @endif


                    @foreach ($product_images as $key => $images)

                        @if ($images->color_id === $color_id)
                            @if ($images->image_type == 'LARGE')
                                <a class="slider-for__item ex1 fancybox-button"
                                    href="{{ asset('') . $images->image_path }}" data-fancybox-group="fancybox-button">
                                    <img src="{{ asset('') . $images->image_path }}" alt="Zoom Image" />
                                </a>
                                @elseif($images->image_type == 'ACTUAL')
                                <a class="slider-for__item ex1 fancybox-button"
                                    href="{{ asset('') . $images->image_path }}" data-fancybox-group="fancybox-button">
                                    <img src="{{ asset('') . $images->image_path }}" alt="Zoom Image" />
                                </a>
                            @endif
                        @endif
                    @endforeach

                </div>

                <div class="slider-nav">
                    @if (!empty($product->products_video_link))
                        <div class="slider-nav__item">
                            <img src="{{ asset('web/images/miscellaneous/video-thumbnail.jpg') }}" alt="Zoom Image" />
                        </div>
                    @endif


                    @foreach ($product_images as $key => $images)
                        @if ($images->color_id === $color_id)

                            @if ($images->image_type == 'THUMBNAIL')
                                <div class="slider-nav__item">
                                    <img src="{{ asset('') . $images->image_path }}" alt="Zoom Image" @if ($images->color_id)
                                    id="product--image-{{ $images->color_id }}"
                            @endif/>
                </div>
        @endif
    @endif
@endforeach
</div>
</div>








@endforeach
@endif
@endforeach --}}

<div class="slider-wrapper slider-banner pd2">
    <div class="slider-for">
        {{-- @if (!empty($product->products_video_link))
            <a class="slider-for__item ex1 fancybox-button iframe">
                {!! $product->products_video_link !!}
            </a>
        @endif --}}
        @if (isset($default_image))
            <a class="slider-for__item ex1 fancybox-button" href="{{ asset('') . $default_image }}"
                data-fancybox-group="fancybox-button">
                <img src="{{ asset('') . $default_image }}" alt="Zoom Image" />
            </a>

        @endif
        @foreach ($product_images as $key => $images)
          @if($images->image_type == 'ACTUAL')
                <a class="slider-for__item ex1 fancybox-button" href="{{ asset('') . $images->image_path }}"
                    data-fancybox-group="fancybox-button">
                    <img src="{{ asset('') . $images->image_path }}" alt="Zoom Image" />
                </a>
            @endif
        @endforeach
    </div>

    <div class="slider-nav">
        {{-- @if (!empty($product->products_video_link))
            <div class="slider-nav__item">
                <img src="{{ asset('web/images/miscellaneous/video-thumbnail.jpg') }}" alt="Zoom Image" />
            </div>
        @endif --}}

        @if (isset($default_image))
            <div class="slider-nav__item">
                <img src="{{ asset('') . $default_image }}" alt="Zoom Image" />
            </div>
        @endif
        @foreach ($product_images as $key => $images)
            @if ($images->image_type == 'ACTUAL')
                <div class="slider-nav__item">
                    <img src="{{ asset('') . $images->image_path }}" alt="Zoom Image" @if ($images->color_id) id="product--image-{{ $images->color_id }}" @endif/>
                </div>
            @endif
     
    @endforeach
</div>
</div>
