<!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>EQV</title>
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
        padding-top: 120px;
        padding-bottom: 160px;
        padding-right: 60px;
        padding-left: 60px;
        margin: 0;
        background-color: rgb(255, 255, 255);
        background-image: url(./plantillas/p_eq.png);
        background-size: cover;
        background-repeat:no-repeat;
        background-position: center center; background-attachment: fixed; 
    }

    header{
        position: fixed;
        top: 70px;
        left: 0cm;
        right: 0cm;
        height: 2cm;
    }

    footer{
        position: fixed;
        bottom: 62px;
        left: 0cm;
        right: 60px;
        height: 2cm;
        color: #BCBCBC;
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
    <p style=" width: 100%; text-align: center; font-size: 10px; font-weight: bold; color: #9B9B9B;">"2022. Año del Qincentenario de la Fundación de Toluca de Lerdo, Capital del Estado de México."</p>
    </header>

    <p style=" margin-top: -20px; text-align: right; font-size: 11px;">
        La paz Estado de México a <?php echo date("d"); ?> de <?php if(date("m")==1){echo "enero";}  if(date("m")==2){echo "febrero";} if(date("m")==3){echo "marzo";} if(date("m")==4){echo "abril";} if(date("m")==5){echo "mayo";} if(date("m")==6){echo "junio";} if(date("m")==7){echo "julio";} if(date("m")==8){echo "agosto";} if(date("m")==9){echo "septiembre";} if(date("m")==10){echo "octubre";} if(date("m")==11){echo "noviembre";} if(date("m")==12){echo "diciembre";}?> del <?php echo date("Y"); ?>
    </p>
    <p style=" margin-top: 5px; text-align: right; font-size: 11px;">
        Oficio No. __________________________________________
    </p>
    <p style=" margin-top: 8px; text-align: right; font-size: 11px;">
        Asunto: Asignaturas a cursar en el semestre _______________
    </p>

    <p style=" margin-top: 25px; text-align: left; font-size: 14px; font-weight: bold;">
        LIC. IVONNE ADRIANA CARLILLO FLORES
    </p>
    <p style=" margin-top: 3px; text-align: left; font-size: 14px; font-weight: bold;">
        JEFA DEL DEPARTAMENTO DE CONTROL ESCOLAR
    </p>
    <p style=" margin-top: 3px; text-align: left; font-size: 14px; font-weight: bold;">
        P R E S E N T E
    </p>

    <p style=" margin-top: 25px; text-align: justify; font-size: 12px; ">
        En seguimiento al proceso de <label style="color: red;">CONVALIDACIÓN</label> del solicitante <u style="font-weight: bold;">{{$datos_alumno->name}}</u> con matrícula {{$datos_alumno->matricula}} de la carrera <label style="color: red;">{{$datos_carrera_new->nombre}}</label> solicito a usted, si el estudiante cumple con los requisitos previos de los documentos originales de la convalidación, sugerimos se le permita la inscripción a las siguientes asignaturas:
    </p>

    <table style=" border-collapse:collapse; width: 100%; margin-top: 20px; ">
        <thead>
            <tr>
                <th style="width: 5%; border: 1px solid #BBCC90; padding: 5px; font-size: 10px; font-weight: bold; background-color: #fdeada;">ID</th>
                <th style=" border: 1px solid #BBCC90; padding: 5px; font-size: 10px; font-weight: bold; background-color: #fdeada;">CLAVE</th>
                <th style="width: 45%; border: 1px solid #BBCC90; padding: 5px; font-size: 10px; font-weight: bold; background-color: #fdeada;">MATERIA</th>
                <th style=" border: 1px solid #BBCC90; padding: 5px; font-size: 10px; font-weight: bold; background-color: #fdeada;">SEMESTRE</th>
                <th style=" border: 1px solid #BBCC90; padding: 5px; font-size: 10px; font-weight: bold; background-color: #fdeada;">CRÉDITOS</th>
            </tr>
        </thead>
        <tbody>
            <?php $contador=1; $sumatoria=0; $numero_registros=0;?>
            @foreach($materias as $materia)
            <tr>
                <td style=" border: 1px solid #BBCC90; padding: 1px; font-size: 12px; font-weight: bold; background-color: #fdeada; text-align: center;">{{$contador}}</td> 
                <td style=" border: 1px solid #BBCC90; padding: 1px; font-size: 12px; font-weight: bold; background-color: #fdeada; text-align: center; color: red;">{{$materia->matricula}}</td> 
                <td style=" border: 1px solid #BBCC90; padding: 2px; font-size: 11px; font-weight: bold; background-color: #fdeada;">
                    &nbsp;{{$materia->nombre}}
                </td> 
                <td style=" border: 1px solid #BBCC90; padding: 1px; font-size: 12px; font-weight: bold; background-color: #fdeada; text-align: center;">{{$materia->grupo}}</td> 
                <td style=" border: 1px solid #BBCC90; padding: 1px; font-size: 12px; font-weight: bold; background-color: #fdeada; text-align: center;">{{$materia->creditos}}</td> 
            </tr>
            <?php $contador++; $sumatoria+=$materia->creditos; $numero_registros++;?>
            @endforeach
            <tr>
               <td style=" border: 1px solid #BBCC90; padding: 1px; font-size: 12px; font-weight: bold; background-color: #fdeada; text-align: center;"></td> 
               <td style=" border: 1px solid #BBCC90; padding: 1px; font-size: 11px; font-weight: bold; background-color: #fdeada; text-align: center;"></td> 
               <td style=" border: 1px solid #BBCC90; padding: 1px; font-size: 10px; font-weight: bold; background-color: #fdeada;"></td> 
               <td style=" border: 1px solid #BBCC90; padding: 1px; font-size: 12px; font-weight: bold; background-color: #fdeada; text-align: center;">TOTAL</td> 
               <td style=" border: 1px solid #BBCC90; padding: 1px; font-size: 12px; font-weight: bold; background-color: #fdeada; text-align: center; color: red;">{{$sumatoria}} Créd.</td> 
            </tr>
        </tbody>
    </table>

    <div style="background-color: #fdeada;  border: 1px solid #BBCC90; padding: 5px; margin-top: 15px; font-size: 8px; text-align: justify; padding-right: 10px;">
        Notas: <br><br>
        <ul style="padding-left: 20px;">
            <li >La presentación por si misma del presente no constituye la ACEPTACIÓN por el Departamento de Control Escolar.</li><br>
            <li style="margin-top: -8px;">El presente formato deberá acompañarse de un formato único de pago debidamente pagado con los conceptos Inscripción + número de créditos que acumulen las asignaturas que solicita.</li><br>
            <li style="margin-top: -8px;">El estudiante de CONVALIDACIÓN, TRASLADO, EQUIVALENCIA deberá presentar este formato de manera semestral con las asignaturas que su Jefe de División le autoriza cursar, hasta que las asignaturas a cursar sean las mismas que las ofrecidas en un semestre ordinario.</li><br>
            <li style="margin-top: -8px;">Cuando un estudiante solicite adelantar asignaturas de noveno semestre a excepción de la residencia, este solo debe pagar los conceptos de Inscripción + créditos de las asignaturas a cursar.</li><br>
            <li style="margin-top: -8px;">Cuando el estudiante que solicitó previamente adelantar las asignaturas de noveno, pero ahora solicita cursar la residencia el mismo debe pagar los conceptos de Inscripción + Colegiatura con 0% de descuento.</li><br>
            <li style="margin-top: -8px;">El contenido de este formato, así como la correspondencia del pago según los créditos aquí descritos es responsabilidad de quien solicita y quien autoriza; por lo que en caso de encontrar diferencias en los importes, los mismos deberán ser subsanados por el solicitante en el momento en que se detecte.</li><br>
            <li style="margin-top: -8px;">El presente NO PROCEDE si el estudiante solicita adelantar asignaturas pero tiene de cuatro a más asignaturas reprobadas previamente.</li><br>
            <li style="margin-top: -8px;">El presente NO PROCEDE si en apariencia fue alterado en su contenido.</li><br>
            <li style="margin-top: -8px;">El presente NO PROCEDE si el estudiante no presenta evidencia de pago con los importes debidos para llevar a efecto su solicitud.</li><br>
            <li style="margin-top: -8px;">El presente NO PROCEDE si el estudiante solicita inscribirse a una materia correspondiente a un plan de estudios y/o división diferente a la suya.</li>
        </ul>

    </div>
    @if($numero_registros>9)
    <table style=" border-collapse:collapse; width: 100%; margin-top: 20px; page-break-before: always;">
    @else
    <table style=" border-collapse:collapse; width: 100%; margin-top: 20px;">
    @endif
        <thead>
            <tr>
                <th style="width: 50%; border-left: 1px solid #BBCC90; border-top: 1px solid #BBCC90; padding: 5px; font-size: 10px; background-color: #fdeada; font-weight: 0;">SOLICITANTE</th>
                <th style="width: 50%; border-right: 1px solid #BBCC90; border-top: 1px solid #BBCC90; padding: 5px; font-size: 10px; background-color: #fdeada; font-weight: 0;">AUTORIZA LA SOLICITUD</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="width: 50%; border-left: 1px solid #BBCC90; border-bottom: 1px solid #BBCC90; padding: 5px; font-size: 12px; font-weight: bold; background-color: #fdeada; text-align: center;"><br><br>
                    <u>{{$datos_alumno->name}}</u><br>
                    <label style="color: red; font-size: 9px;">NOMBRE COMPLETO Y FIRMA DEL ESTUDIANTE QUE SOLICITA</label>
                </td>
                <td style="width: 50%; border-right: 1px solid #BBCC90; border-bottom: 1px solid #BBCC90; padding: 5px; font-size: 12px; font-weight: bold; background-color: #fdeada; text-align: center;"><br><br><br>
                    <u>Cirilo Martinez Liga</u><br>
                    <label style="color: red; font-size: 9px;">NOMBRE COMPLETO Y FIRMA DEL JEFE DE DIVISIÓN QUE AUTORIZA LA SOLICITUD</label>
                </td>
            </tr>
        </tbody>
        
    </table>


    <footer style="text-align: right; font-size: 10px;">
        <label style="font-weight: bold;">SECRETARIA DE EDUCACIÓN</label><br>
        <label style="font-weight: bold;">SUBSECRETARIA GENERAL DE EDUCACIÓN</label><br>
        <label style="font-weight: bold;">SUBSECRETARIA DE EDUCACIÓN SUPERIOR Y NORMAL</label><br>
        DIRECCIÓN GENERAL DE EDUCACIÓN SUPERIOR<br>
        TECNOLÓGICO DE ESTUDIOS SUPERIORES DEL ORIENTE DEL ESTADO DE MÉXICO
    </footer>
</body>

</html>



