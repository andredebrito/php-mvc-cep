$(function () {

    /**
     * FORM OPTIONS
     */
    $(".search-type").on("change", function () {
        var option = $(this);

        switch (option.val()) {
            case "cep":
                option.prop("disabled", true);
                $("#address").fadeOut(function () {
                    $("#cep").fadeIn();
                    option.prop("disabled", false);
                    $(".container-response").fadeOut().html("");
                });
                $("#action").val("bycep");

                var inputsAddress = $("#address").find("input");
                var inputsCep = $("#cep").find("input");
                removeRequired(inputsAddress);
                addRequired(inputsCep);


                console.log("consulta por cep selecionada!");
                break;

            case "address":
                option.prop("disabled", true);
                $("#cep").fadeOut(function () {
                    $("#address").fadeIn();
                    option.prop("disabled", false);
                    $(".container-response").fadeOut().html("");
                });

                $("#action").val("byaddress");

                var inputsAddress = $("#address").find("input");
                var inputsCep = $("#cep").find("input");
                addRequired(inputsAddress);
                removeRequired(inputsCep);

                console.log("consulta por endereço selecionada!");
                break;
        }

        /**
         * 
         * @param {type} elements
         * @returns {undefined}
         */
        function removeRequired(elements) {
            elements.each(function () {
                $(this).prop("required", false);
            });
        }

        /**
         * 
         * @param {type} elements
         * @returns {undefined}
         */
        function addRequired(elements) {
            elements.each(function () {
                $(this).prop("required", true);
            });
        }

    });

    /*
     * jQuery MASK
     */
    $(".mask-zipcode").mask('00000-000', {reverse: true});


    /**
     * AJAX FORM
     */
    $("form").submit(function (e) {
        e.preventDefault();
        var form = $(this);
        var load = $(".ajax-load");
        var ajaxResponse = $(".ajax-response");
        var containerResponse = $(".container-response");

        form.ajaxSubmit({
            url: form.attr("action"),
            type: "POST",
            dataType: "json",
            beforeSend: function () {
                load.fadeIn(200).css("display", "flex");
                containerResponse.fadeOut(200).html("");
            },
            success: function (response) {
                load.fadeOut();

                //error            
                if (response.error) {
                    $(ajaxResponse).html(errorMessage(response.message)).fadeIn(100);
                    $("html,body").animate({scrollTop: 0}, 100);
                } else {
                    $(ajaxResponse).fadeOut(100).html('');
                }

                //success
                if (response.success) {
                    if (response.result) {
                        var htmlList = renderHmtList(response);
                        containerResponse.html(htmlList).fadeIn(200);
                        if (response.result_quantity) {
                            containerResponse.prepend("<div class='card-header text-right'><span> Resultados encontrados: <b>" + response.result_quantity + "</b></span></div>");
                        }
                    } else {
                        $(ajaxResponse).html(infoMessage("Sua consulta não retornou resultados!")).fadeIn(100);
                    }
                }
            },
            complete: function () {
                if (form.data("reset") === true) {
                    form.trigger("reset");
                }
            },
            error: function () {
                var message = "<div class='alert alert-danger text-center'>Desculpe mas não foi possível processar a requisição. Favor tentar novamente!</div>";
                $(ajaxResponse).html(message).fadeIn();
                $("html,body").animate({scrollTop: 0}, 100);
                load.fadeOut();
            }
        });


        /**
         * Error message
         * 
         * @param {type} text
         * @returns {String}
         */
        function errorMessage(text) {
            var html = "<div class='alert alert-danger text-center'>" + text + "</div>";
            return html;
        }

        /**
         * Information mesage
         * 
         * @param {type} text
         * @returns {String}
         */
        function infoMessage(text) {
            var html = "<div class='alert alert-info text-center'>" + text + "</div>";
            return html;
        }

        /**
         * Render response HMTL
         * 
         * @param {type} response
         * @returns {String}
         */
        function renderHmtList(response) {
            if (response.multiple === true) {
                var html = "";

                $.each(response.result, function (index, value) {
                    html = html + "<hr>" + htmlList(value);
                });

                return html;

            } else {
                return htmlList(response.result);
            }
        }

        /**
         * Creates a list of results
         * 
         * @param {type} data
         * @returns {String}
         */
        function htmlList(data) {
            var html = "<ul class='list-unstyled'>\n\
                            <li><label>Logradouro:</label> <span>" + data.logradouro + "</span></li>\n\
                            <li><label>Bairro:</label> <span>" + data.bairro + "</span></li>\n\
                            <li><label>Localidade:</label> <span>" + data.localidade + "</span></li>\n\
                            <li><label>CEP:</label> <span>" + data.cep + "</span></li>\n\
                            <li><label>UF:</label> <span>" + data.uf + "</span></li>\n\
                        </ul>"

            return html;
        }
    });



})




