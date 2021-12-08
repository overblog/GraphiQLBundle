<?php

namespace Overblog\GraphiQLBundle\Config;

final class GraphiQLViewJavaScriptLibraries
{
    /** @var string */
    private $graphiQLVersion;

    /** @var string */
    private $reactVersion;

    /** @var string */
    private $fetchVersion;

    public function __construct(
        $graphiQLVersion,
        $reactVersion,
        $fetchVersion
    ) {
        $this->graphiQLVersion = $graphiQLVersion;
        $this->reactVersion = $reactVersion;
        $this->fetchVersion = $fetchVersion;
    }

    /**
     * @return string
     */
    public function getGraphiQLVersion()
    {
        return $this->graphiQLVersion;
    }

    /**
     * @return string
     */
    public function getReactVersion()
    {
        return $this->reactVersion;
    }

    /**
     * @return string
     */
    public function getFetchVersion()
    {
        return $this->fetchVersion;
    }
}
