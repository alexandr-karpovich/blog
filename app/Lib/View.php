<?php

namespace Lib;


class View
{
    const BASE_LAYOUT = BASE_DIR . '/app/View/layout.php';

    protected $template;
    protected $fields = [];

    /**
     * @param $template - template path in view folder
     * @param array $fields
     */
    public function __construct($template, array $fields = [])
    {
        $this->setTemplate($template);

        foreach ($fields as $name => $value)
        {
            $this->setParameter($name, $value);
        }
    }

    /**
     * @param $template
     * @param array $params
     * @return bool
     */
    public static function renderTemplate($template, array $params = [])
    {
        $view = new View($template, $params);

        return $view->render();
    }

    /**
     * @param $template
     * @return $this
     */
    public function setTemplate($template)
    {
        $template = BASE_DIR . '/app/View/' . $template . ".php";

        if ( !is_readable($template) || !is_file($template) )
            throw new \InvalidArgumentException("The template '$template' is invalid.");

        $this->template = $template;

        return $this;
    }

    /**
     * @param $name
     * @param $value
     * @return $this
     */
    public function setParameter($name, $value)
    {
        if( $name === 'template' && $name === 'fields' )
            throw new \InvalidArgumentException("Field name '".$name."'. is not allowed");

        $this->fields[$name] = $value;

        return $this;
    }

    /**
     * @param $name
     * @return mixed
     */
    public function getParameter($name)
    {
        if( !isset($this->fields[$name]) )
            throw new \InvalidArgumentException("Parameter does not exist '".$name."'");

        return $this->fields[$name];
    }

    /**
     * @param $name
     * @return $this
     */
    public function removeParameter($name)
    {
        if ( !isset($this->fields[$name]) )
            throw new \InvalidArgumentException("Parameter does not exist '".$name."'");

        unset($this->fields[$name]);

        return $this;
    }

    /**
     * @param $name
     * @return bool
     */
    public function issetParameter($name)
    {
        return isset($this->fields[$name]);
    }

    /**
     * Render template
     *
     * @return bool
     */
    public function render()
    {
        extract($this->fields);
        ob_start();
        require $this->template;
        $content = ob_get_contents();
        ob_end_clean();

        include self::BASE_LAYOUT;

        return true;
    }


}