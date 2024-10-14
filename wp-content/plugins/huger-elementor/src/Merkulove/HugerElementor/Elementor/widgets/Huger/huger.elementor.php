<?php /** @noinspection PhpUndefinedClassInspection */
/**
 * Huger for Elementor
 * Customizable mega menu for Elementor editor
 * Exclusively on https://1.envato.market/huger-elementor
 *
 * @encoding        UTF-8
 * @version         1.0.0
 * @copyright       (C) 2018 - 2022 Merkulove ( https://merkulov.design/ ). All rights reserved.
 * @license         Envato License https://1.envato.market/KYbje
 * @contributors    Nemirovskiy Vitaliy (nemirovskiyvitaliy@gmail.com), Dmitry Merkulov (dmitry@merkulov.design), Cherviakov Vlad (vladchervjakov@gmail.com)
 * @support         help@merkulov.design
 **/

namespace Merkulove\HugerElementor;

/** Exit if accessed directly. */
if ( ! defined( 'ABSPATH' ) ) {
    header( 'Status: 403 Forbidden' );
    header( 'HTTP/1.1 403 Forbidden' );
    exit;
}

use Elementor\Icons_Manager;
use Elementor\Plugin;
use Elementor\Repeater;
use Exception;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;
use Elementor\Core\Schemes\Color;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Merkulove\HugerElementor\Unity\Plugin as UnityPlugin;

/** @noinspection PhpUnused */
/**
 * Huger - Custom Elementor Widget.
 **/
class huger_elementor extends Widget_Base {

    /**
     * Use this to sort widgets.
     * A smaller value means earlier initialization of the widget.
     * Can take negative values.
     * Default widgets and widgets from 3rd party developers have 0 $mdp_order
     **/
    public $mdp_order = 1;

    /**
     * Widget base constructor.
     * Initializing the widget base class.
     *
     * @access public
     * @throws Exception If arguments are missing when initializing a full widget instance.
     * @param array      $data Widget data. Default is an empty array.
     * @param array|null $args Optional. Widget default arguments. Default is null.
     *
     * @return void
     **/
    public function __construct( $data = [], $args = null ) {

        parent::__construct( $data, $args );

        wp_register_style( 'mdp-huger-elementor-admin', UnityPlugin::get_url() . 'src/Merkulove/Unity/assets/css/elementor-admin' . UnityPlugin::get_suffix() . '.css', [], UnityPlugin::get_version() );
        wp_register_style( 'mdp-huger-elementor', UnityPlugin::get_url() . 'css/huger-elementor' . UnityPlugin::get_suffix() . '.css', [], UnityPlugin::get_version() );
	    wp_register_script( 'mdp-huger-elementor', UnityPlugin::get_url() . 'js/huger-elementor' . UnityPlugin::get_suffix() . '.js', [ 'elementor-frontend' ], UnityPlugin::get_version(), true );

    }

    /**
     * Return a widget name.
     *
     * @return string
     **/
    public function get_name() {

        return 'mdp-huger-elementor';

    }

    /**
     * Return the widget title that will be displayed as the widget label.
     *
     * @return string
     **/
    public function get_title() {

        return esc_html__( 'Huger', 'huger-elementor' );

    }

    /**
     * Set the widget icon.
     *
     * @return string
     */
    public function get_icon() {

        return 'mdp-huger-elementor-widget-icon';

    }

    /**
     * Set the category of the widget.
     *
     * @return array with category names
     **/
    public function get_categories() {

        return [ 'general' ];

    }

    /**
     * Get widget keywords. Retrieve the list of keywords the widget belongs to.
     *
     * @access public
     *
     * @return array Widget keywords.
     **/
    public function get_keywords() {

        return [ 'Merkulove', 'Huger' ];

    }

    /**
     * Get style dependencies.
     * Retrieve the list of style dependencies the widget requires.
     *
     * @access public
     *
     * @return array Widget styles dependencies.
     **/
    public function get_style_depends() {

        return [ 'mdp-huger-elementor', 'mdp-huger-elementor-admin' ];

    }

	/**
	 * Get script dependencies.
	 * Retrieve the list of script dependencies the element requires.
	 *
	 * @access public
     *
	 * @return array Element scripts dependencies.
	 **/
	public function get_script_depends() {

		return [ 'mdp-huger-elementor' ];

    }

    /**
     * Get menus from wp
     *
     * @since 1.0.0
     * @access private
     *
     * @return array
     * */
    private function get_menus() {
        $menus = wp_get_nav_menus();

        $options = [];

        foreach ( $menus as $menu ) {
            $options[ $menu->slug ] = $menu->name;
        }

        return $options;
    }

    /**
     * Get elementor templates.
     *
     * @since 1.0.0
     * @access private
     *
     * @return array
     * */
    private function get_templates() {
        $templates = Plugin::instance()->templates_manager->get_source( 'local' )->get_items();

        $results = [];

        foreach ( $templates as $template ) {
            $results[ $template[ 'template_id' ] ] = $template[ 'title' ];
        }
       return $results;
    }


    /**
     * Add the widget controls.
     *
     * @access protected
     * @return void with category names
     **/
    protected function register_controls() {

        /** Content Tab. */
        $this->tab_content();

        /** Style Tab. */
        $this->tab_style();

    }

    /**
     * Add widget controls on Content tab.
     *
     * @since 1.0.0
     * @access private
     *
     * @return void
     **/
    private function tab_content() {

        /** Content -> General settings Section. */
        $this->section_general_settings();

        /** Content -> Menu items settings Section. */
        $this->section_menu_items_settings();

        /** Content -> Mobile menu settings Section */
        $this->section_mobile_menu_settings();

        /** Content -> Submenu settings Section */
        $this->section_submenu_settings();

        /** Content -> WP menu settings Section */
        $this->section_wp_menu_settings();

    }

    /**
     * Add widget controls on Style tab.
     *
     * @since 1.0.0
     * @access private
     *
     * @return void
     **/
    private function tab_style() {

        /** Style -> Section Style Menu Item. */
        $this->section_style_menu_item();

        /** Style -> Section Style Submenu. */
        $this->section_style_submenu();

        /** Style -> Section Style WP Menu Item. */
        $this->section_style_wp_menu_item();

        /** Style -> Section Style WP Menu Submenu. */
        $this->section_style_wp_menu_submenu();

        /** Style -> Section Style Submenu Item. */
        $this->section_style_wp_menu_submenu_item();

        /** Style -> Section Style Toggle. */
        $this->section_style_toggle();

        /** Style -> Section Style Close Toggle. */
        $this->section_style_close_toggle();

        /** Style -> Section Style Mobile Menu. */
        $this->section_style_mobile_menu();

    }

