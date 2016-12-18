(function($) {

    if (typeof( input_class ) === 'undefined') {
        input_class = 'acf-wp-show-passwd';
    }

    // add our custom class
    $("#user_pass").addClass(input_class);
    $("#passwd-actions").css( 'margin-bottom', '2em' );

    $("#passwd-reset").click( function() {
      $("." + input_class).val("")
    })

    // Show / Hide password
    $("#show-password").change(function () {
        if ($("#show-password").is(":checked")) {
            $("." + input_class).attr('type', 'text')
        }
        else {
            $("." + input_class).attr('type', 'password')
        }
    });
     
})(jQuery)