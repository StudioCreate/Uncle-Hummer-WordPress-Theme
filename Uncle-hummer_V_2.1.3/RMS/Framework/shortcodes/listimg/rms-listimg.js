(function() {
   tinymce.create('tinymce.plugins.listimg', {
      init : function(ed, url) {
         ed.addButton('listimg', {
            title : 'List Item',
            image : url+'/listimg.png',
            onclick : function() {
               // triggers the thickbox
                var width = jQuery(window).width(), H = jQuery(window).height(), W = ( 720 < width ) ? 720 : width;
                W = W - 80;
                H = H - 84;
                tb_show( 'List Item Shortcode', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=listimg-form' );
            }
         });
      },
      createControl : function(n, cm) {
         return null;
      },
      getInfo : function() {
         return {
            longname : "List Item",
            author : 'RMS IT',
            authorurl : 'http://www.themeonlab.com',
            infourl : 'http://www.themeonlab.com',
            version : "1.0"
         };
      }
   });
   tinymce.PluginManager.add('listimg', tinymce.plugins.listimg);
   // executes this when the DOM is ready
	jQuery(function(){
		// creates a form to be displayed everytime the button is clicked
		// you should achieve this using AJAX instead of direct html code like this
		var form = jQuery('<div id="listimg-form"><table id="listimg-table" class="form-table">\
			<tr>\
				<th><label for="listimg_number"></label> Demo Shortcode</th>\
				<td><small>\
                                Please Press Insert button. You will get a Demo Shortcode.<br/>\
                                Edit the shortcode content to achive your requirement<br/><br/>\
                                <strong>Demo Shortcode</strong><br/>\
                                [rms-listimg]<br/>\
                                [rms-list-img]Insert your content here.[/rms-list-img]<br/>\
                                [rms-list-img]Insert your content here.[/rms-list-img]<br/>\
                                [/rms-listimg]<br/>\
                                </small></td>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="listimg_submit" class="button-primary" value="Insert Button" name="submit" />\
		</p>\
		</div>');
		
		var table = form.find('table');
		form.appendTo('body').hide();
		
		// handles the click event of the submit button
		form.find('#listimg_submit').click(function(){
			// defines the options and their default values
			// again, this is not the most elegant way to do this
			// but well, this gets the job done nonetheless
			var shortcode = '[rms-listimg]';
			shortcode += '[rms-list-img]Insert your content here.[/rms-list-img]';
			shortcode += '[rms-list-img]Insert your content here.[/rms-list-img]';
			shortcode += '[/rms-listimg]';
			
			// inserts the shortcode into the active editor
			tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
			
			// closes Thickbox
			tb_remove();
		});
	});
})();