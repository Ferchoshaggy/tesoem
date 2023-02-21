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
        padding-top: 130px;
        padding-bottom: 160px;
        padding-right: 50px;
        padding-left: 50px;
        margin: 0;
        background-color: rgb(255, 255, 255);
        background-image: url(./plantillas/p_con.png);
        background-size: cover;
        background-repeat:no-repeat;
        background-position: center center; background-attachment: fixed; 
    }

    header{
        position: fixed;
        top: 100px;
        left: 0cm;
        right: 0cm;
        height: 2cm;
    }
    @page {
        margin: 0cm 0cm;
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
    <p style=" width: 100%; text-align: center; font-size: 14px; font-weight: bold; color: #9B9B9B;">"{{$datos_pdf->texto_superior}}"</p>
</header>

    <p style=" margin-top: -10px; text-align: right; font-size: 12px;">
        La paz Estado de México a <?php echo date("d"); ?> de <?php if(date("m")==1){echo "enero";}  if(date("m")==2){echo "febrero";} if(date("m")==3){echo "marzo";} if(date("m")==4){echo "abril";} if(date("m")==5){echo "mayo";} if(date("m")==6){echo "junio";} if(date("m")==7){echo "julio";} if(date("m")==8){echo "agosto";} if(date("m")==9){echo "septiembre";} if(date("m")==10){echo "octubre";} if(date("m")==11){echo "noviembre";} if(date("m")==12){echo "diciembre";}?> del <?php echo date("Y"); ?>
    </p>
    <p style=" margin-top: 20px;  width: 100%; text-align: left; font-size: 12px; padding-left: 25px;">{{$datos_pdf->j_division}}</p>
    <p style=" margin-top: 5px;  width: 100%; text-align: left; font-size: 12px; padding-left: 25px; font-weight: bold;">@if($datos_pdf->sexo_j_division==1) Jefa @else Jefe @endif de División de ISC.</p>
    <p style=" margin-top: 5px;  width: 100%; text-align: left; font-size: 12px; padding-left: 25px; font-weight: bold;">P r e s e n t e.</p>
    <p style=" margin-top: 15px;   text-align: justify; font-size: 12px; padding-left: 25px; ">En conformidad a lo previamente descrito del C. <label style="font-weight: bold;">{{$datos_alumno->name}}</label>, se dictamina lo siguiente: </p>
    <p style=" margin-top: 15px;   text-align: justify; font-size: 12px; padding-left: 25px; ">Se hace el listado de las asignaturas a cursar conforme a la retícula <label style="font-weight: bold;">{{$datos_carrera_new->clave}}</label> de {{$datos_carrera_new->nombre}}.</p>
    <div style=" margin-top: 15px;  width: 100%; text-align: left; font-size: 10px;">
        <table style="padding-left: 50px; padding-right: 50px; border-collapse:collapse; width: 100%;">
            <thead>
                <tr>
                    <th style="width: 10%; border: black 1px solid; padding: 5px; font-size: 10px; font-weight: bold; background-color: #CECECE;">SEMESTRE</th>
                    <th style="width: 50%; border: black 1px solid; padding: 5px; font-size: 10px; font-weight: bold; background-color: #CECECE;">NOMBRE DE LA ASIGNATURA</th>
                    <th style=" border: black 1px solid; padding: 5px; font-size: 10px; font-weight: bold; background-color: #CECECE;">CLAVE</th>
                    <th style=" border: black 1px solid; padding: 5px; font-size: 10px; font-weight: bold; background-color: #CECECE;">MATERIAS CONVALIDADAS</th>
                </tr>
            </thead>
            <tbody>
                @for($i=1;$i<=$numero_semestres;$i++)
                @if($i>1)
                <tr>
                    <td style="border: black 1px solid; padding: 3px; text-align: center; height: 10px;"></td>
                    <td style="border: black 1px solid; padding: 3px; text-align: center;"></td>
                    <td style="border: black 1px solid; padding: 3px; text-align: center;"></td>
                    <td style="border: black 1px solid; padding: 3px; text-align: center;"></td>
                </tr>
                @endif
                <?php $primero=1; ?>
                @foreach($materias as $materia)
                @if($materia->semestre==$i)
                <tr>
                    <td style="border: black 1px solid; padding: 3px; text-align: center;">
                    @if($primero==1)

                    @if($i==1)Primero @endif @if($i==2)Segundo @endif @if($i==3)Tercero @endif @if($i==4)Cuarto @endif @if($i==5)Quinto @endif @if($i==6)Sexto @endif @if($i==7)Séptimo @endif @if($i==8)Octavo @endif @if($i==9)Noveno @endif

                    @endif
                    </td>
                    <td style="border: black 1px solid; padding: 3px; ">{{$materia->nombre}}</td>
                    <td style="border: black 1px solid; padding: 3px; text-align: center;">{{$materia->matricula}}</td>
                    <td style="border: black 1px solid; padding: 3px; text-align: center;">
                        @if($materia->validacion=="si" && $materia->calificacion>=70)
                        CONVALIDADA
                        @else
                        NO CONVALIDADA
                        @endif
                    </td>
                </tr>
                <?php $primero++; ?>
                @endif
                @endforeach
                @endfor
                
            </tbody>
        </table>
    </div>
    <div style=" margin-top: 15px;  width: 100%; text-align: left; font-size: 10px;">
        <table style=" border-collapse:collapse; width: 100%;">
            <thead>
                <tr>
                    <th style="width: 25%; border: black 1px solid; padding: 20px; font-size: 10px; font-weight: bold; text-align: center; padding-top: 70px;">
                    ___________________________________
                    {{$datos_pdf->p_academia}}
                    @if($datos_pdf->sexo_p_academia==1) Presidenta @else Presidente @endif de Academia de ISC.

                    </th>
                    <th style="border: black 1px solid; padding: 5px; font-size: 10px; text-align: center;"></th>
                    <th style="width: 25%; border: black 1px solid; padding: 20px; font-size: 10px; font-weight: bold; text-align: center; padding-top: 70px;">
                    ___________________________________
                    {{$datos_pdf->s_academia}}
                    @if($datos_pdf->sexo_s_academia==1) Secretaria @else Secretario @endif de Academia de ISC.

                    </th>
                </tr>
            </thead>
        </table>
    </div>
</body>

</html>



