<x-landing-layout>
    <x-slot name="title">
        Блог
    </x-slot>

    <section class="bg-white dark:bg-custom-background-dark py-8 lg:py-16">
        <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6">
            <div class="mx-auto max-w-screen-sm text-center lg:mb-16 mb-8">
                <h2 class="mb-4 text-3xl lg:text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">Наш Блог</h2>
                <p class="font-light text-gray-500 sm:text-xl dark:text-gray-400">Здесь мы делимся новостями платформы, полезными гайдами и статьями об онлайн-образовании.</p>
            </div>
            <div class="grid gap-8 lg:grid-cols-2">

                @forelse ($posts as $post)
                    <article class="p-6 bg-white dark:bg-custom-container-dark rounded-lg border border-gray-200 dark:border-custom-border-dark shadow-md">
                        <div class="flex justify-between items-center mb-5 text-gray-500 dark:text-gray-400">
                            {{-- Теги категорий, если они будут у постов в будущем --}}
                            {{-- <span class="bg-primary-100 text-primary-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded dark:bg-primary-200 dark:text-primary-800">
                                <svg class="mr-1 w-3 h-3" fill="currentColor" viewBox="0 0 20 20">...</svg>
                                Tutorial
                            </span> --}}
                            <span class="text-sm">{{ $post->published_at->diffForHumans() }}</span>
                        </div>
                        <h2 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white"><a href="{{ route('blog.show', $post) }}">{{ $post->title }}</a></h2>
                        <p class="mb-5 font-light text-gray-500 dark:text-gray-400">{{ $post->excerpt }}</p>
                        <div class="flex justify-between items-center">
                            <div class="flex items-center space-x-4">
                                {{-- Аватар автора (пока заглушка) --}}
                                <img class="w-7 h-7 rounded-full" src="https://placehold.co/28x28/141414/FFFFFF?text=A" alt="{{ $post->user->name }} avatar" />
                                <span class="font-medium dark:text-white">
                                  {{ $post->user->name }}
                              </span>
                            </div>
                            <a href="{{ route('blog.show', $post) }}" class="inline-flex items-center font-medium text-custom-accent hover:underline">
                                Читать далее
                                <svg class="ml-2 w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                            </a>
                        </div>
                    </article>
                @empty
                    <p class="col-span-full text-center text-gray-500 dark:text-gray-400">Постов в блоге пока нет.</p>
                @endforelse

            </div>
        </div>
    </section>
    </x-app-layout>
