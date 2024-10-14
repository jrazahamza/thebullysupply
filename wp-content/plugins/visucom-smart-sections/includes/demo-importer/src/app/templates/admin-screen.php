<?php defined ( 'ABSPATH' ) || exit; ?>
<div class="wrap gusta-demo-wrap">
    <h2><?php _e('Demo Importer', 'gusta-demo'); ?></h2>

    <form method="post" id="purchase-code-status" onsubmit="return false;">
        <div class="section">
            <h3><?php echo _e('Verify your Envato Purchase'); ?></h3>
            <p><?php echo _e('In order to be able to import the demos listed below, you need to verify your Envato purchase.', 'mb_framework'); ?> <a target="_blank" href="https://help.market.envato.com/hc/en-us/articles/202822600-Where-Is-My-Purchase-Code-"><?php echo _e('Where is my purchase code?', 'mb_framework'); ?></a></p>
            <div class="verified-status" <?php echo ! $verified ? 'style="display:none"' : ''; ?>>
                <p>
                    <span><?php printf(__('<strong>Verified:</strong> <span class="echo-purchase-code">%s</span>', 'gusta-demo'), GustaDemo\Admin::getSetting('purchase_code')); ?></span>
                    <span>&mdash; <a href="javascript:;"><?php _e('Enter a new purchase code', 'gusta-demo'); ?></a></span>
                </p>
            </div>

            <div class="input-hold" <?php echo $verified ? 'style="display:none"' : ''; ?>>
                <input type="text" name="purchase-code" value="<?php echo esc_attr( GustaDemo\Admin::getSetting('purchase_code') ); ?>" />
                <input type="submit" value="<?php echo esc_attr_e('Verify', 'gusta-demo'); ?>" data-loading="<?php echo esc_attr_e('Verifying..', 'gusta-demo'); ?>" class="button button-primary" />
                <input type="hidden" name="action" value="gusta-demo-verify-purchase-code" />
                <?php wp_nonce_field('gusta-demo-verify', 'nonce'); ?>
                <p class="gusta-import-notice"><?php echo _e('Please be aware that images used in the demos are not included in the imports. We have used the following Google Fonts in our demos: Roboto, Playfair Display, Poppins, Nunito and Open Sans. If you do not add these fonts from the', 'mb_framework'); echo ' <a target="_blank" href="https://www.youtube.com/watch?v=iAZ5rOJz1ek&index=4&list=PLhHXQ5n2SiyHgqG7qr-DMLKkJSu3N-7fO">'; echo _e('Font Manager', 'mb_framework'); echo '</a>'; echo _e(', texts will be displayed with your default theme fonts. Modified versions of WPBakery Page Builder bundled with several themes may cause some minor problems with Smart Sections. Since these demos were created using native Visual Composer shortcodes and architecture, it may conflict with your theme shortcodes or architecture. If you do not get the desired result after importing the demos, that might mean that the demos are not compatible with the modified WPBakery Page Builder of your theme, please try creating your own sections with the modified version of WPBakery Page Builder in your theme. If you feel you have a major issue, please open a ticket to let us know.', 'mb_framework'); ?> <a target="_blank" href="https://support.themegusta.com"><?php echo _e('Theme Gusta Support', 'mb_framework'); ?></a></p>
            </div>
            
        </div>
    </form>
</div>

