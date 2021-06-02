<!doctype html>
<html>

<!-- Pagina de INDEX que contiene el codigo de HTML de la pagina final vista por el usuario -->

<!-- Programa desarrollado por Edwin Enciso [UTP] -->

    <head>

    <link rel="shortcut icon" href="#" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <!-- Referencias de archivos necesarios para la implementacion del proyecto -->

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- FontAwesom CSS -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <!--Sweet Alert 2 -->
    <link rel="stylesheet" href="plugins/sweetalert2/sweetalert2.min.css">
    <!--CSS custom -->
    <link rel="stylesheet" href="main.css">

    <!-- Inicio de condigo HTML -->

    </head>
    <body>
    <header>
        <br><br>
        <h1 class="text-center text-dark"><span class="badge badge-primary">Sistema de Administracion iMotriz [CRUD]</span></h1>
        <br><br>
    </header>

     <div id="appiMotriz">                      <!-- Aplicacion iMotriz -->
        <div class="container">                 <!-- Contenedor de la aplicacion -->
            <div class="row">
                <div class="col">               <!-- Boton de Añadir un nuevo Producto -->
                    <button @click="btnAlta" class="btn btn-success" title="Nuevo Producto"><i class="fas fa-plus-circle fa-2x"></i></button>
                </div>
                <div class="col text-right">    <!-- Contador de Productos totales del sistema -->
                    <h4>Cantidad Total de Productos: <span class="badge badge-success">{{totalCantidad}}</span></h4>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-lg-12">
                    <table class="table table-striped">
                        <thead>
                            <tr class="bg-primary text-light">      <!-- Filas de la Tabla -->
                                <th><h5> ID </h5></th>
                                <th><h5> Descripcion </h5></th>
                                <th><h5> Referencia </h5></th>
                                <th><h5> Moneda </h5></th>
                                <th><h5> Precio </h5></th>
                                <th><h5> Cantidad </h5></th>
                                <th><h5> Acciones </h5></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(producto,indice) of productos">     <!-- llamado de los productos del sistema -->
                                <td> {{producto.id}} </td>
                                <td> {{producto.descripcion}} </td>
                                <td> {{producto.referencia}} </td>
                                <td> {{producto.moneda}} </td>
                                <td> {{producto.precio}} </td>
                                <td>
                                    <div class="col-md-8">                  <!-- Label para contener la cantidad del producto -->
                                    <input type="number" v-model.number="producto.cantidad" class="form-control text-left" disabled>
                                    </div>
                                </td>
                                <td>
                                <div class="btn-group" role="group">        <!-- Botones Editar y Eliminar -->
                                    <button class="btn btn-info" title="Editar" @click="btnEditar(producto.id, producto.descripcion, producto.referencia, producto.moneda, producto.precio, producto.cantidad)"><i class="fas fa-pencil-alt"></i></button>
                                    <button class="btn btn-danger" title="Eliminar" @click="btnBorrar(producto.id)"><i class="fas fa-trash-alt"></i></button>
								                </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <br>
                    <div align="center"> <img src = "img/Logo.png"> </div>  <!-- Imagen con el Logo de la empresa iMotriz -->
                </div>
            </div>
        </div>
    </div>



    <!-- Archivos necesarios para la implementacion del proyecto -->

    <!-- jQuery, Popper.js, Bootstrap JS -->
    <script src="jquery/jquery-3.3.1.min.js"></script>
    <script src="popper/popper.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!--Vue.JS -->
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <!--Axios -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.15.2/axios.js"></script>
    <!--Sweet Alert 2 -->
    <script src="plugins/sweetalert2/sweetalert2.all.min.js"></script>
    <!--Código custom -->
    <script src="main.js"></script>

    </body>

    <!-- Fin de HTML -->
</html>
