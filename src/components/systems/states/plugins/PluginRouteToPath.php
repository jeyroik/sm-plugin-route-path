<?php
namespace jeyroik\extas\components\systems\states\plugins;

use jeyroik\extas\components\systems\Plugin;
use jeyroik\extas\interfaces\systems\states\extensions\IStatesRoute;
use jeyroik\extas\interfaces\systems\states\plugins\IPluginRouteTo;

/**
 * Class PluginRouteToPath
 *
 * @package jeyroik\extas\components\systems\states\plugins
 * @author Funcraft <me@funcraft.ru>
 */
class PluginRouteToPath extends Plugin implements IPluginRouteTo
{
    const ROUTE__PATH = '@directive.stateRoute().__path()';

    public $preDefinedStage = IStatesRoute::STAGE__TO;

    /**
     * @param IStatesRoute $route
     * @param $toStateId
     *
     * @return string
     */
    public function __invoke(IStatesRoute &$route, $toStateId)
    {
        $routeContent = $route->getRoute();

        if (!isset($routeContent[static::ROUTE__PATH])) {
            $routeContent[static::ROUTE__PATH] = [];
        }

        $routeContent[static::ROUTE__PATH][] = [$route->getCurrentFrom() => $toStateId];

        $route->setRoute($routeContent);

        return $toStateId;
    }
}
