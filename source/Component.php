<?php

namespace iiifx\Yii2\Autocomplete;

use yii\base\Application;
use yii\base\BootstrapInterface;

class Component extends \yii\base\Object implements BootstrapInterface
{
    /**
     * @var string
     */
    public $environment = 'dev';

    /**
     * @var array
     */
    public $controllerMap = [
        'ide-components' => \iiifx\Yii2\Autocomplete\Console\Controller::class,
    ];

    /**
     * @var string
     */
    public $result = '_ide_components.php';

    /**
     * @var array
     */
    public $config;

    /**
     * @inheritdoc
     */
    public function bootstrap ( $app )
    {
        if ( $app instanceof \yii\console\Application && $this->isActive() ) {
            $this->updateControllerMap( $app );
        }
    }

    /**
     * @return bool
     */
    public function isActive ()
    {
        return defined( 'YII_ENV' ) && YII_ENV === $this->environment;
    }

    /**
     * @param Application $app
     */
    protected function updateControllerMap ( Application $app )
    {
        if ( is_array( $this->controllerMap ) ) {
            foreach ( $this->controllerMap as $name => $controller ) {
                if ( is_subclass_of( $controller, \yii\console\Controller::class ) ) {
                    $app->controllerMap[ $name ] = $controller;
                }
            }
        }
    }
}