jQuery(function($){
    var XHR = {}, i18n = function(k)
    {
        return GUSTA_DEMO.i18n[k] || k;
    }, FADE_PERC = 0.3, ERR_TPL = '<div class="error notice is-dismissible" style="margin-left:0"><p>%s</p></div>'
    , active_button;

    var deletePurchaseCode = function()
    {
        $('[name="purchase-code"]').val('');

        if ( XHR.verify && XHR.verify.abort )
            XHR.verify.abort();

        XHR.verify = $.ajax({
            type: 'POST',
            url: GUSTA_DEMO.ajaxUrl,
            data: $('#purchase-code-status').serialize(),
            success: function( res )
            {
                $('[name="purchase-code"]').val('');
                $('.echo-purchase-code').html( '' );
                $('.gusta-demo-wrap .input-hold').show();
                $('.gusta-demo-wrap .verified-status').hide();
                $('.demo-actions button')
                    .text( i18n('verify_purchase') )
                    .prop('disabled', 'disabled')
                    .removeClass('verified')
                    .addClass('not-verified');
            }
        });
    }

    $(document).on('click', '.gusta-demo-wrap .verified-status a', function(e){
        e.preventDefault();

        var parent = $(this).closest('.verified-status')
          , field_hold = $('.input-hold', parent.parent());

        if ( $(this).hasClass('deletes-key') ) {
            return deletePurchaseCode();
        } else {
            field_hold.fadeToggle('fast', function(){
                if ( $(this).is(':visible') ) {
                    $('[name="purchase-code"]', this).select();
                }
            });
        }
    });

    $(document).on('submit', '#purchase-code-status', function(e){
        e.preventDefault();

        var form = $(this)
          , field = $('[name="purchase-code"]', form)
          , button = $('input[type="submit"]', form)
          , status = $('.verified-status', form)
          , field_hold = $('.input-hold', form);

        if ( XHR.verify && XHR.verify.abort )
            XHR.verify.abort();

        if ( ! $.trim( field.val() ) ) {
            return deletePurchaseCode();
        }

        button.data('text', button.data('text') || button.val());
        button.val( button.data('loading') || 'Verifying..' );

        XHR.verify = $.ajax({
            type: 'POST',
            url: GUSTA_DEMO.ajaxUrl,
            data: form.serialize(),
            success: function( res )
            {
                button.val( button.data('text') || 'Verify' );

                if ( res.success ) {
                    $('.echo-purchase-code').html( field.val() );
                    status.show();
                    field_hold.hide();
                    $('.demo-actions button').text( i18n('import') ).prop('disabled', false).removeClass('not-verified').addClass('verified');
                } else {
                    status.hide();
                    $('.demo-actions button').text( i18n('verify_purchase') ).prop('disabled', 'disabled').removeClass('verified').addClass('not-verified');
                    alert( res.data && res.data.errors ? res.data.errors.join('\n') : i18n( 'err_general' ) );
                }
            },
            error: function()
            {
                if ( 'abort' != XHR.verify.statusText ) {
                    alert( i18n( 'err_general' ) );
                    button.val( button.data('text') || 'Verify' );
                    reActivate();
                }
            }
        });
    });

    $(window).resize(function(){
        if ( ! window.gdemcmdl || 'object' != typeof window.gdemcmdl )
            return;

        var h = gdemcmdl.outerHeight();
        var w = gdemcmdl.outerWidth();
        var availh = $(window).outerHeight();
        var availw = $(window).outerWidth();
        var top = (availh - h)/2;
        var left = (availw - w)/2;

        maxHeight = '100%';
        maxWidth = '100%';

        if ( availw > 600 ) {
            maxWidth = 600;
            left = (availw-600) /2
        } else {
            left = 0;
        }

        if ( availh > 500 ) {
            maxHeight = 500;
            top = (availh-500) /2
        } else {
            top = 0;
        }

        top -= $('#wpadminbar').outerHeight()/2

        gdemcmdl.css({
            top: top,
            left: left,
            height: maxHeight,
            width: maxWidth,
        });

        var loading = $('em.loading', gdemcmdl);

        if ( loading && loading.length ) {
            loading.css({
                top: (gdemcmdl.height()/2) - (loading.outerHeight()/2),
                left: (gdemcmdl.width()/2) - (loading.outerWidth()/2)
            });
        }

        if ( ! gdemcmdl.data('animated') ) {
            gdemcmdl.closest('.gdem-modal').hide().fadeIn({queue: false, duration: 200});
            gdemcmdl.css({
                top: top + top*FADE_PERC
            }).animate({top: top}, 200);
            gdemcmdl.data('animated', true);
        }
    });

    var onscroll = function(e)
    {
        e.preventDefault();
        var close = $('.modal-close', this);
        close.css({
            top: $(this).scrollTop()
        });
    }

    var loadModal = function(url, then)
    {
        if ( url && XHR.modal && XHR.modal.abort ) {
            XHR.modal.abort();
        }

        $('.gdem-modal').remove();

        var modal = $('<div class="gdem-modal gusta-import-window"></div>')
          , content = $('<div class="modal-content"></div>')
          , inner = $('<div class="inner"><em class="loading gdem-ds">' + i18n('loading') + '</em></div>')
          , close = $('<span class="modal-close gdem-ds">&times;</span>');

        content.append( [close, inner] );
        modal.append( content );

        $('body').append( modal );
        window.gdemcmdl = content;
        $(window).resize();

        close.click(function(e){
            e.preventDefault(e);
        });
        
        content.scroll(onscroll);

        if ( url ) {
            XHR.modal = $.get(url, function(res){
                var inner = $('> .inner', gdemcmdl);
                inner.prop('innerHTML', null);
                inner.append(res);
                inner.hide();
                inner.fadeIn(200);
                if ( then && 'function' == typeof then ) { then(inner); }
            });
        } else {
            then(inner);
        }
    }

    var closeModal = function()
    {
        if ( XHR.modal && XHR.modal.abort ) {
            XHR.modal.abort();
        }

        if ( ! window.gdemcmdl || 'object' != typeof window.gdemcmdl )
            return;

        var modal = gdemcmdl.closest('.gdem-modal');

        if ( ! modal || ! modal.length || ! modal.is(':visible') )
            return;

        modal.fadeOut({queue: false, duration: 200});
        gdemcmdl.animate({top: parseInt(gdemcmdl.css('top')) - parseInt(gdemcmdl.css('top'))*FADE_PERC}, 200);
        // modal.fadeOut(200);
        active_button.hasClass('gdem-success') || active_button.html( active_button.data('text') );
    }
    
    var reActivate = function () {
        $('.gusta-demo-grid-wrap .demo-actions button[data-demo]').addClass('verified').removeClass('not-verified').removeAttr("disabled");
        setTimeout(function() { closeModal(); }, 4000);
    }

    $(document).on('click', '.gusta-demo-grid-wrap .demo-actions button[data-demo]', function(e){
        e.preventDefault();

        $('.gusta-demo-grid-wrap .demo-actions button[data-demo]').removeClass('verified').addClass('not-verified').attr("disabled", "disabled");
        var btn = $(this);

        btn.data('text', btn.data('text') || btn.text());
        btn.html( i18n('import_loading') );
        active_button = btn;

        loadModal(null, function(inner){
            inner.prop('innerHTML', null);
            inner.append('<p style="margin-top:0">' + i18n('downloading_item').replace('%s', $('.demo-title-hold', btn.closest('.inside')).text()) + '</p>');
            inner.hide();
            inner.fadeIn(200);

            XHR.modal = $.ajax({
                type: 'POST',
                url: GUSTA_DEMO.ajaxUrl,
                data: {
                    action: 'gusta-demo-import',
                    demo: btn.data('demo'),
                    nonce: GUSTA_DEMO.import_nonce,
                },
                success: function(res)
                {
                    if ( res.success ) {
                        //inner.append('<p>' + i18n('download_success') + '</p>');
                        
                        setTimeout(function(){
                            //inner.append('<p>' + i18n('reading_download_data') + '</p>');

                            setTimeout(function(){
                                var inactive_plugins = 0;
                                if ( res.data.plugins && Object.keys( res.data.plugins ).length ) {
                                    inner.append('<p>' + i18n('demo_suggests_plugins') + '</p>');
                                    for ( var plugin in res.data.plugins ) {
                                        if ( res.data.plugins.hasOwnProperty(plugin) ) {
                                            plugin = res.data.plugins[plugin];
                                            inactive_plugins += plugin.installed && plugin.activated ? 0 : 1;
                                            inner.append(
                                                '<p class="gdem-require-plugin-hold">'
                                                 + '<strong>' + plugin.Name +  '</strong>&nbsp;'
                                                 + (plugin.installed && plugin.activated ? ('&nbsp;' + i18n('installed_and_activated')) : (
                                                 '<a data-id="'
                                                 + plugin.wporg_id
                                                 + '"href="javascript:;" class="gdem-require-plugin button button-primary" style="vertical-align:baseline">'
                                                 + (plugin.installed ? i18n('plugin_activate') : i18n('plugin_install_activate'))
                                                 ))
                                                 + '</a>'
                                                 + '</p>'
                                            );
                                        }
                                    }
                                }

                                inner.append('<p><a class="button button-primary gdem-continue-import gusta-hide" data-demo="'
                                    + btn.data('demo')
                                    + '">' + i18n('continue_import') + '</a></p>');

                                if ( ! inactive_plugins ) {
                                    setTimeout(function(){
                                        $('.gdem-continue-import', inner).trigger('click');
                                    }, 500);
                                } else {
                                    $('.gdem-continue-import').removeClass('gusta-hide');
                                }
                            }, 500);
                        }, 500);
                    } else {
                        setTimeout(function(){
                            inner.append(ERR_TPL.replace('%s', (
                                (res.data && res.data.errors ? res.data.errors : [i18n('err_general')]).join('</p><p>')
                            )));
                        }, 200);
                        reActivate();
                    }
                },
                error: function()
                {
                    if ( 'abort' != XHR.modal.statusText ) {
                        inner.append('<p class="gusta-import-error">' + i18n('err_general') + '</p>');
                        reActivate();
                    }
                }
            });
        });
    });

    $(document).on('click', '.gdem-modal .gdem-require-plugin', function(e){
        e.preventDefault();

        var a = $(this), plugin_id = $(this).data('id');

        if ( ! plugin_id ) {
            return alert( i18n('err_general') );
        }

        XHR.requires = XHR.requires || {};

        if ( XHR.requires && XHR.requires[plugin_id] && XHR.requires[plugin_id].abort ) {
            XHR.requires[plugin_id].abort();
        }

        a.attr('disabled', 'disabled');

        XHR.requires[plugin_id] = $.ajax({
            type: 'POST',
            url: GUSTA_DEMO.adminUrl,
            data: {
                action: 'gusta-demo-install-plugin',
                install_wp_plugin: GUSTA_DEMO.install_nonce,
                plugin_id: plugin_id
            },
            success: function(res)
            {
                console.log( XHR.requires[plugin_id].responseURL );

                a.attr('disabled', false);
                if ( res.success ) {
                    a.replaceWith( $(i18n('installed_and_activated')) );
                } else {
                    inner.append(ERR_TPL.replace('%s', (
                        (res.data && res.data.errors ? res.data.errors : [i18n('err_general')]).join('</p><p class="gusta-import-error">')
                    )));
                }
            },
            error: function()
            {
                if ( 'abort' != XHR.requires[plugin_id].statusText ) {
                    inner.append('<p class="gusta-import-error">' + i18n('err_general') + '</p>');
                    a.attr('disabled', false);
                }
            }
        })
    });

    $(document).on('click', '.gdem-modal .gdem-continue-import', function(e){
        e.preventDefault();

        var a = $(this), demo = $(this).data('demo'), inner = a.closest('.inner');

        if ( ! demo ) {
            return alert( i18n('err_general') );
        }

        if ( XHR.continue_import && XHR.continue_import.abort ) {
            XHR.continue_import.abort();
        }

        a.attr('disabled', 'disabled');

        $.get(GUSTA_DEMO.adminUrl, function(){
            XHR.continue_import = $.ajax({
                type: 'POST',
                url: GUSTA_DEMO.ajaxUrl,
                data: {
                    action: 'gusta-demo-import',
                    demo: a.data('demo'),
                    nonce: GUSTA_DEMO.import_nonce,
                    skip_plugins: true
                },
                success: function(res)
                {
                    a.remove();

                    if ( res.success ) {
                        if ( res.data.output ) {
                            //inner.append('<div>' + res.data.output + '</div>');
                        }

                        inner.append(ERR_TPL.replace('error', 'updated').replace('%s', i18n('import_success')));

                        if ( active_button ) {
                            active_button.addClass('gdem-success').html( i18n('import_check') );
                        }
                        
                        reActivate();
                        
                    } else {
                        inner.append(ERR_TPL.replace('%s', (
                            (res.data && res.data.errors ? res.data.errors : [i18n('err_general')]).join('</p><p  class="gusta-import-error">')
                        )));

                        if ( active_button ) {
                            active_button.html( active_button.data('text') );
                        }
                        
                        reActivate();
                    }
                },
                error: function()
                {
                    if ( 'abort' != XHR.continue_import.statusText ) {
                        inner.append('<p class="gusta-import-error">' + i18n('err_general') + '</p>');
                        a.attr('disabled', false);
                        reActivate();
                    }
                }
            })
        });
    });
});