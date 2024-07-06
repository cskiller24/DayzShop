<div class="page bg-dark text-light" data-bs-theme="dark">
    <!-- Navbar -->
    <x-customer.navbar/>
    <div class="page-wrapper">
        <!-- Page body -->
        <div class="page-body">
            <section class="bg-dark-subtle">
                <div class="container mx-auto">
                    <h1 class="text-center display-2">
                        Ultimate online destination for all your urgent supply and essential needs!
                    </h1>
                    <div class="d-flex flex-column flex-md-row justify-content-around align-items-center">
                        <div>
                            <img src="{{ Vite::image('computer.svg') }}" alt="Computer Image">
                        </div>
                        <div
                            class="d-flex flex-column md:w-1/3 sm:w-full h-full bg-dark text-white border py-5 py-lg-7 px-5 rounded">
                            <p class="text-justify h2">A platform that is meticulously designed to cater those
                                moments
                                when
                                time is of the essence, ensuring you get what you need when you need it. All
                                within a single
                                day.</p>
                            <x-base::button
                                class="mt-4 w-full bg-secondary border-primary-100 text-white uppercase text-xl">
                                Get Started
                            </x-base::button>
                        </div>
                    </div>
                </div>
            </section>

            <section class="bg-dark">
                <div class="container mx-auto text-center">
                    <div class="d-flex justify-content-around flex-md-row flex-column">
                        <div>
                            <img src="{{ Vite::image('door-delivery.svg') }}" alt="Door to Door Delivery Image">
                            <div>
                                <h2>
                                    Swift Delivery
                                </h2>
                                <p>
                                    Guaranteed one-day
                                    delivery.
                                </p>
                            </div>
                        </div>
                        <div>
                            <img src="{{ Vite::image('ecomweb.svg') }}" alt="User Friendly Interface Image">
                            <div>
                                <h2>
                                    User-Friendly Interface
                                </h2>
                                <p>
                                    Designed for a seamless
                                    shopping experience
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center">
                        <div>
                            <img src="{{ Vite::image('ecomweb2.svg') }}" class="w-full"
                                 alt="Wide Range of Products Image">
                            <div>
                                <h2>Wide Range of Products</h2>
                                <p>Diverse selection to meet your requirements</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            @php
                $sections = [
                    [
                        'title' => 'Browse and Select',
                        'text' => 'Explore our extensive product range and add items to your cart.',
                        'image' => 'productexplore.svg',
                    ],
                    [
                        'title' => 'Checkout',
                        'text' => 'Proceed to checkout and provide your delivery details.',
                        'image' => 'shoppingbag.svg',
                    ],
                    [
                        'title' => 'Fast Delivery',
                        'text' => 'Sit back and relax as we ensure your order reaches you within a day.',
                        'image' => 'deliveryman.svg',
                    ],
                ];
            @endphp
            <section class="bg-dark-subtle py-4 my-5">
                <div class="container mx-auto text-center">
                    <h1 class="text-center mb-4">How it Works</h1>
                    <div class="d-flex justify-content-evenly flex-column flex-md-row">
                        @foreach ($sections as $section)
                            <div class="d-flex flex-column justify-content-between align-items-center">
                                <h3 class="text-orange">{{ $section['title'] }}</h3>
                                <img src="{{ Vite::image($section['image']) }}" alt=""
                                     class="w-75">
                                <h3 class="fw-bold mb-3">{{ $section['text'] }}</h3>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
            <section class="py-4">
                <div class="container mx-auto text-center">
                    <div class="d-flex justify-content-evenly flex-column flex-md-row align-items-center">
                        <div class="md:w-1/2 sm:w-full">
                            <h1 class="font-bold text-4xl mb-5">Contact Us!</h1>
                            <div class="mx-10">
                                <input class="form-control mb-2" type="email" placeholder="Enter your Email">
                                <textarea class="form-control mb-2" placeholder="Type your content / message"
                                          rows="10"></textarea>
                                <x-base.button class="w-full border border-light-subtle">
                                    Submit
                                </x-base.button>
                            </div>
                        </div>
                        <picture>
                            <source srcset="{{ Vite::image('horn-dark.svg') }}"
                                    media="(prefers-color-scheme: dark)">
                            <source srcset="{{ Vite::image('horn.svg') }}"
                                    media="(prefers-color-scheme: light)">
                            <img src="{{ Vite::image('horn.svg') }}" alt="Horn">
                        </picture>
                    </div>
                </div>
            </section>
            <section class="bg-dark-subtle py-3">
                <div class="container mx-auto text-center">
                    <div class="d-flex justify-content-evenly mx-10 flex-md-row flex-column align-items-center">
                        <div class="d-flex justify-content-center m-3">
                            <img src="{{ Vite::image('questions.svg') }}" alt="" class="md:w-full sm:w-1/2"
                                 srcset="">
                        </div>
                        <div class="accordion md:w-1/2 sm:w-full" id="accordionExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseOne" aria-expanded="true"
                                            aria-controls="collapseOne">
                                        IS EMERGENCY DELIVERY AVAILABLE?
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse show"
                                     data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        Emergency delivery service is offered for unexpected situations to give you the
                                        supplies you need as soon as possible.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseTwo" aria-expanded="false"
                                            aria-controls="collapseTwo">
                                        Accordion Item #2
                                    </button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse"
                                     data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        Save time and effort by setting up subscription-based services for your regular
                                        needs.
                                        Your chosen items will be delivered at your preferred frequency, ensuring you
                                        never run out of essentials.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseThree" aria-expanded="false"
                                            aria-controls="collapseThree">
                                        Accordion Item #3
                                    </button>
                                </h2>
                                <div id="collapseThree" class="accordion-collapse collapse"
                                     data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        Our dedicated customer support team is available around the clock to
                                        assist you with
                                        any
                                        queries or issues you may have.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <footer class="footer footer-transparent d-print-none">
            <div class="container-xl">
                <x-base.default-footer/>
            </div>
        </footer>
    </div>
</div>



