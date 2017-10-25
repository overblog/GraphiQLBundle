<?php

namespace Overblog\GraphiQLBundle\Config;

class GraphiQLViewConfig
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

    public static function createFromArrayConfiguration($config)
    {
        $javaScriptLibraries = new GraphiQLViewJavascriptLibraries(
            $config['javascript_libraries']['graphiql'],
            $config['javascript_libraries']['react'],
            $config['javascript_libraries']['fetch']
        );

        return new self($javaScriptLibraries, $config['template']);
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
