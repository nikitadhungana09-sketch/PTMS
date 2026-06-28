@props(['disabled' => false])

<input
    @disabled($disabled)

    {{ $attributes->merge([
        'class' => '
            w-full
            rounded-lg
            border
            border-gray-300
            bg-white
            text-gray-900
            px-4
            py-3
            shadow-sm
            focus:border-blue-500
            focus:ring-2
            focus:ring-blue-200
            transition
        '
    ]) }}
>