<?php if ( class_exists('WP_Importer') ) : ?>

    <div class="wrap gusta-demo-grid-wrap">
        <h2><?php _e('Demos', 'gusta-demo'); ?></h2>
        
        <div class="container">
            <div class="demos-grid row">
                <div class="col-12">
                    <h3><?php _e('Horizontal & Vertical Headers', 'mb_framwork'); ?></h3>
                </div>
                <div class="demo-item col-6">
                    <div class="inside">
                        <div class="demo-img">
                            <img src="https://www.themegusta.com/smartsections/wp-content/uploads/2018/03/1-1.jpg" />
                            <span class="demo-title-hold"></span>
                        </div>

                        <div class="demo-actions">
                            <button type="button" class="button button-primary <?php echo ! $verified ? 'not-verified" disabled="disabled' : 'verified'; ?>" data-demo="./header/Header Demo 1 - Center aligned header with toggle search.xml">
                                <?php echo ! $verified ? __('Verify purchase') : __('Import', 'gusta-demo'); ?>
                            </button>
                            <a href="https://www.themegusta.com/showcase/#header-demo-1" target="_blank" class="button"></a>
                        </div>
                    </div>
                </div>
                <div class="demo-item col-6">
                    <div class="inside">
                        <div class="demo-img">
                            <img src="https://www.themegusta.com/smartsections/wp-content/uploads/2018/03/2.jpg" />
                            <span class="demo-title-hold"></span>
                        </div>

                        <div class="demo-actions">
                            <button type="button" class="button button-primary <?php echo ! $verified ? 'not-verified" disabled="disabled' : 'verified'; ?>" data-demo="./header/Header Demo 2 - Standart header with top bar.xml">
                                <?php echo ! $verified ? __('Verify purchase') : __('Import', 'gusta-demo'); ?>
                            </button>
                            <a href="https://www.themegusta.com/showcase/#header-demo-2" target="_blank" class="button"></a>
                        </div>
                    </div>
                </div>
                <div class="demo-item col-6">
                    <div class="inside">
                        <div class="demo-img">
                            <img src="https://www.themegusta.com/smartsections/wp-content/uploads/2018/03/3.jpg" />
                            <span class="demo-title-hold"></span>
                        </div>

                        <div class="demo-actions">
                            <button type="button" class="button button-primary <?php echo ! $verified ? 'not-verified" disabled="disabled' : 'verified'; ?>" data-demo="./header/Header Demo 3 - Boxed header with toggle button.xml">
                                <?php echo ! $verified ? __('Verify purchase') : __('Import', 'gusta-demo'); ?>
                            </button>
                            <a href="https://www.themegusta.com/showcase/#header-demo-3" target="_blank" class="button"></a>
                        </div>
                    </div>
                </div>
                <div class="demo-item col-6">
                    <div class="inside">
                        <div class="demo-img">
                            <img src="https://www.themegusta.com/smartsections/wp-content/uploads/2018/03/4.jpg" />
                            <span class="demo-title-hold"></span>
                        </div>

                        <div class="demo-actions">
                            <button type="button" class="button button-primary <?php echo ! $verified ? 'not-verified" disabled="disabled' : 'verified'; ?>" data-demo="./header/Header Demo 4 - Material header with toggle buttons.xml">
                                <?php echo ! $verified ? __('Verify purchase') : __('Import', 'gusta-demo'); ?>
                            </button>
                            <a href="https://www.themegusta.com/showcase/#header-demo-4" target="_blank" class="button"></a>
                        </div>
                    </div>
                </div>
                <div class="demo-item col-6">
                    <div class="inside">
                        <div class="demo-img">
                            <img src="https://www.themegusta.com/smartsections/wp-content/uploads/2018/03/6-4.jpg" />
                            <span class="demo-title-hold"></span>
                        </div>

                        <div class="demo-actions">
                            <button type="button" class="button button-primary <?php echo ! $verified ? 'not-verified" disabled="disabled' : 'verified'; ?>" data-demo="./header/Header Demo 6 - Basic full width header with shadowed style navigation.xml">
                                <?php echo ! $verified ? __('Verify purchase') : __('Import', 'gusta-demo'); ?>
                            </button>
                            <a href="https://www.themegusta.com/showcase/#header-demo-6" target="_blank" class="button"></a>
                        </div>
                    </div>
                </div>
                <div class="demo-item col-6">
                    <div class="inside">
                        <div class="demo-img">
                            <img src="https://www.themegusta.com/smartsections/wp-content/uploads/2018/03/7.jpg" />
                            <span class="demo-title-hold"></span>
                        </div>

                        <div class="demo-actions">
                            <button type="button" class="button button-primary <?php echo ! $verified ? 'not-verified" disabled="disabled' : 'verified'; ?>" data-demo="./header/Header Demo 7 - Dark header with featured image and top bar.xml">
                                <?php echo ! $verified ? __('Verify purchase') : __('Import', 'gusta-demo'); ?>
                            </button>
                            <a href="https://www.themegusta.com/showcase/#header-demo-7" target="_blank" class="button"></a>
                        </div>
                    </div>
                </div>
                <div class="demo-item col-6">
                    <div class="inside">
                        <div class="demo-img">
                            <img src="https://www.themegusta.com/smartsections/wp-content/uploads/2018/03/8.jpg" />
                            <span class="demo-title-hold"></span>
                        </div>

                        <div class="demo-actions">
                            <button type="button" class="button button-primary <?php echo ! $verified ? 'not-verified" disabled="disabled' : 'verified'; ?>" data-demo="./header/Header Demo 8 - Basic full width header.xml">
                                <?php echo ! $verified ? __('Verify purchase') : __('Import', 'gusta-demo'); ?>
                            </button>
                            <a href="https://www.themegusta.com/showcase/#header-demo-8" target="_blank" class="button"></a>
                        </div>
                    </div>
                </div>
                <div class="demo-item col-6">
                    <div class="inside">
                        <div class="demo-img">
                            <img src="https://www.themegusta.com/smartsections/wp-content/uploads/2018/03/9.jpg" />
                            <span class="demo-title-hold"></span>
                        </div>

                        <div class="demo-actions">
                            <button type="button" class="button button-primary <?php echo ! $verified ? 'not-verified" disabled="disabled' : 'verified'; ?>" data-demo="./header/Header Demo 9 - Header with grey outline.xml">
                                <?php echo ! $verified ? __('Verify purchase') : __('Import', 'gusta-demo'); ?>
                            </button>
                            <a href="https://www.themegusta.com/showcase/#header-demo-9" target="_blank" class="button"></a>
                        </div>
                    </div>
                </div>
                <div class="demo-item col-6">
                    <div class="inside">
                        <div class="demo-img">
                            <img src="https://www.themegusta.com/smartsections/wp-content/uploads/2018/03/10.jpg" />
                            <span class="demo-title-hold"></span>
                        </div>

                        <div class="demo-actions">
                            <button type="button" class="button button-primary <?php echo ! $verified ? 'not-verified" disabled="disabled' : 'verified'; ?>" data-demo="./header/Header Demo 10 - Header with top bar.xml">
                                <?php echo ! $verified ? __('Verify purchase') : __('Import', 'gusta-demo'); ?>
                            </button>
                            <a href="https://www.themegusta.com/showcase/#header-demo-10" target="_blank" class="button"></a>
                        </div>
                    </div>
                </div>
                <div class="demo-item col-6">
                    <div class="inside">
                        <div class="demo-img">
                            <img src="https://www.themegusta.com/smartsections/wp-content/uploads/2018/03/11.jpg" />
                            <span class="demo-title-hold"></span>
                        </div>

                        <div class="demo-actions">
                            <button type="button" class="button button-primary <?php echo ! $verified ? 'not-verified" disabled="disabled' : 'verified'; ?>" data-demo="./header/Header Demo 11 - Header with a rounded menu and breadcrumb.xml">
                                <?php echo ! $verified ? __('Verify purchase') : __('Import', 'gusta-demo'); ?>
                            </button>
                            <a href="https://www.themegusta.com/showcase/#header-demo-11" target="_blank" class="button"></a>
                        </div>
                    </div>
                </div>
                <div class="demo-item col-6">
                    <div class="inside">
                        <div class="demo-img">
                            <img src="https://www.themegusta.com/smartsections/wp-content/uploads/2018/03/12.jpg" />
                            <span class="demo-title-hold"></span>
                        </div>

                        <div class="demo-actions">
                            <button type="button" class="button button-primary <?php echo ! $verified ? 'not-verified" disabled="disabled' : 'verified'; ?>" data-demo="./header/Header Demo 12 - Sticky header with search box.xml">
                                <?php echo ! $verified ? __('Verify purchase') : __('Import', 'gusta-demo'); ?>
                            </button>
                            <a href="https://www.themegusta.com/showcase/#header-demo-12" target="_blank" class="button"></a>
                        </div>
                    </div>
                </div>
                
                <div class="demo-item col-6">
                    <div class="inside">
                        <div class="demo-img">
                            <img src="https://www.themegusta.com/smartsections/wp-content/uploads/2018/03/13.jpg" />
                            <span class="demo-title-hold"></span>
                        </div>

                        <div class="demo-actions">
                            <button type="button" class="button button-primary <?php echo ! $verified ? 'not-verified" disabled="disabled' : 'verified'; ?>" data-demo="./header/Header Demo 13 - Full Screen Header with Title and BG.xml">
                                <?php echo ! $verified ? __('Verify purchase') : __('Import', 'gusta-demo'); ?>
                            </button>
                            <a href="https://www.themegusta.com/showcase/#header-demo-13" target="_blank" class="button"></a>
                        </div>
                    </div>
                </div>
                
                <div class="demo-item col-3">
                    <div class="inside">
                        <div class="demo-img">
                            <img src="https://www.themegusta.com/smartsections/wp-content/uploads/2018/03/5.jpg" />
                            <span class="demo-title-hold"></span>
                        </div>

                        <div class="demo-actions">
                            <button type="button" class="button button-primary <?php echo ! $verified ? 'not-verified" disabled="disabled' : 'verified'; ?>" data-demo="./header/Header Demo 5 - Vertical header with toggle map.xml">
                                <?php echo ! $verified ? __('Verify purchase') : __('Import', 'gusta-demo'); ?>
                            </button>
                            <a href="https://www.themegusta.com/showcase/#header-demo-5" target="_blank" class="button"></a>
                        </div>
                    </div>
                </div>
                
                <div class="demo-item col-3">
                    <div class="inside">
                        <div class="demo-img">
                            <img src="https://www.themegusta.com/smartsections/wp-content/uploads/2018/03/14.jpg" />
                            <span class="demo-title-hold"></span>
                        </div>

                        <div class="demo-actions">
                            <button type="button" class="button button-primary <?php echo ! $verified ? 'not-verified" disabled="disabled' : 'verified'; ?>" data-demo="./header/Header 14 - Vertical menu with multiple navigation.xml">
                                <?php echo ! $verified ? __('Verify purchase') : __('Import', 'gusta-demo'); ?>
                            </button>
                            <a href="https://www.themegusta.com/showcase/#header-demo-14" target="_blank" class="button"></a>
                        </div>
                    </div>
                </div>
                
                <div class="demo-item col-3">
                    <div class="inside">
                        <div class="demo-img">
                            <img src="https://www.themegusta.com/smartsections/wp-content/uploads/2018/03/15.jpg" />
                            <span class="demo-title-hold"></span>
                        </div>

                        <div class="demo-actions">
                            <button type="button" class="button button-primary <?php echo ! $verified ? 'not-verified" disabled="disabled' : 'verified'; ?>" data-demo="./header/Header Demo 15 - Vertical header with author info box.xml">
                                <?php echo ! $verified ? __('Verify purchase') : __('Import', 'gusta-demo'); ?>
                            </button>
                            <a href="https://www.themegusta.com/showcase/#header-demo-15" target="_blank" class="button"></a>
                        </div>
                    </div>
                </div>
                
                <div class="col-12">
                    <h3><?php _e('Post Listing', 'mb_framwork'); ?></h3>
                </div>
                
                <div class="demo-item col-4">
                    <div class="inside">
                        <div class="demo-img">
                            <img src="https://themegusta.com/showcase/previews/post-listing-demo-1.jpg" />
                            <span class="demo-title-hold"></span>
                        </div>

                        <div class="demo-actions">
                            <button type="button" class="button button-primary <?php echo ! $verified ? 'not-verified" disabled="disabled' : 'verified'; ?>" data-demo="./post listing/Smart Sections Post Listing Demo 1 - Dark Background.xml">
                                <?php echo ! $verified ? __('Verify purchase') : __('Import', 'gusta-demo'); ?>
                            </button>
                            <a href="https://www.themegusta.com/showcase/#post-listing-demo-1" target="_blank" class="button"></a>
                        </div>
                    </div>
                </div>
                <div class="demo-item col-4">
                    <div class="inside">
                        <div class="demo-img">
                            <img src="https://themegusta.com/showcase/previews/post-listing-demo-2.jpg" />
                            <span class="demo-title-hold"></span>
                        </div>

                        <div class="demo-actions">
                            <button type="button" class="button button-primary <?php echo ! $verified ? 'not-verified" disabled="disabled' : 'verified'; ?>" data-demo="./post listing/Smart Sections Post Listing Demo 2 - with Dark Background 2.xml">
                                <?php echo ! $verified ? __('Verify purchase') : __('Import', 'gusta-demo'); ?>
                            </button>
                            <a href="https://www.themegusta.com/showcase/#post-listing-demo-2" target="_blank" class="button"></a>
                        </div>
                    </div>
                </div>
                <div class="demo-item col-4">
                    <div class="inside">
                        <div class="demo-img">
                            <img src="https://themegusta.com/showcase/previews/post-listing-demo-3.jpg" />
                            <span class="demo-title-hold"></span>
                        </div>

                        <div class="demo-actions">
                            <button type="button" class="button button-primary <?php echo ! $verified ? 'not-verified" disabled="disabled' : 'verified'; ?>" data-demo="./post listing/Smart Sections Post Listing Demo 3 - Flat 1.xml">
                                <?php echo ! $verified ? __('Verify purchase') : __('Import', 'gusta-demo'); ?>
                            </button>
                            <a href="https://www.themegusta.com/showcase/#post-listing-demo-3" target="_blank" class="button"></a>
                        </div>
                    </div>
                </div>
                <div class="demo-item col-4">
                    <div class="inside">
                        <div class="demo-img">
                            <img src="https://themegusta.com/showcase/previews/post-listing-demo-4.jpg" />
                            <span class="demo-title-hold"></span>
                        </div>

                        <div class="demo-actions">
                            <button type="button" class="button button-primary <?php echo ! $verified ? 'not-verified" disabled="disabled' : 'verified'; ?>" data-demo="./post listing/Smart Sections Post Listing Demo 4 - Overlay 3.xml">
                                <?php echo ! $verified ? __('Verify purchase') : __('Import', 'gusta-demo'); ?>
                            </button>
                            <a href="https://www.themegusta.com/showcase/#post-listing-demo-4" target="_blank" class="button"></a>
                        </div>
                    </div>
                </div>
                <div class="demo-item col-4">
                    <div class="inside">
                        <div class="demo-img">
                            <img src="https://themegusta.com/showcase/previews/post-listing-demo-5.jpg" />
                            <span class="demo-title-hold"></span>
                        </div>

                        <div class="demo-actions">
                            <button type="button" class="button button-primary <?php echo ! $verified ? 'not-verified" disabled="disabled' : 'verified'; ?>" data-demo="./post listing/Smart Sections Post Listing Demo 5 - Flat 2.xml">
                                <?php echo ! $verified ? __('Verify purchase') : __('Import', 'gusta-demo'); ?>
                            </button>
                            <a href="https://www.themegusta.com/showcase/#post-listing-demo-5" target="_blank" class="button"></a>
                        </div>
                    </div>
                </div>
                <div class="demo-item col-4">
                    <div class="inside">
                        <div class="demo-img">
                            <img src="https://themegusta.com/showcase/previews/post-listing-demo-6.jpg" />
                            <span class="demo-title-hold"></span>
                        </div>

                        <div class="demo-actions">
                            <button type="button" class="button button-primary <?php echo ! $verified ? 'not-verified" disabled="disabled' : 'verified'; ?>" data-demo="./post listing/Smart Sections Post Listing Demo 6 - Overlay 1.xml">
                                <?php echo ! $verified ? __('Verify purchase') : __('Import', 'gusta-demo'); ?>
                            </button>
                            <a href="https://www.themegusta.com/showcase/#post-listing-demo-6" target="_blank" class="button"></a>
                        </div>
                    </div>
                </div>
                <div class="demo-item col-4">
                    <div class="inside">
                        <div class="demo-img">
                            <img src="https://themegusta.com/showcase/previews/post-listing-demo-7.jpg" />
                            <span class="demo-title-hold"></span>
                        </div>

                        <div class="demo-actions">
                            <button type="button" class="button button-primary <?php echo ! $verified ? 'not-verified" disabled="disabled' : 'verified'; ?>" data-demo="./post listing/Smart Sections Post Listing Demo 7 - Overlay 2.xml">
                                <?php echo ! $verified ? __('Verify purchase') : __('Import', 'gusta-demo'); ?>
                            </button>
                            <a href="https://www.themegusta.com/showcase/#post-listing-demo-7" target="_blank" class="button"></a>
                        </div>
                    </div>
                </div>
                <div class="demo-item col-4">
                    <div class="inside">
                        <div class="demo-img">
                            <img src="https://themegusta.com/showcase/previews/post-listing-demo-8.jpg" />
                            <span class="demo-title-hold"></span>
                        </div>

                        <div class="demo-actions">
                            <button type="button" class="button button-primary <?php echo ! $verified ? 'not-verified" disabled="disabled' : 'verified'; ?>" data-demo="./post listing/Smart Sections Post Listing Demo 8 - without featured image.xml">
                                <?php echo ! $verified ? __('Verify purchase') : __('Import', 'gusta-demo'); ?>
                            </button>
                            <a href="https://www.themegusta.com/showcase/#post-listing-demo-8" target="_blank" class="button"></a>
                        </div>
                    </div>
                </div>
                <div class="demo-item col-4">
                    <div class="inside">
                        <div class="demo-img">
                            <img src="https://themegusta.com/showcase/previews/post-listing-demo-9.jpg" />
                            <span class="demo-title-hold"></span>
                        </div>

                        <div class="demo-actions">
                            <button type="button" class="button button-primary <?php echo ! $verified ? 'not-verified" disabled="disabled' : 'verified'; ?>" data-demo="./post listing/Smart Sections Post Listing Demo 9 - Horizontal 2.xml">
                                <?php echo ! $verified ? __('Verify purchase') : __('Import', 'gusta-demo'); ?>
                            </button>
                            <a href="https://www.themegusta.com/showcase/#post-listing-demo-9" target="_blank" class="button"></a>
                        </div>
                    </div>
                </div>
                <div class="demo-item col-4">
                    <div class="inside">
                        <div class="demo-img">
                            <img src="https://themegusta.com/showcase/previews/post-listing-demo-10.jpg" />
                            <span class="demo-title-hold"></span>
                        </div>

                        <div class="demo-actions">
                            <button type="button" class="button button-primary <?php echo ! $verified ? 'not-verified" disabled="disabled' : 'verified'; ?>" data-demo="./post listing/Smart Sections Post Listing Demo 10 - Horizontal Large Layout.xml">
                                <?php echo ! $verified ? __('Verify purchase') : __('Import', 'gusta-demo'); ?>
                            </button>
                            <a href="https://www.themegusta.com/showcase/#post-listing-demo-10" target="_blank" class="button"></a>
                        </div>
                    </div>
                </div>
                <div class="demo-item col-4">
                    <div class="inside">
                        <div class="demo-img">
                            <img src="https://themegusta.com/showcase/previews/post-listing-demo-11.jpg" />
                            <span class="demo-title-hold"></span>
                        </div>

                        <div class="demo-actions">
                            <button type="button" class="button button-primary <?php echo ! $verified ? 'not-verified" disabled="disabled' : 'verified'; ?>" data-demo="./post listing/Smart Sections Post Listing Demo 11 - Timeline.xml">
                                <?php echo ! $verified ? __('Verify purchase') : __('Import', 'gusta-demo'); ?>
                            </button>
                            <a href="https://www.themegusta.com/showcase/#post-listing-demo-11" target="_blank" class="button"></a>
                        </div>
                    </div>
                </div>
                <div class="demo-item col-4">
                    <div class="inside">
                        <div class="demo-img">
                            <img src="https://themegusta.com/showcase/previews/post-listing-demo-12.jpg" />
                            <span class="demo-title-hold"></span>
                        </div>

                        <div class="demo-actions">
                            <button type="button" class="button button-primary <?php echo ! $verified ? 'not-verified" disabled="disabled' : 'verified'; ?>" data-demo="./post listing/Smart Sections Post Listing Demo 12 - Basic.xml">
                                <?php echo ! $verified ? __('Verify purchase') : __('Import', 'gusta-demo'); ?>
                            </button>
                            <a href="https://www.themegusta.com/showcase/#post-listing-demo-12" target="_blank" class="button"></a>
                        </div>
                    </div>
                </div>
                <div class="demo-item col-4">
                    <div class="inside">
                        <div class="demo-img">
                            <img src="https://themegusta.com/showcase/previews/post-listing-demo-13.jpg" />
                            <span class="demo-title-hold"></span>
                        </div>

                        <div class="demo-actions">
                            <button type="button" class="button button-primary <?php echo ! $verified ? 'not-verified" disabled="disabled' : 'verified'; ?>" data-demo="./post listing/Smart Sections Post Listing Demo 13 - Material.xml">
                                <?php echo ! $verified ? __('Verify purchase') : __('Import', 'gusta-demo'); ?>
                            </button>
                            <a href="https://www.themegusta.com/showcase/#post-listing-demo-13" target="_blank" class="button"></a>
                        </div>
                    </div>
                </div>
                <div class="demo-item col-4">
                    <div class="inside">
                        <div class="demo-img">
                            <img src="https://themegusta.com/showcase/previews/post-listing-demo-14.jpg" />
                            <span class="demo-title-hold"></span>
                        </div>

                        <div class="demo-actions">
                            <button type="button" class="button button-primary <?php echo ! $verified ? 'not-verified" disabled="disabled' : 'verified'; ?>" data-demo="./post listing/Smart Sections Post Listing Demo 14 - for Sidebar.xml">
                                <?php echo ! $verified ? __('Verify purchase') : __('Import', 'gusta-demo'); ?>
                            </button>
                            <a href="https://www.themegusta.com/showcase/#post-listing-demo-14" target="_blank" class="button"></a>
                        </div>
                    </div>
                </div>
                <div class="demo-item col-4">
                    <div class="inside">
                        <div class="demo-img">
                            <img src="https://themegusta.com/showcase/previews/post-listing-demo-15.jpg" />
                            <span class="demo-title-hold"></span>
                        </div>

                        <div class="demo-actions">
                            <button type="button" class="button button-primary <?php echo ! $verified ? 'not-verified" disabled="disabled' : 'verified'; ?>" data-demo="./post listing/Smart Sections Post Listing Demo 15 - Overlay 4.xml">
                                <?php echo ! $verified ? __('Verify purchase') : __('Import', 'gusta-demo'); ?>
                            </button>
                            <a href="https://www.themegusta.com/showcase/#post-listing-demo-15" target="_blank" class="button"></a>
                        </div>
                    </div>
                </div>
				
				<div class="demo-item col-4">
                    <div class="inside">
                        <div class="demo-img">
                            <img src="https://themegusta.com/showcase/previews/post-listing-demo-16.jpg" />
                            <span class="demo-title-hold"></span>
                        </div>

                        <div class="demo-actions">
                            <button type="button" class="button button-primary <?php echo ! $verified ? 'not-verified" disabled="disabled' : 'verified'; ?>" data-demo="./post listing/Smart Sections Post Listing Demo 16 - Dark Overlay Read More on Hover.xml">
                                <?php echo ! $verified ? __('Verify purchase') : __('Import', 'gusta-demo'); ?>
                            </button>
                            <a href="https://www.themegusta.com/showcase/#post-listing-demo-16" target="_blank" class="button"></a>
                        </div>
                    </div>
                </div>
				
				<div class="demo-item col-4">
                    <div class="inside">
                        <div class="demo-img">
                            <img src="https://themegusta.com/showcase/previews/post-listing-demo-17.jpg" />
                            <span class="demo-title-hold"></span>
                        </div>

                        <div class="demo-actions">
                            <button type="button" class="button button-primary <?php echo ! $verified ? 'not-verified" disabled="disabled' : 'verified'; ?>" data-demo="./post listing/Smart Sections Post Listing Demo 17 - Sky Blue Overlay on Hover.xml">
                                <?php echo ! $verified ? __('Verify purchase') : __('Import', 'gusta-demo'); ?>
                            </button>
                            <a href="https://www.themegusta.com/showcase/#post-listing-demo-17" target="_blank" class="button"></a>
                        </div>
                    </div>
                </div>
				
				<div class="demo-item col-4">
                    <div class="inside">
                        <div class="demo-img">
                            <img src="https://themegusta.com/showcase/previews/post-listing-demo-18.jpg" />
                            <span class="demo-title-hold"></span>
                        </div>

                        <div class="demo-actions">
                            <button type="button" class="button button-primary <?php echo ! $verified ? 'not-verified" disabled="disabled' : 'verified'; ?>" data-demo="./post listing/Smart Sections Post Listing Demo 18 - 1 Column Simple with Author.xml">
                                <?php echo ! $verified ? __('Verify purchase') : __('Import', 'gusta-demo'); ?>
                            </button>
                            <a href="https://www.themegusta.com/showcase/#post-listing-demo-18" target="_blank" class="button"></a>
                        </div>
                    </div>
                </div>
				
				<div class="demo-item col-4">
                    <div class="inside">
                        <div class="demo-img">
                            <img src="https://themegusta.com/showcase/previews/post-listing-demo-19.jpg" />
                            <span class="demo-title-hold"></span>
                        </div>

                        <div class="demo-actions">
                            <button type="button" class="button button-primary <?php echo ! $verified ? 'not-verified" disabled="disabled' : 'verified'; ?>" data-demo="./post listing/Smart Sections Post Listing Demo 19 - Absolute Radius.xml">
                                <?php echo ! $verified ? __('Verify purchase') : __('Import', 'gusta-demo'); ?>
                            </button>
                            <a href="https://www.themegusta.com/showcase/#post-listing-demo-19" target="_blank" class="button"></a>
                        </div>
                    </div>
                </div>
				
				<div class="demo-item col-4">
                    <div class="inside">
                        <div class="demo-img">
                            <img src="https://themegusta.com/showcase/previews/post-listing-demo-20.jpg" />
                            <span class="demo-title-hold"></span>
                        </div>

                        <div class="demo-actions">
                            <button type="button" class="button button-primary <?php echo ! $verified ? 'not-verified" disabled="disabled' : 'verified'; ?>" data-demo="./post listing/Smart Sections Post Listing Demo 20 - Ticket Purple Line on Hover.xml">
                                <?php echo ! $verified ? __('Verify purchase') : __('Import', 'gusta-demo'); ?>
                            </button>
                            <a href="https://www.themegusta.com/showcase/#post-listing-demo-20" target="_blank" class="button"></a>
                        </div>
                    </div>
                </div>
				
				<div class="demo-item col-4">
                    <div class="inside">
                        <div class="demo-img">
                            <img src="https://themegusta.com/showcase/previews/post-listing-demo-21.jpg" />
                            <span class="demo-title-hold"></span>
                        </div>

                        <div class="demo-actions">
                            <button type="button" class="button button-primary <?php echo ! $verified ? 'not-verified" disabled="disabled' : 'verified'; ?>" data-demo="./post listing/Smart Sections Post Listing Demo 21 - Dark BG Image on Hover.xml">
                                <?php echo ! $verified ? __('Verify purchase') : __('Import', 'gusta-demo'); ?>
                            </button>
                            <a href="https://www.themegusta.com/showcase/#post-listing-demo-21" target="_blank" class="button"></a>
                        </div>
                    </div>
                </div>
				
				<div class="demo-item col-4">
                    <div class="inside">
                        <div class="demo-img">
                            <img src="https://themegusta.com/showcase/previews/post-listing-demo-22.jpg" />
                            <span class="demo-title-hold"></span>
                        </div>

                        <div class="demo-actions">
                            <button type="button" class="button button-primary <?php echo ! $verified ? 'not-verified" disabled="disabled' : 'verified'; ?>" data-demo="./post listing/Smart Sections Post Listing Demo 22 - Obscure with Hover.xml">
                                <?php echo ! $verified ? __('Verify purchase') : __('Import', 'gusta-demo'); ?>
                            </button>
                            <a href="https://www.themegusta.com/showcase/#post-listing-demo-22" target="_blank" class="button"></a>
                        </div>
                    </div>
                </div>
				
				<div class="demo-item col-4">
                    <div class="inside">
                        <div class="demo-img">
                            <img src="https://themegusta.com/showcase/previews/post-listing-demo-23.jpg" />
                            <span class="demo-title-hold"></span>
                        </div>

                        <div class="demo-actions">
                            <button type="button" class="button button-primary <?php echo ! $verified ? 'not-verified" disabled="disabled' : 'verified'; ?>" data-demo="./post listing/Smart Sections Post Listing Demo 23 - Crypto Dark Blue Background.xml">
                                <?php echo ! $verified ? __('Verify purchase') : __('Import', 'gusta-demo'); ?>
                            </button>
                            <a href="https://www.themegusta.com/showcase/#post-listing-demo-23" target="_blank" class="button"></a>
                        </div>
                    </div>
                </div>
				
				<div class="demo-item col-4">
                    <div class="inside">
                        <div class="demo-img">
                            <img src="https://themegusta.com/showcase/previews/post-listing-demo-24.jpg" />
                            <span class="demo-title-hold"></span>
                        </div>

                        <div class="demo-actions">
                            <button type="button" class="button button-primary <?php echo ! $verified ? 'not-verified" disabled="disabled' : 'verified'; ?>" data-demo="./post listing/Smart Sections Post Listing Demo 24 - Cloud Degrade Framed Image on Hover.xml">
                                <?php echo ! $verified ? __('Verify purchase') : __('Import', 'gusta-demo'); ?>
                            </button>
                            <a href="https://www.themegusta.com/showcase/#post-listing-demo-24" target="_blank" class="button"></a>
                        </div>
                    </div>
                </div>
				
				<div class="demo-item col-4">
                    <div class="inside">
                        <div class="demo-img">
                            <img src="https://themegusta.com/showcase/previews/post-listing-demo-25.jpg" />
                            <span class="demo-title-hold"></span>
                        </div>

                        <div class="demo-actions">
                            <button type="button" class="button button-primary <?php echo ! $verified ? 'not-verified" disabled="disabled' : 'verified'; ?>" data-demo="./post listing/Smart Sections Post Listing Demo 25 - Purple Green Hover.xml">
                                <?php echo ! $verified ? __('Verify purchase') : __('Import', 'gusta-demo'); ?>
                            </button>
                            <a href="https://www.themegusta.com/showcase/#post-listing-demo-25" target="_blank" class="button"></a>
                        </div>
                    </div>
                </div>
				
				<div class="demo-item col-4">
                    <div class="inside">
                        <div class="demo-img">
                            <img src="https://themegusta.com/showcase/previews/post-listing-demo-26.jpg" />
                            <span class="demo-title-hold"></span>
                        </div>

                        <div class="demo-actions">
                            <button type="button" class="button button-primary <?php echo ! $verified ? 'not-verified" disabled="disabled' : 'verified'; ?>" data-demo="./post listing/Smart Sections Post Listing Demo 26 - Dark BG - Anim Author.xml">
                                <?php echo ! $verified ? __('Verify purchase') : __('Import', 'gusta-demo'); ?>
                            </button>
                            <a href="https://www.themegusta.com/showcase/#post-listing-demo-26" target="_blank" class="button"></a>
                        </div>
                    </div>
                </div>
				
				<div class="demo-item col-4">
                    <div class="inside">
                        <div class="demo-img">
                            <img src="https://themegusta.com/showcase/previews/post-listing-demo-27.jpg" />
                            <span class="demo-title-hold"></span>
                        </div>

                        <div class="demo-actions">
                            <button type="button" class="button button-primary <?php echo ! $verified ? 'not-verified" disabled="disabled' : 'verified'; ?>" data-demo="./post listing/Smart Sections Post Listing Demo 27 - White Description Overlay.xml">
                                <?php echo ! $verified ? __('Verify purchase') : __('Import', 'gusta-demo'); ?>
                            </button>
                            <a href="https://www.themegusta.com/showcase/#post-listing-demo-27" target="_blank" class="button"></a>
                        </div>
                    </div>
                </div>
				
				<div class="demo-item col-4">
                    <div class="inside">
                        <div class="demo-img">
                            <img src="https://themegusta.com/showcase/previews/post-listing-demo-28.jpg" />
                            <span class="demo-title-hold"></span>
                        </div>

                        <div class="demo-actions">
                            <button type="button" class="button button-primary <?php echo ! $verified ? 'not-verified" disabled="disabled' : 'verified'; ?>" data-demo="./post listing/Smart Sections Post Listing Demo 28 - Flat Contrast.xml">
                                <?php echo ! $verified ? __('Verify purchase') : __('Import', 'gusta-demo'); ?>
                            </button>
                            <a href="https://www.themegusta.com/showcase/#post-listing-demo-28" target="_blank" class="button"></a>
                        </div>
                    </div>
                </div>
				
				<div class="demo-item col-4">
                    <div class="inside">
                        <div class="demo-img">
                            <img src="https://themegusta.com/showcase/previews/post-listing-demo-29.jpg" />
                            <span class="demo-title-hold"></span>
                        </div>

                        <div class="demo-actions">
                            <button type="button" class="button button-primary <?php echo ! $verified ? 'not-verified" disabled="disabled' : 'verified'; ?>" data-demo="./post listing/Smart Sections Post Listing Demo 29 - Elegant Border.xml">
                                <?php echo ! $verified ? __('Verify purchase') : __('Import', 'gusta-demo'); ?>
                            </button>
                            <a href="https://www.themegusta.com/showcase/#post-listing-demo-29" target="_blank" class="button"></a>
                        </div>
                    </div>
                </div>
				
				<div class="demo-item col-4">
                    <div class="inside">
                        <div class="demo-img">
                            <img src="https://themegusta.com/showcase/previews/post-listing-demo-30.jpg" />
                            <span class="demo-title-hold"></span>
                        </div>

                        <div class="demo-actions">
                            <button type="button" class="button button-primary <?php echo ! $verified ? 'not-verified" disabled="disabled' : 'verified'; ?>" data-demo="./post listing/Smart Sections Post Listing Demo 30 - Picture of the Day.xml">
                                <?php echo ! $verified ? __('Verify purchase') : __('Import', 'gusta-demo'); ?>
                            </button>
                            <a href="https://www.themegusta.com/showcase/#post-listing-demo-30" target="_blank" class="button"></a>
                        </div>
                    </div>
                </div>
				
				<div class="demo-item col-4">
                    <div class="inside">
                        <div class="demo-img">
                            <img src="https://themegusta.com/showcase/previews/post-listing-demo-31.jpg" />
                            <span class="demo-title-hold"></span>
                        </div>

                        <div class="demo-actions">
                            <button type="button" class="button button-primary <?php echo ! $verified ? 'not-verified" disabled="disabled' : 'verified'; ?>" data-demo="./post listing/Smart Sections Post Listing Demo 31 - Flat Border Bottom.xml">
                                <?php echo ! $verified ? __('Verify purchase') : __('Import', 'gusta-demo'); ?>
                            </button>
                            <a href="https://www.themegusta.com/showcase/#post-listing-demo-31" target="_blank" class="button"></a>
                        </div>
                    </div>
                </div>
				
				<div class="demo-item col-4">
                    <div class="inside">
                        <div class="demo-img">
                            <img src="https://themegusta.com/showcase/previews/post-listing-demo-32.jpg" />
                            <span class="demo-title-hold"></span>
                        </div>

                        <div class="demo-actions">
                            <button type="button" class="button button-primary <?php echo ! $verified ? 'not-verified" disabled="disabled' : 'verified'; ?>" data-demo="./post listing/Smart Sections Post Listing Demo 32 - Dark Hover Overlay.xml">
                                <?php echo ! $verified ? __('Verify purchase') : __('Import', 'gusta-demo'); ?>
                            </button>
                            <a href="https://www.themegusta.com/showcase/#post-listing-demo-32" target="_blank" class="button"></a>
                        </div>
                    </div>
                </div>
				
				<div class="demo-item col-4">
                    <div class="inside">
                        <div class="demo-img">
                            <img src="https://themegusta.com/showcase/previews/post-listing-demo-33.jpg" />
                            <span class="demo-title-hold"></span>
                        </div>

                        <div class="demo-actions">
                            <button type="button" class="button button-primary <?php echo ! $verified ? 'not-verified" disabled="disabled' : 'verified'; ?>" data-demo="./post listing/Smart Sections Post Listing Demo 33 - Gradient Hover Overlay - Learn More.xml">
                                <?php echo ! $verified ? __('Verify purchase') : __('Import', 'gusta-demo'); ?>
                            </button>
                            <a href="https://www.themegusta.com/showcase/#post-listing-demo-33" target="_blank" class="button"></a>
                        </div>
                    </div>
                </div>
				
				<div class="demo-item col-4">
                    <div class="inside">
                        <div class="demo-img">
                            <img src="https://themegusta.com/showcase/previews/post-listing-demo-34.jpg" />
                            <span class="demo-title-hold"></span>
                        </div>

                        <div class="demo-actions">
                            <button type="button" class="button button-primary <?php echo ! $verified ? 'not-verified" disabled="disabled' : 'verified'; ?>" data-demo="./post listing/Smart Sections Post Listing Demo 34 - Dark Overlay - Hover Category and Date.xml">
                                <?php echo ! $verified ? __('Verify purchase') : __('Import', 'gusta-demo'); ?>
                            </button>
                            <a href="https://www.themegusta.com/showcase/#post-listing-demo-34" target="_blank" class="button"></a>
                        </div>
                    </div>
                </div>
				
				<div class="demo-item col-4">
                    <div class="inside">
                        <div class="demo-img">
                            <img src="https://themegusta.com/showcase/previews/post-listing-demo-35.jpg" />
                            <span class="demo-title-hold"></span>
                        </div>

                        <div class="demo-actions">
                            <button type="button" class="button button-primary <?php echo ! $verified ? 'not-verified" disabled="disabled' : 'verified'; ?>" data-demo="./post listing/Smart Sections Post Listing Demo 35 - Flat - Hover Shadow Up.xml">
                                <?php echo ! $verified ? __('Verify purchase') : __('Import', 'gusta-demo'); ?>
                            </button>
                            <a href="https://www.themegusta.com/showcase/#post-listing-demo-35" target="_blank" class="button"></a>
                        </div>
                    </div>
                </div>
				
				<div class="demo-item col-4">
                    <div class="inside">
                        <div class="demo-img">
                            <img src="https://themegusta.com/showcase/previews/post-listing-demo-36.jpg" />
                            <span class="demo-title-hold"></span>
                        </div>

                        <div class="demo-actions">
                            <button type="button" class="button button-primary <?php echo ! $verified ? 'not-verified" disabled="disabled' : 'verified'; ?>" data-demo="./post listing/Smart Sections Post Listing Demo 36 - Padded Border - White Overlay.xml">
                                <?php echo ! $verified ? __('Verify purchase') : __('Import', 'gusta-demo'); ?>
                            </button>
                            <a href="https://www.themegusta.com/showcase/#post-listing-demo-36" target="_blank" class="button"></a>
                        </div>
                    </div>
                </div>
				
				<div class="demo-item col-4">
                    <div class="inside">
                        <div class="demo-img">
                            <img src="https://themegusta.com/showcase/previews/post-listing-demo-37.jpg" />
                            <span class="demo-title-hold"></span>
                        </div>

                        <div class="demo-actions">
                            <button type="button" class="button button-primary <?php echo ! $verified ? 'not-verified" disabled="disabled' : 'verified'; ?>" data-demo="./post listing/Smart Sections Post Listing Demo 37 - Dark Overlay - Text Center.xml">
                                <?php echo ! $verified ? __('Verify purchase') : __('Import', 'gusta-demo'); ?>
                            </button>
                            <a href="https://www.themegusta.com/showcase/#post-listing-demo-37" target="_blank" class="button"></a>
                        </div>
                    </div>
                </div>
				
				<div class="demo-item col-4">
                    <div class="inside">
                        <div class="demo-img">
                            <img src="https://themegusta.com/showcase/previews/post-listing-demo-38.jpg" />
                            <span class="demo-title-hold"></span>
                        </div>

                        <div class="demo-actions">
                            <button type="button" class="button button-primary <?php echo ! $verified ? 'not-verified" disabled="disabled' : 'verified'; ?>" data-demo="./post listing/Smart Sections Post Listing Demo 38 - Overlay Text on Hover - Circle Button.xml">
                                <?php echo ! $verified ? __('Verify purchase') : __('Import', 'gusta-demo'); ?>
                            </button>
                            <a href="https://www.themegusta.com/showcase/#post-listing-demo-38" target="_blank" class="button"></a>
                        </div>
                    </div>
                </div>
				
				<div class="demo-item col-4">
                    <div class="inside">
                        <div class="demo-img">
                            <img src="https://themegusta.com/showcase/previews/post-listing-demo-39.jpg" />
                            <span class="demo-title-hold"></span>
                        </div>

                        <div class="demo-actions">
                            <button type="button" class="button button-primary <?php echo ! $verified ? 'not-verified" disabled="disabled' : 'verified'; ?>" data-demo="./post listing/Smart Sections Post Listing Demo 39 - Full Width Overlay Text and Social.xml">
                                <?php echo ! $verified ? __('Verify purchase') : __('Import', 'gusta-demo'); ?>
                            </button>
                            <a href="https://www.themegusta.com/showcase/#post-listing-demo-39" target="_blank" class="button"></a>
                        </div>
                    </div>
                </div>
				
				<div class="demo-item col-4">
                    <div class="inside">
                        <div class="demo-img">
                            <img src="https://themegusta.com/showcase/previews/post-listing-demo-40.jpg" />
                            <span class="demo-title-hold"></span>
                        </div>

                        <div class="demo-actions">
                            <button type="button" class="button button-primary <?php echo ! $verified ? 'not-verified" disabled="disabled' : 'verified'; ?>" data-demo="./post listing/Smart Sections Post Listing Demo 40 - White BG Padding on Hover.xml">
                                <?php echo ! $verified ? __('Verify purchase') : __('Import', 'gusta-demo'); ?>
                            </button>
                            <a href="https://www.themegusta.com/showcase/#post-listing-demo-40" target="_blank" class="button"></a>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <h3><?php _e('Sticky', 'mb_framwork'); ?></h3>
                </div>
                
                <div class="demo-item col-4">
                    <div class="inside">
                        <div class="demo-img">
                            <img src="https://www.themegusta.com/smartsections/wp-content/uploads/2018/03/1-8.jpg" />
                            <span class="demo-title-hold"></span>
                        </div>

                        <div class="demo-actions">
                            <button type="button" class="button button-primary <?php echo ! $verified ? 'not-verified" disabled="disabled' : 'verified'; ?>" data-demo="./sticky/Sticky Demo 1 - Pop-up call to action modal box.xml">
                                <?php echo ! $verified ? __('Verify purchase') : __('Import', 'gusta-demo'); ?>
                            </button>
                            <a href="https://www.themegusta.com/showcase/#sticky-demo-1" target="_blank" class="button"></a>
                        </div>
                    </div>
                </div>
                
                <div class="demo-item col-4">
                    <div class="inside">
                        <div class="demo-img">
                            <img src="https://www.themegusta.com/smartsections/wp-content/uploads/2018/03/2-7.jpg" />
                            <span class="demo-title-hold"></span>
                        </div>

                        <div class="demo-actions">
                            <button type="button" class="button button-primary <?php echo ! $verified ? 'not-verified" disabled="disabled' : 'verified'; ?>" data-demo="./sticky/Sticky Demo 2 - Expanding sticky search at the bottom.xml">
                                <?php echo ! $verified ? __('Verify purchase') : __('Import', 'gusta-demo'); ?>
                            </button>
                            <a href="https://www.themegusta.com/showcase/#sticky-demo-2" target="_blank" class="button"></a>
                        </div>
                    </div>
                </div>
                
                <div class="demo-item col-4">
                    <div class="inside">
                        <div class="demo-img">
                            <img src="https://www.themegusta.com/smartsections/wp-content/uploads/2018/03/3-7.jpg" />
                            <span class="demo-title-hold"></span>
                        </div>

                        <div class="demo-actions">
                            <button type="button" class="button button-primary <?php echo ! $verified ? 'not-verified" disabled="disabled' : 'verified'; ?>" data-demo="./sticky/Sticky Demo 3 - Sticky social sharing box at the middle left.xml">
                                <?php echo ! $verified ? __('Verify purchase') : __('Import', 'gusta-demo'); ?>
                            </button>
                            <a href="https://www.themegusta.com/showcase/#sticky-demo-3" target="_blank" class="button"></a>
                        </div>
                    </div>
                </div>
                
                <div class="demo-item col-4">
                    <div class="inside">
                        <div class="demo-img">
                            <img src="https://www.themegusta.com/smartsections/wp-content/uploads/2018/03/4-6.jpg" />
                            <span class="demo-title-hold"></span>
                        </div>

                        <div class="demo-actions">
                            <button type="button" class="button button-primary <?php echo ! $verified ? 'not-verified" disabled="disabled' : 'verified'; ?>" data-demo="./sticky/Sticky Demo 4 - Sticky Social Sharing Box at the bottom.xml">
                                <?php echo ! $verified ? __('Verify purchase') : __('Import', 'gusta-demo'); ?>
                            </button>
                            <a href="https://www.themegusta.com/showcase/#sticky-demo-4" target="_blank" class="button"></a>
                        </div>
                    </div>
                </div>
                
                <div class="demo-item col-4">
                    <div class="inside">
                        <div class="demo-img">
                            <img src="https://www.themegusta.com/smartsections/wp-content/uploads/2018/03/5-6.jpg" />
                            <span class="demo-title-hold"></span>
                        </div>

                        <div class="demo-actions">
                            <button type="button" class="button button-primary <?php echo ! $verified ? 'not-verified" disabled="disabled' : 'verified'; ?>" data-demo="./sticky/Sticky Demo 5 - Toggle triggered Contact Form 7.xml">
                                <?php echo ! $verified ? __('Verify purchase') : __('Import', 'gusta-demo'); ?>
                            </button>
                            <a href="https://www.themegusta.com/showcase/#sticky-demo-5" target="_blank" class="button"></a>
                        </div>
                    </div>
                </div>
                
                <div class="col-12">
                    <h3><?php _e('Mega Menu', 'mb_framwork'); ?></h3>
                </div>
                
                <div class="demo-item col-4">
                    <div class="inside">
                        <div class="demo-img">
                            <img src="https://www.themegusta.com/smartsections/wp-content/uploads/2018/03/1-4.jpg" />
                            <span class="demo-title-hold"></span>
                        </div>

                        <div class="demo-actions">
                            <button type="button" class="button button-primary <?php echo ! $verified ? 'not-verified" disabled="disabled' : 'verified'; ?>" data-demo="./mega menu/Mega Menu Demo 1 - With tour element.xml">
                                <?php echo ! $verified ? __('Verify purchase') : __('Import', 'gusta-demo'); ?>
                            </button>
                            <a href="https://www.themegusta.com/showcase/#mega-menu-demo-1" target="_blank" class="button"></a>
                        </div>
                    </div>
                </div>
                
                <div class="demo-item col-4">
                    <div class="inside">
                        <div class="demo-img">
                            <img src="https://www.themegusta.com/smartsections/wp-content/uploads/2018/03/2-3.jpg" />
                            <span class="demo-title-hold"></span>
                        </div>

                        <div class="demo-actions">
                            <button type="button" class="button button-primary <?php echo ! $verified ? 'not-verified" disabled="disabled' : 'verified'; ?>" data-demo="./mega menu/Mega Menu Demo 2 - Six columns with an image.xml">
                                <?php echo ! $verified ? __('Verify purchase') : __('Import', 'gusta-demo'); ?>
                            </button>
                            <a href="https://www.themegusta.com/showcase/#mega-menu-demo-2" target="_blank" class="button"></a>
                        </div>
                    </div>
                </div>
                
                <div class="demo-item col-4">
                    <div class="inside">
                        <div class="demo-img">
                            <img src="https://www.themegusta.com/smartsections/wp-content/uploads/2018/03/mega-menu-3.jpg" />
                            <span class="demo-title-hold"></span>
                        </div>

                        <div class="demo-actions">
                            <button type="button" class="button button-primary <?php echo ! $verified ? 'not-verified" disabled="disabled' : 'verified'; ?>" data-demo="./mega menu/Mega Menu Demo 3 - Three columns with image above.xml">
                                <?php echo ! $verified ? __('Verify purchase') : __('Import', 'gusta-demo'); ?>
                            </button>
                            <a href="https://www.themegusta.com/showcase/#mega-menu-demo-3" target="_blank" class="button"></a>
                        </div>
                    </div>
                </div>
                
                <div class="demo-item col-4">
                    <div class="inside">
                        <div class="demo-img">
                            <img src="https://www.themegusta.com/smartsections/wp-content/uploads/2018/03/4-3.jpg" />
							<span class="demo-title-hold"></span>
                        </div>

                        <div class="demo-actions">
                            <button type="button" class="button button-primary <?php echo ! $verified ? 'not-verified" disabled="disabled' : 'verified'; ?>" data-demo="./mega menu/Mega Menu Demo 4 - Latest Posts.xml">
                                <?php echo ! $verified ? __('Verify purchase') : __('Import', 'gusta-demo'); ?>
                            </button>
                            <a href="https://www.themegusta.com/showcase/#mega-menu-demo-4" target="_blank" class="button"></a>
                        </div>
                    </div>
                </div>
                
                <div class="demo-item col-4">
                    <div class="inside">
                        <div class="demo-img">
                            <img src="https://www.themegusta.com/smartsections/wp-content/uploads/2018/03/5-3.jpg" />
                            <span class="demo-title-hold"></span>
                        </div>

                        <div class="demo-actions">
                            <button type="button" class="button button-primary <?php echo ! $verified ? 'not-verified" disabled="disabled' : 'verified'; ?>" data-demo="./mega menu/Mega Menu Demo 5 - Four columns with latest posts and social media links.xml">
                                <?php echo ! $verified ? __('Verify purchase') : __('Import', 'gusta-demo'); ?>
                            </button>
                            <a href="https://www.themegusta.com/showcase/#mega-menu-demo-5" target="_blank" class="button"></a>
                        </div>
                    </div>
                </div>
                
                <div class="col-12">
                    <h3><?php _e('Content', 'mb_framwork'); ?></h3>
                </div>
                
                <div class="demo-item col-4">
                    <div class="inside">
                        <div class="demo-img">
                            <img src="https://www.themegusta.com/smartsections/wp-content/uploads/2018/03/1-5.jpg" />
                            <span class="demo-title-hold"></span>
                        </div>

                        <div class="demo-actions">
                            <button type="button" class="button button-primary <?php echo ! $verified ? 'not-verified" disabled="disabled' : 'verified'; ?>" data-demo="./content/Content Demo 1 - Simple stylish call to action with icon and button.xml">
                                <?php echo ! $verified ? __('Verify purchase') : __('Import', 'gusta-demo'); ?>
                            </button>
                            <a href="https://www.themegusta.com/showcase/#content-demo-1" target="_blank" class="button"></a>
                        </div>
                    </div>
                </div>
                
                <div class="demo-item col-4">
                    <div class="inside">
                        <div class="demo-img">
                            <img src="https://www.themegusta.com/smartsections/wp-content/uploads/2018/03/2-4.jpg" />
                            <span class="demo-title-hold"></span>
                        </div>

                        <div class="demo-actions">
                            <button type="button" class="button button-primary <?php echo ! $verified ? 'not-verified" disabled="disabled' : 'verified'; ?>" data-demo="./content/Content Demo 2 - Mailchimp subsciption form.xml">
                                <?php echo ! $verified ? __('Verify purchase') : __('Import', 'gusta-demo'); ?>
                            </button>
                            <a href="https://www.themegusta.com/showcase/#content-demo-2" target="_blank" class="button"></a>
                        </div>
                    </div>
                </div>
                
                <div class="demo-item col-4">
                    <div class="inside">
                        <div class="demo-img">
                            <img src="https://www.themegusta.com/smartsections/wp-content/uploads/2018/03/3-4.jpg" />
                            <span class="demo-title-hold"></span>
                        </div>

                        <div class="demo-actions">
                            <button type="button" class="button button-primary <?php echo ! $verified ? 'not-verified" disabled="disabled' : 'verified'; ?>" data-demo="./content/Content Demo 3 - Author info and comment box.xml">
                                <?php echo ! $verified ? __('Verify purchase') : __('Import', 'gusta-demo'); ?>
                            </button>
                            <a href="https://www.themegusta.com/showcase/#content-demo-3" target="_blank" class="button"></a>
                        </div>
                    </div>
                </div>
                
                <div class="demo-item col-4">
                    <div class="inside">
                        <div class="demo-img">
                            <img src="https://www.themegusta.com/smartsections/wp-content/uploads/2018/03/4-4.jpg" />
                            <span class="demo-title-hold"></span>
                        </div>

                        <div class="demo-actions">
                            <button type="button" class="button button-primary <?php echo ! $verified ? 'not-verified" disabled="disabled' : 'verified'; ?>" data-demo="./content/Content Demo 4 - Meta data and featured image.xml">
                                <?php echo ! $verified ? __('Verify purchase') : __('Import', 'gusta-demo'); ?>
                            </button>
                            <a href="https://www.themegusta.com/showcase/#content-demo-4" target="_blank" class="button"></a>
                        </div>
                    </div>
                </div>
                
                <div class="demo-item col-4">
                    <div class="inside">
                        <div class="demo-img">
                            <img src="https://www.themegusta.com/smartsections/wp-content/uploads/2018/03/5-4.jpg" />
                            <span class="demo-title-hold"></span>
                        </div>

                        <div class="demo-actions">
                            <button type="button" class="button button-primary <?php echo ! $verified ? 'not-verified" disabled="disabled' : 'verified'; ?>" data-demo="./content/Content Demo 5 - Multiple post listing layouts.xml">
                                <?php echo ! $verified ? __('Verify purchase') : __('Import', 'gusta-demo'); ?>
                            </button>
                            <a href="https://www.themegusta.com/showcase/#content-demo-5" target="_blank" class="button"></a>
                        </div>
                    </div>
                </div>
                
                <div class="demo-item col-4">
                    <div class="inside">
                        <div class="demo-img">
                            <img src="https://www.themegusta.com/smartsections/wp-content/uploads/2018/03/6-3.jpg" />
                            <span class="demo-title-hold"></span>
                        </div>

                        <div class="demo-actions">
                            <button type="button" class="button button-primary <?php echo ! $verified ? 'not-verified" disabled="disabled' : 'verified'; ?>" data-demo="./content/Content Demo 6 - Related posts.xml">
                                <?php echo ! $verified ? __('Verify purchase') : __('Import', 'gusta-demo'); ?>
                            </button>
                            <a href="https://www.themegusta.com/showcase/#content-demo-6" target="_blank" class="button"></a>
                        </div>
                    </div>
                </div>
                
                <div class="demo-item col-4">
                    <div class="inside">
                        <div class="demo-img">
                            <img src="https://www.themegusta.com/smartsections/wp-content/uploads/2018/03/7-2.jpg" />
                            <span class="demo-title-hold"></span>
                        </div>

                        <div class="demo-actions">
                            <button type="button" class="button button-primary <?php echo ! $verified ? 'not-verified" disabled="disabled' : 'verified'; ?>" data-demo="./content/Content Demo 7 - Dark page title with featured image and breadcrumb.xml">
                                <?php echo ! $verified ? __('Verify purchase') : __('Import', 'gusta-demo'); ?>
                            </button>
                            <a href="https://www.themegusta.com/showcase/#content-demo-7" target="_blank" class="button"></a>
                        </div>
                    </div>
                </div>
                
                <div class="demo-item col-4">
                    <div class="inside">
                        <div class="demo-img">
                            <img src="https://www.themegusta.com/smartsections/wp-content/uploads/2018/03/8-2.jpg" />
                            <span class="demo-title-hold"></span>
                        </div>

                        <div class="demo-actions">
                            <button type="button" class="button button-primary <?php echo ! $verified ? 'not-verified" disabled="disabled' : 'verified'; ?>" data-demo="./content/Content Demo 8 - Page title with featured image date and author.xml">
                                <?php echo ! $verified ? __('Verify purchase') : __('Import', 'gusta-demo'); ?>
                            </button>
                            <a href="https://www.themegusta.com/showcase/#content-demo-8" target="_blank" class="button"></a>
                        </div>
                    </div>
                </div>
                
                <div class="col-12">
                    <h3><?php _e('Page & Post Template', 'mb_framwork'); ?></h3>
                </div>

                <div class="demo-item col-3">
                    <div class="inside">
                        <div class="demo-img">
                            <img src="https://www.themegusta.com/smartsections/wp-content/uploads/2018/03/1-7.jpg" />
                            <span class="demo-title-hold"></span>
                        </div>

                        <div class="demo-actions">
                            <button type="button" class="button button-primary <?php echo ! $verified ? 'not-verified" disabled="disabled' : 'verified'; ?>" data-demo="./layout/Layout Demo 1 - Layout template with full screen featured image and boxed content.xml">
                                <?php echo ! $verified ? __('Verify purchase') : __('Import', 'gusta-demo'); ?>
                            </button>
                            <a href="https://www.themegusta.com/showcase/#layout-demo-1" target="_blank" class="button"><?php _e('', 'gusta-demo'); ?></a>
                        </div>
                    </div>
                </div>
                <div class="demo-item col-3">
                    <div class="inside">
                        <div class="demo-img">
                            <img src="https://www.themegusta.com/smartsections/wp-content/uploads/2018/03/2-6.jpg" />
                            <span class="demo-title-hold"></span>
                        </div>

                        <div class="demo-actions">
                            <button type="button" class="button button-primary <?php echo ! $verified ? 'not-verified" disabled="disabled' : 'verified'; ?>" data-demo="./layout/Layout Demo 2 - Layout template with meta data, sidebar and comments box.xml">
                                <?php echo ! $verified ? __('Verify purchase') : __('Import', 'gusta-demo'); ?>
                            </button>
                            <a href="https://www.themegusta.com/showcase/#layout-demo-2" target="_blank" class="button"><?php _e('', 'gusta-demo'); ?></a>
                        </div>
                    </div>
                </div>
                <div class="demo-item col-3">
                    <div class="inside">
                        <div class="demo-img">
                            <img src="https://www.themegusta.com/smartsections/wp-content/uploads/2018/03/3-6.jpg" />
                            <span class="demo-title-hold"></span>
                        </div>

                        <div class="demo-actions">
                            <button type="button" class="button button-primary <?php echo ! $verified ? 'not-verified" disabled="disabled' : 'verified'; ?>" data-demo="./layout/Layout Demo 3 - Side full height image layout template.xml">
                                <?php echo ! $verified ? __('Verify purchase') : __('Import', 'gusta-demo'); ?>
                            </button>
                            <a href="https://www.themegusta.com/showcase/#layout-demo-3" target="_blank" class="button"><?php _e('', 'gusta-demo'); ?></a>
                        </div>
                    </div>
                </div>
                <div class="demo-item col-3">
                    <div class="inside">
                        <div class="demo-img">
                            <img src="https://www.themegusta.com/smartsections/wp-content/uploads/2018/03/page-layout4.jpg" />
                            <span class="demo-title-hold"></span>
                        </div>

                        <div class="demo-actions">
                            <button type="button" class="button button-primary <?php echo ! $verified ? 'not-verified" disabled="disabled' : 'verified'; ?>" data-demo="./layout/Layout Demo 4 - 404 Page.xml">
                                <?php echo ! $verified ? __('Verify purchase') : __('Import', 'gusta-demo'); ?>
                            </button>
                            <a href="https://www.themegusta.com/showcase/#layout-demo-4" target="_blank" class="button"><?php _e('', 'gusta-demo'); ?></a>
                        </div>
                    </div>
                </div>
                
                <div class="col-12">
                    <h3><?php _e('Widgetized Sidebar', 'mb_framwork'); ?></h3>
                </div>

                <div class="demo-item col-4">
                    <div class="inside">
                        <div class="demo-img">
                            <img src="https://www.themegusta.com/smartsections/wp-content/uploads/2018/03/1-6.jpg" />
                            <span class="demo-title-hold"></span>
                        </div>

                        <div class="demo-actions">
                            <button type="button" class="button button-primary <?php echo ! $verified ? 'not-verified" disabled="disabled' : 'verified'; ?>" data-demo="./sidebar/Smart Sections Sidebar Demo 1 - Comments Tab.xml">
                                <?php echo ! $verified ? __('Verify purchase') : __('Import', 'gusta-demo'); ?>
                            </button>
                            <a href="https://www.themegusta.com/showcase/#sidebar-demo-1" target="_blank" class="button"><?php _e('', 'gusta-demo'); ?></a>
                        </div>
                    </div>
                </div>
                <div class="demo-item col-4">
                    <div class="inside">
                        <div class="demo-img">
                            <img src="https://www.themegusta.com/smartsections/wp-content/uploads/2018/03/2-5.jpg" />
                            <span class="demo-title-hold"></span>
                        </div>

                        <div class="demo-actions">
                            <button type="button" class="button button-primary <?php echo ! $verified ? 'not-verified" disabled="disabled' : 'verified'; ?>" data-demo="./sidebar/Smart Sections Sidebar Demo 2 - Call to Action.xml">
                                <?php echo ! $verified ? __('Verify purchase') : __('Import', 'gusta-demo'); ?>
                            </button>
                            <a href="https://www.themegusta.com/showcase/#sidebar-demo-2" target="_blank" class="button"><?php _e('', 'gusta-demo'); ?></a>
                        </div>
                    </div>
                </div>
                <div class="demo-item col-4">
                    <div class="inside">
                        <div class="demo-img">
                            <img src="https://www.themegusta.com/smartsections/wp-content/uploads/2018/03/3-5.jpg" />
                            <span class="demo-title-hold"></span>
                        </div>

                        <div class="demo-actions">
                            <button type="button" class="button button-primary <?php echo ! $verified ? 'not-verified" disabled="disabled' : 'verified'; ?>" data-demo="./sidebar/Smart Sections Sidebar Demo 3 - Post Listing.xml">
                                <?php echo ! $verified ? __('Verify purchase') : __('Import', 'gusta-demo'); ?>
                            </button>
                            <a href="https://www.themegusta.com/showcase/#sidebar-demo-3" target="_blank" class="button"><?php _e('', 'gusta-demo'); ?></a>
                        </div>
                    </div>
                </div>
                <div class="demo-item col-4">
                    <div class="inside">
                        <div class="demo-img">
                            <img src="https://www.themegusta.com/smartsections/wp-content/uploads/2018/03/4-5.jpg" />
                            <span class="demo-title-hold"></span>
                        </div>

                        <div class="demo-actions">
                            <button type="button" class="button button-primary <?php echo ! $verified ? 'not-verified" disabled="disabled' : 'verified'; ?>" data-demo="./sidebar/Smart Sections Sidebar Demo 4 - Basic Menu.xml">
                                <?php echo ! $verified ? __('Verify purchase') : __('Import', 'gusta-demo'); ?>
                            </button>
                            <a href="https://www.themegusta.com/showcase/#sidebar-demo-4" target="_blank" class="button"><?php _e('', 'gusta-demo'); ?></a>
                        </div>
                    </div>
                </div>
                <div class="demo-item col-4">
                    <div class="inside">
                        <div class="demo-img">
                            <img src="https://www.themegusta.com/smartsections/wp-content/uploads/2018/03/5-5.jpg" />
                            <span class="demo-title-hold"></span>
                        </div>

                        <div class="demo-actions">
                            <button type="button" class="button button-primary <?php echo ! $verified ? 'not-verified" disabled="disabled' : 'verified'; ?>" data-demo="./sidebar/Smart Sections Sidebar Demo 5 - Author Info Box.xml">
                                <?php echo ! $verified ? __('Verify purchase') : __('Import', 'gusta-demo'); ?>
                            </button>
                            <a href="https://www.themegusta.com/showcase/#sidebar-demo-5" target="_blank" class="button"><?php _e('', 'gusta-demo'); ?></a>
                        </div>
                    </div>
                </div>
                
                <div class="col-12">
                    <h3><?php _e('Footer', 'mb_framwork'); ?></h3>
                </div>
                
                <div class="demo-item col-4">
                    <div class="inside">
                        <div class="demo-img">
                            <img src="https://www.themegusta.com/smartsections/wp-content/uploads/2017/12/footer1.jpg" />
                            <span class="demo-title-hold"></span>
                        </div>

                        <div class="demo-actions">
                            <button type="button" class="button button-primary <?php echo ! $verified ? 'not-verified" disabled="disabled' : 'verified'; ?>" data-demo="./footer/Footer Demo 1 - Dark background footer with four columns plus two columns.xml">
                                <?php echo ! $verified ? __('Verify purchase') : __('Import', 'gusta-demo'); ?>
                            </button>
                            <a href="https://www.themegusta.com/showcase/#footer-demo-1" target="_blank" class="button"><?php _e('', 'gusta-demo'); ?></a>
                        </div>
                    </div>
                </div>
                
                <div class="demo-item col-4">
                    <div class="inside">
                        <div class="demo-img">
                            <img src="https://www.themegusta.com/smartsections/wp-content/uploads/2017/12/footer2.jpg" />
                            <span class="demo-title-hold"></span>
                        </div>

                        <div class="demo-actions">
                            <button type="button" class="button button-primary <?php echo ! $verified ? 'not-verified" disabled="disabled' : 'verified'; ?>" data-demo="./footer/Footer Demo 2 - Footer with google map and toggle pop-up contact form.xml">
                                <?php echo ! $verified ? __('Verify purchase') : __('Import', 'gusta-demo'); ?>
                            </button>
                            <a href="https://www.themegusta.com/showcase/#footer-demo-2" target="_blank" class="button"><?php _e('', 'gusta-demo'); ?></a>
                        </div>
                    </div>
                </div>
                
                <div class="demo-item col-4">
                    <div class="inside">
                        <div class="demo-img">
                            <img src="https://www.themegusta.com/smartsections/wp-content/uploads/2017/12/footer3.jpg" />
                            <span class="demo-title-hold"></span>
                        </div>

                        <div class="demo-actions">
                            <button type="button" class="button button-primary <?php echo ! $verified ? 'not-verified" disabled="disabled' : 'verified'; ?>" data-demo="./footer/Footer Demo 3 - 3 column center aligned footer with dark background.xml">
                                <?php echo ! $verified ? __('Verify purchase') : __('Import', 'gusta-demo'); ?>
                            </button>
                            <a href="https://www.themegusta.com/showcase/#footer-demo-3" target="_blank" class="button"><?php _e('', 'gusta-demo'); ?></a>
                        </div>
                    </div>
                </div>
                
                <div class="demo-item col-4">
                    <div class="inside">
                        <div class="demo-img">
                            <img src="https://www.themegusta.com/smartsections/wp-content/uploads/2017/12/footer4.jpg" />
                            <span class="demo-title-hold"></span>
                        </div>

                        <div class="demo-actions">
                            <button type="button" class="button button-primary <?php echo ! $verified ? 'not-verified" disabled="disabled' : 'verified'; ?>" data-demo="./footer/Footer Demo 4 - Footer with a dark box at the left side.xml">
                                <?php echo ! $verified ? __('Verify purchase') : __('Import', 'gusta-demo'); ?>
                            </button>
                            <a href="https://www.themegusta.com/showcase/#footer-demo-4" target="_blank" class="button"><?php _e('', 'gusta-demo'); ?></a>
                        </div>
                    </div>
                </div>
                
                <div class="demo-item col-4">
                    <div class="inside">
                        <div class="demo-img">
                            <img src="https://www.themegusta.com/smartsections/wp-content/uploads/2017/12/footer5.jpg" />
                            <span class="demo-title-hold"></span>
                        </div>

                        <div class="demo-actions">
                            <button type="button" class="button button-primary <?php echo ! $verified ? 'not-verified" disabled="disabled' : 'verified'; ?>" data-demo="./footer/Footer Demo 5 - Footer with a top bar.xml">
                                <?php echo ! $verified ? __('Verify purchase') : __('Import', 'gusta-demo'); ?>
                            </button>
                            <a href="https://www.themegusta.com/showcase/#footer-demo-5" target="_blank" class="button"><?php _e('', 'gusta-demo'); ?></a>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>

<?php endif; ?>