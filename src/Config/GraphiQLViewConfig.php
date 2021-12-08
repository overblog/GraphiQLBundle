<?php

namespace Overblog\GraphiQLBundle\Config;

final class GraphiQLViewConfig
{
    /** @var GraphiQLViewJavaScriptLibraries */
    private $javaScriptLibraries;

    /** @var string */
    private $template;

    public function __construct(GraphiQLViewJavaScriptLibraries $javaScriptLibraries, $template)
    {
        $this->javaScriptLibraries = $javaScriptLibraries;
        $this->template = $template;
    }

    /**
     * @return GraphiQLViewJavaScriptLibraries
     */
    public function getJavaScriptLibraries()
    {
        return $this->javaScriptLibraries;
    }

    /**
     * @return string
     */
    public function getTemplate()
    {
        return $this->template;
    }
}
