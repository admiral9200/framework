<?php

namespace Shopper\Framework\Sidebar\Presentation;

use Illuminate\Contracts\View\Factory;
use Maatwebsite\Sidebar\Append;

class ShopperAppendRenderer
{
    /**
     * @var Factory
     */
    protected $factory;

    /**
     * @var string
     */
    protected $view = 'shopper::sidebar.append';

    public function __construct(Factory $factory)
    {
        $this->factory = $factory;
    }

    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function render(Append $append)
    {
        if ($append->isAuthorized()) {
            return $this->factory->make($this->view, [
                'append' => $append,
            ])->render();
        }
    }
}
