<?php
namespace Mindofmicah\Presenter;

use Mindofmicah\Presenter\Exceptions\PresenterException;

trait PresentableTrait
{
    protected $presenter_instance;

    public function present()
    {
        if (!$this->presenter or !class_exists($this->presenter)) {
            throw new PresenterException('Please set the property');
        }

        if(!isset($this->presenter_instance)) {
            $this->presenter_instance = new $this->presenter($this);
        }

        return $this->presenter_instance;
    }
}

