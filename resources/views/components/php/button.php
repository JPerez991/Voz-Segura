<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Button extends Component
{
    public $variant;

    /**
     * Crear una nueva instancia del componente.
     *
     * @param string $variant
     */
    public function __construct($variant = 'primary')
    {
        $this->variant = $variant;
    }

    /**
     * Renderizar la vista o el contenido del componente.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.button');
    }
}
