<?php
    class MvcController{
        //Muestra una plantilla al usuario
        public function plantilla(){
            include 'views/template.php';
        }
        //Mostrar enlaces
        public function enlacesPaginasController(){

            if(isset($_GET['action'])){
                $enlaces = $_GET['action'];
            }else{
                $enlaces = 'index';
            }

            $respuesta = Paginas::enlacesPaginasModel($enlaces);
            include $respuesta;
        }

        public function inicioDeSesion(){
            if(isset($_POST['txtUsuario']) && isset($_POST['txtContraseña'])){
                $datos = array(
                    "usuario" => $_POST['txtUsuario'],
                    "contraseña" => $POST['txtContraseña']
                );

                $respuesta = Datos::ingresoUsuarioModel($datos, 'users');

                if($respuesta['usuario'] == $_POST['txtUsuario'] && password_verify($_POST['txtContraseña'], $respuesta['password']){
                    session_start();
                    $_SESSION['validar'] = true;
                    $_SESSION['usuario'] = $respuesta['usuario'];
                    $_SESSION['id'] = $respuesta['id'];
                    header('location:index.php?action=tablero');
                }else{
                    header('location:index.php?action=fallo&res=fallo');
                }
                

            }
        }

        public function vistaUsersController(){
            $respuesta = Datos::vistaUserModel('users');

            foreach($respuesta as $row => $item){
                echo '
                    <tr>
                        <td>
                            <a href="index.php?action=usuarios&idUserEditar='.$item['id'].'" class="btn btn-warning btn-sm btn-icon" 
                            title="Editar" data-toggle="tooltip"><i class="fa fa-edit"></i></a>
                            
                        </td>
                        <td>
                            <a href="index.php?action=usuarios&idBorrar='.$item['id'].'" class="btn btn-danger btn-sm btn-icon" 
                            title="Eliminar" data-toggle="tooltip"><i class="fa fa-trash"></i></a>
                        </td>
                        
                        <td>'.$item['firstname'].'</td>
                        <td>'.$item['lastname'].'</td>
                        <td>'.$item['user_name'].'</td>
                        <td>'.$item['user_email'].'</td>
                        <td>'.$item['date_added'].'</td>
                    </tr>';
            }
        }
        public function registrarUserController (){
            ?>
            <div class="col-md-6 mt-3">
                <div class="card card-primary">
                    <div class="card-header">
                        <h4><b>Registro</b de Usuarios</h4>
                    </div>
                    <div class="card-body">
                        <form method="post" action="index.php?action=usuarios">
                            <div class="form-group">
                                <label for="nusuariotxt">Nombre: </label>
                                <input class="form-control" type="text" name="nusuariotxt" id="nusuariotxt"
                                placeholder="Ingrese el nombre" required>
                            </div>
                            <div class="form-group">
                                <label for="ausuariotxt">Apellido: </label>
                                <input class="form-control" type="text" name="ausuariotxt" id="ausuariotxt"
                                placeholder="Ingrese el Apellido" required>
                            </div>
                            <div class="form-group">
                                <label for="usuariotxt">Usuario: </label>
                                <input class="form-control" type="text" name="usuariotxt" id="usuariotxt"
                                placeholder="Ingrese el Usuario" required>
                            </div>
                            <div class="form-group">
                                <label for="ucontratxt">Contraseña: </label>
                                <input class="form-control" type="password" name="ucontratxt" id="ucontratxt"
                                placeholder="Ingrese la contraseña" required>
                            </div>
                            <div class="form-group">
                                <label for="uemailtxt">Correo electronico: </label>
                                <input class="form-control" type="email" name="uemailtxt" id="uemailtxt"
                                placeholder="Ingrese el correo electronico" required>
                            </div>
                            <button class="btn btn-primary" type="submit">Agregar</button>
                        </form>
                    </div>
                </div>
            </div>
            <?php
        }

        public function insertarUserController() {
            if(isset($_POST["nusuariotxt"])) {
                //Encriptar la contraseña.
                $_POST["ucontratxt"] = password_hash($_POST["ucontratxt"], PASSWORD_DEFAULT);
                $datosController = array("nusuario"=>$_POST["nusuariotxt"],"ausuario"=>$_POST["ausuariotxt"],
                "usuario"=>$_POST["usuariotxt"],"contra"=>$_POST["ucontratxt"],"email"=>$_POST["uemailtxt"]);

                $respuesta = Datos::insertarUserModel($datosController,"users");

                if($respuesta == "success"){
                    echo '
                        <div class="col-md-6 mt-3">
                            <div class="alert alert-success alert-dismissible">
                            <button class="close" type="button" data-dismiss="alert" aria-hidden="true">x</
                            button>
                            <h5>
                                <i class="icon fas fa-check"></i>
                                !Exito!
                            </h5>
                            Usuario agregado con exito.
                        </div>
                    </div>
                    ';
                } else {
                    echo '
                        <div class="col-md-6 mt-3">
                            <div class="alert alert-danger alert-dismissible">
                            <button class="close" type="button" data-dismiss="alert" aria-hidden="true">x</
                            button>
                            <h5>
                                <i class="icon fas fa-check"></i>
                                !Error!
                            </h5>
                            Se ha producido un error al momento de agregar el usuario, trate de nuevo.
                        </div>
                    </div>
                    ';
                }
            }
        }
        public function editarUserController() {
            $datosController = $_GET["idUserEditar"];
            //envío de datos al mododelo
            $respuesta = Datos::editarUserModel($datosController,"users");
            ?>
            <div class="col-md-6 mt-3">
                <div class="card card-warning">
                    <div class="card-header">
                        <h4><b>Editor</b> de Usuarios</h4>
                    </div>
                    <div class="card-body">
                        <form method="post" action="index.php?action=usuarios">
                            <div class="form-group">
                                <input type="hidden" name="idUserEditar" class="form-control" value="<?php echo $respuesta["id"]; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="nusuariotxtEditar">Nombre: </label>
                                <input class="form-control" type="text" name="nusuariotxtEditar" id="nusuariotxtEditar" placeholder="Ingrese el nuevo nombre" value="<?php echo $respuesta["nusuario"]; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="ausuariotxtEditar">Apellido: </label>
                                <input class="form-control" type="text" name="ausuariotxtEditar" id="ausuariotxtEditar" placeholder="Ingrese el nuevo apellido" value="<?php echo $respuesta["ausuario"]; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="usuariotxtEditar">Usuario: </label>
                                <input class="form-control" type="text" name="usuariotxtEditar" id="usuariotxtEditar" placeholder="Ingrese el nuevo usuario" value="<?php echo $respuesta["usuario"]; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="contratxtEditar">Contraseña: </label>
                                <input class="form-control" type="password" name="contratxtEditar" id="contratxtEditar" placeholder="Ingrese la nueva contraseña" required>
                            </div>
                            <div class="form-group">
                                <label for="uemailtxtEditar">Correo Electrónico: </label>
                                <input class="form-control" type="email" name="uemailtxtEditar" id="uemailtxtEditar" placeholder="Ingrese el nuevo correo electrónico" value="<?php echo $respuesta["email"]; ?>" required>
                            </div>
                            <button class="btn btn-primary" type="submit">Editar</button>
                        </form>
                    </div>
                </div>
        </div>
        <?php
        }

        public function actualizarUserController(){
            if (isset($_POST["nusuariotxtEditar"])){
                $_POST["contratxtEditar"] = password_hash($_POST["contratxtEditar"],PASSWORD_DEFAULT);

                $datosController = array("id"=>$_POST["idUserEditar"],"nusuario"=>$_POST["nusuariotxtEditar"],
                "ausuario"=>$_POST["ausuariotxtEditar"],,"usuario"=>$_POST["usuariotxtEditar"],"contra"=>$_POST
                ["contratxtEditar"],"email"=>$_POST["uemailtxtEditar"]);

                //Enviar datos al modelo
                if($respuesta == "success"){
                    echo '
                        <div class="col-md-6 mt-3">
                            <div class="alert alert-success alert-dismissible">
                            <button class="close" type="button" data-dismiss="alert" aria-hidden="true">x</
                            button>
                            <h5>
                                <i class="icon fas fa-check"></i>
                                !Exito!
                            </h5>
                            Usuario editado con exito.
                        </div>
                    </div>
                    ';
                } else {
                    echo '
                        <div class="col-md-6 mt-3">
                            <div class="alert alert-danger alert-dismissible">
                            <button class="close" type="button" data-dismiss="alert" aria-hidden="true">x</
                            button>
                            <h5>
                                <i class="icon fas fa-ban"></i>
                                !Error!
                            </h5>
                            Se ha producido un error al momento de editar el usuario, trate de nuevo.
                        </div>
                    </div>
                    ';
                }
            }
        }



        public function eliminarUserController(){
            if (isset($_GET["idBorrar"])){
                $respuesta = Datos::eliminarUserModel($datosController, "users");

                //se recibe respuesta del modelo
                if ($respuesta == "success") {
                    echo '
                        <div class="col-md-6 mt-3">
                            <div class="alert alert-danger alert-dismissible">
                            <button class="close" type="button" data-dismiss="alert" aria-hidden="true">x</
                            button>
                            <h5>
                                <i class="icon fas fa-check"></i>
                                !Error!
                            </h5>
                            Usuario eliminado con exito!
                        </div>
                    </div>
                    ';
                }else{
                    echo '
                        <div class="col-md-6 mt-3">
                            <div class="alert alert-danger alert-dismissible">
                                <button class="close" type="button" data-dismiss="alert" aria-hidden="true">x</
                                button>
                                <h5>
                                    <i class="icon fas fa-ban"></i>
                                    !Error!
                                </h5>
                                Se ha producido un error al momento de eliminar el usuario, trate de nuevo.
                            </div>
                        </div>
                    ';
                }
            }
        }

        public function contarFilas(){
            $respuesta_users = Datos::contarFilasModel("users");
            $respuesta_products = Datos::contarFilasModel("products");
            $respuesta_categorias = Datos::contarFilasModel("categorias");
            $respuesta_historial = Datos::contarFilasModel("historial");

            echo '
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>'.$respuesta_users["filas"].'</h3>
                            <p>Total de Usuarios</p>
                        </div>
                        <div class="icon">
                            <i class="far fa-address-card"></i>
                        </div>
                        <a class="small-box-footer" href="index.php?action=usuarios">Más <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>';
        }

        public function vistaUsersController(){
            $respuesta = Datos::vistaUserModel('products');

            foreach($respuesta as $row => $item){
                echo '
                    <tr>
                        <td>
                            <a href="index.php?action=inventario&idProductEditar='.$item['id'].'" class="btn btn-warning btn-sm btn-icon" 
                            title="Editar" data-toggle="tooltip"><i class="fa fa-edit"></i></a>
                            
                        </td>
                        <td>
                            <a href="index.php?action=inventario&idBorrar='.$item['id'].'" class="btn btn-danger btn-sm btn-icon" 
                            title="Eliminar" data-toggle="tooltip"><i class="fa fa-trash"></i></a>
                        </td>
                        
                        <td>'.$item['id_product'].'</td>
                        <td>'.$item['code_product'].'</td>
                        <td>'.$item['name_product'].'</td>
                        <td>'.$item['date_added'].'</td>
                        <td>'.$item['price_product'].'</td>
                        <td>'.$item['stock'].'</td>
                        <td>'.$item['id_category'].'</td>

                        <td>
                            <a href="index.php?action=inventario&idProductAdd='.$item['id'].'" class="btn btn-danger btn-sm btn-icon" 
                            title="Agregar Stock" data-toggle="tooltip"><i class="fa fa-trash"></i></a>
                        </td>

                        <td>
                            <a href="index.php?action=inventario&idProductDel='.$item['id'].'" class="btn btn-danger btn-sm btn-icon" 
                            title="Quitar Stock" data-toggle="tooltip"><i class="fa fa-trash"></i></a>
                        </td>

                    </tr>';
            }
        }

        public function registrarProductController (){
            ?>
            <div class="col-md-6 mt-3">
                <div class="card card-primary">
                    <div class="card-header">
                        <h4><b>Registro</b de Productos</h4>
                    </div>
                    <div class="card-body">
                        <form method="post" action="index.php?action=usuarios">
                            <div class="form-group">
                                <label for="nusuariotxt">Codigo: </label>
                                <input class="form-control" type="text" name="codigotxt" id="codigotxt"
                                placeholder="Codigo del Producto" required>
                            </div>
                            <div class="form-group">
                                <label for="ausuariotxt">Nombre: </label>
                                <input class="form-control" type="text" name="nombretxt" id="nombretxt"
                                placeholder="Nombre de Producto" required>
                            </div>
                            <div class="form-group">
                                <label for="usuariotxt">Precio: </label>
                                <input class="form-control" type="number" name="preciotxt" id="preciotxt"
                                placeholder="Precio de Producto" required>
                            </div>
                            <div class="form-group">
                                <label for="ucontratxt">Stock: </label>
                                <input class="form-control" type="number" name="stocktxt" id="stocktxt"
                                placeholder="Cantidad de Stock del Producto" required>
                            </div>
                            <div class="form-group">
                                <label for="uemailtxt">Motivo: </label>
                                <input class="form-control" type="email" name="referenciatxt" id="referenciatxt"
                                placeholder="Referencia del Producto" required>
                            </div>
                            <div class="form-group">
                                <label for="uemailtxt">Motivo: </label>
                                <select name="categoria" id="categoria" class="form-control">
                                    <?php
                                        $respuesta_categoria = Datos::obtenerCategoryModel("categories");
                                        foreach ($$respuesta_categoria as $row => $item) {
                                    ?>
                                            <option value="<?php echo $item["id"]; ?>"><?php echo $item["categoria"]; ?></option>
                                    <?php
                                        }
                                    ?>
                                </select>
                            </div>
                            <button class="btn btn-primary" type="submit">Agregar</button>
                        </form>
                    </div>
                </div>
            </div>
            <?php
        }
         /*-- Esta funcion permite insertar productos llamando al modelo  que se encuentra en  elarchivo crud de modelos confirma con un isset que la caja de texto del codigo este llena y procede a llenar en una variable llamada datos controller este arreglo se manda como parametro aligual que elnombre de la tabla,una vez se obtiene una respuesta de la funcion del modelo de inserccion 
        tenemos que checar si la respuesta fue afirmativa hubo un error y mostrara los respectivas alerta,para insertar datos en la tabla de historial se tiene que mandar a un modelollamado ultimoproductmodel este traera el ultimo dato insertado que es el id del producto que se manda en elarray de datoscontroller2 junto al nombre de la tabla asi insertando los datos en la tabla historial --*/
        public function insertarProductController(){
            if(isset($_POST["codigotxt"])){
                $datosController = array("codigo"=>$_POST["codigotxt"], "precio"=>$_POST["preciotxt"]), "stock"=>$_POST["stocktxt"], "categoria"=>$_POST["categoria"], "nombre"=>$_POST["nombretxt"]); $respuesta = Datos::insertarProductsModel($datosController, "products");
                if($respuesta == "success"){
                    $respuesta3 = Datos::ultimoProductsModel("products");
                    $datosController2 = array("user"=>$_SESSION["id"], "cantidad"=>$_POST["stocktxt"], "producto"=>$respuesta3["id"],"note"=>$_SESSION["nombre_usuario"]."agrego/compro","reference"=>$_POST["referenciatxt"]);
                    $respuesta2 = Datos::insertarHistorialModel($datosController2,"historial");
                    echo '
                        <div class="col-md-6 mt-3">
                            <div class="alert alert-danger alert-dismissible">
                                <button class="close" type="button" data-dismiss="alert" aria-hidden="true">x</button>
                                <h5>
                                    <i class="icon fas fa-ban"></i>
                                    ¡Exito!
                                </h5>
                                Producto Agregado con Exito
                            </div>
                        </div>
                    ';
                }else{
                    echo '
                        <div class="col-md-6 mt-3">
                            <div class="alert alert-danger alert-dismissible">
                                <button class="close" type="button" data-dismiss="alert" aria-hidden="true">x</button>
                                <h5>
                                    <i class="icon fas fa-ban"></i>
                                    ¡Error!
                                </h5>
                                Se ha producido un error al momento de agregar el producto, trate de nuevo.
                            </div>
                        </div>
                    ';
                }
            }
        }

        public function editarProductController(){
            $datosController = $_GET["idProductEditar"];
            $respuesta = Datos::editarProductModel($datosController,"products");
            ?>
            <div class="col-mb-6 mt-3">
                <div class="card card-warning">
                    <div class="card-header">
                        <h4><b>Editor</b> de Productos</h4>
                    </div>
                    <div class="card-body">
                        <form method="post" action="index.php?action=inventario">
                            <div class="form-group">
                                <input type="hidden" name="idProductEditar" class="form-control" value="<?php echo $respuesta["id"]; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="codigotxtEditar">Codigo:</label>
                                <input class="form-control" type="text" id="codigotxteditar" name="codigotxteditar" value="<?php echo $respuesta["codigo"]; ?>" requiered placeholder="Codigo de Producto">
                            </div>
                            <div class="form-group">
                                <label for="nombretxtEditar">Nombre:</label>
                                <input class="form-control" type="text" id="nombretxteditar" name="nombretxteditar" value="<?php echo $respuesta["nombre"]; ?>" requiered placeholder="Nombre de Producto">
                            </div>
                            <div class="form-group">
                                <label for="preciotxtEditar">Precio:</label>
                                <input class="form-control" type="text" id="preciotxteditar" name="preciotxteditar" value="<?php echo $respuesta["precio"]; ?>" requiered placeholder="Precio de Producto">
                            </div>
                            <div class="form-group">
                                <label for="stocktxtEditar">Stocks:</label>
                                <input class="form-control" type="text" id="stocktxteditar" name="stocktxteditar" value="<?php echo $respuesta["stock"]; ?>" requiered placeholder="Cantidad de Stock del Producto">
                            </div>
                            <div class="form-group">
                                <label for="referenciatxtEditar">Motivo:</label>
                                <input class="form-control" type="text" id="referenciatxteditar" name="referenciatxteditar" requiered placeholder="Referencia del Producto">
                            </div>
                            <div class="form-group">
                                <label for="categoriaEditar">Categoria:</label>
                                <select class="form-control" id="categoriaeditar" name="categoriaeditar">
                                    <?php
                                        $respuesta_categoria = Datos::obtenerCategoryModel("categories");
                                        foreach ($respuesta_categoria as $row => $item) {
                                    ?>
                                    <option value="<?php echo $item["id"]; ?>"><?php echo $item["categoria"]; ?></option>
                                </select>
                                <?php
                                        }
                                ?>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <?php
        }
        public function actualizarProductController(){
            if(isset($_POST["codigotxteditar"])){
                $datosController = array("id"=>$_POST["idProductEditar"], "codigo"=>$_POST["codigotxteditar"], "precio"=>$_POST["preciotxteditar"], "stock"=>$_POST["stocktxteditar"], "categoria"=>$_POST["categoriaeditar"], "nombre"=>$_POST["nombretxteditar"]);
                $respuesta = Datos::actualizarProductModel($datosController, "products");
                if($respuesta == "success"){
                    $datosController2 = array("user"=>$_SESSION["id"], "cantidad"=>$_POST["stocktxteditar"], "producto"=>$_POST["idProductEditar"], "note"=>$_SESSION["nombre_usuario"]."agregar/compro", "reference"=>$_POST["referenciatxteditar"]);
                    $respuesta2 = Datos::insertarHistorialModel($datosController2, "historial");
                    echo '
                        <div class="col-md-6 mt-3">
                            <div class="alert alert-danger alert-dismissible">
                                <button class="close" type="button" data-dismiss="alert" aria-hidden="true">x</button>
                                <h5>
                                    <i class="icon fas fa-ban"></i>
                                    ¡Exito!
                                </h5>
                                Producto Actualizado con Exito
                            </div>
                        </div>
                    ';
                }else{
                    echo '
                        <div class="col-md-6 mt-3">
                            <div class="alert alert-danger alert-dismissible">
                                <button class="close" type="button" data-dismiss="alert" aria-hidden="true">x</button>
                                <h5>
                                    <i class="icon fas fa-ban"></i>
                                    ¡Error!
                                </h5>
                                Se ha producido un error al momento de actualizar el producto, trate de nuevo.
                            </div>
                        </div>
                    ';
                }
            }
        }

        public function addProductController(){
            $datosController = $_GET["idProductAdd"];
            $respuesta = Datos::editarProductModel($datosController, "products");
            ?>
            <div class="col-mb-6 mt-3">
                <div class="card card-warning">
                    <div class="card-header">
                        <h4><b>Agregar</b> Stock al Productos</h4>
                    </div>
                    <div class="card-body">
                        <form method="post" action="index.php?action=inventario">
                            <div class="form-group">
                                <input type="hidden" name="idProductAdd" class="form-control" value="<?php echo $respuesta["id"]; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="stocktxtEditar">Stocks:</label>
                                <input class="form-control" type="number" id="addstocktxt" name="addstocktxt" min="1" value="1" requiered placeholder="Stock de Producto">
                            </div>
                            <div class="form-group">
                                <label for="referenciatxtadd">Motivo:</label>
                                <input class="form-control" type="text" id="referenciatxtadd" name="referenciatxtadd" requiered placeholder="Referencia del Producto">
                            </div>
                            <button class="btn btn-primary" type="submit">Realizar Cambio</button>
                        </form>
                    </div>
                </div>
            </div>
            <?php
        }

        public function actualizar1StockController(){
            if(isset($_POST["addstocktxt"])){
                $datosController = array("id"=>$_POST["idProductAdd"], "stock"=>$_POST["addstocktxt"]);
                $respuesta = Datos::pushProductsModel($datosController, "products");
                if($respuesta == "success"){
                    $datosController2 = array("user"=>$_SESSION["id"], "cantidad"=>$_POST["addstocktxt"], "producto"=>$_POST["idProductAdd"], "note"=>$_SESSION["nombre_usuario"]."agregar/compro", "reference"=>$_POST["referenciatxtadd"]);
                    $respuesta = Datos::insertarHistorialModel($datosController, "historia");
                    echo '
                        <div class="col-md-6 mt-3">
                            <div class="alert alert-danger alert-dismissible">
                                <button class="close" type="button" data-dismiss="alert" aria-hidden="true">x</button>
                                <h5>
                                    <i class="icon fas fa-ban"></i>
                                    ¡Exito!
                                </h5>
                                Stock Modificado con Exito
                            </div>
                        </div>
                    ';
                }else{
                    echo '
                        <div class="col-md-6 mt-3">
                            <div class="alert alert-danger alert-dismissible">
                                <button class="close" type="button" data-dismiss="alert" aria-hidden="true">x</button>
                                <h5>
                                    <i class="icon fas fa-ban"></i>
                                    ¡Error!
                                </h5>
                                Se ha producido un error al momento de actualizar el Stock, trate de nuevo.
                            </div>
                        </div>
                    ';
                }
            }
        }

        public function actualizar2StockController(){
            if(isset($_POST["delstocktxt"])){
                $datosController = array("id"=>$_POST["idProductDel"], "stock"=>$_POST["delstocktxt"]);
                $respuesta = Datos::pushProductsModel($datosController, "products");
                if($respuesta == "success"){
                    $datosController2 = array("user"=>$_SESSION["id"], "cantidad"=>$_POST["delstocktxt"], "producto"=>$_POST["idProductDel"], "note"=>$_SESSION["nombre_usuario"]."agregar/compro", "reference"=>$_POST["referenciatxtadd"]);
                    $respuesta2 = Datos::insertarHistorialModel($datosController2, "historia");
                    echo '
                        <div class="col-md-6 mt-3">
                            <div class="alert alert-danger alert-dismissible">
                                <button class="close" type="button" data-dismiss="alert" aria-hidden="true">x</button>
                                <h5>
                                    <i class="icon fas fa-ban"></i>
                                    ¡Exito!
                                </h5>
                                Stock Modificado con Exito
                            </div>
                        </div>
                    ';
                }else{
                    echo '
                        <div class="col-md-6 mt-3">
                            <div class="alert alert-danger alert-dismissible">
                                <button class="close" type="button" data-dismiss="alert" aria-hidden="true">x</button>
                                <h5>
                                    <i class="icon fas fa-ban"></i>
                                    ¡Error!
                                </h5>
                                Se ha producido un error al momento de actualizar el Stock, trate de nuevo.
                            </div>
                        </div>
                    ';
                }
            }
        }

        public function delProductController(){
            $datosController = $_GET["idProductDel"];
            $respuesta = Datos::editarProductModel($datosController, "products");
            ?>
            <div class="col-mb-6 mt-3">
                <div class="card card-warning">
                    <div class="card-header">
                        <h4><b>Eliminar</b> Stock al Productos</h4>
                    </div>
                    <div class="card-body">
                        <form method="post" action="index.php?action=inventario">
                            <div class="form-group">
                                <input type="hidden" name="idProductDel" class="form-control" value="<?php echo $respuesta["id"]; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="codigotxtEditar">Stock:</label>
                                <input class="form-control" name="delstocktxt" id="delstocktxt" type="number" min="1" max="<?php echo $respuesta["stock"]; ?>" value="<?php echo $respuesta["stock"]; ?>" requiered placeholder="Stock de Producto">
                            </div>
                            <div class="form-group">
                                <label for="nombretxtEditar">Motivo:</label>
                                <input class="form-control" type="text" id="referenciatxtdel" name="referenciatxtdel" requiered placeholder="Referencia del Producto">
                            </div>
                            <button class="btn btn-primary" type="submit">Realizar Cambio</button>
                        </form>
                    </div>
                </div>
            </div>
            <?php
        }

        public function vistaHistorialController(){
            $respuesta = Datos::vistaHistorialModel("historia");
            foreach($respuesta as $row => $item){
                echo '
                    <tr>
                        <td>'.$item["usuario"].'</td>
                        <td>'.$item["producto"].'</td>
                        <td>'.$item["note"].'</td>
                        <td>'.$item["cantidad"].'</td>
                        <td>'.$item["referencia"].'</td>
                        <td>'.$item["fecha"].'</td>
                    </tr>
                ';
            }
        }

        public function vistaCategoriesController(){
            $respuesta = Datos::vistaCategoriesModel("categories");
            foreach($respuesta as $row => $item){
                echo '
                    <tr>
                        <td>
                            <a href="indes.php?action=categorias&idCategoryEditar='.$item["idc"].'" class="btn btn-warning btn-sm btn-icon" title="Editar" data-toggle="tooltip"><i class="fa fa-edit"></i></a>
                        </td>
                        <td>
                            <a href="indes.php?action=categorias&idBorrar='.$item["idc"].'" class="btn btn-danger btn-sm btn-icon" title="Eliminar" data-toggle="tooltip"><i class="fa fa-trash"></i></a>
                        </td>
                        <td>'.$item["idc"].'</td>
                        <td>'.$item["idc"].'</td>
                        <td>'.$item["idc"].'</td>
                        <td>'.$item["idc"].'</td>
                    ';
            }
        }

        public function registrarCategoryController(){
            ?>
            <div class="col-mb-6 mt-3">
                <div class="card card-warning">
                    <div class="card-header">
                        <h4><b>Eliminar</b> Stock al Productos</h4>
                    </div>
                    <div class="card-body">
                        <form method="post" action="index.php?action=inventario">
                            <div class="form-group">
                                <input type="hidden" name="idProductDel" class="form-control" value="<?php echo $respuesta["id"]; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="codigotxtEditar">Nombre de la Categoria:</label>
                                <input class="form-control" name="ncategoriatxt" id="ncategoriatxt" type="text" placeholder="Ingrese el Nombre de la Categoria">
                            </div>
                            <div class="form-group">
                                <label for="nombretxtEditar">Descripcion de la Categoria:</label>
                                <input class="form-control" type="text" id="dcategoriatxt" name="dcategoriatxt" placeholder="Ingrese la Descripcion de la Categoria">
                            </div>
                            <button class="btn btn-primary" type="submit">Agregar</button>
                        </form>
                    </div>
                </div>
            </div>
        }

        public function insertarCategoryController(){
            if(isset($_POST["ncategoriatxt"]) && isset($_POST["ncategoriatxt"])){
                $datosController = array("nombre_categoria"=>$_POST["ncategoriatxt"], "descripcion_categoria"=>$_POST["dcategoriatxt"]);
                $respuesta = Datos::insertarCategoryModel($datosController,"categories");
                if($respuesta == "success"){

                }
            }
        }

        public function editarCategoryController(){
            $datosController = $_GET["idCategoryEditar"];
            $respuesta = Datos::editarCategoryModel($datosController,"categories");
            ?>
            <div class="col-md-6 mt-3">
                <div class="card card-warning">
                    <div class="card-header">
                        <h4><b>Editor</b> de categorias</h4>
                    </div>
                    <div class="card-body">
                        <form action="index.php?action=categorias" method="post">
                            <div class="form-group">
                                <input type="hidden" name="idCategoryEditar" class="form-control" value="<?php echo $respuesta["id"]; required ?>">
                            </div>
                            <div class="form-group">
                                <label for="ncategoriatxt">Nombre de la Categoria: </label>
                                <input type="text" class="form-control" name="ncategoriatxteditar" value="<?php echo $respuesta["nombre_categoria"]; ?>">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        }
    }
?>