    /**
     * Add widget controls: Content -> General Settings Section.
     *
     * @since 1.0.0
     * @access private
     *
     * @return void
     **/
    private function section_general_settings() {

        $this->start_controls_section( 'section_general_settings', [
            'label' => esc_html__( 'General settings', 'huger-elementor' ),
            'tab'   => Controls_Manager::TAB_CONTENT
        ] );

        $this->add_control(
            'menu_layout',
            [
                'label' => esc_html__( 'Layout', 'huger-elementor' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'horizontal',
                'options' => [
                    'vertical' => esc_html__( 'Vertical', 'huger-elementor' ),
                    'horizontal' => esc_html__( 'Horizontal', 'huger-elementor' ),
                ],
            ]
        );


        $this->add_control(
            'horizontal_menu_align',
            [
                'label' => esc_html__( 'Menu alignment', 'huger-elementor' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => esc_html__( 'Left', 'huger-elementor' ),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'huger-elementor' ),
                        'icon' => 'fa fa-align-center',
                    ],
                    'flex-end' => [
                        'title' => esc_html__( 'Right', 'huger-elementor' ),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'condition' => [ 'menu_layout' => 'horizontal' ],
                'selectors' => [
                    '{{WRAPPER}} .mdp-huger-elementor-main-nav-horizontal' => 'justify-content: {{VALUE}}'
                ],
                'default' => 'flex-start',
                'toggle' => true,
            ]
        );

        $this->add_control(
            'submenu_indicator',
            [
                'label' => esc_html__( 'Submenu indicator', 'huger-elementor' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'fa fa-chevron-down',
                'options' => [
                    'fa fa-chevron-down' => esc_html__( 'Chevron', 'huger-elementor' ),
                    'fas fa-angle-down' => esc_html__( 'Angle', 'huger-elementor' ),
                    'fas fa-plus' => esc_html__( 'Plus', 'huger-elementor' ),
                    'fa fa-circle' => esc_html__( 'Circle', 'huger-elementor' ),
                    'fa fa-minus' => esc_html__( 'Minus', 'huger-elementor' ),
                    'fas fa-square' => esc_html__( 'Square', 'huger-elementor' ),
                    'custom' => esc_html__( 'Custom', 'huger-elementor' ),
                    '' => esc_html__( 'None', 'huger-elementor' )
                ],
            ]
        );

        $this->add_control(
            'custom_submenu_indicator',
            [
                'label' => esc_html__( 'Custom indicator', 'huger-elementor' ),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fa fa-chevron-down',
                    'library' => 'solid',
                ],
                'condition' => [ 'submenu_indicator' => 'custom' ]
            ]
        );

        $this->add_control(
            'pointer',
            [
                'label' => esc_html__( 'Pointer', 'huger-elementor' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'none',
                'options' => [
                    'mdp-huger-elementor-main-menu--item-underline' => esc_html__('Underline', 'huger-elementor'),
                    'mdp-huger-elementor-main-menu--item-overline' => esc_html__( 'Overline', 'huger-elementor' ),
                    'mdp-huger-elementor-main-menu--item-double-line' => esc_html__( 'Double line', 'huger-elementor' ),
                    'mdp-huger-elementor-main-menu--item-framed' => esc_html__( 'Framed', 'huger-elementor' ),
                    'none' => esc_html__( 'None', 'huger-elementor' ),
                ],
            ]
        );

        $this->add_control(
            'pointer_animation',
            [
                'label' => esc_html__( 'Pointer animation', 'huger-elementor' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'none',
                'options' => [
                    'grow' => esc_html__( 'Grow', 'huger-elementor' ),
                    'shrink' => esc_html__( 'Shrink', 'huger-elementor' ),
                    'slide-up' => esc_html__( 'Slide up', 'huger-elementor' ),
                    'slide-down' => esc_html__( 'Slide down', 'huger-elementor' ),
                    'fade' => esc_html__( 'Fade', 'huger-elementor' ),
                    'none' => esc_html__( 'None', 'huger-elementor' ),
                ],
                'selectors' => [
                    "{{WRAPPER}} .mdp-huger-elementor-main-menu--item-underline:hover::after" => 'animation: {{VALUE}}',
                    "{{WRAPPER}} .mdp-huger-elementor-main-menu--item-overline:hover::after" => 'animation: {{VALUE}}',
                    "{{WRAPPER}} .mdp-huger-elementor-main-menu--item-double-line:hover::after" => 'animation: {{VALUE}}',
                    "{{WRAPPER}} .mdp-huger-elementor-main-menu--item-double-line:hover::before" => 'animation: {{VALUE}}',
                    "{{WRAPPER}} .mdp-huger-elementor-main-menu--item-framed:hover::before" => 'animation: {{VALUE}}',
                ],
                'condition' => [
                    'pointer!' => 'none'
                ],
            ]
        );

        $this->add_control(
            'pointer_animation_easing',
            [
                'label' => esc_html__( 'Easing', 'huger-elementor' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'ease',
                'options' => [
                    'ease' => esc_html__( 'Ease', 'huger-elementor' ),
                    'ease-in' => esc_html__( 'Ease-in', 'huger-elementor' ),
                    'ease-out' => esc_html__( 'Ease-out', 'huger-elementor' ),
                    'ease-in-out' => esc_html__( 'Ease-in-out', 'huger-elementor' ),
                    'linear' => esc_html__( 'Linear', 'huger-elementor' ),
                ],
                'condition' => [
                    'pointer_animation!' => 'none',
                    'pointer!' => 'none'
                ],
                'selectors' => [
                    "{{WRAPPER}} .mdp-huger-elementor-main-menu--item-underline:hover::after" => 'animation-timing-function: {{VALUE}}',
                    "{{WRAPPER}} .mdp-huger-elementor-main-menu--item-overline:hover::after" => 'animation-timing-function: {{VALUE}}',
                    "{{WRAPPER}} .mdp-huger-elementor-main-menu--item-double-line:hover::after" => 'animation-timing-function: {{VALUE}}',
                    "{{WRAPPER}} .mdp-huger-elementor-main-menu--item-double-line:hover::before" => 'animation-timing-function: {{VALUE}}',
                    "{{WRAPPER}} .mdp-huger-elementor-main-menu--item-framed:hover::before" => 'animation-timing-function: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'pointer_animation_duration',
            [
                'label' => esc_html__( 'Duration', 'huger-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 's' ],
                'range' => [
                    's' => [
                        'min' => 0.1,
                        'max' => 5,
                        'step' => 0.1,
                    ],
                ],
                'default' => [
                    'unit' => 's',
                    'size' => 1,
                ],
                'selectors' => [
                    "{{WRAPPER}} .mdp-huger-elementor-main-menu--item-underline:hover::after" => 'animation-duration: {{SIZE}}{{UNIT}}',
                    "{{WRAPPER}} .mdp-huger-elementor-main-menu--item-overline:hover::after" => 'animation-duration: {{SIZE}}{{UNIT}}',
                    "{{WRAPPER}} .mdp-huger-elementor-main-menu--item-double-line:hover::after" => 'animation-duration: {{SIZE}}{{UNIT}}',
                    "{{WRAPPER}} .mdp-huger-elementor-main-menu--item-double-line:hover::before" => 'animation-duration: {{SIZE}}{{UNIT}}',
                    "{{WRAPPER}} .mdp-huger-elementor-main-menu--item-framed:hover::before" => 'animation-duration: {{SIZE}}{{UNIT}}',
                ],
                'condition' => [
                    'pointer_animation!' => 'none',
                    'pointer!' => 'none'
                ],
            ]
        );

        $this->add_control(
            'pointer_animation_delay',
            [
                'label' => esc_html__( 'Delay', 'huger-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 's' ],
                'range' => [
                    's' => [
                        'min' => 0,
                        'max' => 5,
                        'step' => 0.1,
                    ],
                ],
                'default' => [
                    'unit' => 's',
                    'size' => 0,
                ],
                'selectors' => [
                    "{{WRAPPER}} .mdp-huger-elementor-main-menu--item-underline:hover::after" => 'animation-delay: {{SIZE}}{{UNIT}}',
                    "{{WRAPPER}} .mdp-huger-elementor-main-menu--item-overline:hover::after" => 'animation-delay: {{SIZE}}{{UNIT}}',
                    "{{WRAPPER}} .mdp-huger-elementor-main-menu--item-double-line:hover::after" => 'animation-delay: {{SIZE}}{{UNIT}}',
                    "{{WRAPPER}} .mdp-huger-elementor-main-menu--item-double-line:hover::before" => 'animation-delay: {{SIZE}}{{UNIT}}',
                    "{{WRAPPER}} .mdp-huger-elementor-main-menu--item-framed:hover::before" => 'animation-delay: {{SIZE}}{{UNIT}}',
                ],
                'condition' => [
                    'pointer_animation!' => 'none',
                    'pointer!' => 'none'
                ],
            ]
        );

        $this->add_control(
            'open_submenu_onclick',
            [
                'label' => esc_html__( 'Open submenu on click', 'huger-elementor' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'huger-elementor' ),
                'label_off' => esc_html__( 'No', 'huger-elementor' ),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_control(
            'open_submenu_onclick_area',
            [
                'label' => esc_html__( 'Click area', 'huger-elementor' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'text',
                'options' => [
                    'icon' => esc_html__( 'Icon', 'huger-elementor' ),
                    'text' => esc_html__( 'Text', 'huger-elementor' ),
                ],
                'condition' => [
                     'open_submenu_onclick' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'submenu_hover_close',
            [
                'label' => esc_html__( 'Submenu close', 'spoter-elementor' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'on-click',
                'options' => [
                    'on-click'  => esc_html__( 'Click on empty space', 'huger-elementor' ),
                    'on-leave' => esc_html__( 'On mouse leave from menu item', 'huger-elementor' ),
                ],
                'condition' => [
                    'open_submenu_onclick!' => 'yes'
                ]
            ]
        );


        $this->end_controls_section();

    }

    /**
     * Add widget controls: Content -> Menu Items Settings Section.
     *
     * @since 1.0.0
     * @access private
     *
     * @return void
     **/
    private function section_menu_items_settings() {
        $this->start_controls_section( 'section_menu_items_settings', [
            'label' => esc_html__( 'Menu items', 'huger-elementor' ),
            'tab'   => Controls_Manager::TAB_CONTENT
        ] );

        $repeater = new Repeater();

        $repeater->add_control(
            'item_title',
            [
                'label' => esc_html__( 'Title', 'huger-elementor' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Item', 'huger-elementor' ),
                'placeholder' => esc_html__( 'Type your title here', 'huger-elementor' ),
            ]
        );

        $repeater->add_control(
            'item_icon',
            [
                'label' => esc_html__( 'Item icon', 'huger-elementor' ),
                'type' => Controls_Manager::ICONS,
            ]
        );

        $repeater->add_control(
            'item_link',
            [
                'label' => esc_html__( 'Link', 'huger-elementor' ),
                'type' => Controls_Manager::URL,
                'placeholder' => esc_html__( 'https://your-link.com', 'huger-elementor' ),
                'show_external' => true,
                'default' => [
                    'url' => '',
                    'is_external' => true,
                    'nofollow' => true,
                ],
            ]
        );

        $repeater->add_control(
            'submenu',
            [
                'label' => esc_html__( 'Submenu', 'huger-elementor' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'wp-menu',
                'options' => [
                    'template'  => esc_html__( 'Template', 'huger-elementor' ),
                    'wp-menu' => esc_html__( 'WP menu', 'huger-elementor' ),
                    'none' => esc_html__( 'None', 'huger-elementor' )
                ],
            ]
        );

        $menus = $this->get_menus();

        if ( !empty( $menus ) ) {
            $repeater->add_control(
                'wp_menu',
                [
                    'label' => esc_html__( 'Select menu', 'huger-elementor' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => array_keys( $menus )[0],
                    'options' => $menus,
                    'save_default' => true,
                    'condition' => [
                        'submenu' => 'wp-menu'
                    ]
                ]
            );
        } else {
            $repeater->add_control(
                'menu_link',
                [
                    'type' => Controls_Manager::RAW_HTML,
                    'raw' => '<strong>' . esc_html__( 'There are no menus in your site.', 'huger-elementor' ) .
                        '</strong><br>' . sprintf( wp_kses_post( 'Go to the <a href="%s" target="_blank">Menus screen</a> to create one.' ),
                            admin_url( 'nav-menus.php?action=edit&menu=0' ) ),
                    'separator' => 'after',
                    'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
                    'condition' => [
                        'submenu' => 'wp-menu'
                    ]
                ]
            );
        }

        $templates = $this->get_templates();

        if ( !empty( $templates ) ) {

            $repeater->add_control(
                'template',
                [
                    'label' => esc_html__('Template', 'huger-elementor'),
                    'type' => Controls_Manager::SELECT,
                    'default' => array_keys( $templates )[0],
                    'options' => $templates,
                    'condition' => [
                        'submenu' => 'template'
                    ]
                ]
            );

        } else {
            $repeater->add_control(
                'template_link',
                [
                    'type' => Controls_Manager::RAW_HTML,
                    'raw' => '<strong>' . esc_html__( 'There are no templates in your site.', 'huger-elementor' ) .
                        '</strong><br>' . sprintf( wp_kses_post( 'Go to the <a href="%s" target="_blank">Templates screen</a> to create one.' ),
                            admin_url( 'edit.php?post_type=elementor_library&tabs_group=library' ) ),
                    'separator' => 'after',
                    'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
                    'condition' => [
                        'submenu' => 'template'
                    ]
                ]
            );
        }

        $this->add_control(
            'menu_items_list',
            [
                'label' => esc_html__( 'Menu items', 'huger-elementor' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'item_title' => esc_html__( 'Item', 'huger-elementor' )
                    ],
                    [
                        'item_title' => esc_html__( 'Item', 'huger-elementor' )
                    ],
                    [
                        'item_title' => esc_html__( 'Item', 'huger-elementor' )
                    ],
                ],
                'title_field' => '{{{ item_title }}}',
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Add widget controls: Content -> Mobile Menu Settings.
     *
     * @since 1.0.0
     * @access private
     *
     * @return void
     **/
    private function section_mobile_menu_settings() {

        $this->start_controls_section( 'section_mobile_menu_settings', [
            'label' => esc_html__( 'Mobile menu settings', 'huger-elementor' ),
            'tab'   => Controls_Manager::TAB_CONTENT
        ] );

        $this->add_control(
            'responsive_breakpoint',
            [
                'label' => esc_html__( 'Responsive breakpoint', 'huger-elementor' ),
                'type' => Controls_Manager::SELECT,
                'default' => '767px',
                'options' => [
                    '767px' => esc_html__( 'Mobile', 'huger-elementor' ),
                    '1024px' => esc_html__( 'Tablet', 'huger-elementor' ),
                    'custom' => esc_html__( 'Custom', 'huger-elementor' ),
                ],
            ]
        );

        $this->add_control(
            'custom_breakpoint',
            [
                'label' => esc_html__( 'Breakpoint', 'huger-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1600,
                        'step' => 10,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 0,
                ],
                'condition' => [
                    'responsive_breakpoint' => 'custom'
                ],
            ]
        );

        $this->add_control(
            'full_width',
            [
                'label' => esc_html__( 'Full width', 'huger-elementor' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'huger-elementor' ),
                'label_off' => esc_html__( 'No', 'huger-elementor' ),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_control(
            'menu_position',
            [
                'label' => esc_html__( 'Menu position', 'huger-elementor' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'left',
                'separator' => 'after',
                'options' => [
                    'left' => esc_html__( 'Left', 'huger-elementor' ),
                    'right' => esc_html__( 'Right', 'huger-elementor' ),
                    'top' => esc_html__( 'Top', 'huger-elementor' ),
                ],
            ]
        );

        $this->add_control(
            'toggle_icon',
            [
                'label' => esc_html__( 'Toggle icon', 'huger-elementor' ),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fa fa-bars',
                    'library' => 'solid',
                ],
            ]
        );

        $this->add_control(
            'toggle_align',
            [
                'label' => esc_html__( 'Toggle align', 'huger-elementor' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => esc_html__( 'Left', 'huger-elementor' ),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'huger-elementor' ),
                        'icon' => 'fa fa-align-center',
                    ],
                    'flex-end' => [
                        'title' => esc_html__( 'Right', 'huger-elementor' ),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .mdp-huger-elementor-toggle-btn' => 'justify-content: {{VALUE}}'
                ],
                'default' => 'flex-start',
                'toggle' => true,
            ]
        );


        $this->add_control(
            'close_toggle_icon',
            [
                'label' => esc_html__( 'Close menu icon', 'huger-elementor' ),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-times',
                    'library' => 'solid',
                ],
            ]
        );



        $this->add_control(
            'toggle_close_align',
            [
                'label' => esc_html__( 'Close toggle align', 'huger-elementor' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => esc_html__( 'Left', 'huger-elementor' ),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'huger-elementor' ),
                        'icon' => 'fa fa-align-center',
                    ],
                    'flex-end' => [
                        'title' => esc_html__( 'Right', 'huger-elementor' ),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .mdp-huger-elementor-toggle-close-btn' => 'justify-content: {{VALUE}}'
                ],
                'default' => 'flex-start',
                'toggle' => true,
            ]
        );

        $this->add_control(
            'submenu_click_area',
            [
                'label' => esc_html__( 'Submenu click area', 'huger-elementor' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'text',
                'options' => [
                    'icon' => esc_html__( 'Icon', 'huger-elementor' ),
                    'text' => esc_html__( 'Text', 'huger-elementor' ),
                ],
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Add widget controls: Content -> Wordpress Menu Settings.
     *
     * @since 1.0.0
     * @access private
     *
     * @return void
     **/
    private function section_wp_menu_settings() {

        $this->start_controls_section( 'section_wp_menu_settings', [
            'label' => esc_html__( 'WP menu settings', 'huger-elementor' ),
            'tab'   => Controls_Manager::TAB_CONTENT
        ] );

        $this->add_control(
            'wp_menu_layout',
            [
                'label' => esc_html__( 'Layout', 'huger-elementor' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'horizontal',
                'options' => [
                    'vertical' => esc_html__( 'Vertical', 'huger-elementor' ),
                    'horizontal' => esc_html__( 'Horizontal', 'huger-elementor' ),
                ],
            ]
        );

        $this->add_control(
            'wp_menu_pointer',
            [
                'label' => esc_html__( 'Pointer', 'huger-elementor' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'none',
                'options' => [
                    'mdp-huger-elementor-wp-menu-underline' => esc_html__( 'Underline', 'huger-elementor' ),
                    'mdp-huger-elementor-wp-menu-overline' => esc_html__( 'Overline', 'huger-elementor' ),
                    'mdp-huger-elementor-wp-menu-double-line' => esc_html__( 'Double line', 'huger-elementor' ),
                    'mdp-huger-elementor-wp-menu-framed' => esc_html__( 'Framed', 'huger-elementor' ),
                    'none' => esc_html__( 'None', 'huger-elementor' ),
                ],
            ]
        );

        $this->add_control(
            'wp_menu_pointer_animation',
            [
                'label' => esc_html__( 'Pointer animation', 'huger-elementor' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'none',
                'options' => [
                    'grow' => esc_html__( 'Grow', 'huger-elementor' ),
                    'shrink' => esc_html__( 'Shrink', 'huger-elementor' ),
                    'slide-up' => esc_html__( 'Slide up', 'huger-elementor' ),
                    'slide-down' => esc_html__( 'Slide down', 'huger-elementor' ),
                    'fade' => esc_html__( 'Fade', 'huger-elementor' ),
                    'none' => esc_html__( 'None', 'huger-elementor' ),
                ],
                'selectors' => [
                    "{{WRAPPER}} .mdp-huger-elementor-wp-menu-underline > li:hover::after" => 'animation: {{VALUE}}',
                    "{{WRAPPER}} .mdp-huger-elementor-wp-menu-overline > li:hover::after" => 'animation: {{VALUE}}',
                    "{{WRAPPER}} .mdp-huger-elementor-wp-menu-double-line > li:hover::after" => 'animation: {{VALUE}}',
                    "{{WRAPPER}} .mdp-huger-elementor-wp-menu-double-line > li:hover::before" => 'animation: {{VALUE}}',
                    "{{WRAPPER}} .mdp-huger-elementor-wp-menu-framed > li:hover::before" => 'animation: {{VALUE}}',
                ],
                'condition' => [
                    'wp_menu_pointer!' => 'none'
                ],
            ]
        );


        $this->add_control(
            'divider_pointer_animation_wp_menu',
            [
                'type' => Controls_Manager::DIVIDER,
                'conditions' => [
                    'relation' => 'or',
                    'terms' => [
                        [
                            'name' => 'wp_menu_pointer_animation',
                            'operator' => '==',
                            'value' => 'none'
                        ],
                        [
                            'name' => 'wp_menu_pointer',
                            'operator' => '==',
                            'value' => 'none'
                        ]
                    ]
                ],
            ]
        );

        $this->add_control(
            'wp_menu_pointer_animation_easing',
            [
                'label' => esc_html__( 'Easing', 'huger-elementor' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'ease',
                'options' => [
                    'ease' => esc_html__( 'Ease', 'huger-elementor' ),
                    'ease-in' => esc_html__( 'Ease-in', 'huger-elementor' ),
                    'ease-out' => esc_html__( 'Ease-out', 'huger-elementor' ),
                    'ease-in-out' => esc_html__( 'Ease-in-out', 'huger-elementor' ),
                    'linear' => esc_html__( 'Linear', 'huger-elementor' ),
                ],
                'condition' => [
                    'wp_menu_pointer_animation!' => 'none',
                    'wp_menu_pointer!' => 'none'
                ],
                'selectors' => [
                    "{{WRAPPER}} .mdp-huger-elementor-wp-menu-underline > li:hover::after" => 'animation-timing-function: {{VALUE}}',
                    "{{WRAPPER}} .mdp-huger-elementor-wp-menu-overline > li:hover::after" => 'animation-timing-function: {{VALUE}}',
                    "{{WRAPPER}} .mdp-huger-elementor-wp-menu-double-line > li:hover::after" => 'animation-timing-function: {{VALUE}}',
                    "{{WRAPPER}} .mdp-huger-elementor-wp-menu-double-line > li:hover::before" => 'animation-timing-function: {{VALUE}}',
                    "{{WRAPPER}} .mdp-huger-elementor-wp-menu-framed > li:hover::before" => 'animation-timing-function: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'wp_menu_pointer_animation_duration',
            [
                'label' => esc_html__( 'Duration', 'huger-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 's' ],
                'range' => [
                    's' => [
                        'min' => 0.1,
                        'max' => 5,
                        'step' => 0.1,
                    ],
                ],
                'default' => [
                    'unit' => 's',
                    'size' => 1,
                ],
                'selectors' => [
                    "{{WRAPPER}} .mdp-huger-elementor-wp-menu-underline > li:hover::after" => 'animation-duration: {{SIZE}}{{UNIT}}',
                    "{{WRAPPER}} .mdp-huger-elementor-wp-menu-overline > li:hover::after" => 'animation-duration: {{SIZE}}{{UNIT}}',
                    "{{WRAPPER}} .mdp-huger-elementor-wp-menu-double-line > li:hover::after" => 'animation-duration: {{SIZE}}{{UNIT}}',
                    "{{WRAPPER}} .mdp-huger-elementor-wp-menu-double-line > li:hover::before" => 'animation-duration: {{SIZE}}{{UNIT}}',
                    "{{WRAPPER}} .mdp-huger-elementor-wp-menu-framed > li:hover::before" => 'animation-duration: {{SIZE}}{{UNIT}}',
                ],
                'condition' => [
                    'wp_menu_pointer_animation!' => 'none',
                    'wp_menu_pointer!' => 'none'
                ],
            ]
        );

        $this->add_control(
            'wp_menu_pointer_animation_delay',
            [
                'label' => esc_html__( 'Delay', 'huger-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 's' ],
                'separator' => 'after',
                'range' => [
                    's' => [
                        'min' => 0,
                        'max' => 5,
                        'step' => 0.1,
                    ],
                ],
                'default' => [
                    'unit' => 's',
                    'size' => 0,
                ],
                'selectors' => [
                    "{{WRAPPER}} .mdp-huger-elementor-wp-menu-underline > li:hover::after" => 'animation-delay: {{SIZE}}{{UNIT}}',
                    "{{WRAPPER}} .mdp-huger-elementor-wp-menu-overline > li:hover::after" => 'animation-delay: {{SIZE}}{{UNIT}}',
                    "{{WRAPPER}} .mdp-huger-elementor-wp-menu-double-line > li:hover::after" => 'animation-delay: {{SIZE}}{{UNIT}}',
                    "{{WRAPPER}} .mdp-huger-elementor-wp-menu-double-line > li:hover::before" => 'animation-delay: {{SIZE}}{{UNIT}}',
                    "{{WRAPPER}} .mdp-huger-elementor-wp-menu-framed > li:hover::before" => 'animation-delay: {{SIZE}}{{UNIT}}',
                ],
                'condition' => [
                    'wp_menu_pointer_animation!' => 'none',
                    'wp_menu_pointer!' => 'none'
                ],
            ]
        );

        $this->add_control(
            'wp_menu_submenu_indicator',
            [
                'label' => esc_html__( 'Submenu indicator', 'huger-elementor' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'fa fa-chevron-down',
                'options' => [
                    'fa fa-chevron-down' => esc_html__( 'Chevron', 'huger-elementor' ),
                    'fas fa-angle-down' => esc_html__( 'Angle', 'huger-elementor' ),
                    'fas fa-plus' => esc_html__( 'Plus', 'huger-elementor' ),
                    'fa fa-circle' => esc_html__( 'Circle', 'huger-elementor' ),
                    'fa fa-minus' => esc_html__( 'Minus', 'huger-elementor' ),
                    'fas fa-square' => esc_html__( 'Square', 'huger-elementor' ),
                    'custom' => esc_html__( 'Custom', 'huger-elementor' ),
                    '' => esc_html__( 'None', 'huger-elementor' )
                ],
            ]
        );

        $this->add_control(
            'custom_wp_menu_submenu_indicator',
            [
                'label' => esc_html__( 'Custom indicator', 'huger-elementor' ),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fa fa-chevron-down',
                    'library' => 'solid',
                ],
                'condition' => [ 'wp_menu_submenu_indicator' => 'custom' ]
            ]
        );

        $this->add_control(
            'expand_wp_menu_position_horizontal',
            [
                'label' => esc_html__( 'Expand submenu position', 'huger-elementor' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'bottom',
                'options' => [
                    'top' => esc_html__( 'Top', 'huger-elementor' ),
                    'bottom' => esc_html__( 'Bottom', 'huger-elementor' ),
                ],
                'condition' => [
                    'wp_menu_layout' => 'horizontal'
                ],
            ]
        );

        $this->add_control(
            'expand_wp_menu_position_vertical',
            [
                'label' => esc_html__( 'Expand submenu position', 'huger-elementor' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'right',
                'options' => [
                    'right' => esc_html__( 'Right', 'huger-elementor' ),
                    'left' => esc_html__( 'Left', 'huger-elementor' ),
                ],
                'condition' => [
                    'wp_menu_layout' => 'vertical'
                ],
            ]
        );

        $this->add_control(
            'wp_menu_submenu_pointer',
            [
                'label' => esc_html__( 'Submenu pointer', 'huger-elementor' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'none',
                'options' => [
                    'mdp-huger-elementor-wp-menu-submenu-underline' => esc_html__( 'Underline', 'huger-elementor' ),
                    'mdp-huger-elementor-wp-menu-submenu-overline' => esc_html__( 'Overline', 'huger-elementor' ),
                    'mdp-huger-elementor-wp-menu-submenu-double-line' => esc_html__( 'Double line', 'huger-elementor' ),
                    'mdp-huger-elementor-wp-menu-submenu-framed' => esc_html__( 'Framed', 'huger-elementor' ),
                    'none' => esc_html__( 'None', 'huger-elementor' ),
                ],
            ]
        );

        $this->add_control(
            'wp_menu_submenu_pointer_animation',
            [
                'label' => esc_html__( 'Pointer animation', 'huger-elementor' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'none',
                'options' => [
                    'grow' => esc_html__( 'Grow', 'huger-elementor' ),
                    'shrink' => esc_html__( 'Shrink', 'huger-elementor' ),
                    'slide-up' => esc_html__( 'Slide up', 'huger-elementor' ),
                    'slide-down' => esc_html__( 'Slide down', 'huger-elementor' ),
                    'fade' => esc_html__( 'Fade', 'huger-elementor' ),
                    'none' => esc_html__( 'None', 'huger-elementor' ),
                ],
                'selectors' => [
                    "{{WRAPPER}} .mdp-huger-elementor-wp-menu-submenu-underline li:hover::after" => 'animation: {{VALUE}}',
                    "{{WRAPPER}} .mdp-huger-elementor-wp-menu-submenu-overline li:hover::after" => 'animation: {{VALUE}}',
                    "{{WRAPPER}} .mdp-huger-elementor-wp-menu-submenu-double-line li:hover::after" => 'animation: {{VALUE}}',
                    "{{WRAPPER}} .mdp-huger-elementor-wp-menu-submenu-double-line li:hover::before" => 'animation: {{VALUE}}',
                    "{{WRAPPER}} .mdp-huger-elementor-wp-menu-submenu-framed li:hover::before" => 'animation: {{VALUE}}',
                ],
                'condition' => [
                    'wp_menu_submenu_pointer!' => 'none'
                ],
            ]
        );

        $this->add_control(
            'divider_pointer_animation_wp_submenu',
            [
                'type' => Controls_Manager::DIVIDER,
                'conditions' => [
                    'relation' => 'or',
                    'terms' => [
                        [
                            'name' => 'wp_menu_submenu_pointer_animation',
                            'operator' => '==',
                            'value' => 'none'
                        ],
                        [
                            'name' => 'wp_menu_submenu_pointer',
                            'operator' => '==',
                            'value' => 'none'
                        ]
                    ]
                ],
            ]
        );

        $this->add_control(
            'wp_menu_submenu_pointer_animation_easing',
            [
                'label' => esc_html__( 'Easing', 'huger-elementor' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'ease',
                'options' => [
                    'ease' => esc_html__( 'Ease', 'huger-elementor' ),
                    'ease-in' => esc_html__( 'Ease-in', 'huger-elementor' ),
                    'ease-out' => esc_html__( 'Ease-out', 'huger-elementor' ),
                    'ease-in-out' => esc_html__( 'Ease-in-out', 'huger-elementor' ),
                    'linear' => esc_html__( 'Linear', 'huger-elementor' ),
                ],
                'condition' => [
                    'wp_menu_submenu_pointer_animation!' => 'none',
                    'wp_menu_submenu_pointer!' => 'none'
                ],
                'selectors' => [
                    "{{WRAPPER}} .mdp-huger-elementor-wp-menu-submenu-underline li:hover::after" => 'animation-timing-function: {{VALUE}}',
                    "{{WRAPPER}} .mdp-huger-elementor-wp-menu-submenu-overline li:hover::after" => 'animation-timing-function: {{VALUE}}',
                    "{{WRAPPER}} .mdp-huger-elementor-wp-menu-submenu-double-line li:hover::after" => 'animation-timing-function: {{VALUE}}',
                    "{{WRAPPER}} .mdp-huger-elementor-wp-menu-submenu-double-line li:hover::before" => 'animation-timing-function: {{VALUE}}',
                    "{{WRAPPER}} .mdp-huger-elementor-wp-menu-submenu-framed li:hover::before" => 'animation-timing-function: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'wp_menu_submenu_pointer_animation_duration',
            [
                'label' => esc_html__( 'Duration', 'huger-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 's' ],
                'range' => [
                    's' => [
                        'min' => 0.1,
                        'max' => 5,
                        'step' => 0.1,
                    ],
                ],
                'default' => [
                    'unit' => 's',
                    'size' => 1,
                ],
                'selectors' => [
                    "{{WRAPPER}} .mdp-huger-elementor-wp-menu-submenu-underline li:hover::after" => 'animation-duration: {{SIZE}}{{UNIT}}',
                    "{{WRAPPER}} .mdp-huger-elementor-wp-menu-submenu-overline li:hover::after" => 'animation-duration: {{SIZE}}{{UNIT}}',
                    "{{WRAPPER}} .mdp-huger-elementor-wp-menu-submenu-double-line li:hover::after" => 'animation-duration: {{SIZE}}{{UNIT}}',
                    "{{WRAPPER}} .mdp-huger-elementor-wp-menu-submenu-double-line li:hover::before" => 'animation-duration: {{SIZE}}{{UNIT}}',
                    "{{WRAPPER}} .mdp-huger-elementor-wp-menu-submenu-framed li:hover::before" => 'animation-duration: {{SIZE}}{{UNIT}}',
                ],
                'condition' => [
                    'wp_menu_submenu_pointer_animation!' => 'none',
                    'wp_menu_submenu_pointer!' => 'none'
                ],
            ]
        );

        $this->add_control(
            'wp_menu_submenu_pointer_animation_delay',
            [
                'label' => esc_html__( 'Delay', 'huger-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 's' ],
                'range' => [
                    's' => [
                        'min' => 0,
                        'max' => 5,
                        'step' => 0.1,
                    ],
                ],
                'default' => [
                    'unit' => 's',
                    'size' => 0,
                ],
                'separator' => 'after',
                'selectors' => [
                    "{{WRAPPER}} .mdp-huger-elementor-wp-menu-submenu-underline li:hover::after" => 'animation-delay: {{SIZE}}{{UNIT}}',
                    "{{WRAPPER}} .mdp-huger-elementor-wp-menu-submenu-overline li:hover::after" => 'animation-delay: {{SIZE}}{{UNIT}}',
                    "{{WRAPPER}} .mdp-huger-elementor-wp-menu-submenu-double-line li:hover::after" => 'animation-delay: {{SIZE}}{{UNIT}}',
                    "{{WRAPPER}} .mdp-huger-elementor-wp-menu-submenu-double-line li:hover::before" => 'animation-delay: {{SIZE}}{{UNIT}}',
                    "{{WRAPPER}} .mdp-huger-elementor-wp-menu-submenu-framed li:hover::before" => 'animation-delay: {{SIZE}}{{UNIT}}',
                ],
                'condition' => [
                    'wp_menu_submenu_pointer_animation!' => 'none',
                    'wp_menu_submenu_pointer!' => 'none'
                ],
            ]
        );

        $this->add_control(
            'wp_menu_submenu_animation',
            [
                'label' => esc_html__( 'Animation', 'huger-elementor' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'none',
                'options' => [
                    'grow' => esc_html__( 'Grow', 'huger-elementor' ),
                    'shrink' => esc_html__( 'Shrink', 'huger-elementor' ),
                    'slide-up' => esc_html__( 'Slide up', 'huger-elementor' ),
                    'slide-down' => esc_html__( 'Slide down', 'huger-elementor' ),
                    'fade' => esc_html__( 'Fade', 'huger-elementor' ),
                    'none' => esc_html__( 'None', 'huger-elementor' ),
                ],
                'selectors' => [
                    '{{WRAPPER}} .mdp-huger-elementor-wp-menu-dropdown' => 'animation: {{VALUE}} ',
                ],
            ]
        );

        $this->add_control(
            'wp_menu_submenu_animation_easing',
            [
                'label' => esc_html__( 'Easing', 'huger-elementor' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'ease',
                'options' => [
                    'ease' => esc_html__( 'Ease', 'huger-elementor' ),
                    'ease-in' => esc_html__( 'Ease-in', 'huger-elementor' ),
                    'ease-out' => esc_html__( 'Ease-out', 'huger-elementor' ),
                    'ease-in-out' => esc_html__( 'Ease-in-out', 'huger-elementor' ),
                    'linear' => esc_html__( 'Linear', 'huger-elementor' ),
                ],
                'condition' => [
                    'wp_menu_submenu_animation!' => 'none'
                ],
                'selectors' => [
                    '{{WRAPPER}} .mdp-huger-elementor-wp-menu-dropdown' => 'animation-timing-function: {{VALUE}} ',
                ],
            ]
        );

        $this->add_control(
            'wp_menu_submenu_animation_duration',
            [
                'label' => esc_html__( 'Duration', 'huger-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 's' ],
                'range' => [
                    's' => [
                        'min' => 0.1,
                        'max' => 5,
                        'step' => 0.1,
                    ],
                ],
                'default' => [
                    'unit' => 's',
                    'size' => 1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .mdp-huger-elementor-wp-menu-dropdown' => 'animation-duration: {{SIZE}}{{UNIT}}',
                ],
                'condition' => [
                    'wp_menu_submenu_animation!' => 'none'
                ],
            ]
        );

        $this->add_control(
            'wp_menu_submenu_animation_delay',
            [
                'label' => esc_html__( 'Delay', 'huger-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 's' ],
                'range' => [
                    's' => [
                        'min' => 0,
                        'max' => 5,
                        'step' => 0.1,
                    ],
                ],
                'default' => [
                    'unit' => 's',
                    'size' => 0,
                ],
                'selectors' => [
                    '{{WRAPPER}} .mdp-huger-elementor-wp-menu-dropdown' => 'animation-delay: {{SIZE}}{{UNIT}}',
                ],
                'condition' => [
                    'wp_menu_submenu_animation!' => 'none'
                ],
            ]
        );



        $this->end_controls_section();
    }


    /**
     * Add widget controls: Content -> Submenu Settings.
     *
     * @since 1.0.0
     * @access private
     *
     * @return void
     **/
    private function section_submenu_settings() {
        $this->start_controls_section( 'section_submenu_settings', [
            'label' => esc_html__( 'Submenu', 'huger-elementor' ),
            'tab'   => Controls_Manager::TAB_CONTENT
        ] );

        $this->add_control(
            'expand_menu_position_horizontal',
            [
                'label' => esc_html__( 'Expand menu position', 'huger-elementor' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'bottom',
                'options' => [
                    'top' => esc_html__( 'Top', 'huger-elementor' ),
                    'bottom' => esc_html__( 'Bottom', 'huger-elementor' ),
                ],
                'condition' => [
                    'menu_layout' => 'horizontal'
                ],
            ]
        );

        $this->add_control(
            'expand_menu_position_vertical',
            [
                'label' => esc_html__( 'Expand menu position', 'huger-elementor' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'right',
                'options' => [
                    'right' => esc_html__( 'Right', 'huger-elementor' ),
                    'left' => esc_html__( 'Left', 'huger-elementor' ),
                ],
                'condition' => [
                    'menu_layout' => 'vertical'
                ],
            ]
        );

        $this->add_control(
            'submenu_animation',
            [
                'label' => esc_html__( 'Animation', 'huger-elementor' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'none',
                'options' => [
                    'grow' => esc_html__( 'Grow', 'huger-elementor' ),
                    'shrink' => esc_html__( 'Shrink', 'huger-elementor' ),
                    'slide-up' => esc_html__( 'Slide up', 'huger-elementor' ),
                    'slide-down' => esc_html__( 'Slide down', 'huger-elementor' ),
                    'fade' => esc_html__( 'Fade', 'huger-elementor' ),
                    'none' => esc_html__( 'None', 'huger-elementor' ),
                ],
                'selectors' => [
                    '{{WRAPPER}} .mdp-huger-elementor-submenu' => 'animation: {{VALUE}} ',
                ],
            ]
        );

        $this->add_control(
            'submenu_animation_easing',
            [
                'label' => esc_html__( 'Easing', 'huger-elementor' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'ease',
                'options' => [
                    'ease' => esc_html__( 'Ease', 'huger-elementor' ),
                    'ease-in' => esc_html__( 'Ease-in', 'huger-elementor' ),
                    'ease-out' => esc_html__( 'Ease-out', 'huger-elementor' ),
                    'ease-in-out' => esc_html__( 'Ease-in-out', 'huger-elementor' ),
                    'linear' => esc_html__( 'Linear', 'huger-elementor' ),
                ],
                'condition' => [
                    'submenu_animation!' => 'none'
                ],
                'selectors' => [
                    '{{WRAPPER}} .mdp-huger-elementor-submenu' => 'animation-timing-function: {{VALUE}} ',
                ],
            ]
        );

        $this->add_control(
            'submenu_animation_duration',
            [
                'label' => esc_html__( 'Duration', 'huger-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 's' ],
                'range' => [
                    's' => [
                        'min' => 0.1,
                        'max' => 5,
                        'step' => 0.1,
                    ],
                ],
                'default' => [
                    'unit' => 's',
                    'size' => 1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .mdp-huger-elementor-submenu' => 'animation-duration: {{SIZE}}{{UNIT}}',
                ],
                'condition' => [
                    'submenu_animation!' => 'none'
                ],
            ]
        );

        $this->add_control(
            'submenu_animation_delay',
            [
                'label' => esc_html__( 'Delay', 'huger-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 's' ],
                'range' => [
                    's' => [
                        'min' => 0,
                        'max' => 5,
                        'step' => 0.1,
                    ],
                ],
                'default' => [
                    'unit' => 's',
                    'size' => 0,
                ],
                'selectors' => [
                    '{{WRAPPER}} .mdp-huger-elementor-submenu' => 'animation-delay: {{SIZE}}{{UNIT}}',
                ],
                'condition' => [
                    'submenu_animation!' => 'none'
                ],
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Function for generating margin padding controls.
     *
     * @param $section_id
     * @param $html_class
     * @return void
     * @since 1.0.0
     * @access private
     *
     */
    private function generate_margin_padding_controls( $section_id, $html_class ) {
        $this->add_responsive_control(
            $section_id.'_margin',
            [
                'label' => esc_html__( 'Margin', 'huger-elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'devices' => ['desktop', 'tablet', 'mobile'],
                'selectors' => [
                    "{{WRAPPER}} .$html_class" => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            $section_id.'_padding',
            [
                'label' => esc_html__( 'Padding', 'huger-elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'devices' => ['desktop', 'tablet', 'mobile'],
                'selectors' => [
                    "{{WRAPPER}} .$html_class" => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            $section_id.'_margin_padding_divider',
            [
                'type' => Controls_Manager::DIVIDER,
            ]
        );
    }


    /**
     * Function for generating typography and tabs controls.
     *
     * @param $section_id
     * @param $html_class
     * @param bool $include_color
     * @param bool $include_typography
     * @param bool $pointer_color
     * @param string $pointer_color_class
     * @param string $pointer_color_name
     * @param bool $include_bg
     * @param bool $active_tab
     * @param string $active_tab_class
     * @param string $pointer_color_condition
     * @param bool $wp_menu
     * @param string $special_color_class
     * @param string $active_color_class
     * @param string $aditional_color_selector
     * @param string $aditional_color_hover_selector
     * @param bool $include_bg_video
     * @param bool $additional_color
     * @param string $additional_color_class
     * @param string $additional_color_hover_class
     * @param string $additional_color_active_class
     * @param string $additional_color_name
     * @return void
     * @since 1.0.0
     * @access private
     */
    private function generate_typography_tabs_controls( $section_id, $html_class, $include_color = true, $include_typography = true, $pointer_color = false,
                                                        $pointer_color_class = '', $pointer_color_name = '', $include_bg = true, $active_tab = true, $active_tab_class = '',
                                                        $pointer_color_condition = '', $wp_menu = false, $special_color_class = '', $active_color_class = '', $aditional_color_selector = '',  $aditional_color_hover_selector = '',
                                                        $include_bg_video = true, $additional_color = false, $additional_color_class = '', $additional_color_hover_class = '', $additional_color_active_class = '',
                                                        $additional_color_name = '', $additional_bg_selector_hover = '' ) {

        $color_class = $special_color_class !== '' ? $special_color_class : $html_class;
        $background_types = $include_bg_video ? ['classic', 'gradient', 'video'] : ['classic', 'gradient'];

        if ( $include_typography ) {
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => $section_id . '_typography',
                    'label' => esc_html__('Typography', 'huger-elementor'),
                    'scheme' => Typography::TYPOGRAPHY_1,
                    'selector' => "{{WRAPPER}} .$html_class",
                ]
            );
        }

        $this->start_controls_tabs( $section_id.'_style_tabs' );

        $this->start_controls_tab( $section_id.'_normal_style_tab', ['label' => esc_html__( 'NORMAL', 'huger-elementor' )] );

        if ( $include_color ) {

            $this->add_control(
                $section_id . '_normal_text_color',
                [
                    'label' => esc_html__('Color', 'huger-elementor'),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Color::get_type(),
                        'value' => Color::COLOR_3,
                    ],
                    'selectors' => [
                        "{{WRAPPER}} .$color_class" => 'color: {{VALUE}}',
                        "$aditional_color_selector" => 'color: {{VALUE}}'
                    ],
                ]
            );

        }

        if ( $additional_color ) {
            $this->add_control(
                $section_id . '_'.$additional_color_name.'_normal_color',
                [
                    'label' => esc_html__($additional_color_name.' color', 'huger-elementor'),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Color::get_type(),
                        'value' => Color::COLOR_3,
                    ],
                    'selectors' => [
                        "{{WRAPPER}} .$additional_color_class" => 'color: {{VALUE}}',
                    ],
                ]
            );
        }

        if ( $include_bg ) {

            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => $section_id . '_normal_background',
                    'label' => esc_html__('Background type', 'huger-elementor'),
                    'types' => $background_types,
                    'selector' => "{{WRAPPER}} .$html_class",
                ]
            );

            $this->add_control(
                $section_id . '_separate_normal',
                [
                    'type' => Controls_Manager::DIVIDER,
                ]
            );
        }




        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => $section_id.'_border_normal',
                'label' => esc_html__( 'Border Type', 'huger-elementor' ),
                'selector' => "{{WRAPPER}} .$html_class",
            ]
        );

        $this->add_responsive_control(
            $section_id.'_border_radius_normal',
            [
                'label' => esc_html__( 'Border radius', 'huger-elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    "{{WRAPPER}} .$html_class" => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => $section_id.'_box_shadow_normal',
                'label' => esc_html__( 'Box Shadow', 'huger-elementor' ),
                'selector' => "{{WRAPPER}} .$html_class",
            ]
        );


        $this->end_controls_tab();

        $this->start_controls_tab( $section_id.'_hover_style_tab', ['label' => esc_html__( 'HOVER', 'huger-elementor' )] );

        if ( $include_color ) {
            $this->add_control(
                $section_id . '_hover_color',
                [
                    'label' => esc_html__('Color', 'huger-elementor'),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Color::get_type(),
                        'value' => Color::COLOR_3,
                    ],
                    'selectors' => [
                        "{{WRAPPER}} .$color_class:hover" => 'color: {{VALUE}}',
                        "$aditional_color_hover_selector" => 'color: {{VALUE}}'
                    ],
                ]
            );
        }

        if ( $additional_color ) {
            $this->add_control(
                $section_id . '_'.$additional_color_name.'_hover_color',
                [
                    'label' => esc_html__($additional_color_name.' color', 'huger-elementor'),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Color::get_type(),
                        'value' => Color::COLOR_3,
                    ],
                    'selectors' => [
                        "{{WRAPPER}} .$additional_color_hover_class" => 'color: {{VALUE}}',
                    ],
                ]
            );
        }

        if ( $pointer_color ) {

            $selectors = $wp_menu ? [
                "{{WRAPPER}} .$pointer_color_class-underline > li:hover::after" => 'background-color: {{VALUE}}',
                "{{WRAPPER}} .$pointer_color_class-overline > li:hover::after" => 'background-color: {{VALUE}}',
                "{{WRAPPER}} .$pointer_color_class-double-line > li:hover::after" => 'background-color: {{VALUE}}',
                "{{WRAPPER}} .$pointer_color_class-double-line > li:hover::before" => 'background-color: {{VALUE}}',
                "{{WRAPPER}} .$pointer_color_class-framed > li:hover::before" => 'border-color: {{VALUE}}',
            ] : [
                "{{WRAPPER}} .$pointer_color_class-underline:hover::after" => 'background-color: {{VALUE}}',
                "{{WRAPPER}} .$pointer_color_class-overline:hover::after" => 'background-color: {{VALUE}}',
                "{{WRAPPER}} .$pointer_color_class-double-line:hover::after" => 'background-color: {{VALUE}}',
                "{{WRAPPER}} .$pointer_color_class-double-line:hover::before" => 'background-color: {{VALUE}}',
                "{{WRAPPER}} .$pointer_color_class-framed:hover::before" => 'border-color: {{VALUE}}',
            ];

            $this->add_control(
                $section_id . '_pointer_color',
                [
                    'label' => esc_html__('Pointer Color', 'huger-elementor'),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Color::get_type(),
                        'value' => Color::COLOR_3,
                    ],
                    'condition' => [
                        "$pointer_color_condition!" => [ 'none' ]
                    ],
                    'selectors' => $selectors,
                ]
            );

        }

        if ( $include_bg ) {

            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => $section_id . '_background_hover',
                    'label' => esc_html__('Background type', 'huger-elementor'),
                    'types' => $background_types,
                    'selector' => "{{WRAPPER}} .$html_class:hover, {{WRAPPER}} .$additional_bg_selector_hover",
                ]
            );

            $this->add_control(
                $section_id.'_separate_hover',
                [
                    'type' => Controls_Manager::DIVIDER,
                ]
            );
        }


        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => $section_id.'_border_hover',
                'label' => esc_html__( 'Border Type', 'huger-elementor' ),
                'selector' => "{{WRAPPER}} .$html_class:hover",
            ]
        );

        $this->add_responsive_control(
            $section_id.'_border_radius_hover',
            [
                'label' => esc_html__( 'Border radius', 'huger-elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    "{{WRAPPER}} .$html_class:hover" => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => $section_id.'_box_shadow_hover',
                'label' => esc_html__( 'Box Shadow', 'huger-elementor' ),
                'selector' => "{{WRAPPER}} .$html_class:hover",
            ]
        );

        $this->end_controls_tab();

        if ( $active_tab ) {

            $active_color_class = $active_color_class === '' ? $active_tab_class : $active_color_class;

            $this->start_controls_tab($section_id . '_active_style_tab', ['label' => esc_html__('Active', 'huger-elementor')]);

            if ($include_color) {
                $this->add_control(
                    $section_id . '_active_color',
                    [
                        'label' => esc_html__('Color', 'huger-elementor'),
                        'type' => Controls_Manager::COLOR,
                        'scheme' => [
                            'type' => Color::get_type(),
                            'value' => Color::COLOR_3,
                        ],
                        'selectors' => [
                            "{{WRAPPER}} .$active_color_class" => 'color: {{VALUE}} ',
                        ],
                    ]
                );
            }

            if ( $additional_color ) {
                $this->add_control(
                    $section_id . '_'.$additional_color_name.'_active_color',
                    [
                        'label' => esc_html__($additional_color_name.' color', 'huger-elementor'),
                        'type' => Controls_Manager::COLOR,
                        'scheme' => [
                            'type' => Color::get_type(),
                            'value' => Color::COLOR_3,
                        ],
                        'selectors' => [
                            "{{WRAPPER}} .$additional_color_active_class" => 'color: {{VALUE}}',
                        ],
                    ]
                );
            }

            if ($include_bg) {

                $this->add_group_control(
                    Group_Control_Background::get_type(),
                    [
                        'name' => $section_id . '_background_active',
                        'label' => esc_html__('Background type', 'huger-elementor'),
                        'types' => $background_types,
                        'selector' => "{{WRAPPER}} .$active_tab_class",
                    ]
                );

                $this->add_control(
                    $section_id . '_separate_active',
                    [
                        'type' => Controls_Manager::DIVIDER,
                    ]
                );
            }


            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => $section_id . '_border_active',
                    'label' => esc_html__('Border Type', 'huger-elementor'),
                    'selector' => "{{WRAPPER}} .$active_tab_class",
                ]
            );

            $this->add_responsive_control(
                $section_id . '_border_radius_active',
                [
                    'label' => esc_html__('Border radius', 'huger-elementor'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%', 'em'],
                    'selectors' => [
                        "{{WRAPPER}} .$active_tab_class" => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => $section_id . '_box_shadow_active',
                    'label' => esc_html__('Box Shadow', 'huger-elementor'),
                    'selector' => "{{WRAPPER}} .$active_tab_class",
                ]
            );

            $this->end_controls_tab();
        }

        $this->end_controls_tabs();
    }

    /**
     * Add widget controls: Style -> Section Menu Item Style.
     *
     * @since 1.0.0
     * @access private
     *
     * @return void
     **/
    private function section_style_menu_item() {

        $this->start_controls_section( 'section_style_menu_item', [
            'label' => esc_html__( 'Menu item', 'huger-elementor' ),
            'tab'   => Controls_Manager::TAB_STYLE
        ] );

        $this->generate_margin_padding_controls( 'section_style_menu_item', 'mdp-huger-elementor-main-nav > .mdp-huger-elementor-mega-menu-item > .mdp-huger-elementor-mega-menu-item-text' );

        $this->add_control(
            'submenu_indicator_color_menu',
            [
                'label' => esc_html__( 'Indicator color', 'huger-elementor' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Color::get_type(),
                    'value' => Color::COLOR_3,
                ],
                'selectors' => [
                    '{{WRAPPER}} .mdp-huger-elementor-main-nav > .mdp-huger-elementor-mega-menu-item .mdp-huger-elementor-submenu-indicator' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'menu_indicator_spacing',
            [
                'label' => esc_html__( 'Indicator spacing', 'huger-elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'devices' => ['desktop', 'tablet', 'mobile'],
                'selectors' => [
                    '{{WRAPPER}} .mdp-huger-elementor-main-nav > .mdp-huger-elementor-mega-menu-item > .mdp-huger-elementor-mega-menu-item-text-wrapper > .mdp-huger-elementor-submenu-indicator' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .mdp-huger-elementor-main-nav > .mdp-huger-elementor-mega-menu-item > .mdp-huger-elementor-menu-link > .mdp-huger-elementor-submenu-indicator' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'menu_indicator_click_area',
            [
                'label' => esc_html__( 'Indicator click area', 'huger-elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'devices' => ['desktop', 'tablet', 'mobile'],
                'selectors' => [
                    '{{WRAPPER}} .mdp-huger-elementor-main-nav > .mdp-huger-elementor-mega-menu-item > .mdp-huger-elementor-mega-menu-item-text-wrapper > .mdp-huger-elementor-submenu-indicator' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .mdp-huger-elementor-main-nav > .mdp-huger-elementor-mega-menu-item > .mdp-huger-elementor-menu-link > .mdp-huger-elementor-submenu-indicator' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'submenu_indicator_size_menu',
            [
                'label' => esc_html__( 'Submenu indicator size', 'huger-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 20,
                ],
                'selectors' => [
                    '{{WRAPPER}} .mdp-huger-elementor-main-nav > .mdp-huger-elementor-mega-menu-item > .mdp-huger-elementor-mega-menu-item-text-wrapper > .mdp-huger-elementor-submenu-indicator' => 'font-size: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .mdp-huger-elementor-main-nav > .mdp-huger-elementor-mega-menu-item > .mdp-huger-elementor-mega-menu-item-text-wrapper > .mdp-huger-elementor-submenu-indicator svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .mdp-huger-elementor-main-nav > .mdp-huger-elementor-mega-menu-item > .mdp-huger-elementor-menu-link > .mdp-huger-elementor-submenu-indicator' => 'font-size: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .mdp-huger-elementor-main-nav > .mdp-huger-elementor-mega-menu-item > .mdp-huger-elementor-menu-link > .mdp-huger-elementor-submenu-indicator svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',

                ],
            ]
        );

        $this->add_responsive_control(
            'submenu_indicator_rotation',
            [
                'label' => esc_html__( 'Submenu indicator rotation', 'huger-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'deg' ],
                'range' => [
                    'deg' => [
                        'min' => -360,
                        'max' => 360,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'deg',
                    'size' => 0,
                ],
                'selectors' => [
                    '{{WRAPPER}} .mdp-huger-elementor-main-nav > .mdp-huger-elementor-mega-menu-item > .mdp-huger-elementor-mega-menu-item-text-wrapper > .mdp-huger-elementor-submenu-indicator' => 'transform: rotate({{SIZE}}{{UNIT}})',
                    '{{WRAPPER}} .mdp-huger-elementor-main-nav > .mdp-huger-elementor-mega-menu-item > .mdp-huger-elementor-menu-link > .mdp-huger-elementor-submenu-indicator' => 'transform: rotate({{SIZE}}{{UNIT}})',

                ],
            ]
        );

        $this->add_control(
            'divider_submenu_indicator_size',
            [
                'type' => Controls_Manager::DIVIDER,
            ]
        );

        $this->add_responsive_control(
            'menu_icon_spacing',
            [
                'label' => esc_html__( 'Icon spacing', 'huger-elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'devices' => ['desktop', 'tablet', 'mobile'],
                'selectors' => [
                    '{{WRAPPER}} .mdp-huger-elementor-main-nav > .mdp-huger-elementor-mega-menu-item > .mdp-huger-elementor-mega-menu-item-text-wrapper > .mdp-huger-elementor-mega-menu-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .mdp-huger-elementor-main-nav > .mdp-huger-elementor-mega-menu-item > .mdp-huger-elementor-menu-link > .mdp-huger-elementor-mega-menu-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'menu_icon_size',
            [
                'label' => esc_html__( 'Icon size', 'huger-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 20,
                ],
                'selectors' => [
                    '{{WRAPPER}} .mdp-huger-elementor-main-nav > .mdp-huger-elementor-mega-menu-item > .mdp-huger-elementor-mega-menu-item-text-wrapper > .mdp-huger-elementor-mega-menu-icon' => 'font-size: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .mdp-huger-elementor-main-nav > .mdp-huger-elementor-mega-menu-item > .mdp-huger-elementor-mega-menu-item-text-wrapper > .mdp-huger-elementor-mega-menu-icon svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .mdp-huger-elementor-main-nav > .mdp-huger-elementor-mega-menu-item > .mdp-huger-elementor-menu-link > .mdp-huger-elementor-mega-menu-icon' => 'font-size: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .mdp-huger-elementor-main-nav > .mdp-huger-elementor-mega-menu-item > .mdp-huger-elementor-menu-link > .mdp-huger-elementor-mega-menu-icon svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',

                ],
            ]
        );

        $this->add_control(
            'divider_menu_icon',
            [
                'type' => Controls_Manager::DIVIDER,
            ]
        );

        $this->add_responsive_control(
            'space_between_menu_items',
            [
                'label' => esc_html__( 'Space between items', 'huger-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .mdp-huger-elementor-mega-menu-item' => 'margin-right: calc({{SIZE}}{{UNIT}} / 2); margin-left: calc({{SIZE}}{{UNIT}} / 2);',
                    '{{WRAPPER}} .mdp-huger-elementor-mega-menu-item:first-child' => 'margin-left: calc({{SIZE}}{{UNIT}} * 0);',
                    '{{WRAPPER}} .mdp-huger-elementor-mega-menu-item:last-child' => 'margin-right: calc({{SIZE}}{{UNIT}} * 0);',
                    '{{WRAPPER}} .mdp-huger-elementor-main-nav-vertical .mdp-huger-elementor-mega-menu-item' => 'margin-right: 0; margin-left: 0; margin-top: calc({{SIZE}}{{UNIT}} / 2); margin-bottom: calc({{SIZE}}{{UNIT}} / 2);',
                    '{{WRAPPER}} .mdp-huger-elementor-main-nav-vertical .mdp-huger-elementor-mega-menu-item:first-child' => 'margin-top: calc({{SIZE}}{{UNIT}} * 0);',
                    '{{WRAPPER}} .mdp-huger-elementor-main-nav-vertical .mdp-huger-elementor-mega-menu-item:last-child' => 'margin-bottom: calc({{SIZE}}{{UNIT}} * 0);',
                    '{{WRAPPER}} .mdp-huger-elementor-mega-menu-wrapper-mobile .mdp-huger-elementor-mega-menu-item' => 'margin-right: 0; margin-left: 0; margin-top: calc({{SIZE}}{{UNIT}} / 2); margin-bottom: calc({{SIZE}}{{UNIT}} / 2);',
                    '{{WRAPPER}} .mdp-huger-elementor-mega-menu-wrapper-mobile .mdp-huger-elementor-mega-menu-item:first-child' => 'margin-top: calc({{SIZE}}{{UNIT}} * 0);',
                    '{{WRAPPER}} .mdp-huger-elementor-mega-menu-wrapper-mobile .mdp-huger-elementor-mega-menu-item:last-child' => 'margin-bottom: calc({{SIZE}}{{UNIT}} * 0);'
                ]
            ]
        );

        $this->add_control(
            'divider_space_between_menu_items',
            [
                'type' => Controls_Manager::DIVIDER,
            ]
        );

        $this->generate_typography_tabs_controls( 'section_style_menu_item', 'mdp-huger-elementor-main-nav > .mdp-huger-elementor-mega-menu-item > .mdp-huger-elementor-mega-menu-item-text', true, true,
            true, 'mdp-huger-elementor-main-nav > .mdp-huger-elementor-main-menu--item', 'Pointer', true, true,
            'mdp-huger-elementor-main-nav > .mdp-huger-elementor-mega-menu-item-current', 'pointer' , false,
            'mdp-huger-elementor-main-nav > .mdp-huger-elementor-mega-menu-item .mdp-huger-elementor-mega-menu-title', 'mdp-huger-elementor-mega-menu-item-current > .mdp-huger-elementor-menu-link > .mdp-huger-elementor-mega-menu-title',
            '{{WRAPPER}} .mdp-huger-elementor-mega-menu-item .mdp-huger-elementor-menu-link .mdp-huger-elementor-mega-menu-title', '{{WRAPPER}} .mdp-huger-elementor-mega-menu-item:hover .mdp-huger-elementor-mega-menu-title', false,
            true, 'mdp-huger-elementor-mega-menu-icon', 'mdp-huger-elementor-mega-menu-item:hover .mdp-huger-elementor-mega-menu-icon',
            'mdp-huger-elementor-mega-menu-item-current > .mdp-huger-elementor-menu-link > .mdp-huger-elementor-mega-menu-icon', 'Icon',
            'mdp-huger-elementor-mega-menu-item:hover > .mdp-huger-elementor-mega-menu-item-text-wrapper' );

        $this->end_controls_section();

    }

    /**
     * Add widget controls: Style -> Section Submenu Style.
     *
     * @since 1.0.0
     * @access private
     *
     * @return void
     **/
    private function section_style_submenu() {

        $this->start_controls_section('section_style_submenu', [
            'label' => esc_html__('Submenu', 'huger-elementor'),
            'tab' => Controls_Manager::TAB_STYLE
        ]);

        $this->generate_margin_padding_controls( 'section_style_submenu', 'mdp-huger-elementor-submenu' );
        $this->add_responsive_control(
            'submenu_offset_x',
            [
                'label' => esc_html__( 'Offset - X', 'huger-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => -500,
                        'max' => 500,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1
                    ],
                ],

        'selectors' => [
                    '{{WRAPPER}} .mdp-huger-elementor-main-nav-horizontal.mdp-huger-elementor-main-nav-submenu-expand-top .mdp-huger-elementor-submenu, {{WRAPPER}} .mdp-huger-elementor-main-nav-horizontal.mdp-huger-elementor-main-nav-submenu-expand-bottom .mdp-huger-elementor-submenu' => 'left: {{SIZE}}{{UNIT}}',
                    '{{WRAPPER}} .mdp-huger-elementor-main-nav-vertical.mdp-huger-elementor-main-nav-submenu-expand-left  .mdp-huger-elementor-submenu' => 'left: {{SIZE}}{{UNIT}}; right: auto;',
                    '{{WRAPPER}} .mdp-huger-elementor-main-nav-vertical.mdp-huger-elementor-main-nav-submenu-expand-right .mdp-huger-elementor-submenu' => 'right: {{SIZE}}{{UNIT}}; left: auto;'
                ],

            ]
        );


        $this->add_responsive_control(
            'submenu_offset_y',
            [
                'label' => esc_html__( 'Offset - Y', 'huger-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => -150,
                        'max' => 150,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .mdp-huger-elementor-main-nav-submenu-expand-right .mdp-huger-elementor-submenu, {{WRAPPER}} .mdp-huger-elementor-main-nav-submenu-expand-left  .mdp-huger-elementor-submenu' => 'top: {{SIZE}}{{UNIT}} !important; bottom: auto;',
                    '{{WRAPPER}} .mdp-huger-elementor-main-nav-submenu-expand-top .mdp-huger-elementor-submenu' => 'bottom: {{SIZE}}{{UNIT}} !important; top: auto;',
                    '{{WRAPPER}} .mdp-huger-elementor-main-nav-submenu-expand-bottom .mdp-huger-elementor-submenu' => 'top: {{SIZE}}{{UNIT}} !important; bottom: auto',
                ],
            ]
        );

        $this->add_responsive_control(
            'submenu_width',
            [
                'label' => esc_html__( 'Submenu width', 'huger-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'vh', 'vw' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 5,
                    ],
                    'vh' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'vw' => [
                        'min' => 0,
                        'max' => 100,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .mdp-huger-elementor-submenu' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'divider_submenu_offset',
            [
                'type' => Controls_Manager::DIVIDER,
            ]
        );


        $this->generate_typography_tabs_controls( 'section_style_submenu', 'mdp-huger-elementor-submenu', false, false,
            false, '', '', true, false );

        $this->end_controls_section();

    }

    /**
     * Add widget controls: Style -> Section WP Menu Item Style.
     *
     * @since 1.0.0
     * @access private
     *
     * @return void
     **/
    private function section_style_wp_menu_item() {

        $this->start_controls_section( 'section_style_wp_menu_item', [
            'label' => esc_html__( 'WP menu item', 'huger-elementor' ),
            'tab'   => Controls_Manager::TAB_STYLE
        ] );

        $this->generate_margin_padding_controls( 'section_style_wp_menu_item', 'mdp-huger-elementor-wp-menu > .mdp-huger-elementor-wp-menu-item > .mdp-huger-elementor-wp-menu-text-wrapper' );


        $this->add_control(
            'submenu_indicator_color_wp_menu',
            [
                'label' => esc_html__( 'Indicator color', 'huger-elementor' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Color::get_type(),
                    'value' => Color::COLOR_3,
                ],
                'selectors' => [
                    '{{WRAPPER}} .mdp-huger-elementor-wp-menu > .mdp-huger-elementor-wp-menu-item > .mdp-huger-wp-menu-submenu-indicator' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'wp_menu_indicator_spacing',
            [
                'label' => esc_html__( 'Indicator spacing', 'huger-elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'devices' => ['desktop', 'tablet', 'mobile'],
                'selectors' => [
                    '{{WRAPPER}} .mdp-huger-elementor-wp-menu > .mdp-huger-elementor-wp-menu-item > .mdp-huger-wp-menu-submenu-indicator' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'wp_menu_indicator_click_area',
            [
                'label' => esc_html__( 'Indicator click area', 'huger-elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'devices' => ['desktop', 'tablet', 'mobile'],
                'selectors' => [
                    '{{WRAPPER}} .mdp-huger-elementor-wp-menu > .mdp-huger-elementor-wp-menu-item > .mdp-huger-wp-menu-submenu-indicator' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'submenu_indicator_size_wp_menu',
            [
                'label' => esc_html__( 'Submenu indicator size', 'huger-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 20,
                ],
                'selectors' => [
                    '{{WRAPPER}} .mdp-huger-elementor-wp-menu > .mdp-huger-elementor-wp-menu-item > .mdp-huger-wp-menu-submenu-indicator' => 'font-size: {{SIZE}}{{UNIT}}'
                ],
            ]
        );

        $this->add_responsive_control(
            'wp_submenu_indicator_rotation',
            [
                'label' => esc_html__( 'Submenu indicator rotation', 'huger-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'deg' ],
                'range' => [
                    'deg' => [
                        'min' => -360,
                        'max' => 360,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'deg',
                    'size' => 0,
                ],
                'selectors' => [
                    '{{WRAPPER}} .mdp-huger-elementor-wp-menu > .mdp-huger-elementor-wp-menu-item > .mdp-huger-wp-menu-submenu-indicator' => 'transform: rotate({{SIZE}}{{UNIT}})',
                ],
            ]
        );

        $this->add_control(
            'divider_wp_menu_submenu_indicator_size',
            [
                'type' => Controls_Manager::DIVIDER,
            ]
        );

        $this->add_responsive_control(
            'space_between_wp_menu_items_horizontal',
            [
                'label' => esc_html__( 'Space between items', 'huger-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .mdp-huger-elementor-wp-menu > .mdp-huger-elementor-wp-menu-item' => 'margin-right: calc({{SIZE}}{{UNIT}} / 2); margin-left: calc({{SIZE}}{{UNIT}} / 2);',
                    '{{WRAPPER}} .mdp-huger-elementor-wp-menu > .mdp-huger-elementor-wp-menu-item:first-child' => 'margin-left: calc({{SIZE}}{{UNIT}} * 0);',
                    '{{WRAPPER}} .mdp-huger-elementor-wp-menu > .mdp-huger-elementor-wp-menu-item:last-child' => 'margin-right: calc({{SIZE}}{{UNIT}} * 0);',
                    '{{WRAPPER}} .mdp-huger-elementor-wp-menu.mdp-huger-elementor-wp-menu-vertical > .mdp-huger-elementor-wp-menu-item' => 'margin-right: 0; margin-left: 0; margin-top: calc({{SIZE}}{{UNIT}} / 2); margin-bottom: calc({{SIZE}}{{UNIT}} / 2);',
                    '{{WRAPPER}} .mdp-huger-elementor-wp-menu.mdp-huger-elementor-wp-menu-vertical > .mdp-huger-elementor-wp-menu-item:first-child' => 'margin-top: calc({{SIZE}}{{UNIT}} * 0);',
                    '{{WRAPPER}} .mdp-huger-elementor-wp-menu.mdp-huger-elementor-wp-menu-vertical > .mdp-huger-elementor-wp-menu-item:last-child' => 'margin-bottom: calc({{SIZE}}{{UNIT}} * 0);',
                    '{{WRAPPER}} .mdp-huger-elementor-wp-menu-wrapper--mobile.mdp-huger-elementor-wp-menu > .mdp-huger-elementor-wp-menu-item' => 'margin-right: 0; margin-left: 0; margin-top: calc({{SIZE}}{{UNIT}} / 2); margin-bottom: calc({{SIZE}}{{UNIT}} / 2);',
                    '{{WRAPPER}} .mdp-huger-elementor-wp-menu-wrapper--mobile.mdp-huger-elementor-wp-menu > .mdp-huger-elementor-wp-menu-item:first-child' => 'margin-top: calc({{SIZE}}{{UNIT}} * 0);',
                    '{{WRAPPER}} .mdp-huger-elementor-wp-menu-wrapper--mobile.mdp-huger-elementor-wp-menu > .mdp-huger-elementor-wp-menu-item:last-child' => 'margin-bottom: calc({{SIZE}}{{UNIT}} * 0);'
                ]
            ]
        );

        $this->add_control(
            'divider_space_between_wp_menu_items',
            [
                'type' => Controls_Manager::DIVIDER,
            ]
        );

        $this->generate_typography_tabs_controls( 'section_style_wp_menu_item', 'mdp-huger-elementor-wp-menu > .mdp-huger-elementor-wp-menu-item > .mdp-huger-elementor-wp-menu-text-wrapper', true, true,
            true, 'mdp-huger-elementor-wp-menu', 'Pointer', true, true, 'mdp-huger-elementor-wp-menu > .mdp-huger-elementor-wp-menu-item-active > .mdp-huger-elementor-wp-menu-text-wrapper', 'wp_menu_pointer', true,
            'mdp-huger-elementor-wp-menu > .mdp-huger-elementor-wp-menu-item a',
            'mdp-huger-elementor-wp-menu > .mdp-huger-elementor-wp-menu-item-active > .mdp-huger-elementor-wp-menu-text-wrapper > a', '',
            '{{WRAPPER}} .mdp-huger-elementor-wp-menu > .mdp-huger-elementor-wp-menu-item:hover > .mdp-huger-elementor-wp-menu-text-wrapper > a', false,
            false, '', '', '', '', 'mdp-huger-elementor-wp-menu > .mdp-huger-elementor-wp-menu-item:hover > .mdp-huger-elementor-wp-menu-text-wrapper');

        $this->end_controls_section();

    }


    /**
     * Add widget controls: Style -> Section WP Menu Submenu Style.
     *
     * @since 1.0.0
     * @access private
     *
     * @return void
     **/
    private function section_style_wp_menu_submenu() {

        $this->start_controls_section('section_style_wp_menu_submenu', [
            'label' => esc_html__('WP menu submenu', 'huger-elementor'),
            'tab' => Controls_Manager::TAB_STYLE
        ]);

        $this->generate_margin_padding_controls( 'section_style_wp_menu_submenu', 'mdp-huger-elementor-wp-menu-dropdown' );
        $this->add_responsive_control(
            'wp_menu_submenu_offset_x',
            [
                'label' => esc_html__( 'Offset - X', 'huger-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => -500,
                        'max' => 500,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .mdp-huger-elementor-wp-menu-horizontal.mdp-huger-elementor-wp-menu-submenu-expand-top .mdp-huger-elementor-wp-menu-dropdown, {{WRAPPER}} .mdp-huger-elementor-wp-menu-horizontal.mdp-huger-elementor-wp-menu-submenu-expand-bottom .mdp-huger-elementor-wp-menu-dropdown' => 'left: {{SIZE}}{{UNIT}} !important',
                    '{{WRAPPER}} .mdp-huger-elementor-wp-menu-vertical.mdp-huger-elementor-wp-menu-submenu-expand-left  .mdp-huger-elementor-wp-menu-dropdown' => 'left: {{SIZE}}{{UNIT}} !important; right: auto;',
                    '{{WRAPPER}} .mdp-huger-elementor-wp-menu-vertical.mdp-huger-elementor-wp-menu-submenu-expand-right .mdp-huger-elementor-wp-menu-dropdown' => 'right: {{SIZE}}{{UNIT}} !important; left: auto;'
                ],
            ]
        );

        $this->add_responsive_control(
            'wp_menu_submenu_offset_y',
            [
                'label' => esc_html__( 'Offset - Y', 'huger-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => -150,
                        'max' => 150,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .mdp-huger-elementor-wp-menu-submenu-expand-right .mdp-huger-elementor-wp-menu-dropdown, {{WRAPPER}} .mdp-huger-elementor-wp-menu-submenu-expand-left .mdp-huger-elementor-wp-menu-dropdown' => 'top: {{SIZE}}{{UNIT}} !important; bottom: auto;',
                    '{{WRAPPER}} .mdp-huger-elementor-wp-menu-submenu-expand-top .mdp-huger-elementor-wp-menu-dropdown' => 'bottom: {{SIZE}}{{UNIT}} !important; top: auto;',
                    '{{WRAPPER}} .mdp-huger-elementor-wp-menu-submenu-expand-bottom  .mdp-huger-elementor-wp-menu-dropdown' => 'top: {{SIZE}}{{UNIT}} !important; bottom: auto',
                ],
            ]
        );

        $this->add_control(
            'divider_wp_menu_submenu_offset',
            [
                'type' => Controls_Manager::DIVIDER,
            ]
        );


        $this->generate_typography_tabs_controls( 'section_style_wp_menu_submenu', 'mdp-huger-elementor-wp-menu-dropdown', false, false,
            false, '', '', true, false );

        $this->end_controls_section();

    }

    /**
     * Add widget controls: Style -> Section Submenu Item Style.
     *
     * @since 1.0.0
     * @access private
     *
     * @return void
     **/
    private function section_style_wp_menu_submenu_item() {
        $this->start_controls_section('section_style_wp_menu_submenu_item', [
            'label' => esc_html__('WP menu submenu item', 'huger-elementor'),
            'tab' => Controls_Manager::TAB_STYLE
        ]);

        $this->generate_margin_padding_controls( 'section_style_wp_menu_submenu_item', 'mdp-huger-elementor-wp-menu-dropdown .mdp-huger-elementor-wp-menu-item > .mdp-huger-elementor-wp-menu-text-wrapper' );

        $this->add_control(
            'indicator_color',
            [
                'label' => esc_html__("Indicator color", 'huger-elementor'),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Color::get_type(),
                    'value' => Color::COLOR_3,
                ],
                'selectors' => [
                    "{{WRAPPER}} .mdp-huger-elementor-wp-menu-dropdown .mdp-huger-wp-menu-submenu-indicator" => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'indicator_spacing',
            [
                'label' => esc_html__( 'Indicator spacing', 'huger-elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'devices' => ['desktop', 'tablet', 'mobile'],
                'selectors' => [
                    "{{WRAPPER}} .mdp-huger-elementor-wp-menu-dropdown .mdp-huger-wp-menu-submenu-indicator" => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'wp_menu_submenu_indicator_click_area',
            [
                'label' => esc_html__( 'Indicator click area', 'huger-elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'devices' => ['desktop', 'tablet', 'mobile'],
                'selectors' => [
                    '{{WRAPPER}} .mdp-huger-elementor-wp-menu-dropdown .mdp-huger-wp-menu-submenu-indicator' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'submenu_indicator_size_wp_menu_submenu',
            [
                'label' => esc_html__( 'Submenu indicator size', 'huger-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 20,
                ],
                'selectors' => [
                    '{{WRAPPER}} .mdp-huger-elementor-wp-menu-dropdown .mdp-huger-wp-menu-submenu-indicator' => 'font-size: {{SIZE}}{{UNIT}}'
                ],
            ]
        );

        $this->add_responsive_control(
            'wp_menu_submenu_indicator_rotation',
            [
                'label' => esc_html__( 'Submenu indicator rotation', 'huger-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'deg' ],
                'range' => [
                    'deg' => [
                        'min' => -360,
                        'max' => 360,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'deg',
                    'size' => 0,
                ],
                'selectors' => [
                    '{{WRAPPER}} .mdp-huger-elementor-wp-menu-dropdown .mdp-huger-wp-menu-submenu-indicator' => 'transform: rotate({{SIZE}}{{UNIT}})',
                ],
            ]
        );

        $this->add_control(
            'divider_space_between_wp_menu_submenu_items',
            [
                'type' => Controls_Manager::DIVIDER,
            ]
        );

        $this->generate_typography_tabs_controls( 'section_style_submenu_item', 'mdp-huger-elementor-wp-menu-dropdown .mdp-huger-elementor-wp-menu-item > .mdp-huger-elementor-wp-menu-text-wrapper', true, true, true, 'mdp-huger-elementor-wp-menu-submenu',
            'Pointer', true,  true, 'mdp-huger-elementor-wp-menu-dropdown > .mdp-huger-elementor-wp-menu-item-active',
            'wp_menu_submenu_pointer', true, 'mdp-huger-elementor-wp-menu-dropdown .mdp-huger-elementor-wp-menu-item a',
            'mdp-huger-elementor-wp-menu-dropdown > .mdp-huger-elementor-wp-menu-item-active > .mdp-huger-elementor-wp-menu-text-wrapper > a', '',
            '{{WRAPPER}} .mdp-huger-elementor-wp-menu-dropdown > .mdp-huger-elementor-wp-menu-item:hover > .mdp-huger-elementor-wp-menu-text-wrapper > a',
            false, '', '', '', '', '', 'mdp-huger-elementor-wp-menu-dropdown > .mdp-huger-elementor-wp-menu-item:hover > .mdp-huger-elementor-wp-menu-text-wrapper ' );

        $this->end_controls_section();

    }

    /**
     * Add widget controls: Style -> Section Toggle Style.
     *
     * @since 1.0.0
     * @access private
     *
     * @return void
     **/
    private function section_style_toggle() {
        $this->start_controls_section('section_style_toggle', [
            'label' => esc_html__('Toggle style', 'huger-elementor'),
            'tab' => Controls_Manager::TAB_STYLE
        ]);

        $this->generate_margin_padding_controls( 'section_style_toggle', 'mdp-huger-elementor-toggle-icon' );

        $this->add_control(
            'toggle_size',
            [
                'label' => esc_html__( 'Toggle size', 'huger-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    's' => [
                        'min' => 1,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 20,
                ],
                'selectors' => [
                    '{{WRAPPER}} .mdp-huger-elementor-toggle-icon' => 'font-size: {{SIZE}}{{UNIT}}'
                ],
            ]
        );

        $this->generate_typography_tabs_controls( 'section_style_toggle', 'mdp-huger-elementor-toggle-icon', true, true, false, '', '', '', false );

        $this->end_controls_section();
    }

    /**
     * Add widget controls: Style -> Section Close Toggle Style.
     *
     * @since 1.0.0
     * @access private
     *
     * @return void
     **/
    private function section_style_close_toggle() {
        $this->start_controls_section('section_style_close_toggle', [
            'label' => esc_html__('Close toggle style', 'huger-elementor'),
            'tab' => Controls_Manager::TAB_STYLE
        ]);

        $this->generate_margin_padding_controls( 'section_style_close_toggle', 'mdp-huger-elementor-toggle-close-icon' );

        $this->add_control(
            'close_toggle_size',
            [
                'label' => esc_html__( 'Close toggle size', 'huger-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    's' => [
                        'min' => 1,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 20,
                ],
                'selectors' => [
                    '{{WRAPPER}} .mdp-huger-elementor-toggle-close-icon' => 'font-size: {{SIZE}}{{UNIT}}'
                ],
            ]
        );

        $this->generate_typography_tabs_controls( 'section_style_close_toggle', 'mdp-huger-elementor-toggle-close-icon', true, true, false, '', '', '', false );


        $this->end_controls_section();
    }


    /**
     * Add widget controls: Style -> Section Mobile Menu Style.
     *
     * @since 1.0.0
     * @access private
     *
     * @return void
     **/
    private function section_style_mobile_menu() {
        $this->start_controls_section('section_style_mobile_menu', [
            'label' => esc_html__('Mobile menu', 'huger-elementor'),
            'tab' => Controls_Manager::TAB_STYLE
        ]);


        $this->add_responsive_control(
            'mobile_menu_padding',
            [
                'label' => esc_html__( 'Padding', 'huger-elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'devices' => ['desktop', 'tablet', 'mobile'],
                'separator' => 'after',
                'selectors' => [
                    '{{WRAPPER}} .mdp-huger-elementor-mega-menu-wrapper-mobile' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'mobile_menu_background',
                'label' => esc_html__( 'Background type', 'huger-elementor' ),
                'types' => [ 'classic', 'gradient', 'video' ],
                'selector' => '{{WRAPPER}} .mdp-huger-elementor-mega-menu-wrapper-mobile',
            ]
        );


        $this->add_control(
            'separate_background_mobile_menu',
            [
                'type' => Controls_Manager::DIVIDER,
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'mobile_menu_item_border',
                'label' => esc_html__( 'Border Type', 'huger-elementor' ),
                'selector' => '{{WRAPPER}} .mdp-huger-elementor-mega-menu-wrapper-mobile',
            ]
        );

        $this->add_responsive_control(
            'mobile_menu_item_border_radius',
            [
                'label' => esc_html__( 'Border radius', 'huger-elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .mdp-huger-elementor-mega-menu-wrapper-mobile'=> 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );


        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'mobile_menu_item_box_shadow',
                'label' => esc_html__( 'Box Shadow', 'huger-elementor' ),
                'selector' => '{{WRAPPER}} .mdp-huger-elementor-mega-menu-wrapper-mobile',
            ]
        );


        $this->end_controls_section();
    }

    /**
     * Set wp menu arguments.
     *
     * @access private
     *
     * @param $item
     * @param $settings
     * @return array
     */
    private function set_menu_arguments( $item, $settings ) {
        if ( empty( $item['wp_menu'] ) ) { return; }

        $args = [
            'menu' => $item['wp_menu'],
            'menu_class' => 'mdp-huger-elementor-wp-menu mdp-huger-elementor-menu',
            'echo' => false,
            'container' => '',
        ];

        if ( $settings['wp_menu_pointer'] !== 'none' ) {
            $args['menu_class'] .= ' '.$settings['wp_menu_pointer'];
        }

        $args['menu_class'] .= ' mdp-huger-elementor-wp-menu-'.$settings['wp_menu_layout'];

        if ( $settings['wp_menu_layout'] === 'vertical' ) {
            $args['menu_class'] .= ' mdp-huger-elementor-wp-menu-submenu-expand-'.$settings['expand_wp_menu_position_vertical'];
        } else {
            $args['menu_class'] .= ' mdp-huger-elementor-wp-menu-submenu-expand-'.$settings['expand_wp_menu_position_horizontal'];
        }


        return $args;
    }

    /**
     * Returns template content.
     *
     * @param $template_id
     * @return string
     * @since 1.0.0
     * @access private
     *
     */
    private function get_template_content( $template_id ) {
        return Plugin::instance()->frontend->get_builder_content_for_display( $template_id );
    }

    /**
     * Adding custom filters for wp menu.
     *
     * @access private
     *
     * @return void
     */
    private function add_filter_huger() {

        // adding custom filter classes on submenu
        add_filter( 'nav_menu_submenu_css_class', [ $this, 'add_sub_menu_classes' ] );

        // adding custom filter classes on links that contains dropdown
        add_filter( 'nav_menu_link_attributes', [ $this, 'add_class_to_items_link' ], 10, 3 );

        // adding custom filter classes on nav menu items
        add_filter( 'nav_menu_css_class', [ $this ,'custom_nav_item_classes' ], 10, 2 );

        // adding custom filter adding menu indicator
        add_filter( 'walker_nav_menu_start_el', [$this, 'adding_menu_indicator'], 10, 4 );

    }

    /**
     * Removing custom filters.
     *
     * @access private
     *
     * @return void
     */
    private function remove_filter_huger() {

        // delete custom filters
        remove_filter( 'nav_menu_link_attributes', [ $this, 'add_class_to_items_link' ] );
        remove_filter( 'nav_menu_submenu_css_class', [ $this, 'add_sub_menu_classes' ] );
        remove_filter( 'nav_menu_css_class', [$this, 'custom_nav_item_classes'] );
        remove_filter( 'walker_nav_menu_start_el', [$this, 'adding_menu_indicator'] );

    }

    /**
     * Styles on breakpoints.
     *
     * @access private
     *
     * @param $settings
     * @return void
     */
    private function mobile_styles_render( $settings ) {
        ?>
        <?php if ( $settings['responsive_breakpoint'] ): ?>
            <style>
                @media only screen and (max-width:  <?php $settings['responsive_breakpoint'] !='custom' ?
                               esc_html_e( $settings['responsive_breakpoint'] ) :
                               esc_html_e( $settings['custom_breakpoint']['size'].$settings['custom_breakpoint']['unit'] ) ?>) {
                    .elementor-element-<?php esc_html_e( $this->get_id() ); ?> .mdp-huger-elementor-main-nav,
                    .elementor-element-<?php esc_html_e( $this->get_id() ); ?> .mdp-huger-elementor-wp-menu{
                        display: inline-flex;
                        flex-direction: column;
                        padding-top: 50px;
                    }

                    .elementor-element-<?php esc_html_e( $this->get_id() ); ?> .mdp-huger-elementor-wp-menu {
                        padding-top: 0 !important;
                    }

                    .elementor-element-<?php esc_html_e( $this->get_id() ); ?> .mdp-huger-elementor-main-nav-submenu-expand-left .mdp-huger-elementor-submenu-indicator,
                    .elementor-element-<?php esc_html_e( $this->get_id() ); ?> .mdp-huger-elementor-main-nav-submenu-expand-left a .mdp-huger-elementor-submenu-indicator,
                    .elementor-element-<?php esc_html_e( $this->get_id() ); ?> .mdp-huger-elementor-wp-menu-submenu-expand-left .mdp-huger-wp-menu-submenu-indicator {
                        transform: rotate(0deg);
                        order: 1;
                        margin-right: 0;
                        margin-left: 10px;
                    }

                    .elementor-element-<?php esc_html_e( $this->get_id() ); ?> .mdp-huger-elementor-main-nav-submenu-expand-right .mdp-huger-elementor-submenu-indicator,
                    .elementor-element-<?php esc_html_e( $this->get_id() ); ?> .mdp-huger-elementor-main-nav-submenu-expand-right a .mdp-huger-elementor-submenu-indicator,
                    .elementor-element-<?php esc_html_e( $this->get_id() ); ?> .mdp-huger-elementor-wp-menu-submenu-expand-right .mdp-huger-wp-menu-submenu-indicator {
                        transform: rotate(0deg);
                        margin-left: 10px;
                    }

                    .elementor-element-<?php esc_html_e( $this->get_id() ); ?> .mdp-huger-elementor-submenu,
                    .elementor-element-<?php esc_html_e( $this->get_id() ); ?> .mdp-huger-elementor-wp-menu-dropdown {
                      animation: initial !important;
                      position: relative;
                      top: 0;
                    }

                    .elementor-element-<?php esc_html_e( $this->get_id() ); ?> .mdp-huger-elementor-submenu.mdp-huger-elementor-submenu-show,
                    .elementor-element-<?php esc_html_e( $this->get_id() ); ?> .mdp-huger-elementor-wp-menu-dropdown.mdp-huger-elementor-wp-menu-dropdown-show {
                        display: block;
                    }

                    .elementor-element-<?php esc_html_e( $this->get_id() ); ?> .mdp-huger-elementor-toggle-btn {
                        display: flex !important;
                        align-items: center;
                        position: relative !important;
                    }

                    .elementor-element-<?php esc_html_e( $this->get_id() ); ?> .mdp-huger-elementor-toggle-close-icon {
                        cursor: pointer;
                    }

                    .elementor-element-<?php esc_html_e( $this->get_id() ); ?> .mdp-huger-elementor-toggle-icon {
                        cursor: pointer;
                    }

                    .elementor-element-<?php esc_html_e( $this->get_id() ); ?> .mdp-huger-elementor-mega-menu-wrapper {
                        position: fixed;
                        overflow-y: auto;
                        top: 0;
                        <?php if( $settings['menu_position'] != 'top' ) {
                        esc_html_e( $settings['menu_position'] );
                        } ?>: -200%;
                        <?php if( $settings['menu_position'] == 'top' ): ?>
                        top: -200%;
                        left: 0;
                        <?php endif; ?>
                        width: 85%;
                         <?php if( $settings['full_width'] == 'yes' ): ?>
                        width: 100%;
                        <?php endif; ?>
                        height: 100%;
                        z-index: 1000;
                        background-color: #fff;
                        padding: 10px;
                        transition: all .3s ease;
                    }
                    .elementor-element-<?php esc_html_e( $this->get_id() ); ?> .mdp-huger-elementor-mega-menu-wrapper.mdp-huger-elementor-mega-menu-wrapper--active{
                    <?php if( $settings['menu_position'] ) {
                        esc_html_e( $settings['menu_position'] );
                    } ?>: 0;
                    }

                    .elementor-element-<?php esc_html_e( $this->get_id() ); ?> .mdp-huger-elementor-mega-menu-item{
                        display: flex;
                        flex-direction: column
                    }

                    .elementor-element-<?php esc_html_e( $this->get_id() ); ?> .mdp-huger-elementor-wp-menu-item  {
                        display: block;
                    }

                    .elementor-element-<?php esc_html_e( $this->get_id() ); ?> .mdp-huger-elementor-wp-menu-dropdown .mdp-huger-elementor-wp-menu-item > .mdp-huger-elementor-wp-menu-dropdown {
                        left: 0 !important;
                    }

                    .elementor-element-<?php esc_html_e( $this->get_id() ); ?> .mdp-huger-elementor-menu-dropdown-active {
                        display: block !important;
                    }

                    .elementor-element-<?php esc_html_e( $this->get_id() ); ?> .mdp-huger-elementor-wp-menu-submenu-expand-bottom .mdp-huger-elementor-wp-menu-dropdown,
                    .elementor-element-<?php esc_html_e( $this->get_id() ); ?> .mdp-huger-elementor-main-nav-submenu-expand-bottom .mdp-huger-elementor-submenu,
                    .elementor-element-<?php esc_html_e( $this->get_id() ); ?> .mdp-huger-elementor-wp-menu-submenu-expand-bottom .mdp-huger-elementor-wp-menu-dropdown,
                    .elementor-element-<?php esc_html_e( $this->get_id() ); ?> .mdp-huger-elementor-main-nav-submenu-expand-bottom .mdp-huger-elementor-submenu {
                        top: 0 !important;
                    }

                    .elementor-element-<?php esc_html_e( $this->get_id() ); ?> .mdp-huger-elementor-wp-menu-submenu-expand-left .mdp-huger-elementor-wp-menu-dropdown,
                    .elementor-element-<?php esc_html_e( $this->get_id() ); ?> .mdp-huger-elementor-main-nav-submenu-expand-left .mdp-huger-elementor-submenu,
                    .elementor-element-<?php esc_html_e( $this->get_id() ); ?> .mdp-huger-elementor-wp-menu-submenu-expand-left .mdp-huger-elementor-wp-menu-dropdown,
                    .elementor-element-<?php esc_html_e( $this->get_id() ); ?> .mdp-huger-elementor-main-nav-submenu-expand-left .mdp-huger-elementor-submenu {
                        top: 0 !important;
                        left: 0 !important;
                        right: auto !important;
                    }
                    .elementor-element-<?php esc_html_e( $this->get_id() ); ?> .mdp-huger-elementor-wp-menu-submenu-expand-right .mdp-huger-elementor-wp-menu-dropdown,
                    .elementor-element-<?php esc_html_e( $this->get_id() ); ?> .mdp-huger-elementor-main-nav-submenu-expand-right .mdp-huger-elementor-submenu,
                    .elementor-element-<?php esc_html_e( $this->get_id() ); ?> .mdp-huger-elementor-wp-menu-submenu-expand-right .mdp-huger-elementor-wp-menu-dropdown,
                    .elementor-element-<?php esc_html_e( $this->get_id() ); ?> .mdp-huger-elementor-main-nav-submenu-expand-right .mdp-huger-elementor-submenu {
                        top: 0 !important;
                        right: 0 !important;
                        left: auto;
                    }

                }
            </style>
        <?php endif; ?>
        <?php
    }


    /**
     * Submenu.
     *
     * @param $settings
     * @param $item
     *
     * @return void
     */
    private function submenu_render( $settings, $item ) {
        ?>
        <div class="mdp-huger-elementor-submenu mdp-huger-elementor-submenu-<?php $settings['menu_layout'] === 'vertical' ? esc_attr_e( $settings['expand_menu_position_vertical'] ) : esc_attr_e( $settings['expand_menu_position_horizontal'] ) ?>" <?php if ( !is_admin() ): ?> style="opacity: 0" <?php endif; ?> >
            <?php if ( !empty( $this->get_templates() ) && $item['submenu'] === 'template' ) {
                echo $this->get_template_content( esc_html__( $item['template'] ) );
            } else {
                // adding filters
                $this->add_filter_huger();

                // setting wp menu
                $menu = wp_nav_menu( $this->set_menu_arguments( $item, $settings ) );
                echo wp_kses_post( $menu );

                // removing filters
                $this->remove_filter_huger();
            } ?>
        </div>

        <?php
    }

    /**
     * Menu item.
     *
     * @param $settings
     * @param $item
     *
     * @return void
     */
    private function menu_item_render( $settings, $item ) {
        ?>
         <?php
            if ( !empty( $item['item_link']['url'] ) ):
                $target = $item['item_link']['is_external'] ? 'target="_blank" ' : '';
                $nofollow = $item['item_link']['nofollow'] ? ' rel="nofollow" ' : '';
                ?>
              <div class="mdp-huger-elementor-mega-menu-item <?php if ( $settings['pointer'] !== 'none' ) { esc_attr_e( $settings['pointer'] ); } ?>" data-widget-id="<?php esc_attr_e( $this->get_id() ); ?>">
                  <a class="mdp-huger-elementor-menu-link mdp-huger-elementor-mega-menu-item-text"
                     href="<?php echo esc_url( $item['item_link']['url'] ) ?>"
                     data-post-link-id="<?php esc_attr_e( url_to_postid( $item['item_link']['url'] ) !== 0 ? url_to_postid( $item['item_link']['url'] ) : '' ); ?>"
                     <?php esc_attr_e( $target . $nofollow ) ?>
                  >
                    <div class="mdp-huger-elementor-mega-menu-icon">
                        <?php Icons_Manager::render_icon( $item['item_icon'], ['aria-hidden' => true] ) ?>
                    </div>
                    <span class="mdp-huger-elementor-mega-menu-title"> <?php esc_html_e( $item['item_title'], 'huger-elementor' ); ?> </span>
                    <?php if ( $item['submenu'] !== 'none' ):  ?>
                    <div class="mdp-huger-elementor-submenu-indicator">
                        <?php if ( $settings['submenu_indicator'] === 'custom' ): ?>
                            <?php Icons_Manager::render_icon( $settings['custom_submenu_indicator'] ); ?>
                        <?php else: ?>
                        <i class="<?php esc_attr_e( $settings['submenu_indicator'] ); ?>"></i>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>
                  </a>
                  <?php if ( $item['submenu'] !== 'none' ):  ?>
                        <?php $this->submenu_render( $settings, $item ); ?>
                    <?php endif; ?>
              </div>
        <?php else: ?>
            <div class="mdp-huger-elementor-mega-menu-item <?php if ( $settings['pointer'] !== 'none' ) { esc_attr_e( $settings['pointer'] ); } ?>" data-widget-id="<?php esc_attr_e( $this->get_id() ); ?>">
                <div class="mdp-huger-elementor-mega-menu-item-text-wrapper mdp-huger-elementor-mega-menu-item-text">
                    <div class="mdp-huger-elementor-mega-menu-icon">
                        <?php Icons_Manager::render_icon( $item['item_icon'], ['aria-hidden' => true] ) ?>
                    </div>
                    <span class="mdp-huger-elementor-mega-menu-title"> <?php esc_html_e( $item['item_title'], 'huger-elementor' ); ?></span>
                    <?php if ( $item['submenu'] !== 'none' ):  ?>
                    <div class="mdp-huger-elementor-submenu-indicator">
                        <?php if ( $settings['submenu_indicator'] === 'custom' ): ?>
                            <?php Icons_Manager::render_icon( $settings['custom_submenu_indicator'] ); ?>
                        <?php else: ?>
                            <i class="<?php esc_attr_e( $settings['submenu_indicator'] ); ?>"></i>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>
                </div>
                <?php if ( $item['submenu'] !== 'none' ):  ?>
                    <?php $this->submenu_render( $settings, $item ); ?>
                <?php endif; ?>
            </div>
        <?php endif; ?>
        <?php
    }

    /**
     * Render Frontend Output. Generate the final HTML on the frontend.
     *
     * @access protected
     *
     * @return void
     **/
    protected function render() {
    $settings = $this->get_settings_for_display();
    ?>
        <!-- Start Huger for Elementor WordPress Plugin -->
        <div class="mdp-huger-elementor-box"
        data-breakpoint = "<?php $settings['responsive_breakpoint'] != 'custom' ?
            esc_html_e( $settings['responsive_breakpoint'] ) :
            esc_html_e( $settings['custom_breakpoint']['size'].$settings['custom_breakpoint']['unit'] ) ?>"
        data-click-area = "<?php esc_attr_e( $settings['submenu_click_area'] ); ?>"
        data-widget-id="<?php esc_attr_e( $this->get_id() ); ?>"
        data-submenu-hover-close="<?php esc_attr_e( $settings['submenu_hover_close'] ); ?>"
        data-open-submenu-onclik="<?php esc_attr_e( $settings['open_submenu_onclick'] ); ?>"
        data-submenu-desktop-click-area="<?php esc_attr_e( $settings['open_submenu_onclick_area'] ); ?>"
        >
            <?php  if ( $settings['responsive_breakpoint'] !== 'custom' || $settings['custom_breakpoint']['size'] > 0 ): ?>
                <div class="mdp-huger-elementor-toggle-btn">
                <div class="mdp-huger-elementor-toggle-icon">
                    <?php Icons_Manager::render_icon( $settings['toggle_icon'], ['aria-hidden' => true] ) ?>
                </div>
            </div>
            <?php endif; ?>
            <div class="mdp-huger-elementor-mega-menu-wrapper">
                <?php  if ( $settings['responsive_breakpoint'] !== 'custom' || $settings['custom_breakpoint']['size'] > 0 ): ?>
                    <div class="mdp-huger-elementor-toggle-btn mdp-huger-elementor-toggle-close-btn">
                        <div class="mdp-huger-elementor-toggle-close-icon">
                            <?php Icons_Manager::render_icon( $settings['close_toggle_icon'], ['aria-hidden' => true] ) ?>
                        </div>
                    </div>
                <?php endif; ?>
                <nav class="mdp-huger-elementor-main-nav mdp-huger-elementor-menu mdp-huger-elementor-main-nav-<?php esc_attr_e( $settings['menu_layout'] ); ?> mdp-huger-elementor-main-nav-submenu-expand-<?php $settings['menu_layout'] === 'vertical' ? esc_attr_e( $settings['expand_menu_position_vertical'] ) : esc_attr_e( $settings['expand_menu_position_horizontal'] ) ?>">
                    <?php foreach ( $settings[ 'menu_items_list' ] as $item ): ?>
                        <?php $this->menu_item_render( $settings, $item ); ?>
                    <?php endforeach; ?>
                </nav>
            </div>
            <?php $this->mobile_styles_render( $settings ); ?>
        </div>
        <!-- End Huger for Elementor WordPress Plugin -->
	<?php
        if ( is_admin() ) {
            $widget_hash = substr( hash( 'ripemd160', date('l jS \of F Y h:i:s A') ), rand( 0 , 20 ), 3 ) . rand( 11 , 99 );
            ?>
            <!--suppress JSUnresolvedFunction -->
            <script>
                try {
                    hugerReady<?php esc_attr_e( $widget_hash ); ?>( hugerElementor.addMegaMenu.bind( hugerElementor ) );
                } catch ( msg ) {
                    const hugerReady<?php esc_attr_e( $widget_hash ); ?> = ( callback ) => {
                        'loading' !== document.readyState ?
                            callback() :
                            document.addEventListener( 'DOMContentLoaded', callback );
                    };
                    hugerReady<?php esc_attr_e( $widget_hash ); ?>( hugerElementor.addMegaMenu.bind( hugerElementor ) );
                }
            </script>
            <?php
        } else { ?>
            <script>
                window.addEventListener( 'load', () => {
                    document.querySelectorAll( '.elementor-element-<?php esc_attr_e( $this->get_id() ); ?> .mdp-huger-elementor-submenu' ).forEach( dropdown => {
                        dropdown.style.opacity = 1;
                    } );
                } );
            </script>
        <?php
        }


    }

    /**
     * Adding classes to wp menu items links
     *
     * @access public
     *
     * @param $atts
     * @param $item
     * @return mixed
     */
    public function add_class_to_items_link( $atts, $item ) {

        // check if the item has children
        $hasChildren = ( in_array( 'menu-item-has-children', $item->classes ) );
        if ( $hasChildren ) {
            // add custom attributes:
            $atts['class'] = 'mdp-huger-elementor-wp-menu-dropdown-link';
            $atts['data-toggle'] = 'dropdown';
            $atts['data-target'] = '#';
        } else {
            $atts['class'] = 'mdp-huger-elementor-wp-menu-link';
        }
        return $atts;

    }

    /**
     * Adding classes to navigation wp menu items
     *
     * @access public
     *
     * @param $classes
     * @param $item
     * @return mixed
     */
    public function custom_nav_item_classes( $classes, $item ) {

        if ( in_array( 'current-menu-item', $item->classes ) ) {
            $classes[] .= ' mdp-huger-elementor-wp-menu-item-active';
        }

        $classes[] = 'mdp-huger-elementor-wp-menu-item';

        return $classes;
    }

    /**
     * Adding wp menu submenu classes method
     *
     * @access public
     *
     * @param $classes
     * @return mixed
     */
    public function add_sub_menu_classes( $classes ) {

        $settings = $this->get_settings_for_display();

        $classes[] = 'mdp-huger-elementor-wp-menu-dropdown mdp-huger-elementor-menu';

        if( $settings['wp_menu_submenu_pointer'] != 'none' ) {
            $classes[] .= $settings['wp_menu_submenu_pointer'];
        }

        return $classes;
    }

    /**
     * Adding wp menu submenu indicator method
     *
     * @access public
     *
     * @param $item_output
     * @param $item
     * @return mixed|string|string[]
     */
    public function adding_menu_indicator($item_output, $item) {

        $settings = $this->get_settings_for_display();



        if (in_array('menu-item-has-children', $item->classes)) {
            if ( $settings['wp_menu_submenu_indicator'] === 'custom' ) {
                $arrow = '<i class="mdp-huger-wp-menu-submenu-indicator '.esc_attr__( $settings['custom_wp_menu_submenu_indicator']['value'] ).'"></i>';
            } else {
                $arrow = '<i class="mdp-huger-wp-menu-submenu-indicator '.esc_attr__( $settings['wp_menu_submenu_indicator'] ).'"></i>';
            }
            $item_output = str_replace('</a>', '</a>'. $arrow .'', $item_output);
        }
        return sprintf('<div class="mdp-huger-elementor-wp-menu-text-wrapper">%s</div>', wp_kses_post( $item_output ) );
    }

    /**
     * Return link for documentation
     * Used to add stuff after widget
     *
     * @access public
     *
     * @return string
     **/
    public function get_custom_help_url() {

        return 'https://docs.merkulov.design/tag/huger';

    }

}
