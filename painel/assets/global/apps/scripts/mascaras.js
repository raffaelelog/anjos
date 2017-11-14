
function mascara(o, f) {
	v_obj = o;
	v_fun = f;
	setTimeout("v_obj.value = v_fun(v_obj.value)", 1);
}
function mascaranome(v) {
	v = v.replace("[\\s]", " ")//Remove numeros
	v = v.replace(/\d/g, "")//Remove numeros
	v = v.replace(/( ){2,}/g, '$1', "")
	return v;
}
function mascaracpf(v) {
	v = v.replace(/\D/g, "")//Remove tudo o que não é dígito
	v = v.replace(/(\d{3})(\d)/, "$1.$2")
	//Coloca um ponto entre o terceiro e o quarto dígitos
	v = v.replace(/(\d{3})(\d)/, "$1.$2")
	//Coloca um ponto entre o terceiro e o quarto dígitos
	v = v.replace(/(\d{3})(\d{1,2})$/, "$1-$2")
	//Coloca um hífen entre o terceiro e o quarto dígitos
	return v
}
function mascaraTelefone( campo ) {
	function trata( valor,  isOnBlur ) {
		valor = valor.replace(/\D/g,"");             			
		valor = valor.replace(/^(\d{2})(\d)/g,"($1)$2"); 		
		if( isOnBlur ) {
			valor = valor.replace(/(\d)(\d{4})$/,"$1-$2");   
		} else {
			valor = valor.replace(/(\d)(\d{4})$/,"$1-$2"); 
		}
		return valor;
	}
	campo.onkeypress = function (evt) {
		var code = (window.event)? window.event.keyCode : evt.which;	
		var valor = this.value
		if(code > 57 || (code < 48 && code != 8 ))  {
			return false;
		} else {
			this.value = trata(valor, false);
		}
	}
	campo.onblur = function() {
		var valor = this.value;
		if( valor.length < 10 ) {
			this.value = ""
		}else {		
			this.value = trata( this.value, true );
		}
	}
	campo.maxLength = 14;
}
