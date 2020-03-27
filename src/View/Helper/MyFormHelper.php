<?php

namespace App\View\Helper;

use AdminLTE\View\Helper\FormHelper;
use Cake\View\View;

class MyFormHelper extends FormHelper
{
    /**
     * {@inheritDoc} \AdminLTE\View\Helper\FormHelper::control()
     */
    public function control($fieldName, array $options = [])
    {
        if (!empty($options['help'])) {
            $options['templates'] = [
                'label' => '<label class="control-label" {{attrs}}>{{text}}</label>
                    <span class="help-tip"><p>' . $options['help'] . '</p></span>',
            ];
            unset($options['help']);
        }

        return parent::control($fieldName, $options);
    }
}
