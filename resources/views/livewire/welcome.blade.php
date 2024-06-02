<div class="text-secondary dark:text-white">
    <section class="bg-white dark:bg-secondary my-8">
        <div class="container mx-auto">
            <h2 class="text-4xl font-bold text-center mx-auto md:w-2/3 mb-6">
                Ultimate online destination for all your urgent supply and essential needs!
            </h2>
            <div class="flex flex-col md:flex-row justify-around items-center">
                <div>
                    <img src="@viteimage('computer.svg')" alt="Computer Image">
                </div>
                <div
                    class="flex flex-col md:w-1/3 h-100 bg-secondary dark:bg-primary text-white dark:text-secondary border py-5 lg:py-10 px-5 rounded">
                    <p class="text-justify text-2xl">A platform that is meticulously designed to cater those moments when
                        time is of the essence, ensuring you get what you need when you need it. All within a single
                        day.</p>
                    <x-base::button class="mt-4 w-full bg-secondary border-primary-100 text-white uppercase text-xl">
                        Get Started
                    </x-base::button>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-secondary dark:bg-primary-100 text-white dark:text-secondary py-4">
        <div class="container mx-auto text-center">
            <div class="flex justify-around md:flex-row flex-col">
                <div>
                    <img src="@viteimage('door-delivery.svg')" alt="Door to Door Delivery Image">
                    <div>
                        <h3 class="text-tertiary text-2xl">
                            Swift Delivery
                        </h3>
                        <p>
                            Guaranteed one-day
                            delivery.
                        </p>
                    </div>
                </div>
                <div>
                    <img src="@viteimage('ecomweb.svg')" alt="User Friendly Interface Image">
                    <div>
                        <h3 class="text-tertiary text-2xl">
                            User-Friendly Interface
                        </h3>
                        <p>
                            Designed for a seamless
                            shopping experience
                        </p>
                    </div>
                </div>
            </div>
            <div class="flex justify-center">
                <div>
                    <img src="@viteimage('ecomweb2.svg')" class="w-100" alt="Wide Range of Products Image">
                    <div>
                        <h3 class="text-tertiary text-2xl">Wide Range of Products</h3>
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
    <section class="dark:bg-secondary bg-primary-100 dark:text-white text-secondary py-4 my-5">
        <div class="container mx-auto text-center">
            <h1 class="text-3xl text-center mb-4">How it Works</h1>
            <div class="flex justify-evenly flex-col md:flex-row">

                @foreach ($sections as $section)
                    <div class="flex flex-col justify-between items-center">
                        <h3 class="text-3xl text-tertiary mb-3">{{ $section['title'] }}</h3>
                        <img src="@viteimage({{ $section['image'] }})" alt="" class="w-2/5 md:w-10/12 mb-3">
                        <p class="text-lg font-semibold w-64 mb-3">{{ $section['text'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <section class="dark:bg-secondary bg-primary-100 dark:text-white text-secondary py-4">
        <div class="container mx-auto text-center">
            <div class="flex justify-evenly flex-col md:flex-row items-center">
                <div class="md:w-1/2 sm:w-full">
                    <h1 class="font-bold text-4xl mb-5">Contact Us!</h1>
                    <div class="mx-10">
                        <input id="subject" name="subject" type="text" autocomplete="email" required
                            placeholder="Title" @class([
                                'block w-full rounded-md border-0 py-3 shadow-sm ring-1 ring-inset placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-tertiary sm:text-sm sm:leading-6',
                                'ring-gray-300' => !$errors->has('email'),
                                'ring-red-800 ring-2' => $errors->has(' mail'),
                            ])>
                        <textarea name="content" id="" cols="30" rows="10" placeholder="Content"
                            @class([
                                'block w-full mt-3 rounded-md border-0 py-3 shadow-sm ring-1 ring-inset placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-tertiary sm:text-sm sm:leading-6',
                                'ring-gray-300' => !$errors->has('email'),
                                'ring-red-800 ring-2' => $errors->has('email'),
                            ])></textarea>
                        <x-base::button
                            class="mt-4 w-full bg-secondary border-primary-100 text-white uppercase text-xl">
                            Submit
                        </x-base::button>
                    </div>
                </div>
                <picture>
                    <source srcset="@viteimage('horn-dark.svg')" media="(prefers-color-scheme: dark)">
                    <source srcset="@viteimage('horn.svg')" media="(prefers-color-scheme: light)">
                    <img src="@viteimage('horn.svg')" alt="Horn">
                </picture>
            </div>
        </div>
    </section>
    <section class="bg-tertiary-500 text-black dark:text-white py-4">
        <div class="container mx-auto text-center">
            <div class="flex justify-evenly mx-10 md:flex-row flex-col items-center">
                <div class="flex justify-center m-3">
                    <img src="@viteimage('questions.svg')" alt="" class="w-1/2 md:w-full" srcset="">
                </div>
                <div id="accordion-collapse" class="w-full md:w-1/3  mx-3" data-accordion="collapse">
                    <h2 id="accordion-collapse-heading-1">
                        <button type="button"
                            class="flex items-center border-2 dark:border-white border-secondary justify-between w-full p-5 font-medium rtl:text-right rounded-t-lg gap-3"
                            data-accordion-target="#accordion-collapse-body-1" aria-expanded="true"
                            aria-controls="accordion-collapse-body-1">
                            <span class="uppercase text-black dark:text-white">IS EMERGENCY DELIVERY AVAILABLE?</span>
                            <svg data-accordion-icon class="w-3 h-3 dark:text-white text-black" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M9 5 5 1 1 5" />
                            </svg>
                        </button>
                    </h2>
                    <div id="accordion-collapse-body-1" class="hidden" aria-labelledby="accordion-collapse-heading-1">
                        <div
                            class="p-5 dark:bg-secondary bg-white border-2 dark:border-white border-secondary border-t-0 ">
                            <p>
                                Emergency delivery service is offered for unexpected situations to give you the supplies
                                you need as soon as possible.
                            </p>
                        </div>
                    </div>
                    <h2 id="accordion-collapse-heading-2">
                        <button type="button"
                            class="flex items-center border-2 dark:border-primary-50 border-secondary justify-between border-t-0 w-full p-5 font-medium rtl:text-right gap-3"
                            data-accordion-target="#accordion-collapse-body-2" aria-expanded="false"
                            aria-controls="accordion-collapse-body-2">
                            <span class="uppercase text-black dark:text-white">Is there a Figma file available?</span>
                            <svg data-accordion-icon class="w-3 h-3 dark:text-white text-black rotate-180 shrink-0"
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M9 5 5 1 1 5" />
                            </svg>
                        </button>
                    </h2>
                    <div id="accordion-collapse-body-2" class="hidden"
                        aria-labelledby="accordion-collapse-heading-2">
                        <div
                            class="p-5 dark:bg-secondary bg-white border-2 dark:border-white border-secondary border-t-0 ">
                            <p>
                                Save time and effort by setting up subscription-based services for your regular needs.
                                Your chosen items will be delivered at your preferred frequency, ensuring you never run
                                out of essentials.
                            </p>
                        </div>
                    </div>
                    <h2 id="accordion-collapse-heading-3">
                        <button type="button"
                            class="flex items-center border-2 dark:border-primary-50 border-secondary justify-between border-t-0 rounded-b-lg w-full p-5 font-medium rtl:text-right gap-3"
                            data-accordion-target="#accordion-collapse-body-3" aria-expanded="false"
                            aria-controls="accordion-collapse-body-3">
                            <span class="uppercase text-black dark:text-white">What are the differences between
                                Flowbite and Tailwind UI?</span>
                            <svg data-accordion-icon class="w-3 h-3 dark:text-white text-black rotate-180 shrink-0"
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M9 5 5 1 1 5" />
                            </svg>
                        </button>
                    </h2>
                    <div id="accordion-collapse-body-3" class="hidden"
                        aria-labelledby="accordion-collapse-heading-3">
                        <div
                            class="p-5 dark:bg-secondary bg-white border-2 dark:border-white border-secondary -mt-1 rounded-b-lg">
                            <p>
                                Our dedicated customer support team is available around the clock to assist you with any
                                queries or issues you may have.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
