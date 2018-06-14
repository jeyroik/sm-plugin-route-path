<?php
namespace tratabor\components\systems\states\plugins;

use tratabor\components\systems\Plugin;
use tratabor\interfaces\systems\states\IStatesRoute;
use tratabor\interfaces\systems\states\plugins\IPluginRouteTo;

/**
 * Class PluginRouteToPath
 *
 * @package tratabor\components\systems\states\plugins
 * @author Funcraft <me@funcraft.ru>
 */
class PluginRouteToPath extends Plugin implements IPluginRouteTo
{
    const ROUTE__PATH = '@directive.stateRoute().__path()';

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
