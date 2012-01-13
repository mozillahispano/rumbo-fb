

function aprobacion()
{
	var form=document.form;	
	
        
        
        if (form.id.value==0)
	{
		document.getElementById("error").innerHTML="<font color='red'>La Año esta vacio</font><hr>";
		form.id.value="";
		form.id.focus();
		return false;
	}
        else
	{
		document.getElementById("error").innerHTML="";
	}
         
        form.submit();
}


