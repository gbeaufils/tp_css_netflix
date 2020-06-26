/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.scss in this case)
// import '../css/app.scss';
import '../css/app.scss';

// Need jQuery? Install it with "yarn add jquery", then uncomment to import it.
import $ from 'jquery';

$(function() {

    $(document).ready(function () {
        $('.favori_btn').click(function () {
            var button = $(this);

            $.ajax(button.data('url'), {
                method: "POST",
                success: function (response) {
                    if (response.success === true) {
                        button.toggleClass('btn-secondary').toggleClass('btn-warning');
                        if (button.hasClass('btn-secondary')) {
                            button.html('Ajouter aux favoris');
                        } else {
                            button.html('Retirer des favoris');
                        }


                    } else {
                        alert(response.message);
                    }
                },
                error: function () {
                    alert('An error occured. Please try again');
                },

            });
        })
    });

});