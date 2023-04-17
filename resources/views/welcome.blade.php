<x-layout>
    <!--Left Col-->
    <div class="flex flex-col justify-center w-full overflow-y-hidden xl:w-2/5 lg:items-start">
        <h1
            class="my-4 text-3xl font-bold leading-tight text-center text-purple-800 md:text-5xl md:text-left slide-in-bottom-h1">
            Simple Image Placeholder service that does what it says... Provide placeholder images.
        </h1>
        <p class="mb-8 text-base leading-normal text-center md:text-2xl md:text-left slide-in-bottom-subtitle">
            Lorem Toneflix was created to help designers prototype and create mockups using real images. It's free to
            use for none commercial projects.
        </p>

    </div>

    <!--Right Col-->
    <div class="w-full py-6 overflow-y-hidden xl:w-3/5">
        <img class="w-2/3 mx-auto lg:mr-0 slide-in-bottom" src="{{ url('images?w=300&h=300') }}">
    </div>
    <div class="w-full py-1 overflow-y-hidden xl:w-3/5">
        <div class="w-2/3 p-2 mx-auto text-center lg:mr-0 slide-in-bottom bg-slate-400">
            {{ url('images') }}</div>
    </div>

    <section class="w-full px-3 pt-6 pb-12 mx-auto mt-4 text-center gradient">
        <h3 class="my-4 text-3xl font-extrabold text-white">
            And it is easier than you thought it was.
        </h3>
        <div class="w-full mb-4">
            <div class="w-1/6 h-1 py-0 mx-auto my-0 bg-white rounded-t opacity-25"></div>
        </div>
        <swiper-container class="mySwiper" pagination="true" pagination-clickable="true" space-between="30"
            slides-per-view="3">
            @foreach ($slides as $slide)
                <swiper-slide>
                    <img class="mx-auto lg:mr-0 slide-in-bottom" src="{{ $slide['url'] }}">
                    <div class="absolute">
                        <div class="text-3xl font-extrabold text-white">{{ $slide['label'] }}</div>
                        <div class="p-2 text-center text-white bg-slate-400">
                            {{ $slide['code'] }}</div>
                    </div>
                </swiper-slide>
            @endforeach
        </swiper-container>
    </section>

    <div class="w-full py-6">
    </div>
    @push('head')
        <style>
            swiper-container {
                width: 100%;
                height: 100%;
            }

            swiper-slide {
                text-align: center;
                font-size: 18px;
                background: #fff;
                display: flex;
                justify-content: center;
                align-items: center;
            }

            swiper-slide img {
                display: block;
                object-fit: contain;
                width: 100%;
            }

            .gradient {
                background-image: linear-gradient(-225deg, #cbbacc 0%, #2580b3 100%);
            }
        </style>
    @endpush
</x-layout>
