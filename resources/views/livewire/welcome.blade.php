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
    <section class="dark:bg-secondary bg-primary-100 dark:text-white text-secondary py-4">
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
            <div class="flex justify-evenly">
                <div>

                    <div id="accordion-flush" data-accordion="collapse"
                        data-active-classes="bg-white dark:bg-gray-900 text-gray-900 dark:text-white"
                        data-inactive-classes="text-gray-500 dark:text-gray-400">
                        <h2 id="accordion-flush-heading-1">
                            <button type="button"
                                class="flex items-center justify-between w-full py-5 font-medium rtl:text-right text-gray-500 border-b border-gray-200 dark:border-gray-700 dark:text-gray-400 gap-3"
                                data-accordion-target="#accordion-flush-body-1" aria-expanded="true"
                                aria-controls="accordion-flush-body-1">
                                <span>What is Flowbite?</span>
                                <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M9 5 5 1 1 5" />
                                </svg>
                            </button>
                        </h2>
                        <div id="accordion-flush-body-1" class="hidden" aria-labelledby="accordion-flush-heading-1">
                            <div class="py-5 border-b border-gray-200 dark:border-gray-700">
                                <p class="mb-2 text-gray-500 dark:text-gray-400">Flowbite is an open-source library of
                                    interactive components built on top of Tailwind CSS including buttons, dropdowns,
                                    modals, navbars, and more.</p>
                                <p class="text-gray-500 dark:text-gray-400">Check out this guide to learn how to <a
                                        href="/docs/getting-started/introduction/"
                                        class="text-blue-600 dark:text-blue-500 hover:underline">get started</a> and
                                    start developing websites even faster with components on top of Tailwind CSS.</p>
                            </div>
                        </div>
                        <h2 id="accordion-flush-heading-2">
                            <button type="button"
                                class="flex items-center justify-between w-full py-5 font-medium rtl:text-right text-gray-500 border-b border-gray-200 dark:border-gray-700 dark:text-gray-400 gap-3"
                                data-accordion-target="#accordion-flush-body-2" aria-expanded="false"
                                aria-controls="accordion-flush-body-2">
                                <span>Is there a Figma file available?</span>
                                <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M9 5 5 1 1 5" />
                                </svg>
                            </button>
                        </h2>
                        <div id="accordion-flush-body-2" class="hidden" aria-labelledby="accordion-flush-heading-2">
                            <div class="py-5 border-b border-gray-200 dark:border-gray-700">
                                <p class="mb-2 text-gray-500 dark:text-gray-400">Flowbite is first conceptualized and
                                    designed using the Figma software so everything you see in the library has a design
                                    equivalent in our Figma file.</p>
                                <p class="text-gray-500 dark:text-gray-400">Check out the <a
                                        href="https://flowbite.com/figma/"
                                        class="text-blue-600 dark:text-blue-500 hover:underline">Figma design system</a>
                                    based on the utility classes from Tailwind CSS and components from Flowbite.</p>
                            </div>
                        </div>
                        <h2 id="accordion-flush-heading-3">
                            <button type="button"
                                class="flex items-center justify-between w-full py-5 font-medium rtl:text-right text-gray-500 border-b border-gray-200 dark:border-gray-700 dark:text-gray-400 gap-3"
                                data-accordion-target="#accordion-flush-body-3" aria-expanded="false"
                                aria-controls="accordion-flush-body-3">
                                <span>What are the differences between Flowbite and Tailwind UI?</span>
                                <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M9 5 5 1 1 5" />
                                </svg>
                            </button>
                        </h2>
                        <div id="accordion-flush-body-3" class="hidden" aria-labelledby="accordion-flush-heading-3">
                            <div class="py-5 border-b border-gray-200 dark:border-gray-700">
                                <p class="mb-2 text-gray-500 dark:text-gray-400">The main difference is that the core
                                    components from Flowbite are open source under the MIT license, whereas Tailwind UI
                                    is a paid product. Another difference is that Flowbite relies on smaller and
                                    standalone components, whereas Tailwind UI offers sections of pages.</p>
                                <p class="mb-2 text-gray-500 dark:text-gray-400">However, we actually recommend using
                                    both Flowbite, Flowbite Pro, and even Tailwind UI as there is no technical reason
                                    stopping you from using the best of two worlds.</p>
                                <p class="mb-2 text-gray-500 dark:text-gray-400">Learn more about these technologies:
                                </p>
                                <ul class="ps-5 text-gray-500 list-disc dark:text-gray-400">
                                    <li><a href="https://flowbite.com/pro/"
                                            class="text-blue-600 dark:text-blue-500 hover:underline">Flowbite Pro</a>
                                    </li>
                                    <li><a href="https://tailwindui.com/" rel="nofollow"
                                            class="text-blue-600 dark:text-blue-500 hover:underline">Tailwind UI</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
                <div>
                    <img src="@viteimage('horn.svg')" alt="Horn">
                </div>
            </div>
        </div>
    </section>
</div>
