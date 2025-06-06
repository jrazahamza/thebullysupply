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

( function () {

    'use strict';

    window.addEventListener( 'DOMContentLoaded', () => {

        /**
         * Rating star hover handler
         * @param e
         */
        function hover( e ) {

            let fill = true;

            for ( let $star of this.parentElement.querySelectorAll( 'span.dashicons' ) ) {

                if ( fill ) {

                    $star.classList.remove( 'dashicons-star-empty' );
                    $star.classList.add( 'dashicons-star-filled' );
                    fill = e.target !== $star;

                } else {

                    $star.classList.remove( 'dashicons-star-filled' );
                    $star.classList.add( 'dashicons-star-empty' );

                }

            }

        }

        /**
         * Random stars for rating
         * @param $element - Rating start wrapper
         */
        function init( $element ) {

            const random = Math.floor( Math.random() * Math.floor( 2 ) ); //Random from 0 to 2
            const stars = $element.querySelectorAll( 'span.dashicons' );

            for ( let i = 4; i > 0; i-- ) {

                if ( i > 4-random ) {

                    stars[ i ].classList.remove( 'dashicons-star-filled' );
                    stars[ i ].classList.add( 'dashicons-star-empty' );

                } else {

                    break;

                }

            }

        }

        // Get all rating stars for all plugins and run loop for each plugin
        for ( let $ratingStars of document.querySelectorAll( '.mdp-rating-stars' ) ) {

            init( $ratingStars ); // Random stars
            $ratingStars.addEventListener( 'mouseover', hover );

        }

    } );

} () );
