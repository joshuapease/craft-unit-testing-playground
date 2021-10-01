<?php

namespace modules\craftunit;

use Craft;
use craft\web\twig\variables\CraftVariable;
use modules\craftunit\services\Nav;
use yii\base\Event;

/**
 * @property Nav $nav
 */
class Module extends \yii\base\Module
{
    public static $instance;

    /**
     * Initializes the module.
     *
     * @return void
     */
    public function init()
    {
        self::$instance = $this;

        Craft::setAlias('@modules/craftunit', __DIR__);

        $this->controllerNamespace = 'modules\craftunit\controllers';

        $this->_registerEvents();

        parent::init();
    }

    /**
     * Gets the Nav service
     *
     * @return Nav
     */
    public function getNav(): Nav
    {
        return $this->get('nav');
    }

    /**
     * Register events
     *
     * @return void
     */
    private function _registerEvents()
    {
        // Now you can access the components and methods in twig with craft.sampleUtil
        Event::on(
            CraftVariable::class,
            CraftVariable::EVENT_INIT,
            function (Event $e) {
                $variable = $e->sender;
                $variable->set('craftunit', self::$instance);
            }
        );
    }
}
