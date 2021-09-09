<?php

namespace Sheenazien8\LivewireComponents;

use Illuminate\View\View;
use Sheenazien8\LivewireComponents\Abstracts\ComponentAbstracts;

class Builder
{
    /**
     * key
     *
     * @var mixed
     * @access private
     */
    private $key;

    /**
     * form
     *
     * @var mixed
     * @access private
     */
    private $form;

    /**
     * route
     *
     * @var mixed
     * @access private
     */
    private $route;

    /**
     * value
     *
     * @var mixed
     * @access private
     */
    private $value;

    /**
     * method
     *
     * @var mixed
     * @access private
     */
    private $method;

    /** @var array $config */
    private $config;

    /**
     * make
     *
     * @param string $key
     * @access public
     * @return self
     */
    public function make(string $key): self
    {
        $this->key = $key;

        return $this;
    } // End function make

    /**
     * setRoute
     *
     * @param string $string
     * @param string $method
     * @access public
     * @return self
     */
    public function setRoute(string $string, ?string $method = null): self
    {
        $this->route = $string;
        $this->method = $method;

        return $this;
    } // End function setRoute

    /**
     * render
     *
     * @access public
     * @return void
     */
    public function render()
    {
        $form = $this->getForm();

        return $this->createForm($form);
    } // End function render

    /**
     * register
     *
     * @param array $array
     * @access public
     * @return void
     */
    public function register(array $array): void
    {
        $this->form = $array;
    } // End function register

    /**
     * getForm
     *
     * @access private
     * @return ?ComponentAbstracts
     */
    private function getForm(): ?ComponentAbstracts
    {
        foreach ($this->form as $key => $form) {
            if ($this->key == $key) {
                return new $form;
            }
        }
    }

    /**
     * Setter for DefaultValue
     *
     * @param array $value
     * @return Builder
     */
    public function setDefaultValue(array $value = null)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @param array $config
     * @return $this
     */
    public function setConfig(array $config)
    {
        $this->config = $config;

        return $this;
    }

    /** @return array  */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * Getter for DefaultValue
     *
     * @return mix|array|null
     */
    public function getDefaultValue()
    {
        return $this->value;
    }

    /**
     * createForm
     *
     * @param ComponentAbstracts $form
     * @access private
     * @return View
     */
    private function createForm(ComponentAbstracts $form): View
    {
        $builder = $form
            ->setDefaultValue($this->getDefaultValue())
            ->setConfig($this->getConfig())
            ->setRoute($this->route, $this->method)
            ->setButton($form->buttons())
            ->setValidation($form->validations())
            ->setSchema($form->builder())
            ->build();

        return view('livewirecomponents::form', compact('builder'));
    }
}
