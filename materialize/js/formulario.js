
  document.getElementById("telefone").addEventListener("keyup", function(){
   formatarTelefone(this);
});




// document.querySelector('input[name="telefone"]').addEventListener("keyup", function(){
//     formatarTelefone(this);
// });


function formatarTelefone(campoTelefone){

  retirarFormatacaoTelefone(campoTelefone);

  if (campoTelefone.value.length >= 3 && campoTelefone.value.length <= 6){
    campoTelefone.value = mascarInicio(campoTelefone.value);

  }else if (campoTelefone.value.length >= 8 && campoTelefone.value.length <= 10){
    campoTelefone.value = mascarFixo(campoTelefone.value);
    
  }else{
    campoTelefone.value = mascarCelular(campoTelefone.value);
    
  }

  
}



function mascarInicio(valor) {
    return valor.replace(/(\d{2})(\d{4})/g,"\(\$1\)\$2");
}


function mascarFixo(valor) {
    return valor.replace(/(\d{2})(\d{4})(\d{4})/g,"\(\$1\)\$2\-\$3");
}

function mascarCelular(valor) {
    return valor.replace(/(\d{2})(\d{5})(\d{4})/g,"\(\$1\)\$2\-\$3");
}



function retirarFormatacaoTelefone(campoTelefone) {
   campoTelefone.value = campoTelefone.value.replace(/(\(|\)|\-|\ )/g,"");
}
