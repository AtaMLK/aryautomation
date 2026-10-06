<?php
function rs_get_fluents_forms()
    {
        $ff_list = wpFluent()->table('fluentform_forms')
            ->select(['id', 'title'])
            ->orderBy('id', 'DESC')
            ->get();

        $forms = [];

        if ($ff_list) {
            $forms[0] = esc_html__('Select a Fluent Forms', 'fluentform');
            foreach ($ff_list as $form) {
                $forms[$form->id] = esc_html($form->title) . ' (' . $form->id . ')';
            }
        } else {
            $forms[0] = esc_html__('Create a Form First', 'fluentform');
        }

        return $forms;
    }