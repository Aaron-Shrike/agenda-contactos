const formContactos = document.querySelector("#contacto"),
        listadoContactos = document.querySelector("#listado-contactos tbody"),
        inputBuscador = document.querySelector("#buscar");

eventListeners();

function eventListeners(){
    //Cuando eñ form se efecute
    formContactos.addEventListener("submit", leerForm);
    //Eliminar un contacto
    if(listadoContactos){
        listadoContactos.addEventListener("click", eliminarContacto);
    }
    //Buscador de contactos
    if(inputBuscador){
        inputBuscador.addEventListener("input", buscarContactos);
    }
    //num dde contactos
    numeroContactos();
}

function leerForm(e){
    e.preventDefault();
    //leer los datos de los imputs
    const nombre = document.querySelector("#nombre").value,
        empresa = document.querySelector("#empresa").value,
        telefono = document.querySelector("#telefono").value,
        accion = document.querySelector("#accion").value;

    if(nombre === "", empresa === "", telefono === ""){
        mostrarNotificacion("Todos los Campos son Obligatorios", "error");
    }else{
        //crear llamado ajax
        const infoContacto = new FormData();
        infoContacto.append("nombre", nombre);
        infoContacto.append("empresa", empresa);
        infoContacto.append("telefono", telefono);
        infoContacto.append("accion", accion);

        if(accion === "crear"){
            insertarBD(infoContacto);
        }else if(accion === "editar"){
            const idRegistro = document.querySelector("#id").value;

            infoContacto.append("id", idRegistro);
            actualizarRegistro(infoContacto);
        }
    }
}
//Insertar BD
function insertarBD(datos){
    //Llamado Ajax
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "includes/modelos/modelo-contactos.php", true);
    xhr.onload = function(){
        if(this.status === 200){
            //console.log(xhr.responseText);
            //Leemos la respuesta q nos envia desde PHP
            const respuesta = JSON.parse(xhr.responseText);
            //Insertar un nuevo elemento a la tabla
            const nuevoContacto = document.createElement('tr');

            nuevoContacto.innerHTML = `
                <td>${respuesta.datos.nombre}</td>
                <td>${respuesta.datos.empresa}</td>
                <td>${respuesta.datos.telefono}</td>
            `;
            //Contenedor para los botones
            const contenedorAcciones = document.createElement('td');
            //crear el icono de editar
            const iconoEditar = document.createElement('i');
            iconoEditar.classList.add('fas', 'fa-pen');
            const btnEditar = document.createElement('a');
            btnEditar.appendChild(iconoEditar);
            btnEditar.href = `editar.php?id=${respuesta.datos.id_insertado}`;
            btnEditar.classList.add('btn', 'btn-editar');

            contenedorAcciones.appendChild(btnEditar);
            //crear el icono de borrar
            const iconoBorrar = document.createElement('i');
            iconoBorrar.classList.add('fas', 'fa-trash');
            const btnBorrar = document.createElement('button');
            btnBorrar.appendChild(iconoBorrar);
            btnBorrar.setAttribute('data-id', respuesta.datos.id_insertado);
            btnBorrar.classList.add('btn', 'btn-borrar');

            contenedorAcciones.appendChild(btnBorrar);

            nuevoContacto.appendChild(contenedorAcciones);

            //agregarlo con los contactos
            listadoContactos.appendChild(nuevoContacto);

            //resetear contacto
            document.querySelector("form").reset();
            //mostrar notificacion
            mostrarNotificacion("Contacto creado correctamente", "correcto");
            numeroContactos();
        }
    }
    xhr.send(datos);
}
//Actualizar registro
function actualizarRegistro(datos){
    //console.log(...datos);
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "includes/modelos/modelo-contactos.php", true);
    xhr.onload = function(){
        if(this.status === 200){
            const respuesta = JSON.parse(xhr.responseText);

            if(respuesta.respuesta === "correcto"){
                mostrarNotificacion("Contacto editado correctamente", "correcto")
            }else{
                mostrarNotificacion("Hubo un error.", "error");
            }
            //redireccionar al index
            setTimeout(() => {
                window.location.href = "index.php";
            }, 4000);
        }
    }
    xhr.send(datos);
}
//Eliminar un contacto
function eliminarContacto(e){
    if(e.target.parentElement.classList.contains("btn-borrar")){
        //tomar ID
        const id = e.target.parentElement.getAttribute("data-id");
        //preguntar si realmente quiere borrar
        const respuesta = confirm("¿Estas seguro?");
        if(respuesta){
            //llamado ajax
            const xhr = new XMLHttpRequest();
            xhr.open("GET", `includes/modelos/modelo-contactos.php?id=${id}&accion=borrar`, true);
            xhr.onload = function(){
                if(this.status === 200){
                    const resultado = JSON.parse(xhr.responseText);

                    if(resultado.respuesta === "correcto"){
                        e.target.parentElement.parentElement.parentElement.remove();

                        mostrarNotificacion("Contacto eliminado", "correcto");
                    }else{
                        mostrarNotificacion("Hubo un error.", "error");
                    }
                }
                numeroContactos();
            }
            xhr.send();
        }
    }
}
//Notoficacion en pantalla
function mostrarNotificacion(mensaje, tipo){
    const notificacion = document.createElement("div");
    notificacion.classList.add(tipo, "notificacion", "sombra");
    notificacion.textContent = mensaje;
    //formulario
    formContactos.insertBefore(notificacion, document.querySelector("form legend")); 
    //ocultar la notificacion
    setTimeout(() =>{
        notificacion.classList.add("visible");

        setTimeout(() =>{
            notificacion.classList.remove("visible");
            setTimeout(() =>{
                notificacion.remove();
            }, 500);
        }, 3000);
    }, 100);
}
//Buscador de contactos
function buscarContactos(e){
    //console.log(e.target.value);
    const expresion = new RegExp(e.target.value, "i"),
            registros = document.querySelectorAll("tbody tr");
    registros.forEach(registro =>{
        registro.style.display = "none";

        // console.log(registro.childNodes);
        // console.log(registro.childNodes[1]);
        // console.log(registro.childNodes[1].textContent);
        // /\s/g: espacio en codigo remplazado por " "
        if(registro.childNodes[1].textContent.replace(/\s/g, " ").search(expresion) != -1){
            registro.style.display = "table-row";
        }
        numeroContactos();
    });
}
//Total de contactos
function numeroContactos(){
    const totalContactos = document.querySelectorAll("tbody tr"),
        contNumero = document.querySelector(".num-contactos span");
    let total = 0;
    
    if(contNumero){
        totalContactos.forEach(contacto => {
            if(contacto.style.display === "" || contacto.style.display === "table-row"){
                total++;
            }
        });
    
        contNumero.textContent = total;
    }
}