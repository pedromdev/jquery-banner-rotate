// JavaScript Document

function formatar(src){
	var mask = '##/##/####';
	var i = src.value.length;
	src.value = src.value.replace("//","/");
	var saida = mask.substring(0,1);
	var texto = mask.substring(i)
	if (texto.substring(0,1) != saida){
   		src.value += texto.substring(0,1);
	}
}

function valida(form){
	if(form.link.value == "" && form.dataRetirada.value == "" && form.pagina.value == ""){
		alert("Campos vazios");
		return;
	} else if(form.link.value == ""){
		alert("É necessário uma URL de imagem");
		return;
	} else if(valida_data(form) == false){
		return;
	}
	
	form.submit();
}

function valida_data(form){
	
	if(form.dataRetirada.value == ""){
		return true;
	}
	
    var data = form.dataRetirada.value.split("/");
	
	var msg = "Data inválida";
	
	var dia = parseInt(data[0]);
	var mes = parseInt(data[1]);
	var ano = parseInt(data[2]);
	
	if(mes < 1 || mes > 12){
		alert(msg);
		return false;
	}
	
	if(mes % 2 == 1 && mes < 8){
		if(dia < 1 || dia > 31){
			alert(msg);
			return false;
		}
	} else if(mes % 2 == 1 && mes > 7){
		if(dia < 1 || dia > 30){
			alert(msg);
			return false;
		}
	} else if(mes % 2 == 0 && mes > 7){
		if(dia < 1 || dia > 31){
			alert(msg);
			return false;
		}
	} else if(mes < 8){
		if(mes % 2 == 0 && mes != 2){
			if(dia < 1 || dia > 30){
				alert(msg);
				return false;
			} 
		} else if(mes == 2){
			if(ano % 4 == 0 && ano % 100 != 0 || ano % 400 == 0){
				if(dia < 1 || dia > 29){
					alert(msg);
					return false;
				}
			} else {
				if(dia < 1 || dia > 28){
					alert(msg);
					return false;
				}
			}
		}
	}
	
	return true;
}
