(function() {
   tinymce.create('tinymce.plugins.counter', {
      init : function(ed, url) {
         ed.addButton('counter', {
            title : 'counter',
            image : url+'/counter.png',
            onclick : function() {
                    // triggers the thickbox
                    var width = jQuery(window).width(), H = jQuery(window).height(), W = ( 720 < width ) ? 720 : width;
                    W = W - 80;
                    H = H - 84;
                    tb_show( 'My Counter Shortcode', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=counter-form' );
            }
         });
      },
      createControl : function(n, cm) {
         return null;
      },
      getInfo : function() {
         return {
            longname : "counter",
            author : 'ThemeonLab',
            authorurl : 'http://www.themeonlab.com',
            infourl : 'http://www.themeonlab.com',
            version : "1.0"
         };
      }
   });
   tinymce.PluginManager.add('counter', tinymce.plugins.counter);
   
   // executes this when the DOM is ready
	jQuery(function(){
		// creates a form to be displayed everytime the button is clicked
		// you should achieve this using AJAX instead of direct html code like this
		var form = jQuery('<div id="counter-form"><table id="counter-table" class="form-table">\
			<tr>\
				<th><label for="counter-text">Insert Count Number.</label></th>\
				<td><input type="text" name="text" id="counter-text" value="150" /><br />\
                <small>Insert Count Number.</small></td>\
			</tr>\
			<tr>\
				<th><label for="counter-text1">Insert Count Title .</label></th>\
				<td><input type="text" name="text1" id="counter-text1" value="Lorem Ipsum" /><br />\
                <small>Insert Count Title .</small></td>\
			</tr>\
			<tr>\
				<th><label for="counter-icon">Insert Icon Class.</label></th>\
				<td><input type="text" name="icon" id="counter-icon" value="" placeholder="fa fa-icon"/><br />\
                <small>Insert Icon.</small></td>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="counter-submit" class="button-primary" value="Insert Button" name="submit" />\
		</p>\
		</div>');
		
		var table = form.find('table');
		form.appendTo('body').hide();
		
		// handles the click event of the submit button
		form.find('#counter-submit').click(function(){
			// defines the options and their default values
			// again, this is not the most elegant way to do this
			// but well, this gets the job done nonetheless
			var options = { 
                'text' 			: '',
				'icon' 			: '',
				'text1' 		: ''
				};
			var shortcode = '[rms-counter';
			
			for( var index in options) {
				var value = table.find('#counter-' + index).val();
				
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