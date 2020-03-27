<?php

namespace App\View\Helper;

use AdminLTE\View\Helper\FormHelper;
use App\View\Helper\MyHtmlHelper;
use Cake\View\View;

class MyFormHelper extends FormHelper
{
    /**
     * {@inheritDoc} \AdminLTE\View\Helper\FormHelper::control()
     */
    public function control($fieldName, array $options = [])
    {
        $helper = new MyHtmlHelper(new View());

        if (!empty($options['help'])) {
            $options['templates'] = [
                'label' => '<label class="control-label" {{attrs}}>{{text}}</label>' .
                $helper->help($options['help']),
            ];
            unset($options['help']);
        }

        return parent::control($fieldName, $options);
    }
}
