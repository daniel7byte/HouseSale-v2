$( "#next" ).click(function() {
    if ( confirm("¿Verificaste el formato del archivo?") == true ) {
        if ($('#file').val() != "") {
            document.getElementById("myForm").submit();
            return true;
        }else{
            return false;
        }
    }else{
        return false;
    }
});
