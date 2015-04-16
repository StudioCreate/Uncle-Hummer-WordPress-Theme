(function() {
   tinymce.create('tinymce.plugins.member', {
      init : function(ed, url) {
         ed.addButton('member', {
            title : 'Member',
            image : url+'/member.png',
            onclick : function() {
               // triggers the thickbox
                var width = jQuery(window).width(), H = jQuery(window).height(), W = ( 720 < width ) ? 720 : width;
                W = W - 80;
                H = H - 84;
                tb_show( 'Member Shortcode', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=member-form' );
            }
         });
      },
      createControl : function(n, cm) {
         return null;
      },
      getInfo : function() {
         return {
            longname : "Member",
            author : 'RMS IT',
            authorurl : 'http://www.themeonlab.com',
            infourl : 'http://www.themeonlab.com',
            version : "1.0"
         };
      }
   });
   tinymce.PluginManager.add('member', tinymce.plugins.member);
   // executes this when the DOM is ready
	jQuery(function(){
		// creates a form to be displayed everytime the button is clicked
		// you should achieve this using AJAX instead of direct html code like this
		var form = jQuery('<div id="member-form"><table id="member-table" class="form-table">\
			<tr>\
				<th><label for="member_member">Member ID</label></th>\
				<td><input type="text" name="member" id="member_member" value="4" /><br />\
				<small>Member Id Should Be Here.</small></td>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="member_submit" class="button-primary" value="Insert Button" name="submit" />\
		</p>\
		</div>');
		
		var table = form.find('table');
		form.appendTo('body').hide();
		
		// handles the click event of the submit button
		form.find('#member_submit').click(function(){
			// defines the options and their default values
			// again, this is not the most elegant way to do this
			// but well, this gets the job done nonetheless
			var options = { 
				'member'            : ''
				};
			var shortcode = '[rms-member';
			
			for( var index in options) {
				var value = table.find('#member_' + index).val();
				
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