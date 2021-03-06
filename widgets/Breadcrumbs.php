<?php
/**
 * Project: weixin
 * User: liyifei
 * Date: 15/12/21
 * Time: 09:26
 */
namespace liyifei\adminlte\widgets;

use Yii;
use yii\base\InvalidConfigException;
use yii\base\Widget;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

class Breadcrumbs extends Widget {
    /**
     * @var array list of links to appear in the breadcrumbs. If this property is empty,
     * the widget will not render anything. Each array element represents a single link in the breadcrumbs
     * with the following structure:
     *
     * ```php
     * [
     *     'label' => 'label of the link',  // required
     *     'url' => 'url of the link',      // optional, will be processed by Url::to()
     *     'template' => 'own template of the item', // optional, if not set $this->itemTemplate will be used
     * ]
     * ```
     *
     * If a link is active, you only need to specify its "label", and instead of writing `['label' => $label]`,
     * you may simply use `$label`.
     *
     * Since version 2.0.1, any additional array elements for each link will be treated as the HTML attributes
     * for the hyperlink tag. For example, the following link specification will generate a hyperlink
     * with CSS class `external`:
     *
     * ```php
     * [
     *     'label' => 'demo',
     *     'url' => 'http://example.com',
     *     'class' => 'external',
     * ]
     * ```
     *
     * Since version 2.0.3 each individual link can override global [[encodeLabels]] param like the following:
     *
     * ```php
     * [
     *     'label' => '<strong>Hello!</strong>',
     *     'encode' => false,
     * ]
     * ```
     *
     */
    public $links = [];
    public $homeLink = null;
    public $options = ['class' => 'breadcrumb'];
    public $itemTemplate = "<li>{link}</li>\n";
    public $activeItemTemplate = "<li class=\"active\">{link}</li>\n";

    /**
     * Renders the widget.
     */
    public function run() {
        if (empty($this->links)) {
            return;
        }
        $links = [];
        if ($this->homeLink === null) {
            $links[] = $this->renderItem([
                                             'label' => '<i class="fa fa-dashboard"></i>首页',
                                             'encode' => false,
                                             'url' => Yii::$app->homeUrl,
                                         ], $this->itemTemplate);
        }
        elseif ($this->homeLink !== false) {
            $links[] = $this->renderItem($this->homeLink, $this->itemTemplate);
        }
        foreach ($this->links as $link) {
            if (!is_array($link)) {
                $link = ['label' => $link];
            }
            $links[] = $this->renderItem($link, isset($link['url']) ? $this->itemTemplate : $this->activeItemTemplate);
        }
        echo Html::tag('ol', implode('', $links), $this->options);
    }

    /**
     * Renders a single breadcrumb item.
     * @param array $link the link to be rendered. It must contain the "label" element. The "url" element is optional.
     * @param string $template the template to be used to rendered the link. The token "{link}" will be replaced by the link.
     * @return string the rendering result
     * @throws InvalidConfigException if `$link` does not have "label" element.
     */
    protected function renderItem($link, $template) {
        $encodeLabel = ArrayHelper::remove($link, 'encode', true);
        if (array_key_exists('label', $link)) {
            $label = $encodeLabel ? Html::encode($link['label']) : $link['label'];
        }
        else {
            throw new InvalidConfigException('The "label" element is required for each link.');
        }
        if (isset($link['template'])) {
            $template = $link['template'];
        }
        if (isset($link['url'])) {
            $options = $link;
            unset($options['template'], $options['label'], $options['url']);
            $link = Html::a($label, $link['url'], $options);
        }
        else {
            $link = $label;
        }

        return strtr($template, ['{link}' => $link]);
    }
}
