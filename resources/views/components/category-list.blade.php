@props(['categories', 'active' => null])

<ul class="flex flex-wrap gap-3">
    @foreach ($categories as $category)
    <li>
        <a href="#"
           class="inline-block px-4 py-2 rounded-full border transition-colors duration-200
           {{ $active === $category->slug 
               ? 'text-white bg-primary border-primary' 
               : 'text-primary bg-primary/10 hover:bg-primary/20 border-primary/20' }}">
            {{ $category->name }}
        </a>
    </li>
    @endforeach
</ul>
