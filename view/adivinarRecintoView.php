<?php
    include_once 'public/header.php';
?>
    <div class="container-fluid">
        <br><br><br>
    <div class="row justify-content-center align-items-center">
        <form action="?controlador=BayesRecinto&accion=adivinarRecinto" method="post">
        <h2>Adivinar recinto de origen</h2>
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
            <input type="number" step="1" min="6" max="9" id="promedio" class="form-control" style="max-width: 400px;" name="promedio">
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