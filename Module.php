<?php

namespace panix\mod\faq;

use Yii;
use panix\engine\WebModule;
use yii\base\BootstrapInterface;
use yii\web\GroupUrlRule;

/**
 * Class Module
 *
 * @property boolean $enableCategory
 *
 * @package panix\mod\faq
 */
class Module extends WebModule implements BootstrapInterface
{

    public $icon = 'question';
    public $enableCategory = true;

    public function bootstrap($app)
    {

        $rules = [];
        if ($this->enableCategory) {
            $rules['<category:[0-9a-zA-Z_\-]+>/<slug:[0-9a-zA-Z_\-]+>/page/<page:\d+>/per-page/<per-page:\d+>'] = 'default/view';
            $rules['<category:[0-9a-zA-Z_\-]+>/<slug:[0-9a-zA-Z_\-]+>/page/<page:\d+>'] = 'default/view';
            $rules['<category:[0-9a-zA-Z_\-]+>/<slug:[0-9a-zA-Z_\-]+>'] = 'default/view';
            $rules['<category:[0-9a-zA-Z_\-]+>/page/<page:\d+>'] = 'default/index';
            $rules['<category:[0-9a-zA-Z_\-]+>'] = 'default/index';

        } else {
            $rules['<slug:[0-9a-zA-Z_\-]+>/page/<page:\d+>/per-page/<per-page:\d+>'] = 'default/view';
            $rules['<slug:[0-9a-zA-Z_\-]+>/page/<page:\d+>'] = 'default/view';
            $rules['<slug:[0-9a-zA-Z_\-]+>'] = 'default/view';
        }
        $rules['page/<page:\d+>/per-page/<per-page:\d+>'] = 'default/index';
        $rules['page/<page:\d+>'] = 'default/index';
        $rules[''] = 'default/index';
        $groupUrlRule = new GroupUrlRule([
            'prefix' => $this->id,
            'rules' => $rules,
        ]);
        $app->getUrlManager()->addRules($groupUrlRule->rules, false);
    }

    public function getAdminMenu()
    {
        return [
            'modules' => [
                'items' => [
                    [
                        'label' => Yii::t($this->id . '/default', 'MODULE_NAME'),
                        'url' => ['/admin/' . $this->id],
                        'icon' => $this->icon,
                        'visible' => Yii::$app->user->can("/{$this->id}/admin/default/index") || Yii::$app->user->can("/{$this->id}/admin/default/*")
                    ],
                ],
            ],
        ];
    }


    public function getInfo()
    {
        return [
            'label' => Yii::t($this->id . '/default', 'MODULE_NAME'),
            'author' => 'dev@pixelion.com.ua',
            'version' => '1.0',
            'icon' => $this->icon,
            'description' => Yii::t($this->id . '/default', 'MODULE_DESC'),
            'url' => ['/admin/' . $this->id],
        ];
    }

}
