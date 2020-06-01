<?php
    include_once 'public/header.php';
?>
<div class="container-fluid">
        <br><br><br>
    <div class="row justify-content-center align-items-center">
        <form action="?controlador=Tarea&accion=obtenerDatosAdivinarSexo" method="post">
        <h2>Adivinar sexo</h2>
        <div class="form-group">
            <label for="estilo">Seleccione su estilo de aprendizaje:</label>   
            <select name="estilo" id="estilo" class="form-control" style="max-width: 400px;">
                <option value="divergente">Divergente</option>
                <option value="convergente">Convergente</option>
                <option value="asimilador">Asimilador</option>
                <option value="acomodador">Acomodador</option>
            </select>
        </div>
        <div class="form-group">
            <label for="promedio">Ingrese su último promedio de matricula</label>
            <input type="number" step="0.01" id="promedio" class="form-control" style="max-width: 400px;" name="promedio">
        </div>
        <div class="form-group">
            <label for="recinto">Seleccione su recinto:</label>
            <select name="recinto" id="recinto" class="form-control" style="max-width: 400px;">
                <option value="Turrialba">Turrialba</option>
                <option value="Paraiso">Paraiso</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Adivinar</button>
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
<?php
    include_once 'public/footer.php';
?>