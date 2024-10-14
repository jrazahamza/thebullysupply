/**
 * Huger for Elementor
 * Customizable mega menu for Elementor editor
 * Exclusively on https://1.envato.market/huger-elementor
 *
 * @encoding        UTF-8
 * @version         1.0.9
 * @copyright       (C) 2018 - 2022 Merkulove ( https://merkulov.design/ ). All rights reserved.
 * @license         Envato License https://1.envato.market/KYbje
 * @contributors    Nemirovskiy Vitaliy (nemirovskiyvitaliy@gmail.com), Dmitry Merkulov (dmitry@merkulov.design), Cherviakov Vlad (vladchervjakov@gmail.com)
 * @support         help@merkulov.design
 **/

"use strict";

/**
 * Mdp huger main object
 * @type {{megaMenu: hugerElementor.megaMenu, menuHover: hugerElementor.menuHover, wpMenu: hugerElementor.wpMenu, addMegaMenu: hugerElementor.addMegaMenu}}
 */

const hugerElementor = {
    megaMenu: function ( wrapperName ) {
        const hugerWrapper = document.querySelector( `.${wrapperName} .mdp-huger-elementor-mega-menu-wrapper` );
        const menuItems = document.querySelectorAll( `.${wrapperName} .mdp-huger-elementor-mega-menu-item` );
        const mediaSize = document.querySelector( `.${wrapperName}` ).dataset.breakpoint;
        const toggleBtn = document.querySelector( `.${wrapperName } .mdp-huger-elementor-toggle-icon` );
        const toggleCloseBtn = document.querySelector( `.${wrapperName } .mdp-huger-elementor-toggle-close-icon` );
        const clickAreaMobile = document.querySelector( `.${wrapperName}` ).dataset.clickArea;
        const dropdownText = document.querySelectorAll( `.${wrapperName} .mdp-huger-elementor-mega-menu-item span` );
        const dropdownIndicator = document.querySelectorAll( `.${wrapperName} .mdp-huger-elementor-mega-menu-item .mdp-huger-elementor-submenu-indicator` );
        const megaMenuLinks = document.querySelectorAll( `.${wrapperName} .mdp-huger-elementor-menu-link` );
        const openSubmenuOnclick = document.querySelector( `.${wrapperName}` ).dataset.openSubmenuOnclik;
        const submenuDesktopClickArea = document.querySelector( `.${wrapperName}` ).dataset.submenuDesktopClickArea;
        const regex = /post=\d+|preview_id=\d+|elementor-preview=\d+/g;

        // set active class for mega menu links
        if ( megaMenuLinks !== null ) {
            const currentPage = document.URL;
            let currentPagePostId;
            if ( currentPage.match( regex ) !== null ) {
                currentPagePostId = currentPage.match( regex ).join( '' ).match( /\d+/g ).join( '' );
            } else {
                currentPagePostId = '';
            }

            megaMenuLinks.forEach( megaMenuLink => {
                const postId = megaMenuLink.dataset.postLinkId;
                if ( currentPagePostId !== '' && postId === currentPagePostId || megaMenuLink.href === currentPage ) {
                    megaMenuLink.parentElement.classList.add( 'mdp-huger-elementor-mega-menu-item-current' );
                }
            } );
        }

        //check if element has parent
        function isDescendant( parent, child ) {
            let node = child.parentNode;
            while ( node !== null ) {
                if( node === parent ) {
                    return true;
                }
                node = node.parentNode;
            }
            return false;
        }

        // menu hover
        this.menuHover( wrapperName, openSubmenuOnclick, hugerWrapper, 'mdp-huger-elementor-mega-menu-item--hover', menuItems, mediaSize,
            clickAreaMobile, submenuDesktopClickArea, dropdownText, dropdownIndicator,  'mdp-huger-elementor-mega-menu-wrapper-mobile', 'mdp-huger-elementor-submenu' );

        if ( mediaSize.replace( /[^0-9]/g,'' ) > 0 ) {
            //close on click outside menu
            document.addEventListener( 'click', e => {
                if( !isDescendant( document.querySelector( `.${wrapperName}` ), e.target ) ) {
                    hugerWrapper.classList.remove( 'mdp-huger-elementor-mega-menu-wrapper--active' );
                    toggleBtn.style.display = 'block';
                    toggleCloseBtn.style.display = 'none';
                }
            } );

            //toggle burger button
            toggleBtn.addEventListener( 'click', () => {
                toggleBtn.style.display = 'none';
                toggleCloseBtn.style.display = 'block';
                hugerWrapper.classList.add( 'mdp-huger-elementor-mega-menu-wrapper--active' );
            } );

            //toggle close button
            toggleCloseBtn.addEventListener( 'click', () => {
                toggleBtn.style.display = 'block';
                toggleCloseBtn.style.display = 'none';
                hugerWrapper.classList.remove( 'mdp-huger-elementor-mega-menu-wrapper--active' );
            } );
        }

        this.wpMenu( wrapperName );

    },

    menuHover: function( wrapperName, openOnclick, menuWrapper, activeItem, menuItems, mediaSize, clickAreaMobile, clickAreaDesktop, dropdownLinks, submenuIndicator,
                         mobileMenuClass, dropdownClass, listenerSubmenuMouseEnter = null, submenuItems = null, includeSubmenuItems = false, menuWrappers = null, checkEdgeWpCallback = null ) {

        const submenuHoverClose = document.querySelector( `.${wrapperName}` ).dataset.submenuHoverClose;

        // check and reposition menu if menu is out of viewport
        function checkEdgeOfScreen( dropdown ) {
            const dropdownPosition = dropdown.getBoundingClientRect();
            const dropdownLeftOffset = dropdown.offsetLeft;
            const windowWidth = window.innerWidth;
            const scrollBarWidth = windowWidth - document.body.offsetWidth;
            if ( dropdown ) {
                if ( Math.floor( dropdownPosition.left ) < 0 ) {
                    dropdown.style.setProperty( 'left', ( Math.floor( dropdownLeftOffset - dropdownPosition.left - scrollBarWidth ) ) + 'px', 'important' );
                    dropdown.style.setProperty( 'right', 'auto', 'important' );
                }
                if ( dropdownPosition.right > windowWidth ) {
                    const offset = dropdownPosition.right - window.innerWidth + scrollBarWidth;
                    dropdown.style.left = ( Math.floor( dropdownLeftOffset - offset ) ) + 'px';
                    dropdown.style.setProperty( 'right', 'auto', 'important' );
                }
            }
        }

        // reset active items on mouse enter
        function resetActiveItems() {
            const activeItems = menuWrapper.querySelectorAll( `.${activeItem}` );

            activeItems.forEach( item => {
                item.classList.remove( `${activeItem}` );
            } );
        }

        // resetting mega menu items
        function resetMegaMenuItems( e ) {
            const wrappers = document.querySelectorAll( `.mdp-huger-elementor-box` );

            wrappers.forEach( wrapper => {
                wrapper.querySelectorAll( `.${activeItem}` ).forEach( itemActive => {
                    if ( wrapper.dataset.widgetId === e.target.dataset.widgetId ) {
                        itemActive.classList.remove(`${activeItem}`);
                    }
                } );
            } );
        }

        // reset dropdowns active items in responsive mode
        function resetClickActiveItems( e, activeClass ) {

            const menuWrapper = e.target.closest( '.mdp-huger-elementor-menu' );

            const activeItems = menuWrapper.querySelectorAll( `.${activeClass}` );

            if ( activeItems !== null ) {
                activeItems.forEach( item => {
                    item.classList.remove( `${activeClass}` );
                } );
            }
        }

        let listenerMouseEnter = function ( e ) {
            let dropdown = e.target.querySelector( `.${dropdownClass}` );

            setTimeout( () => {
                if ( dropdown !== null ) {
                    if ( dropdown.getBoundingClientRect().width > window.innerWidth ) { dropdown.style.width = window.innerWidth + 'px' }
                    checkEdgeOfScreen( dropdown );
                }
            }, 0 );

            if ( !e.target.closest( '.mdp-huger-elementor-submenu' ) || e.target.classList.contains( 'mdp-huger-elementor-wp-menu-item' ) ) {
                resetActiveItems();
            } else {
                resetMegaMenuItems( e );
            }

            e.target.classList.add( `${activeItem}` );
        }

        let listenerMouseLeave = function ( e ) {

            if ( !e.target.closest( '.mdp-huger-elementor-submenu' ) || e.target.classList.contains( 'mdp-huger-elementor-wp-menu-item' ) ) {
                resetActiveItems();
            } else {
                resetMegaMenuItems( e );
            }
        }

        function openSubmenuOnclick( clickArea, activeClass, responsiveMode ) {

            // prevent redirect on click on indicator
            submenuIndicator.forEach( indicator => {
                if ( indicator.classList.contains( 'mdp-huger-elementor-submenu-indicator' ) ) {
                    indicator.addEventListener( 'click', ( e ) => {
                        if ( indicator.parentElement.tagName === 'A' ) {
                            e.preventDefault();
                        }
                    } );
                }
            } );

            const clickAreas = clickArea === 'text' ? dropdownLinks : submenuIndicator;
            resetActiveItems();
            menuItems.forEach( item => {
                item.removeEventListener( 'mouseenter', listenerMouseEnter );
                item.removeEventListener( 'mouseleave', listenerMouseLeave );
            } );

            if ( includeSubmenuItems ) {
                submenuItems.forEach( item => {
                    item.removeEventListener( 'mouseenter', listenerSubmenuMouseEnter );
                } );
            }

            clickAreas.forEach( area => {
                area.onclick = ( e ) => {
                    if ( area.tagName === 'A' || area.parentElement.tagName === 'A' ) {
                        if ( area.parentElement.nextElementSibling.classList.contains( 'mdp-huger-elementor-submenu' ) || area.parentElement.nextElementSibling.classList.contains( 'mdp-huger-elementor-wp-menu-dropdown' ) ) {
                            e.preventDefault();
                        }
                    }
                    let dropdown = includeSubmenuItems ? area.closest( "li" ).querySelector( `.${dropdownClass}` ) : area.parentNode.nextElementSibling;

                    if ( dropdown !== null ) {

                        if ( !responsiveMode ) {
                            setTimeout(() => {
                                checkEdgeOfScreen( dropdown );
                                if ( dropdownClass === 'mdp-huger-elementor-wp-menu-dropdown' ) {
                                    checkEdgeWpCallback( dropdown );
                                }
                            }, 0);
                        }

                        let target;
                        if ( responsiveMode ) {
                            target = dropdown;
                        } else {
                            target = dropdownClass === 'mdp-huger-elementor-wp-menu-dropdown' ? dropdown.parentElement : dropdown.parentElement.closest( '.mdp-huger-elementor-mega-menu-item' );
                        }
                        if ( target.classList.contains( `${activeClass}` ) ) {
                            target.classList.remove( `${activeClass}` );
                        } else {
                            resetClickActiveItems( e, activeClass );
                            target.classList.add( `${activeClass}` );
                        }
                    }
                };
            } );
        }

        function checkSizeOfScreen() {
            if ( window.matchMedia( `(max-width: ${mediaSize})` ).matches ) {
                menuWrapper.classList.add( `${mobileMenuClass}` );

                openSubmenuOnclick( clickAreaMobile, 'mdp-huger-elementor-menu-dropdown-active', true );

            } else {
                if ( openOnclick === 'yes' ) {
                    openSubmenuOnclick( clickAreaDesktop, dropdownClass === 'mdp-huger-elementor-wp-menu-dropdown' ? 'mdp-huger-elementor-wp-menu-item--hover' : 'mdp-huger-elementor-mega-menu-item--hover',
                        false );

                } else {
                    menuItems.forEach( item => {
                        item.addEventListener( 'mouseenter', listenerMouseEnter );

                        if ( submenuHoverClose === 'on-leave' ) {
                            item.addEventListener( 'mouseleave', listenerMouseLeave );
                        } else {
                            item.removeEventListener( 'mouseleave', listenerMouseLeave );
                        }

                    } );

                    if ( includeSubmenuItems ) {
                        submenuItems.forEach( item => {
                            item.addEventListener( 'mouseenter', listenerSubmenuMouseEnter );
                        } );
                    }

                }

                //check if element has parent
                function isDescendant( parent, child ) {
                    let node = child.parentNode;
                    while ( node !== null ) {
                        if( node === parent ) {
                            return true;
                        }
                        node = node.parentNode;
                    }
                    return false;
                }

                // close menu on click outside
                if ( submenuHoverClose === 'on-click' || openOnclick === 'yes' ) {
                    document.addEventListener( 'click', e => {
                        if ( !isDescendant( menuWrapper, e.target ) ) {
                            resetActiveItems();
                        }
                    } );
                }

                menuWrapper.classList.remove( `${mobileMenuClass}` );
            }
        }

        // check screen size on resizing
        window.addEventListener( 'resize', () => {
            checkSizeOfScreen( mediaSize );
        } );

        // check screen size on refresh
        checkSizeOfScreen( mediaSize );
    },

    wpMenu: function ( wrapperName ) {
        const wpMenuWrappers = document.querySelectorAll( `.${wrapperName} .mdp-huger-elementor-wp-menu` );
        const wpMenuItems = document.querySelectorAll( `.${wrapperName} .mdp-huger-elementor-wp-menu > .mdp-huger-elementor-wp-menu-item` );
        const submenuItems = document.querySelectorAll( `.${wrapperName} .mdp-huger-elementor-wp-menu-dropdown > .mdp-huger-elementor-wp-menu-item` );
        const mediaSize = document.querySelector( `.${wrapperName}` ).dataset.breakpoint;
        const clickArea = document.querySelector( `.${wrapperName}` ).dataset.clickArea;
        const dropdownLinks = document.querySelectorAll( `.${wrapperName} .mdp-huger-elementor-wp-menu-dropdown-link ` );
        const dropdownIndicator = document.querySelectorAll( `.${wrapperName} .mdp-huger-wp-menu-submenu-indicator` );
        const openSubmenuOnclick = document.querySelector( `.${wrapperName}` ).dataset.openSubmenuOnclik;
        const submenuDesktopClickArea = document.querySelector( `.${wrapperName}` ).dataset.submenuDesktopClickArea;

        // check and reposition menu if menu is out of viewport
        function checkEdgeOfScreenWpDropdown( dropdown ) {
            const dropdownPosition = dropdown.getBoundingClientRect();
            const windowWidth = window.innerWidth;
            if ( dropdown ) {
                // check if submenu is out of viewport
                if ( dropdownPosition.left < 0 ) {
                    dropdown.style.setProperty( 'right', '-' + dropdown.offsetWidth + 'px', 'important' );
                    dropdown.style.setProperty( 'left', 'auto', 'important' );
                }
                if ( dropdownPosition.right > windowWidth ) {
                    dropdown.style.setProperty( 'left', '-' + dropdown.offsetWidth + 'px', 'important' );
                    dropdown.style.setProperty( 'right', 'auto', 'important' );
                }
            }
        }


        wpMenuWrappers.forEach( wpMenuWrapper => {

            let listenerSubmenuMouseEnter = function ( e ) {
                if ( e.relatedTarget.classList.contains( 'mdp-huger-elementor-wp-menu-dropdown' ) ) {
                    e.relatedTarget.querySelectorAll( '.mdp-huger-elementor-wp-menu-item--hover' ).forEach( item => {
                        item.classList.remove( 'mdp-huger-elementor-wp-menu-item--hover' );
                    } );
                }

                e.target.classList.add( 'mdp-huger-elementor-wp-menu-item--hover' );

                setTimeout( () => {
                    if ( e.target.querySelector( '.mdp-huger-elementor-wp-menu-dropdown' ) !== null ) {
                        checkEdgeOfScreenWpDropdown( e.target.querySelector( '.mdp-huger-elementor-wp-menu-dropdown' ) );
                    }
                }, 0 );

                e.target.addEventListener( 'mouseleave', ( e ) => {
                    if ( e.relatedTarget !== null ) {
                        if ( e.relatedTarget.classList.contains( 'mdp-huger-elementor-wp-menu-item' )
                            ||  e.relatedTarget.classList.contains( 'mdp-huger-elementor-wp-menu-dropdown-link' )
                            ||  e.relatedTarget.classList.contains( 'mdp-huger-elementor-wp-menu-submenu-indicator' ) ) {
                            e.target.classList.remove( 'mdp-huger-elementor-wp-menu-item--hover' );
                        } else if ( e.relatedTarget.classList.contains( 'mdp-huger-elementor-wp-menu-dropdown' ) ) {
                            e.relatedTarget.querySelectorAll( '.mdp-huger-elementor-wp-menu-item--hover' ).forEach( item => {
                                item.classList.remove( 'mdp-huger-elementor-wp-menu-item--hover' );
                            } );
                            e.target.classList.add( 'mdp-huger-elementor-wp-menu-item--hover' );
                        }
                    }
                } );
            }

            // wp menu hover
            this.menuHover( wrapperName, openSubmenuOnclick, wpMenuWrapper, 'mdp-huger-elementor-wp-menu-item--hover',
                wpMenuItems, mediaSize, clickArea, submenuDesktopClickArea,
                dropdownLinks, dropdownIndicator, 'mdp-huger-elementor-wp-menu-wrapper--mobile',
                'mdp-huger-elementor-wp-menu-dropdown', listenerSubmenuMouseEnter,
                submenuItems, true, wpMenuWrappers, checkEdgeOfScreenWpDropdown );
        } );



    },

    addMegaMenu: function () {
        const hugerBox = document.querySelectorAll( '.mdp-huger-elementor-box' );

        for ( let i = 0; i < hugerBox.length; i++ ) {
            hugerBox[i].classList.add( 'mdp-huger-elementor-box-' + i );
            this.megaMenu( 'mdp-huger-elementor-box-' + i );
        }

    }
}

/**
 * Init for Front-End
 * @param callback
 */
document.addEventListener( 'DOMContentLoaded', hugerElementor.addMegaMenu.bind( hugerElementor ) );