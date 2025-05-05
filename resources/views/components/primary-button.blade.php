<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center px-6 py-3 w-full text-lg font-medium text-white bg-primary rounded-full hover:bg-[#156612] focus:bg-[#135f10] active:bg-[#11540f] transition-colors duration-200 focus:outline-none focus:ring-4 focus:ring-primary/20 disabled:opacity-50 disabled:cursor-not-allowed']) }}>
{{ $slot }}
</button>