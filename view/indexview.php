<?php
    include_once 'public/header.php';
?>
    <div class="table-responsive" style="padding: 80px;">
    <h2>
        Estilo de Aprendizaje
    </h2>
    <br>
    <p>Instrucciones: Para utilizar el instrumento usted debe conceder una calificación alta a aquellas palabras que mejor caracterizan la forma en que usted aprende, y una calificación baja a las palabras que menos caracterizan su estilo de aprendizaje.</p>
    <br>
    <form action="?controlador=Tarea&accion=obtenerDatosEstiloAprendizaje" method="post">
            <table class="table table-bordered">
            <tbody>
            <tr>
                <td>
                discerniendo
                <select name="c1" class="form-control" style="max-width: 72px;">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                </select>
                <br>
                </td>
                <td>
                ensayando
                    <select name="c2" class="form-control" style="width: 72px;" id="c2">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    </select>
                    <br>
                </td>
                <td>
                involucrándome
                <select name="c3" class="form-control" style="width: 72px;">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                </select>
                </td>
                <td>
                practicando
                <select name="c4" class="form-control" style="width: 72px;">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                </select>
                </td>
            </tr>
            <tr>
             
                <td>
                receptivamente
                <select name="c5" class="form-control" style="width: 72px;">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                </select>
            </td>
                <td>
                relacionando
                <select name="c6" class="form-control" style="width: 72px;">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                </select>
                </td>
                <td>
                analíticamente
                <select name="c7" class="form-control" style="width: 72px;">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                </select>
                </td>
                <td>
                imparcialmente
                <select name="c8" class="form-control" style="width: 72px;">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                </select>
                </td>
            </tr>
            <tr>
                <td>
                sintiendo
                <select name="c9" class="form-control" style="width: 72px;">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                </select>
                </td>
                <td>
                observando
                <select name="c10" class="form-control" style="width: 72px;">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                </select>
                </td>
                <td>
                pensando
                <select name="c11" class="form-control" style="width: 72px;">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                </select>
         </td>
                <td>
                    haciendo
                <select name="c12" class="form-control" style="width: 72px;">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                </select>
         </td>
            </tr>
            <tr>
                <td>
                    aceptando
                <select name="c13" class="form-control" style="width: 72px;">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                </select>
         </td>
                <td>
                arriesgando
                <select name="c14" class="form-control" style="width: 72px;">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                </select>
         </td>
                <td>
                evaluando
                <select name="c15" class="form-control" style="width: 72px;">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                </select>
         </td>
                <td>
                con cautela 
                <select name="c16" class="form-control" style="width: 72px;">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                </select>
        </td>
            </tr>
            <tr>
                <td>
                intuitivamente
                <select name="c17" class="form-control" style="width: 72px;">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                </select>
         </td>
                <td>
                productivamente
                <select name="c18" class="form-control" style="width: 72px;">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                </select>
         </td>
                <td>
                lógicamente
                <select name="c19" class="form-control" style="width: 72px;">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                </select>
         </td>
                <td>
                cuestionando
                <select name="c20" class="form-control" style="width: 72px;">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                </select>
         </td>
            </tr>
            <tr>
                <td>
                abstracto
                <select name="c21" class="form-control" style="width: 72px;">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                </select>
         </td>
                <td>
                observando
                <select name="c22" class="form-control" style="width: 72px;">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                </select>
         </td>
                <td>
                concreto
                <select name="c23" class="form-control" style="width: 72px;">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                </select>
         </td>
                <td>
                activo
                <select name="c24" class="form-control" style="width: 72px;">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                </select>
         </td>
            </tr>
            <tr>
                <td>
                orientado al presente
                <select name="c25" class="form-control" style="width: 72px;">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                </select>
         </td>
                <td>
                reflexivamente
                <select name="c26" class="form-control" style="width: 72px;">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                </select>
         </td>
                <td>
                orientado hacia el futuro
                <select name="c27" class="form-control" style="width: 72px;">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                </select>
         </td>
                <td>
                pragmático
                <select name="c28" class="form-control" style="width: 72px;">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                </select>
         </td>
            </tr>
            <tr>
                <td>
                aprendo más de la experiencia
                <select name="c29" class="form-control" style="width: 72px;">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                </select>
         </td>
                <td>
                aprendo más de la observación
                <select name="c30" class="form-control" style="width: 72px;">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                </select>
         </td>
                <td>
                aprendo más de la conceptualización
                <select name="c31" class="form-control" style="width: 72px;">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                </select>
         </td>
                <td>
                aprendo más de la experimentación
                <select name="c32" class="form-control" style="width: 72px;">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                </select>
         </td>
            </tr>
            <tr>
                <td>
                emotivo
                <select name="c33" class="form-control" style="width: 72px;">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                </select>
         </td>
                <td>
                reservado
                <select name="c34" class="form-control" style="width: 72px;">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                </select>
         </td>
                <td>
                racional
                <select name="c35" class="form-control" style="width: 72px;">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                </select>
         </td>
                <td>
                abierto
                <select name="c36" class="form-control" style="width: 72px;">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                </select>
         </td>
            </tr>

            </tbody>
    </table>
    <button class="btn btn-success" style="font-size: 20px;" type="submit">Calcular</button>
    </form>
     <br>

     <h3>Resultado: <?php
       if($vars != NULL){
              echo $vars;
       }?>
     </h3>
  </div>

  <?php
    include_once 'public/footer.php';
?>