(function() {
   tinymce.create('tinymce.plugins.mybtn', {
      init : function(ed, url) {
         ed.addButton('mybtn', {
            title : 'mybtn',
            image : url+'/mybtn.png',
            onclick : function() {
                    // triggers the thickbox
                    var width = jQuery(window).width(), H = jQuery(window).height(), W = ( 720 < width ) ? 720 : width;
                    W = W - 80;
                    H = H - 84;
                    tb_show( 'My Button Shortcode', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=mybtn-form' );
            }
         });
      },
      createControl : function(n, cm) {
         return null;
      },
      getInfo : function() {
         return {
            longname : "mybtn",
            author : 'ThemeonLab',
            authorurl : 'http://www.themeonlab.com',
            infourl : 'http://www.themeonlab.com',
            version : "1.0"
         };
      }
   });
   tinymce.PluginManager.add('mybtn', tinymce.plugins.mybtn);
   
   // executes this when the DOM is ready
	jQuery(function(){
		// creates a form to be displayed everytime the button is clicked
		// you should achieve this using AJAX instead of direct html code like this
		var form = jQuery('<div id="mybtn-form"><table id="mybtn-table" class="form-table">\
			<tr>\
				<th><label for="mybtn-types">Button Type</label></th>\
				<td><select name="type" id="mybtn-types" >\
                                <option value="Normal-Button">Normal Button</option>\
                                <option value="Parallax-Button">Parallax Button</option>\
                                <option value="Simple-Button">Parallax Button</option>\
                                </select><br />\
				<small>Select Button Type.</small></td>\
			</tr>\
			<tr>\
				<th><label for="mybtn-text">Text To Show</label></th>\
				<td><input type="text" name="text" id="mybtn-text" value="Call To Action" /><br />\n\
                                <small>Insert Button Value.</small></td>\
			</tr>\
			<tr>\
				<th><label for="mybtn-link">Link</label></th>\
				<td><input type="text" name="link" id="mybtn-link" value="#" /><br />\
				<small>Insert Link. If you want a button then make it blank</small>\</td>\
			</tr>\
			<tr>\
				<th><label for="mybtn-position">Position</label></th>\
				<td><select name="position" id="mybtn-position"><option value="left">Left</option><option value="center">Center</option><option value="right">Right</option></select><br />\
				<small>Select Button Alingment Posigion</small></td>\
			</tr>\
			<tr>\
				<th><label for="mybtn-icon">FontAweSome Icon</label></th>\
				<td><input type="text" name="icon" id="mybtn-icon" value="" /><br />\
                                <small>Insert FontAweSome Icon Class.</small></td>\
			</tr>\
			<tr>\
				<th><label for="mybtn-Color">Text Color</label></th>\
				<td><input type="text" name="color" id="mybtn-color" value="" /><br />\
				<small>Insert Button Text Color.</small></td>\
			</tr>\
			<tr>\
				<th><label for="mybtn-bg">Background Color</label></th>\
				<td><input type="text" name="bg" id="mybtn-bg" value="" /><br />\
				<small>Insert Background Color</small></td>\
			</tr>\
			<tr>\
				<th><label for="mybtn-margin">Button Margin</label></th>\
				<td><input type="text" name="margin" id="mybtn-margin" value="" /><br />\
				<small>Set Margin (Top Right Bottom Left).</small></td>\
			</tr>\
			<tr>\
				<th><label for="mybtn-padding">Button Padding</label></th>\
				<td><input type="text" name="padding" id="mybtn-padding" value="" /><br />\
				<small>Set padding (Top Right Bottom Left).</small></td>\
			</tr>\
			<tr>\
				<th><label for="mybtn-border">Botton Border</label></th>\
				<td><input type="text" name="border" id="mybtn-border" value="" /><br />\
				<small>Example (1px solid #FFFFFF).</small></td>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="mybtn-submit" class="button-primary" value="Insert Button" name="submit" />\
		</p>\
		</div>');
		
		var table = form.find('table');
		form.appendTo('body').hide();
		
		// handles the click event of the submit button
		form.find('#mybtn-submit').click(function(){
			// defines the options and their default values
			// again, this is not the most elegant way to do this
			// but well, this gets the job done nonetheless
			var options = { 
                                'types'         : '', 
                'text'          : '', 
				'link'          : '',
				'position'      : '',
                                'icon'          : '',
				'bg'            : '',
				'color'         : '',
                                'margin'        : '',
                                'padding'       : '',
                                'border'        : ''
				};
			var shortcode = '[rms-mybtn';
			
			for( var index in options) {
				var value = table.find('#mybtn-' + index).val();
				
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