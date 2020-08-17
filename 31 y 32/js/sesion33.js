var enviar = document.getElementById('btnEnviar');
//conseguir la referencia a los elementos del documento
var nombre = document.getElementById("txtNombre");
var mensaje = document.getElementById("txtComentario");

enviar.addEventListener("click", function() {
    //se utiliza el Api Fetch
    fetch("http://localhost/php/script_sesion_33.php", {
            method: 'POST',
            headers: {
                "Content-type": "application/json; charset=utf-8"
            },
            body: JSON.stringify({
                _nombre: nombre.value,
                _comentario: mensaje.value
            })
        })
        .then((respuesta) => {
            //se retorna la respuesta del archivo php
            return respuesta.json();
        })
        .then((json) => {
            //se retornan los datos enviados en la consola
            console.log(json);
            document.getElementById("respuesta").innerHTML = "";
			
			var respuesta = `<tr>
								<th>Nombre</th>
								<th>Comentario</th>
							</tr>`;
			//procesar el objeto JSON
			json.forEach(function(info){
				respuesta+=`<tr>
								<td>${info.c_nombre}</td>
								<td>${info.c_comentario}</td>
							</tr>`;
			});
			document.getElementById("respuesta").innerHTML=respuesta;
        })
        .catch((err) => {
            //se muestra error si llegara a existir
            console.error(err);
        });
});
