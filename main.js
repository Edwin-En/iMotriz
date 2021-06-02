// Pagina JS que contiene la aplicacion Vue, los botones y los metodos necesarios para el CRUD.

// Programa desarrollado por Edwin Enciso [UTP]

var url = "bd/crud.php";                      // URL del crud de la Base de Datos

var appiMotriz = new Vue({                    // Creacion del objeto Vue
el: "#appiMotriz",
data:{                                        // Datos utilizados para mostrar los productos
     productos:[],
     descripcion:"",
     referencia:"",
     moneda: "",
     precio: "",
     cantidad:"",
     total:0,
 },
methods:{
    //      BOTONES

    // Boton para Añadir un Producto
    btnAlta:async function(){
        const {value: formValues} = await Swal.fire({               // Creacion del Sweet Alert 2 para el boton de Nuevo
        title: 'Nuevo Producto',
        html:
        '<div class="row"><label class="col-sm-3 col-form-label">Descripcion</label><div class="col-sm-7"><input id="descripcion" type="text" class="form-control"></div></div><div class="row"><label class="col-sm-3 col-form-label">Referencia</label><div class="col-sm-7"><input id="referencia" type="text" class="form-control"></div></div><div class="row"><label class="col-sm-3 col-form-label">Moneda</label><div class="col-sm-7"><input id="moneda" type="text" class="form-control"></div></div><div class="row"><label class="col-sm-3 col-form-label">Precio</label><div class="col-sm-7"><input id="precio" type="text" class="form-control"></div></div><div class="row"><label class="col-sm-3 col-form-label">Cantidad</label><div class="col-sm-7"><input id="cantidad" type="number" min="0" class="form-control"></div></div>',
        focusConfirm: false,
        showCancelButton: true,
        confirmButtonText: 'Guardar',
        confirmButtonColor:'#1cc88a',
        cancelButtonColor:'#3085d6',

        preConfirm: () => {                                       // Confirmacion de que se han leido datos por pantalla
            return [
              this.descripcion = document.getElementById('descripcion').value,
              this.referencia = document.getElementById('referencia').value,
              this.moneda = document.getElementById('moneda').value,
              this.precio = document.getElementById('precio').value,
             this.cantidad = document.getElementById('cantidad').value
            ]
          }
        })

        if(this.descripcion == "" || this.referencia == "" ||  this.moneda == "" || this.precio == "" || this.cantidad == 0){
                Swal.fire({
                  type: 'info',
                  title: 'Datos incompletos',                     // En caso de que falte algun dato
                })
        }
        else{
          this.altaiMotriz();                                     // Llamado al metodo para añadir productos
          const Toast = Swal.mixin({                              // Notificacion de Sweet Alert
              toast: true,
              position: 'top-end',
              showConfirmButton: false,
              timer: 3000
            });
            Toast.fire({                                          // Mensaje de notificicacion
              type: 'success',
              title: '¡Producto Agregado!'
            })
        }},

    // Boton para Editar un Producto
    btnEditar:async function(id, descripcion, referencia, moneda, precio, cantidad){
        await Swal.fire({
        title: 'Editar Producto: '+id+" ",
        html:
        '<div class="form-group"><div class="row"><label class="col-sm-3 col-form-label">Descripcion</label><div class="col-sm-7"><input id="descripcion" value="'+descripcion+'" type="text" class="form-control"></div></div><div class="row"><label class="col-sm-3 col-form-label">Referencia</label><div class="col-sm-7"><input id="referencia" value="'+referencia+'" type="text" class="form-control"></div></div><div class="row"><label class="col-sm-3 col-form-label">Moneda</label><div class="col-sm-7"><input id="moneda" value="'+moneda+'" type="text" class="form-control"></div></div><div class="row"><label class="col-sm-3 col-form-label">Precio</label><div class="col-sm-7"><input id="precio" value="'+precio+'" type="text" class="form-control"></div></div><div class="row"><label class="col-sm-3 col-form-label">Cantidad</label><div class="col-sm-7"><input id="cantidad" value="'+cantidad+'" type="number" min="0" class="form-control"></div></div></div>',
        focusConfirm: false,
        showCancelButton: true,
        }).then((result) => {
          if (result.value) {                   // Verificacion de que se editaron los campos
            descripcion = document.getElementById('descripcion').value,
            referencia = document.getElementById('referencia').value,
            moneda = document.getElementById('moneda').value,
            precio = document.getElementById('precio').value,
            cantidad = document.getElementById('cantidad').value,

            this.editariMotriz(id, descripcion, referencia, moneda, precio, cantidad);      // Llamado al metodo para Editar
            Swal.fire(                          // Alerta de Sweet Alert
              '¡Actualizado!',
              'El registro ha sido actualizado.',
              'success'
            )
          }
        });
    },

    // Boton para Eliminar un Producto
    btnBorrar:function(id){
        Swal.fire({                           // Alerta de Sweet Alert
          title: '¿Está seguro de borrar el registro: '+id+" ?",
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor:'#d33',
          cancelButtonColor:'#3085d6',
          confirmButtonText: 'Borrar'
        }).then((result) => {
          if (result.value) {
            this.borrariMotriz(id);           // Metodo para Borrar un Producto
            Swal.fire(                        // Mensaje de notificacion de la eliminacion
              '¡Eliminado!',
              'El registro ha sido borrado.',
              'success'
            )
          }
        })},


    //      PROCEDIMIENTOS para el CRUD

    //  Procedimiento para mostrar los productos de la Base de Datos
    listarProductos:function(){
        axios.post(url, {opcion:4}).then(response =>{
           this.productos = response.data;
        });
    },

    //Procedimiento para Crear un producto en la Base de Datos
    altaiMotriz:function(){
        axios.post(url, {opcion:1, descripcion:this.descripcion, referencia:this.referencia, moneda:this.moneda, precio:this.precio, cantidad:this.cantidad }).then(response =>{
            this.listarProductos();
        });
         this.descripcion = "",
         this.referencia = "",
         this.moneda = "",
         this.precio = "",
         this.cantidad = 0
    },

    //Procedimiento para Editar un Producto de la Base de Datos
    editariMotriz:function(id, descripcion, referencia, moneda, precio, cantidad){
       axios.post(url, {opcion:2, id:id, descripcion:descripcion, referencia:referencia, moneda:moneda, precio:precio, cantidad:cantidad}).then(response =>{
           this.listarProductos();
        });
    },

    //Procedimiento para Borrar un producto de la Base de Datos
    borrariMotriz:function(id){
        axios.post(url, {opcion:3, id:id}).then(response =>{
            this.listarProductos();
            });
    }

},

created: function(){              // Inicio de ciclo de vida de Vue.JS muestra los productos
   this.listarProductos();
},
computed:{
    totalCantidad(){              // Funcion para llevar el total de productos en el sistema
        this.total = 0;
        for(producto of this.productos){
            this.total = this.total + parseInt(producto.cantidad);
        }
        return this.total;
    }
}
});
