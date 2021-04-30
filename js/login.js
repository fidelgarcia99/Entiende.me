jQuery(document).ready(function($) {

	"use strict";
    $("#frmAcceso").on('submit',function(e)
{
	e.preventDefault();
    let logina=$("#logina").val();
    let clavea=$("#clavea").val();

    $.post("php/ajax/usuario.php?op=verificar",
        {"logina":logina,"clavea":clavea},
        function(data)
    {
        if (data!="null")
        {
            $(location).attr("href","index.php");            
        }
        else
        {
            bootbox.alert("Usuario y/o Password incorrectos");
        }
    });
})
});
