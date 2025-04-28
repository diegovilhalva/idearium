@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary placeholder-gray-400 transition-colors duration-200 disabled:bg-gray-50 disabled:cursor-not-allowed']) }}>