<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-[#C3E617] border border-transparent rounded-md font-semibold text-xs text-black uppercase tracking-widest hover:bg-[#d4f73a] focus:bg-[#d4f73a] active:bg-[#a8c916] focus:outline-none focus:ring-2 focus:ring-[#C3E617] focus:ring-offset-2 disabled:opacity-50 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
