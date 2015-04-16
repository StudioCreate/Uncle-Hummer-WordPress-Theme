jQuery(document).ready(function() {
    jQuery("#pageSelect").select2(); 
    jQuery("#selectLayout").select2();
    jQuery("#SelectFont, #selectf, #selectf2, #selectf3, #selectf4, #selectf5, #selectf6, #pFont, #aFont, #selectLayoutSingel").select2();
});

jQuery(document).ready(function(){
   jQuery("#pageSelect").change(function(){
       var name = jQuery("option:selected",this).html();
       var val = jQuery(this).val();
       jQuery(".selected_page").append('<p class="page_sereal"><span>'+name+'</span><input type="hidden" name="pID[]" value="'+val+'"><a href="#" class="deduct">x</a></p>');
   }) ;
   jQuery(document.body).on('click', '.deduct', function(e){
        e.preventDefault();
        jQuery(this).parent().remove(); 
    });
});

jQuery(document).ready(function(){
   jQuery('#baseColor, #h1Color, #h2Color, #h3Color, #h4Color, #h5Color, #h6Color, #pColor, #aColor').ColorPicker({
	onSubmit: function(hsb, hex, rgb, el) {
		jQuery(el).val(hex);
		jQuery(el).ColorPickerHide();
	},
	onBeforeShow: function () {
		jQuery(this).ColorPickerSetColor(this.value);
	}
})
.bind('keyup', function(){
	jQuery(this).ColorPickerSetColor(this.value);
}); 
});

jQuery(document).ready(function(){
   if(jQuery("#headerstylecheck").length > 0)
   {
       jQuery("#headerstylecheck .headery_style").each(function(){
          jQuery(this).click(function(e){
              e.preventDefault();
             var id = jQuery(this).attr("id");
             jQuery(".header_img").removeClass('selectedheader');
             jQuery(this).parent('.header_img').addClass('selectedheader');
             jQuery("#headerstyle").val(id);
          });
       });
   }
   
//   var editor = CodeMirror.fromTextArea(document.getElementById("code"), {
//        lineNumbers: true,
//        theme: "lesser-dark",
//        styleActiveLine: true,
//        matchBrackets: true
//      });
});