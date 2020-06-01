<?php
    include_once 'public/header.php';
?>
<div class="container-fluid">
        <br><br><br>
    <div class="row justify-content-center align-items-center">
        <form action="?controlador=Tarea&accion=obtenerDatosAprendizajeEstudiante" method="post">
        <h2>Calcular estilo de aprendizaje de un estudiante</h2>
        <div class="form-group">
            <label for="recinto">Seleccione su recinto</label>   
            <select name="recinto" id="recinto" class="form-control" style="max-width: 400px;">
                <option value="Turrialba">Turrialba</option>
                <option value="Paraiso">Paraiso</option>
            </select>
        </div>
        <div class="form-group">
            <label for="promedio">Ingrese su último promedio de matricula</label>
            <input type="number" step="0.01" id="promedio" name="promedio" class="form-control" style="max-width: 400px;" required>
        </div>
        <div class="form-group">
            <label for="sexo">Seleccione su sexo:</label>
            <select name="sexo" id="sexo" class="form-control" style="max-width: 400px;">
                <option value="M">M</option>
                <option value="F">F</option>
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
<?php
    include_once 'public/footer.php';
?>