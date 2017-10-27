<?php

namespace Overblog\GraphiQLBundle\Config;

final class GraphiQLViewConfig
{
    /** @var GraphiQLViewJavascriptLibraries */
    private $javascriptLibraries;

    /** @var string */
    private $template;

    public function __construct(GraphiQLViewJavascriptLibraries $javascriptLibraries, $template)
    {
        $this->javascriptLibraries = $javascriptLibraries;
        $this->template = $template;
    }

    /**
     * @return GraphiQLViewJavascriptLibraries
     */
    public function getJavascriptLibraries()
    {
        return $this->javascriptLibraries;
    }

    /**
     * @return string
     */
    public function getTemplate()
    {
        return $this->template;
    }
}
