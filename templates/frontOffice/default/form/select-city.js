/**
 * Created by doud on 20/10/15.
 */


(function ($) {
    $(document).ready(function () {

        changeCity = function() {
            var zip = $(".zip-code").val();
            if (zip && zip.length == 5) {
                $.get("/inseegeo/city/zip/" + zip, function (data) {
                    // ajout des valeurs dans le select de la ville
                    var $select = $('#city_city_code');
                    var opt = "";
                    for (var k in data) {
                        var city = data[k];
                        var cityId = $select.data('selected');
                        opt += "<option value=" + k;
                        if (k == cityId) {
                            opt += " selected ";
                        }
                        opt += " >" + city + "</option>";
                    }
                    $select.html(opt);
                    $select.selectpicker('refresh');
                })
            }
        };

        var $form = $("form").parent();


        $form.on('change', ".zip-code", function () {
            changeCity()
        });

        changeCity();

    });
})(jQuery);
