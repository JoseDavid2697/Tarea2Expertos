<?php
    include_once 'public/header.php';
?>
<div class="container-fluid">
        <br><br><br>
    <div class="row justify-content-center align-items-center">
        <form action="?controlador=BayesSexo&accion=adivinarSexo" method="post">
        <h2>Adivinar sexo</h2>
        <div class="form-group">
            <label for="estilo">Seleccione su estilo de aprendizaje:</label>   
            <select name="estilo" id="estilo" class="form-control" style="max-width: 400px;">
                <option value="Divergente">Divergente</option>
                <option value="Convergente">Convergente</option>
                <option value="Asimilador">Asimilador</option>
                <option value="Acomodador">Acomodador</option>
            </select>
        </div>
        <div class="form-group">
            <label for="promedio">Ingrese su último promedio de matricula</label>
            <input type="number" min="6" max="9" step="1" id="promedio" class="form-control" style="max-width: 400px;" name="promedio">
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