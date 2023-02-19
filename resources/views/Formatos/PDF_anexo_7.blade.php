<!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ANEXO VI</title>
    <link href="https://fonts.cdnfonts.com/css/soberana-sans" rel="stylesheet">
    <link rel="icon" type="image/jpg" href="{{url('favicon.ico')}}"/>
</head>
<style type="text/css">
    @import url('https://fonts.cdnfonts.com/css/letter-gothic-std-2?styles=29995');
    
    *{
        margin: 0;
        padding: 0;
            
        }

    body{   

        
        font-size: 15px;
        font-family: 'Soberana Sans', sans-serif;
        font-style: normal;
        padding-top: 30px;
        padding-bottom: 30px;
        padding-right: 40px;
        padding-left: 40px;
        margin: 0;
        background-color: rgb(255, 255, 255);
        /*background-image: url(./formatos/Formato externo.png);*/
        background-size: cover;
        background-repeat:no-repeat;
        background-position: center center; background-attachment: fixed; 
    }

    header{
        //background-color: darkblue;
        /*height: 1615px;*/
        
    }

    .linea {
        padding-top: 20px;
        padding-bottom: 20px;
        border-bottom: 2px solid #cccccc;
    }
</style>
<body>
<?php date_default_timezone_set('America/Mexico_City'); ?>
<header>
    
