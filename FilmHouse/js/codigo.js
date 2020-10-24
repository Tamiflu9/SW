window.addEventListener("load", function() {
    var selector = document.getElementById("order");

    selector.addEventListener("change", function(e) {
        var selector = e.target;
        var valor = selector.selectedOptions;
        var url = window.location.href;
        var separo_url = url.split("=");
        window.location.replace(separo_url[0] + "=" + valor[0].value);
    });
});
