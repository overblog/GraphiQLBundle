<?php

namespace Overblog\GraphiQLBundle\Config;

interface GraphiQLControllerEndpoint
{
    /**
     * Return a uri by it's schema name.
     *
     * @param string $name
     *
     * @return string
     */
    public function getBySchema($name);

    /**
     * Return the default uri.
     *
     * @return string
     */
    public function getDefault();
}