</header>
<p style=" width: 100%; text-align: center; font-size: 11px; font-weight: bold;">ANEXO VII. DICTAMEN TÉCNICO DE CONVALIDACIÓN DE ESTUDIOS</p>
    <p style=" margin-top: 15px;  width: 100%; text-align: center; font-size: 11px; font-weight: bold;">Tecnológico de Estudios Superiores del Oriente del Estado de México</p>
    <p style=" margin-top: 15px; width: 100%; text-align: center; font-size: 11px; font-weight: bold;">Análisis académico de convalidación de estudios</p>
    <p style=" margin-top: 30px; width: 85%; text-align: right; font-size: 12px; ">
        La paz Estado de México a <?php echo date("d"); ?> de <?php if(date("m")==1){echo "enero";}  if(date("m")==2){echo "febrero";} if(date("m")==3){echo "marzo";} if(date("m")==4){echo "abril";} if(date("m")==5){echo "mayo";} if(date("m")==6){echo "junio";} if(date("m")==7){echo "julio";} if(date("m")==8){echo "agosto";} if(date("m")==9){echo "septiembre";} if(date("m")==10){echo "octubre";} if(date("m")==11){echo "noviembre";} if(date("m")==12){echo "diciembre";}?> del <?php echo date("Y"); ?>
    </p>
    <p style=" margin-top: 15px;  width: 100%; text-align: left; font-size: 11px; padding-left: 25px;">Nombre del estudiante <u style="font-weight: bold;">{{$datos_alumno->name}}</u>,</p>
    <div style=" margin-top: 15px;  width: 100%; text-align: left; font-size: 10px;">
        <table style="padding-left: 25px; padding-right: 25px; border-collapse:collapse; width: 100%;">
            <thead>
                <tr>
                    <th style="width: 50%; border: black 1px solid; padding: 3px; font-size: 11px;">De:</th>
                    <th style="width: 50%; border: black 1px solid; padding: 3px; font-size: 11px;">A:</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="border: black 1px solid; padding: 3px;">Nombre del Plan de Estudios: {{$datos_carrera->nombre}}</td>
                    <td style="border: black 1px solid; padding: 3px;">Nombre del Plan de Estudios: {{$datos_carrera_new->nombre}}</td>
                </tr>
                <tr>
                    <td style="border: black 1px solid; padding: 3px;">Clave del Plan de Estudios: <label style="font-weight: bold; font-size: 11px;">{{$datos_carrera->clave}}</label></td>
                    <td style="border: black 1px solid; padding: 3px;">Clave del Plan de Estudios: <label style="font-weight: bold; font-size: 11px;">{{$datos_carrera_new->clave}}</label></td>
                </tr>
                <tr>
                    <td style="border: black 1px solid; padding: 3px;">Institución de procedencia: {{$datos_institucion->nombre}}</td>
                    <td style="border: black 1px solid; padding: 3px;">Institución de procedencia: {{$datos_institucion_new->nombre}}</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div style=" margin-top: 15px;  width: 100%; text-align: left; font-size: 10px;">
        <table style=" border-collapse:collapse; width: 100%;">
            <thead>
                <tr>
                    <th style="width: 3%; border: black 1px solid; padding: 3px;">No.</th>
                    <th style="width: 35%; border: black 1px solid; padding: 3px; ">Asignatura cursada</th>
                    <th style="width: 13.5%; border: black 1px solid; padding: 3px; ">Calificación</th>
                    <th style="width: 35%; border: black 1px solid; padding: 3px; ">Asignatura a covalidar</th>
                    <th style="width: 13.5%; border: black 1px solid; padding: 3px; ">Creditos</th>
                </tr>
            </thead>
            <tbody>
                <?php $contador=1; $encontro=false; $existe_semestre=false; $sumatoria=0;?>
                @if($proceso->tipo_proceso==1)

                @for($i=1; $i<=$numero_semestres; $i++)
                <?php $existe_semestre=false; ?>
                @foreach($materias as $materia)
                @if($materia->semestre==$i)
                <?php $existe_semestre=true; ?>
                @break
                @endif
                @endforeach
                @if($existe_semestre)
                <tr style="border: black 1px solid;">
                    <td style="border: black 1px solid; padding: 4px;"></td>
                    <td style="border: black 1px solid; padding: 4px;"></td>
                    <td style="border: black 1px solid;padding: 4px;"></td>
                    <td style="border: black 1px solid;padding: 4px; font-weight: bold;">@if($i==1)Primero @endif @if($i==2)Segundo @endif @if($i==3)Tercero @endif @if($i==4)Cuarto @endif @if($i==5)Quinto @endif @if($i==6)Sexto @endif @if($i==7)Séptimo @endif @if($i==8)Octavo @endif @if($i==9)Noveno @endif</td>
                    <td style="border: black 1px solid;padding: 4px;"></td>
                </tr>
                @endif
                @foreach($materias as $materia)
                @if($materia->semestre==$i)
                <tr style="border: black 1px solid;">
                    <?php $encontro=false; ?>
                    @foreach($materias_calificacion as $materia_calificacion)
                    @if($materia_calificacion->id_materia_convalida==$materia->id)
                    <td style="border: black 1px solid;padding: 4px; text-align: center;">{{$contador}}</td>
                    <td style="border: black 1px solid; padding: 4px;">{{$materia_calificacion->nombre}}</td>
                    <td style="border: black 1px solid;padding: 4px; text-align: center;">{{$materia_calificacion->calificacion}}</td>
                    <?php $encontro=true; ?>
                    @break
                    @endif
                    @endforeach
                    @if(!$encontro)
                    <td style="border: black 1px solid;padding: 4px;">{{$contador}}</td>
                    <td style="border: black 1px solid; padding: 4px;"></td>
                    <td style="border: black 1px solid; padding: 4px;"></td>
                    @endif
                    <td style="border: black 1px solid;padding: 4px;">{{$materia->nombre}}</td>
                    <td style="border: black 1px solid;padding: 4px; text-align: center;">{{$materia->creditos}}</td>
                    <?php $sumatoria+=$materia->creditos; ?>
                </tr>
                <?php $contador++; ?>
                @endif
                @endforeach
                @endfor

                @else

                @for($i=1; $i<=$numero_semestres; $i++)
                <?php $existe_semestre=false; ?>
                @foreach($materias as $materia)
                @if($materia->semestre==$i)
                <?php $existe_semestre=true; ?>
                @break
                @endif
                @endforeach
                @if($existe_semestre)
                <tr style="border: black 1px solid;">
                    <td style="border: black 1px solid; padding: 4px;"></td>
                    <td style="border: black 1px solid; padding: 4px;"></td>
                    <td style="border: black 1px solid;padding: 4px;"></td>
                    <td style="border: black 1px solid;padding: 4px; font-weight: bold;">@if($i==1)Primero @endif @if($i==2)Segundo @endif @if($i==3)Tercero @endif @if($i==4)Cuarto @endif @if($i==5)Quinto @endif @if($i==6)Sexto @endif @if($i==7)Séptimo @endif @if($i==8)Octavo @endif @if($i==9)Noveno @endif</td>
                    <td style="border: black 1px solid;padding: 4px;"></td>
                </tr>
                @endif
                @foreach($materias as $materia)
                @if($materia->semestre==$i)
                <tr style="border: black 1px solid;">
                    <?php $encontro=false; ?>
                    
                    <td style="border: black 1px solid;padding: 4px; text-align: center;">{{$contador}}</td>
                    <td style="border: black 1px solid; padding: 4px;">{{$materia->nombre}}</td>
                    <td style="border: black 1px solid;padding: 4px; text-align: center;">{{$materia->calificacion}}</td>
                    <?php $encontro=true; ?>
                    
                    <td style="border: black 1px solid;padding: 4px;">{{$materia->nombre}}</td>
                    <td style="border: black 1px solid;padding: 4px; text-align: center;">{{$materia->creditos}}</td>
                    <?php $sumatoria+=$materia->creditos; ?>
                </tr>
                <?php $contador++; ?>
                @endif
                @endforeach
                @endfor

                @endif
                <tr>
                    <td style="border: black 1px solid;padding: 4px;"></td>
                    <td style="border: black 1px solid; padding: 4px; text-align: right;" colspan="3">Total de créditos convalidados:</td>
                    <td style="border: black 1px solid; padding: 4px; text-align: center;">{{$sumatoria}}</td>
                </tr>
            </tbody>
        </table>
    </div>
    <p style=" margin-top: 20px; text-align: justify; font-size: 11px; padding-left: 50px; padding-right: 50px;">Nota: Este documento sólo contiene las asignaturas aceptadas en la convalidación. En el caso que, para convalidar una asignatura, se consideran dos o más asignaturas de procedencia, se asignará como calificación el promedio de las mismas.</p>
    <p style=" margin-top: 35px; width: 100%; text-align: center; font-size: 11px; font-weight: bold;">Documento autorizado por</p>
    <p style=" margin-top: 80px; width: 100%; text-align: center; font-size: 13px; font-weight: bold;"><u>Cirilo Martinez Liga</u></p>
    <p style=" margin-top: 20px; text-align: center; font-size: 13.5px; padding-left: 50px; padding-right: 50px; font-family: sans-serif;">Nombre y firma del (de la) Jefe(a) de la División de Estudios Profesionales o su equivalente en los Institutos Tecnológicos Descentralizados</p>
</body>

</html>



