<button {{ $attributes->merge(['type' => 'button', 'class' => 'btn btn-outline-secondary text']) }}>
    {{ $slot }}
</button>
