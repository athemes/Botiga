
(function($){

    'use strict';

    var botigaPluginInstaller = window.botigaPluginInstaller || {};

    botigaPluginInstaller = {
        installButtonSelector: '.botiga-install-plugin',

        init: function() {
            this.events();
        },

        events: function() {
            const self = this;

            $(document).on('click', self.installButtonSelector, function(e){
                e.preventDefault();

                const type = $(this).data('type') === 'external' ? 'external' : 'wporg';
                const plugin_name = $(this).data('plugin-name');
                const redirect_to = $(this).data('redirect-to');

                if (type === 'external') {
                    const url = $(this).data('plugin-url');

                    self.installExternalPlugin($(this), url, plugin_name, redirect_to);
                } else {
                    // self.installPlugin(plugin_name); - TODO: We don't need it yet, but we should rely on the WP API to install plugins from wp.org.
                }
            });
        },

        installExternalPlugin: function( button, url, plugin_name, redirect_to ) {
            const data = {
                action: 'botiga_install_external_plugin',
                url: url,
                plugin_name: plugin_name,
                nonce: botigaPluginInstallerConfig.nonce
            };

            button.text(botigaPluginInstallerConfig.i18n.installingText);

            $.post(ajaxurl, data, function(response) {
                if ( ! response.success ) {
                    button.text(botigaPluginInstallerConfig.i18n.defaultText);
                    alert(response.data.message);

                    return;
                }

                button.text(botigaPluginInstallerConfig.i18n.activatingText);

                setTimeout(function(){
                    window.location.href = redirect_to;
                }, 1000 );
            });
        },


    }
    
    $(document).ready(function(){
        botigaPluginInstaller.init();
    });

})(jQuery);