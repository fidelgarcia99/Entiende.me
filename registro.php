<?php

include "header.php";

?>
      <!-- Content -->
      <div class="content">
           <div class="row">
                   <div class="col">
                           <div class="card">
                                   <div class="card-header center" >
                                    <label for="">Registro</label>
                                   </div>
                                   <div class="card-body card-block">
                                    <form name="formulario" id="formulario" method="POST" enctype="multipart/form-data" class="form-horizontal">
                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Primer Nombre</label></div>
                                        <div class="col-12 col-md-9"><input type="text" id="pnombre" name="Nombre" placeholder="Ingrese Nombre" class="form-control"><small id="Nombre-val" class="form-text text-muted">* Debe ingresar Nombre</small></div>
                                        
                                    </div>
                                    
                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Segundo Nombre</label></div>
                                        <div class="col-12 col-md-9"><input type="text" id="snombre" name="Apellido" placeholder="Ingrese Apellido" class="form-control"><small id="Apellido-val" class="form-text text-muted">* Ingrese Apellido</small></div>                                        
                                    </div>

                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Primer Apellido</label></div>
                                        <div class="col-12 col-md-9"><input type="text" id="papellido" name="Identidad" placeholder="Ingrese Identidad" class="form-control"><small id="Identidad-val" class="form-text text-muted">* Ingrese Identidad o Digite 0</small></div>
                                        
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Segundo Apellido</label></div>
                                        <div class="col-12 col-md-9"><input type="text" id="sapellido" name="Identidad" placeholder="Ingrese Identidad" class="form-control"><small id="Identidad-val" class="form-text text-muted">* Ingrese Identidad o Digite 0</small></div>
                                        
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Email</label></div>
                                        <div class="col-12 col-md-9"><input type="text" id="email" name="Identidad" placeholder="Ingrese Identidad" class="form-control"><small id="Identidad-val" class="form-text text-muted">* Ingrese Identidad o Digite 0</small></div>
                                        
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Contraseña</label></div>
                                        <div class="col-12 col-md-9"><input type="password" id="contraseña" name="Identidad" placeholder="Ingrese Identidad" class="form-control"><small id="Identidad-Victima-val" class="form-text text-muted">* Ingrese Identidad o Digite 0</small></div>
                                        
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Telefono</label></div>
                                        <div class="col-12 col-md-9"><input type="text" id="telefono" name="Identidad" placeholder="Ingrese Identidad" class="form-control"><small id="Identidad-Victima-val" class="form-text text-muted">* Ingrese Identidad o Digite 0</small></div>
                                        
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="select" class=" form-control-label">Sexo</label></div>
                                        <div class="col-12 col-md-9">
                                            <select name="select" id="sexo" class="form-control">  
                                                <option value="0">Seleccionar</option>
                                                <option value="Femenino">Femenino</option>
                                                <option value="Femenino">Masculino</option>
                                            </select>
                                            <small id="EstadoGestacion-val" class="form-text text-muted">* Seleccione Una Opción</small>    
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">NickName</label></div>
                                        <div class="col-12 col-md-9"><input type="text" id="nickname" name="Identidad" placeholder="Ingrese Identidad" class="form-control"><small id="Identidad-Victima-val" class="form-text text-muted">* Ingrese Identidad o Digite 0</small></div>
                                        
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Fecha de Nacimiento</label></div>
                                        <div class="col-12 col-md-9"><input type="date" id="fecha_nacimiento" name="Identidad" placeholder="Ingrese Identidad" class="form-control"><small id="Identidad-Victima-val" class="form-text text-muted">* Ingrese Identidad o Digite 0</small></div>
                                        
                                    </div>

                                    <div class="row justify-content-center">
                                    <div class="col-6 text-center"><button type="button" class="btn btn-success btn-lg btn-block" onclick="guardar()" ><i class="fa fa-save"></i>&nbsp; Guardar</button></div>
                                    </div><br>
          
                                    </div>
                                    </form>
                            </div>

                        <!-- Fin Modal Modus -->


                   </div>
           </div>
        </div>
        <script src="js/usuario.js"></script>
<?php
include "footer.html";

?>