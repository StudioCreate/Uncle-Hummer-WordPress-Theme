(function() {
   tinymce.create('tinymce.plugins.textblock', {
      init : function(ed, url) {
         ed.addButton('textblock', {
            title : 'textblock',
            image : url+'/textblock.png',
            onclick : function() {
                    // triggers the thickbox
                    var width = jQuery(window).width(), H = jQuery(window).height(), W = ( 720 < width ) ? 720 : width;
                    W = W - 80;
                    H = H - 84;
                    tb_show( 'My Button Shortcode', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=textblock-form' );
            }
         });
      },
      createControl : function(n, cm) {
         return null;
      },
      getInfo : function() {
         return {
            longname : "textblock",
            author : 'ThemeonLab',
            authorurl : 'http://www.themeonlab.com',
            infourl : 'http://www.themeonlab.com',
            version : "1.0"
         };
      }
   });
   tinymce.PluginManager.add('textblock', tinymce.plugins.textblock);
   
   // executes this when the DOM is ready
	jQuery(function(){
		// creates a form to be displayed everytime the button is clicked
		// you should achieve this using AJAX instead of direct html code like this
		var form = jQuery('<div id="textblock-form"><table id="textblock-table" class="form-table">\
			<tr>\
				<th><label for="textblock-text">Text For Title</label></th>\
				<td><input type="text" name="text" id="textblock-text" value="Lorem Ipsum" /><input type="text" name="icon" id="textblock-icon" value="" placeholder="fa fa-icon"/><input type="text" name="text1" id="textblock-text1" value="Sit Amet" /><br />\
                                <small>Insert Title 1st part then icon and then 2nd part.</small></td>\
			</tr>\
			<tr>\
				<th><label for="textblock-contents">Content For Show</label></th>\
				<td><textarea name="contents" id="textblock-contents" style="width:300px;height:180px;"></textarea><br />\n\
                                <small>Insert Content.</small></td>\
			</tr>\
			<tr>\
				<th><label for="textblock-Color">Text Color</label></th>\
				<td><input type="text" name="color" id="textblock-color" value="" /><br />\
				<small>Insert Button Text Color.</small></td>\
			</tr>\
			<tr>\
				<th><label for="textblock-margin">Margin</label></th>\
				<td><input type="text" name="margin" id="textblock-margin" value="" /><br />\
				<small>Set Margin (Top Right Bottom Left).</small></td>\
			</tr>\
			<tr>\
				<th><label for="textblock-fsize">Font Size</label></th>\
				<td><input type="text" name="fsize" id="textblock-fsize" value="" /><br />\
				<small>Example (14px).</small></td>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="textblock-submit" class="button-primary" value="Insert Button" name="submit" />\
		</p>\
		</div>');
		
		var table = form.find('table');
		form.appendTo('body').hide();
		
		// handles the click event of the submit button
		form.find('#textblock-submit').click(function(){
			// defines the options and their default values
			// again, this is not the most elegant way to do this
			// but well, this gets the job done nonetheless
			var options = { 
                'text' 			: '',
				'icon' 			: '',
				'text1' 		: '',
				'contents' 		: '',
				'color' 		: '',
				'fsize'			: '',
				'margin'		: ''
				};
			var shortcode = '[rms-textblock';
			
			for( var index in options) {
				var value = table.find('#textblock-' + index).val();
				
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