(function() {
   tinymce.create('tinymce.plugins.partner', {
      init : function(ed, url) {
         ed.addButton('partner', {
            title : 'partner',
            image : url+'/partner.png',
            onclick : function() {
               // triggers the thickbox
                var width = jQuery(window).width(), H = jQuery(window).height(), W = ( 720 < width ) ? 720 : width;
                W = W - 80;
                H = H - 84;
                tb_show( 'partner Member Shortcode', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=partner-form' );
            }
         });
      },
      createControl : function(n, cm) {
         return null;
      },
      getInfo : function() {
         return {
            longname : "partner",
            author : 'ThemeonLab',
            authorurl : 'http://www.themeonlab.com',
            infourl : 'http://www.themeonlab.com',
            version : "1.0"
         };
      }
   });
   tinymce.PluginManager.add('partner', tinymce.plugins.partner);
   // executes this when the DOM is ready
	jQuery(function(){
		// creates a form to be displayed everytime the button is clicked
		// you should achieve this using AJAX instead of direct html code like this
		var form = jQuery('<div id="partner-form"><table id="partner-table" class="form-table">\
			<tr>\
				<th><label for="partner_view">partner View</label></th>\
				<td><select id="partner_view" name="view">\
                                <option value="normal">Normal</option><option value="slide">Slide</option>\
                                </select><br />\
				<small>Select partner View</small></td>\
			</tr>\
			<tr>\
				<th><label for="partner_member">Number Of Member</label></th>\
				<td><input type="text" name="member" id="partner_member" value="4" /><br />\
				<small>How many member you want to show.</small></td>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="partner_submit" class="button-primary" value="Insert Button" name="submit" />\
		</p>\
		</div>');
		
		var table = form.find('table');
		form.appendTo('body').hide();
		
		// handles the click event of the submit button
		form.find('#partner_submit').click(function(){
			// defines the options and their default values
			// again, this is not the most elegant way to do this
			// but well, this gets the job done nonetheless
			var options = { 
				'view'            : '',
				'member'            : ''
				};
			var shortcode = '[rms-partner';
			
			for( var index in options) {
				var value = table.find('#partner_' + index).val();
				
				// attaches the attribute to the shortcode only if it's different from the default value
				if ( value !== options[index] )
                                {
					shortcode += ' ' + index + '="' + value + '"';
                                }
			}
			
			shortcode += ']';
			
			// inserts the shortcode into the active editor
			tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
			
			// closes Thickbox
			tb_remove();
		});
	});
})();