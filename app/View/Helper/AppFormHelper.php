<?php
/**
 * Created by IntelliJ IDEA.
 * User: booyan
 * Date: 14/12/14
 * Time: 1:25
 */
App::uses('FormHelper', 'View/Helper');

class AppFormHelper extends FormHelper {

    /**
     * @param $fieldName
     * @param array $options
     * @return string
     */
    public function pInput($fieldName, $options = []) {
        $format = '%s%s';
        $error = $this->error($fieldName, null, ['wrap' => 'p', 'class' => false]);
        $error = ($error) ? sprintf('<div class="error">%s</div>', $error) : '';
        return sprintf($format, $this->input($fieldName, $options), $error);
    }

    /**
     * @param $fieldName
     * @param array $options
     * @return string
     */
    public function fInput($fieldName, $options = []) {
        $format = '%s%s';
        $error = $this->error($fieldName, null, ['wrap' => 'p', 'class' => false]);
        $error = ($error) ? sprintf('<div class="errorBox">%s</div>', $error) : '';
        return sprintf($format, $this->input($fieldName, $options), $error);
    }

    /**
     * @param string $fieldName
     * @param array $options
     * @param array $attributes
     * @return array|string
     */
    public function radio($fieldName, $options = array(), $attributes = array()) {
        $attributes = $this->_initInputField($fieldName, $attributes);

        $showEmpty = $this->_extractOption('empty', $attributes);
        if ($showEmpty) {
            $showEmpty = ($showEmpty === true) ? __d('cake', 'empty') : $showEmpty;
            $options = array('' => $showEmpty) + $options;
        }
        unset($attributes['empty']);

        $legend = false;
        if (isset($attributes['legend'])) {
            $legend = $attributes['legend'];
            unset($attributes['legend']);
        } elseif (count($options) > 1) {
            $legend = __(Inflector::humanize($this->field()));
        }

        $label = true;
        if (isset($attributes['label'])) {
            $label = $attributes['label'];
            unset($attributes['label']);
        }

        $separator = null;
        if (isset($attributes['separator'])) {
            $separator = $attributes['separator'];
            unset($attributes['separator']);
        }

        $between = null;
        if (isset($attributes['between'])) {
            $between = $attributes['between'];
            unset($attributes['between']);
        }

        $value = null;
        if (isset($attributes['value'])) {
            $value = $attributes['value'];
        } else {
            $value = $this->value($fieldName);
        }

        $disabled = array();
        if (isset($attributes['disabled'])) {
            $disabled = $attributes['disabled'];
        }

        $out = array();

        $hiddenField = isset($attributes['hiddenField']) ? $attributes['hiddenField'] : true;
        unset($attributes['hiddenField']);

        if (isset($value) && is_bool($value)) {
            $value = $value ? 1 : 0;
        }

        $this->_domIdSuffixes = array();
        foreach ($options as $optValue => $optTitle) {
            $optionsHere = array('value' => $optValue, 'disabled' => false);

            if (isset($value) && strval($optValue) === strval($value)) {
                $optionsHere['checked'] = 'checked';
            }
            $isNumeric = is_numeric($optValue);
            if ($disabled && (!is_array($disabled) || in_array((string)$optValue, $disabled, !$isNumeric))) {
                $optionsHere['disabled'] = true;
            }
            $tagName = $attributes['id'] . $this->domIdSuffix($optValue);

            if ($label) {
                $labelOpts = is_array($label) ? $label : array();
                $labelOpts += array('for' => $tagName);
                $optTitle = $this->label($tagName, $optTitle, $labelOpts);
            }

            if (is_array($between)) {
                $optTitle .= array_shift($between);
            }
            $optTitle = '<p>' . $optTitle . '</p>';
            $allOptions = array_merge($attributes, $optionsHere);
            $radioTag = $this->Html->useTag('radio', $attributes['name'], $tagName,
                array_diff_key($allOptions, array('name' => null, 'type' => null, 'id' => null)),
                $optTitle
            );
            $out[] = '<label>' . $radioTag . '</label>';
        }
        $hidden = null;

        if ($hiddenField) {
            if (!isset($value) || $value === '') {
                $hidden = $this->hidden($fieldName, array(
                    'form' => isset($attributes['form']) ? $attributes['form'] : null,
                    'id' => $attributes['id'] . '_',
                    'value' => '',
                    'name' => $attributes['name']
                ));
            }
        }
        $out = $hidden . implode($separator, $out);

        if (is_array($between)) {
            $between = '';
        }
        if ($legend) {
            $out = $this->Html->useTag('fieldset', '', $this->Html->useTag('legend', $legend) . $between . $out);
        }
        return $out;
    }
}