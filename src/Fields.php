<?php
declare(strict_types=1);

namespace CyfModule;

class Fields
{
    public static function registerFields(): void
    {
        if (function_exists('acf_add_local_field_group')) {
            remove_post_type_support('page', 'editor');

            acf_add_local_field_group([
                'key' => 'group_steps',
                'title' => __('Steps', 'cyf-module'),
                'fields' => [
                    [
                        'key' => 'field_block_title',
                        'label' => __('Block Title', 'cyf-module'),
                        'name' => 'block_title',
                        'type' => 'text',
                    ],
                    [
                        'key' => 'field_steps',
                        'label' => __('Steps', 'cyf-module'),
                        'name' => 'steps',
                        'type' => 'repeater',
                        'layout' => 'block',
                        'button_label' => __('Add Step', 'cyf-module'),
                        'sub_fields' => [
                            [
                                'key' => 'field_step_type',
                                'label' => __('Step Type', 'cyf-module'),
                                'name' => 'step_type',
                                'type' => 'radio',
                                'choices' => [
                                    'radio' => __('Radio', 'cyf-module'),
                                    'checkbox' => __('Checkbox', 'cyf-module'),
                                    'input' => __('Input', 'cyf-module'),
                                ],
                                'layout' => 'horizontal',
                            ],
                            [
                                'key' => 'field_step_size',
                                'label' => __('Step Size', 'cyf-module'),
                                'name' => 'step_size',
                                'type' => 'radio',
                                'choices' => [
                                    'regular' => __('Regular', 'cyf-module'),
                                    'large' => __('Large', 'cyf-module'),
                                ],
                                'layout' => 'horizontal',
                                'conditional_logic' => [
                                    [
                                        [
                                            'field' => 'field_step_type',
                                            'operator' => '!=',
                                            'value' => 'input',
                                        ],
                                    ],
                                ],
                            ],
                            [
                                'key' => 'field_step_title',
                                'label' => __('Step Title', 'cyf-module'),
                                'name' => 'step_title',
                                'type' => 'text',
                            ],
                            [
                                'key' => 'field_step_subtitle',
                                'label' => __('Step Subtitle', 'cyf-module'),
                                'name' => 'step_subtitle',
                                'type' => 'text',
                            ],
                            [
                                'key' => 'field_step_description',
                                'label' => __('Step Description', 'cyf-module'),
                                'name' => 'step_description',
                                'type' => 'textarea',
                            ],
                            [
                                'key' => 'field_step_options',
                                'label' => __('Step Options', 'cyf-module'),
                                'name' => 'step_options',
                                'type' => 'repeater',
                                'layout' => 'block',
                                'button_label' => __('Add Option', 'cyf-module'),
                                'sub_fields' => [
                                    [
                                        'key' => 'field_option_image',
                                        'label' => __('Option Image', 'cyf-module'),
                                        'name' => 'option_image',
                                        'type' => 'image',
                                        'return_format' => 'array',
                                        'preview_size' => 'thumbnail',
                                        'library' => 'all',
                                        'conditional_logic' => [
                                            [
                                                [
                                                    'field' => 'field_step_type',
                                                    'operator' => '!=',
                                                    'value' => 'input',
                                                ],
                                            ],
                                        ],
                                    ],
                                    [
                                        'key' => 'field_option_title',
                                        'label' => __('Option Title', 'cyf-module'),
                                        'name' => 'option_title',
                                        'type' => 'text',
                                    ],
                                    [
                                        'key' => 'field_input_type',
                                        'label' => __('Input Type', 'cyf-module'),
                                        'name' => 'input_type',
                                        'type' => 'radio',
                                        'choices' => [
                                            'email' => __('Email', 'cyf-module'),
                                            'tel' => __('Phone', 'cyf-module'),
                                            'date' => __('Date', 'cyf-module'),
                                            'time' => __('Time', 'cyf-module'),
                                            'text' => __('Text', 'cyf-module'),
                                            'number' => __('Number', 'cyf-module'),
                                            'url' => __('URL', 'cyf-module'),
                                        ],
                                        'layout' => 'horizontal',
                                        'conditional_logic' => [
                                            [
                                                [
                                                    'field' => 'field_step_type',
                                                    'operator' => '==',
                                                    'value' => 'input',
                                                ],
                                            ],
                                        ],
                                    ],
                                    [
                                        'key' => 'field_option_attributes',
                                        'label' => __('Option Attributes', 'cyf-module'),
                                        'name' => 'option_attributes',
                                        'type' => 'repeater',
                                        'button_label' => __('Add Attribute', 'cyf-module'),
                                        'conditional_logic' => [
                                            [
                                                [
                                                    'field' => 'field_step_type',
                                                    'operator' => '!=',
                                                    'value' => 'input',
                                                ],
                                            ],
                                        ],
                                        'sub_fields' => [
                                            [
                                                'key' => 'field_attribute_title',
                                                'label' => __('Attribute Title', 'cyf-module'),
                                                'name' => 'attribute_title',
                                                'type' => 'text',
                                            ],
                                            [
                                                'key' => 'field_attribute_value',
                                                'label' => __('Attribute Value', 'cyf-module'),
                                                'name' => 'attribute_value',
                                                'type' => 'text',
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
                'location' => [
                    [
                        [
                            'param' => 'page_template',
                            'operator' => '==',
                            'value' => 'cyf-template.php',
                        ],
                    ],
                ],
            ]);
        }
    }
}
