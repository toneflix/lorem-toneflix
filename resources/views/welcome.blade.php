<x-layout>

    <!--Left Col-->
    <div class="flex flex-col w-full xl:w-2/5 justify-center lg:items-start overflow-y-hidden">
        <h1
            class="my-4 text-3xl md:text-5xl text-purple-800 font-bold leading-tight text-center md:text-left slide-in-bottom-h1">
            Simple Image Placeholder service that does what it says... Provide placeholder images.
        </h1>
        <p class="leading-normal text-base md:text-2xl mb-8 text-center md:text-left slide-in-bottom-subtitle">
            Lorem Toneflix was created to help designers prototype and create mockups using real images. It's free to
            use for none commercial projects.
        </p>

    </div>

    <!--Right Col-->
    <div class="w-full xl:w-3/5 py-6 overflow-y-hidden">
        <img class="mx-auto lg:mr-0 slide-in-bottom w-2/3" src="{{ url('images?w=300&h=300') }}">
    </div>
    <div class="w-full xl:w-3/5 py-1 overflow-y-hidden">
        <div class="mx-auto lg:mr-0 slide-in-bottom w-2/3 bg-slate-400 p-2 text-center">
            {{ url('images') }}</div>
    </div>

    <section class="gradient w-full mx-auto text-center pt-6 mt-4 pb-12 px-3">
        <h3 class="my-4 text-3xl font-extrabold text-white">
            And it is easier than you thought it was.
        </h3>
        <div class="w-full mb-4">
            <div class="h-1 mx-auto bg-white w-1/6 opacity-25 my-0 py-0 rounded-t"></div>
        </div>
        <swiper-container class="mySwiper" pagination="true" pagination-clickable="true" space-between="30"
            slides-per-view="3">
            <swiper-slide>
                <img class="mx-auto lg:mr-0 slide-in-bottom" src="{{ url('images/avatar?w=300&h=300') }}">
                <div class="absolute">
                    <div class="text-3xl font-extrabold text-white">Avatars</div>
                    <div class="bg-slate-400 text-white p-2 text-center">
                        {{ '/images/avatar?w=300&h=300' }}</div>
                </div>
            </swiper-slide>
            <swiper-slide>
                <img class="mx-auto lg:mr-0 slide-in-bottom" src="{{ url('images/album?w=300&h=300') }}">
                <div class="absolute">
                    <div class="text-3xl font-extrabold text-white">Album Covers</div>
                    <div class="bg-slate-400 text-white p-2 text-center">
                        {{ '/images/album?w=300&h=300' }}</div>
                </div>
            </swiper-slide>
            <swiper-slide>
                <img class="mx-auto lg:mr-0 slide-in-bottom" src="{{ url('images?w=300&h=300') }}">
                <div class="absolute">
                    <div class="text-3xl font-extrabold text-white">Anything Random</div>
                    <div class="bg-slate-400 text-white p-2 text-center">
                        {{ '/images?w=300&h=300' }}</div>
                </div>
            </swiper-slide>
            <swiper-slide>
                <img class="mx-auto lg:mr-0 slide-in-bottom" src="{{ url('images/image/00020?text=true') }}">
                <div class="absolute">
                    <div class="text-3xl font-extrabold text-white">Specific Image</div>
                    <div class="bg-slate-400 text-white p-2 text-center">
                        {{ '/images/image/00020' }}<br /> [You can easily get image id by passing text=true as a
                        parameter]
                    </div>
                </div>
            </swiper-slide>
            <swiper-slide>
                <img class="mx-auto lg:mr-0 slide-in-bottom"
                    src="{{ url('images?w=300&h=300&greyscale=true&random=4' . ['&pixelate=10', ''][rand(0, 1)]) }}">
                <div class="absolute">
                    <div class="text-3xl font-extrabold text-white">Greyscale</div>
                    <div class="bg-slate-400 text-white p-2 text-center">
                        {{ '/images?w=300&h=300&greyscale=true' }}</div>
                </div>
            </swiper-slide>
            <swiper-slide>
                <img class="mx-auto lg:mr-0 slide-in-bottom" src="{{ url('images?w=300&h=300&pixelate=10') }}">
                <div class="absolute">
                    <div class="text-3xl font-extrabold text-white">Pixelate</div>
                    <div class="bg-slate-400 text-white p-2 text-center">
                        {{ '/images?w=300&h=300&pixelate=5' }}</div>
                </div>
            </swiper-slide>
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
