<?php
    include_once 'public/header.php';
?>
    <div class="container-fluid" style="padding: 80px;">
        <div class="row justify-content-center align-items-center">
            <form action="?controlador=Bayes&accion=adivinarTipoProfesor" method="post">
                <div class="form-group" id="">
                  
                <h2>Determinar tipo de profesor</h2>
                <br> 
                
                    <div class="form-group">
                        <label for="A">Edad:</label>
                        <select name="A" id="A" class="form-control">
                            <option value="1">Menor o igual a 30</option>
                            <option value="2">+30 y menor o igual a 55</option>
                            <option value="3">+55</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="B">Género:</label>
                        <select name="B" id="B" class="form-control">
                            <option value="M">Masculino</option>
                            <option value="F">Femenino</option>
                            <option value="NA">Otro</option>
                        </select>
                    </div>   
                        <div class="form-group">
                            <label for="C">Evaluación propia de sus habilidades</label>
                            <select name="C" id="C" class="form-control">
                                <option value="B">Principiante</option>
                                <option value="I">Intermedio</option>
                                <option value="A">Avanzado</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="D">Número de veces que ha impartido este tipo de curso</label>
                            <select name="D" id="D" class="form-control">
                                <option value="1">Nunca</option>
                                <option value="2">De 1 a 5 veces</option>
                                <option value="3">Más de 5 veces</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="E">Disciplina o área de especialización</label>
                            <select name="E" id="E" class="form-control">
                                <option value="DM">Toma de decisiones</option>
                                <option value="ND">Diseño de redes</option>
                                <option value="O">Otra</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="F">Habilidad usando computadoras</label>
                            <select name="F" id="F" class="form-control">
                                <option value="L">Baja</option>
                                <option value="A">Promedio</option>
                                <option value="H">Alta</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="G">Experiencia usando tecnología web para enseñar</label>
                            <select name="G" id="G" class="form-control">
                                <option value="N">Nunca</option>
                                <option value="S">Algunas veces</option>
                                <option value="O">A menudo</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="H">Experiencia usando un sitio web</label>
                            <select name="H" id="H" class="form-control">
                            <option value="N">Nunca</option>
                                <option value="S">Algunas veces</option>
                                <option value="O">A menudo</option>
                            </select>
                        </div>
                
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