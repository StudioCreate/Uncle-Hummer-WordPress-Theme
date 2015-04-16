var WPML_package_translation = WPML_package_translation || {};

WPML_package_translation.ManagementPage = function()
{
    var self = this;

    self.init = function()
    {
        jQuery('.js_package_all_cb').on('change', self._check_uncheck_all);
        jQuery('.js_package_row_cb').on('change', self._enable_disable_delete);
        jQuery('#delete_packages').on('click', self._delete_selected_packages);
        jQuery('#package_kind').on('change', self._filter_by_kind);
    };
    
    self._check_uncheck_all = function () {
        var checked = jQuery('.js_package_all_cb:checked').length != 0;
        
        jQuery('.js_package_row_cb').each( function () {
            if (!jQuery(this).is(':disabled')) {
                jQuery(this).prop('checked', checked);
            }
        })
     
        self._enable_disable_delete();   
    }

    self._enable_disable_delete = function () {
        var enable = jQuery('.js_package_row_cb:checked:visible').length != 0;
        
        jQuery('#delete_packages').prop('disabled', !enable);
    }
    
    self._delete_selected_packages = function () {
        
        if (confirm(jQuery('.js-delete-confirm-message').html())) {
            jQuery('#delete_packages').prop('disabled', true);
            jQuery('.wpml_tt_spinner').show();
    
            var selected = jQuery('.js_package_row_cb:checked:visible');
            
            var packages = Array();
            
            selected.each( function () {
                packages.push ( jQuery(this).val() );
            })
    
            var data = {
                action : 'wpml_delete_packages',
                wpnonce : jQuery('#wpml_package_nonce').attr('value'),
                packages : packages
            }
            
            jQuery.ajax({
                url: ajaxurl,
                type: 'post',
                data: data,
                success: function(data) {
                    selected.each (function () {
                        jQuery(this).parent().parent().fadeOut(1000, function () {
                            jQuery(this).remove();
                        });
                    })
                    jQuery('.wpml_tt_spinner').hide();
                    
                }
            });
        }        
    }
    
    self._filter_by_kind = function () {
        var kind = jQuery('#package_kind').val();
        if (kind == '-1') {
            // ALL
            jQuery('#icl_package_translations tbody tr').show();
        } else {
            jQuery('.js-package-kind').each ( function () {
                if (kind == jQuery(this).text()) {
                    jQuery(this).parent().show();
                } else {
                    jQuery(this).parent().hide();
                }
            })
        }
        
        self._enable_disable_delete();   
        
    }
    
    self.init();
};

jQuery(document).ready(function () {
    WPML_package_translation.management_page = new WPML_package_translation.ManagementPage();
});


