
<!-- : Botón estilizado para usar en diversas partes de la página. -->
 
<button {{ $attributes->merge(['class' => 'px-4 py-2 rounded']) }}>
    {{ $slot }}
</button>
