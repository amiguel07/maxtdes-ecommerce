<x-app-layout>
    <div class="container py-8">
        <div class="carousel-container">
            @foreach($carousels as $carousel)
                <div class="carousel-slide active" id="slide">
                    <img class="carousel-image" src="{{ asset('storage/carousel/'.$carousel->image) }}" alt="{{ $carousel->name }}">
                    <div class="carousel-text">
                        <span class="title">{{ $carousel->name }}</span> <br>
                        <span class="desc">{{ $carousel->desc }}</span>
                    </div>
                </div>
            @endforeach
            <button class="carousel-button" id="prevBtn" onClick="prevSlide()">
                <i class="fas fa-angle-left"></i>
            </button>
            <button class="carousel-button" id="nextBtn" onClick="nextSlide()">
                <i class="fas fa-angle-right"></i>
            </button>
        </div>
    </div>
    

    <style>
        div.carousel-container {
            position: relative;
            /* max-width: 600px; */
            height: 260px;
            margin: auto;
            overflow: hidden;
            border-radius: 10px
        }
        .carousel-slide {
            display: none;
            position: absolute;
            height: 100%;
            width: 100%;
        }
        .carousel-slide::before {
            content: '';
            position: absolute;
            width: 100%;
            height: 50%;
            bottom: 0;
            left: 0;
            background: linear-gradient(to top, rgba(0, 0, 0, 1), transparent);
        }
        img.carousel-image {
            height: 100%;
            width: 100%;
            object-fit: cover
        }
        div.carousel-text {
            position: absolute;
            bottom: 10px;
            left: 50%;
            transform: translateX(-50%);
            color: white;
            text-align: center;
        }
        span.title {
            font-weight: bold;
        }
        span.desc {
            color: var(--labelSecondaryDark)
        }
        button.carousel-button {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            font-size: 24px;
            cursor: pointer;
            background: var(--fillPrimary);
            height: 36px;
            width: 36px;
            border-radius: 18px;
            backdrop-filter: saturate(180%) blur(20px);
            color: rgba(255, 255, 255, .75)
        }
        button.carousel-button:hover {
            background: var(--tint);
            color: white;
        }
        #prevBtn {
            left: 10px
        }
        #nextBtn {
            right: 10px
        }
    </style>

    <script>
        let currentSlide = 1;
        let interval;

        function showSlide(n) {
            const slides = document.getElementsByClassName("carousel-slide");

            if (n > slides.length) {
                currentSlide = 1
            }

            if (n < 1) {
                currentSlide = slides.length;
            }

            for (let i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }

            slides[currentSlide - 1].style.display = "block";
        }

        function nextSlide() {
            stopAutoSlide();
            showSlide(currentSlide += 1);
            startAutoSlide();
        }

        function prevSlide() {
            stopAutoSlide();
            showSlide(currentSlide -= 1);
            startAutoSlide();
        }

        function startAutoSlide() {
            interval = setInterval(function() {
                nextSlide();
            }, 8000)
        }

        function stopAutoSlide() {
            clearInterval(interval)
        }

        showSlide(currentSlide);
        startAutoSlide();
    </script>

    <div class="container py-8">
        @forelse($categories as $category)
            <section class="mb-6 px-6">
                <div class="flex items-center mb-2">
                    <h1 class="text-lg uppercase font-semibold text-gray-700">
                        {{$category->name}}
                    </h1>
                    <a href="{{route('categories.show',$category)}}" class="text-orange-500 hover:text-orange-400 hover:underline ml-2 font-semibold" style="color: var(--tint)">Ver más</a>
                </div>                

                @livewire('category-product', ['category' => $category])

            </section>   
        @empty
            <section class='mb-6 px-6'>
                <span style="color: var(--labelSecondary)">Sin categorías</span>
            </section>
        @endforelse
        
    </div>
    
    @push('script')
        <script>
            Livewire.on('glider',function(id){

            new Glider(document.querySelector('.glider-'+id), {
            slidesToScroll: 1,
            slidesToShow: 1,
            draggable: true,
            dots: '.glider-'+id+'~ .dots',
            arrows: {
                prev: '.glider-'+id+'~ .glider-prev',
                next: '.glider-'+id+'~ .glider-next'
            },
            responsive:[
                {
                    breakpoint:640,
                    settings:{
                        slidesToScroll: 2,
                        slidesToShow: 2.5,
                    }
                },
                {
                    breakpoint:768,
                    settings:{
                        slidesToScroll: 3,
                        slidesToShow: 3.5,
                    }
                },
                {
                    breakpoint:1024,
                    settings:{
                        slidesToScroll: 4,
                        slidesToShow: 4.5,
                    }
                },
                {
                    breakpoint:1280,
                    settings:{
                        slidesToScroll: 5,
                        slidesToShow: 5.5,
                    }
                }
            ]
            });

            });
        </script>
    @endpush

</x-app-layout>