@props(['categories', 'active' => null])

<div class="overflow-x-auto scroll-x-padding  pb-2 sm:overflow-visible sm:pb-0">
    <ul class="flex flex-nowrap sm:flex-wrap justify-center gap-2 sm:pl-0 sm:px-0 px-4 w-max sm:w-full mx-auto">
        @foreach ($categories as $category)
            <li class="flex-shrink-0"> 
                <a href="{{route('post.byCategory',$category->slug)}}"
                    class="inline-block px-4 py-1.5 sm:py-2 rounded-full border transition-all duration-200 text-sm sm:text-base
                    {{ $active === $category->slug
                        ? 'text-white bg-primary border-primary shadow-sm font-medium'
                        : 'text-primary bg-primary/10 hover:bg-primary/20 border-primary/20 hover:border-primary/30' }}
                    whitespace-nowrap"> 
                    {{ $category->name }}
                </a>
            </li>
        @endforeach
    </ul>
</div>