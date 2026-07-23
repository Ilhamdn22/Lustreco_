<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex justify-center items-center px-6 py-3 bg-black border border-transparent rounded-xl font-medium text-[14px] text-white hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-black focus:ring-offset-2 transition ease-in-out shadow-sm']) }}>
    {{ $slot }}
</button>
