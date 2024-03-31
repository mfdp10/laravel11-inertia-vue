<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
</script>

<template>
    <div>
        <div
            class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
            <ApplicationLogo class="block h-20 w-auto" />

            <h1 class="mt-8 text-2xl font-medium text-gray-900 dark:text-white">
                Welcome to your Tasks application!
            </h1>
            <!-- {{ $page.props }} -->
            <p class="mt-6 text-gray-500 dark:text-gray-400 leading-relaxed">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Soluta porro saepe, sunt eligendi iure
                reiciendis odio maiores, labore repellendus neque facere distinctio, at officiis cumque quia accusamus
                excepturi asperiores necessitatibus.
            </p>
        </div>

        <div
            class="bg-gray-200 dark:bg-gray-800 bg-opacity-25 grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8 p-6 lg:p-8">
            <div>
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        class="w-6 h-6 stroke-gray-400">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                    </svg>
                    <h2 class="ms-3 text-xl font-semibold text-gray-900 dark:text-white">
                        <a href="https://laravel.com/docs">Documentation</a>
                    </h2>
                </div>

                <ul class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
                    <li>Lorem ipsum dolor sit amet.</li>
                    <li>Suscipit distinctio enim blanditiis alias.</li>
                    <li>Molestiae dolorum aperiam quibusdam iure.</li>
                    <li>Dolores id voluptatibus alias praesentium!</li>
                    <li>Aut neque nulla inventore sapiente!</li>
                </ul>

                <p class="mt-4 text-sm">
                    <a href="#" class="inline-flex items-center font-semibold text-indigo-700 dark:text-indigo-300">
                        Explore the documentation

                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                            class="ms-1 w-5 h-5 fill-indigo-500 dark:fill-indigo-200">
                            <path fill-rule="evenodd"
                                d="M5 10a.75.75 0 01.75-.75h6.638L10.23 7.29a.75.75 0 111.04-1.08l3.5 3.25a.75.75 0 010 1.08l-3.5 3.25a.75.75 0 11-1.04-1.08l2.158-1.96H5.75A.75.75 0 015 10z"
                                clip-rule="evenodd" />
                        </svg>
                    </a>
                </p>
            </div>

            <div>
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        class="w-6 h-6 stroke-gray-400">
                        <path stroke-linecap="round"
                            d="M10 3v4a1 1 0 0 1-1 1H5m4 10v-2m3 2v-6m3 6v-3m4-11v16a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V7.914a1 1 0 0 1 .293-.707l3.914-3.914A1 1 0 0 1 9.914 3H18a1 1 0 0 1 1 1Z" />
                    </svg>
                    <h2 class="ms-3 text-xl font-semibold text-gray-900 dark:text-white">
                        <a href="https://laracasts.com">Stats</a>
                    </h2>
                </div>

                <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Porro fuga veritatis iure quaerat sunt
                    quidem, cum odio nostrum blanditiis optio similique odit fugit expedita! Quae, ipsum! Iure cumque
                    corrupti soluta?
                </p>

                <p class="mt-4 text-sm">
                    <a href="https://laracasts.com"
                        class="inline-flex items-center font-semibold text-indigo-700 dark:text-indigo-300">
                        Start watching Stats

                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                            class="ms-1 w-5 h-5 fill-indigo-500 dark:fill-indigo-200">
                            <path fill-rule="evenodd"
                                d="M5 10a.75.75 0 01.75-.75h6.638L10.23 7.29a.75.75 0 111.04-1.08l3.5 3.25a.75.75 0 010 1.08l-3.5 3.25a.75.75 0 11-1.04-1.08l2.158-1.96H5.75A.75.75 0 015 10z"
                                clip-rule="evenodd" />
                        </svg>
                    </a>
                </p>
            </div>

            <div>
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        class="w-6 h-6 stroke-gray-400">
                        <path fill-rule="evenodd"
                            d="M12 6a3.5 3.5 0 1 0 0 7 3.5 3.5 0 0 0 0-7Zm-1.5 8a4 4 0 0 0-4 4 2 2 0 0 0 2 2h7a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-3Zm6.82-3.096a5.51 5.51 0 0 0-2.797-6.293 3.5 3.5 0 1 1 2.796 6.292ZM19.5 18h.5a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-1.1a5.503 5.503 0 0 1-.471.762A5.998 5.998 0 0 1 19.5 18ZM4 7.5a3.5 3.5 0 0 1 5.477-2.889 5.5 5.5 0 0 0-2.796 6.293A3.501 3.501 0 0 1 4 7.5ZM7.1 12H6a4 4 0 0 0-4 4 2 2 0 0 0 2 2h.5a5.998 5.998 0 0 1 3.071-5.238A5.505 5.505 0 0 1 7.1 12Z"
                            clip-rule="evenodd" />
                    </svg>
                    <h2 class="ms-3 text-xl font-semibold text-gray-900 dark:text-white">
                        <a href="https://tailwindcss.com/">Customers</a>
                    </h2>
                </div>

                <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
                    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Alias molestiae mollitia repellat unde
                    nobis architecto vitae optio provident obcaecati, perspiciatis dolore, magni nulla nam praesentium
                    tempore! Laudantium voluptatem qui neque ducimus aliquam explicabo consequuntur obcaecati laborum
                    voluptas. Voluptates consequatur odit, unde repudiandae eius placeat rem.
                </p>
            </div>

            <div>
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        class="w-6 h-6 stroke-gray-400">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 21v-9m3-4H7.5a2.5 2.5 0 1 1 0-5c1.5 0 2.875 1.25 3.875 2.5M14 21v-9m-9 0h14v8a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1v-8ZM4 8h16a1 1 0 0 1 1 1v3H3V9a1 1 0 0 1 1-1Zm12.155-5c-3 0-5.5 5-5.5 5h5.5a2.5 2.5 0 0 0 0-5Z" />
                    </svg>
                    <h2 class="ms-3 text-xl font-semibold text-gray-900 dark:text-white">
                        Products
                    </h2>
                </div>

                <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Tenetur, deleniti autem. Possimus et magni
                    reprehenderit autem assumenda ex, iure tenetur, animi repellendus accusantium voluptatem odio rem
                    commodi suscipit, natus eos. Vero id impedit laboriosam quia velit dicta sapiente.
                </p>
            </div>
        </div>
    </div>
</template>
