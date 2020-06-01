<?php
    include_once 'public/header.php';
?>
    <div class="container-fluid" style="padding: 80px;">
        <div class="row justify-content-center align-items-center">
            <div class="form-group">
            <h2>Determinar tipo de red</h2>
            <br>
                <form action="?controlador=Tarea&accion=obtenerDatosRedes" method="post">
                    <div class="form-group">
                    <label for="Re">Fiabilidad de la red</label>
                    <select name="Re" id="Re" class="form-control">
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                    </div>
                    <div class="form-group">
                    <label for="Li">Número de enlaces</label>
                    <select name="Li" id="Li" class="form-control">
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                        <option value="13">13</option>
                        <option value="14">14</option>
                        <option value="15">15</option>
                        <option value="16">16</option>
                        <option value="17">17</option>
                        <option value="18">18</option>
                        <option value="19">19</option>
                        <option value="20">20</option>
                    </select>
                    </div>
                    <div class="form-group">
                    <label for="Ca">Capacidad total de la red</label>
                    <select name="Ca" id="Ca" class="form-control">
                        <option value="Low">Baja</option>
                        <option value="Medium">Media</option>
                        <option value="High">Alta</option>
                    </select>
                    </div>
                    <div class="form-group">
                    <label for="Co">Costo de la red</label>
                    <select name="Co" id="Co" class="form-control">
                        <option value="Low">Baja</option>
                        <option value="Medium">Media</option>
                        <option value="High">Alta</option>
                    </select>
                    </div>
                    
                    <button type="submit" class="btn btn-success">Calcular</button>
                    <br>
                    <br>
                    <h5>Resultado: <?php
                        if($vars != NULL){
                            echo $vars;
                        }?>
                    </h5>
                </form>
            </div>
        </div>
    </div>
<?php
    include_once 'public/footer.php';
?>
