(function($) {

    if (typeof( input_class ) === 'undefined') {
        input_class = 'acf-wp-show-passwd';
    }

    if( typeof acf.add_action !== 'undefined' ) {
        /*
         *  ready (ACF5)
         *
         *  @type   event
         *  @date   20/07/13
         *
         *  @param  $el (jQuery selection) the jQuery element which contains the ACF fields
         *  @return n/a
         */
        acf.add_action('ready', function($el){
            $el.find("#passwd-reset").click( function() {
              $("." + input_class).val("")
            })

            // Show / Hide password
            $el.find("#show-password").change(function () {
                if ($el.find("#show-password").is(":checked")) {
                    $("." + input_class).attr('type', 'text')
                }
                else {
                    $("." + input_class).attr('type', 'password')
                }
            });
        })
    }
})(jQuery)