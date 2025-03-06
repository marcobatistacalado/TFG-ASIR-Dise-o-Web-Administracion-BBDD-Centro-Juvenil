<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Noticia - Parzán</title>
    <link rel="stylesheet" type="text/css" href="../p_style.css">
    <link rel="icon" type="image/jpg" href="../img/logolabalsa.png" />
</head>

<body>
    <nav>
        <input type="checkbox" id="active">
        <label for="active" class="menu-btn"><i class="fas fa-bars"></i></label>
        <div class="wrapper">
            <ul class="c_menu-horizontal">
                <img id="logosls" class="c_img" src="../img/logosls.png"></img>
                <li><a href="../../index.php">Sobre nosotros</a></li>
                <li>
                    <a href="#" id="secciones">Secciones</a>
                    <a href="../secciones/chiqui.php" class="niveles" hidden>Chiquicentro</a>
                    <a href="../secciones/preas.php" class="niveles" hidden>Preas</a>
                    <a href="../secciones/a2_jov.php" class="niveles" hidden>Adolecentes & Jovenes</a>
                    <a href="../secciones/catecumenado.php" class="niveles" hidden>Catecumenado</a>

                    <ul class="c_menu-vertical">
                        <li><a href="../secciones/chiqui.php">Chiquicentro</a></li>
                        <li><a href="../secciones/preas.php">Preas</a></li>
                        <li><a href="../secciones/a2_jov.php">Adolescentes & Jovenes</a></li>
                        <li><a href="../secciones/catecumenado.php">Catecumenado</a></li>
                    </ul>
                </li>
                <li>
                    <a href="../videos/videos.php">Vídeos</a>   
                </li>
                <?php
                session_start();


                // Requerir las funciones del fichero funciones.php para utilizarlas.
                require '../../funciones.php';
                if (!isset($_SESSION['usuario'])) {
                        echo "<li><a href='../.././login.php'>"; //PAGINA CON DOS BOTONES: INICIAR SESION Y REGISTRO
                        echo "Usuario";
                        echo "</a></li>";
                }else {
                        $user=$_SESSION['usuario'];
                        echo "<li><a href='../.././usuario.php'>"; //PÁGINA CON TODAS LAS OPCIONES DE ADMINISTRACION, BOTONES
                        echo $user;
                        echo "</a></li>";
                }
                ?>
                <img class="c_img" src="../img/logolabalsa.png"></img>
            </ul>
        </div>
    </nav>
    <main>
        <div class="c_cont-portada" id="a_parzan">
            <h1>Campamento Parzán 2023</h1>
        </div>
        <article>
            <h2 id="colora2_jov"> Información</h2>
            <div class="c_informacion">
                <div class="c_texto c_texto_secciones">
                    <p>
                    <strong>¿Qué?</strong>
                    <br>PARZÁN 2023 es un campamento de verano realizado por centros juveniles salesianos, que tiene como objetivos la integración, la educación para la salud, la participación y la superación. Damos continuidad a los procesos de pastoral realizados durante el año en el Centro Juvenil y en el colegio.
                    <br><br><strong>¿Para quién?</strong>
                    <br>Socios de los centros juveniles organizadores. Si no eres socio del Centro Juvenil, habla con el coordinador de Pastoral o con los animadores del Centro.
                    <br><br><strong>¿Cuándo?</strong>
                    <br>PARZÁN 2023 se celebra entre los días 15 de julio y 30 de julio. Salimos el 15 por la mañana y volvemos el 30 por la noche.
                    <br><br><strong>¿Dónde?</strong>
                    <br>El lugar es el pueblo de PARZÁN, en el valle de Pineta, en el Pirineo aragonés. Llevamos yendo a este campamento los últimos diez años y los otros centros Juveniles desde hace 30.
                    <br/> <br/>
                    </p>
                </div>
    
            </div>
        </article>
        
        <div class="c_cont-portada">
			<input type="radio" name="slider" id="item-1" checked>
			<input type="radio" name="slider" id="item-2">
			<input type="radio" name="slider" id="item-3">
            <div class="cards">
				<label class="card" for="item-1" id="song-1">
					<img src="../img/parzan.png" alt="song">
				</label>
				<label class="card" for="item-2" id="song-2">
					<img src="../img/parzan4.JPG" alt="song">
				</label>
				<label class="card" for="item-3" id="song-3">
					<img src="../img/parzan5.jpg" alt="song">
				</label>
			</div>
            <h1 style="font-size: 2em; font-weight: bold;"></h1>
        </div>
        <article>
            <h2>Próximas actividades</h2>
            <div class="c_tarjetas">
                <a href="../../formularios/parzan.php">
                <div class="actividad">
                    <div class="c_imagen" id="actividad1"></div>
                    <div class="c_espacio"></div>
                    <div class="c_info">
                        <h3><a href="../../formularios/parzan.php">Campamento Parzán 2023</a></h3>
                        <p>¡Apúntate! y disfruta.</p>
                    </div>
                </div>
                </a>
                <a href="../../formularios/cenaconfirmaciones.php">
                <div class="actividad">
                    <div class="c_imagen" id="actividad2"></div>
                    <div class="c_espacio"></div>
                    <div class="c_info">
                        <h3><a href="../../formularios/cenaconfirmaciones.php">Cena de Confirmaciones</a></h3>
                        <p>¡Apúntate! y disfruta.</p>
                    </div>
                </div>
                </a>
                <a href="../../formularios/musical.php">
                <div class="actividad">
                    <div class="c_imagen" id="actividad3"></div>
                    <div class="c_espacio"></div>
                    <div class="c_info">
                        <h3><a href="../../formularios/musical.php">Musical: Shrek</a></h3>
                        <p>¡Apúntate! y disfruta.</p>
                    </div>
                </div>
                </a>
        </article>

        <div class="pie">
            <p>Colegio Salesiano San Juan Bautista | Salesianos Estrecho </p>
            <img src="../img/maux.png" alt="20px">
            <img src="../img/dbosco.png" alt="20px">
        </div>
    </main>
    <div class="RRSS">
        <a href="../info.html" class="enlaces">
            <img class="imgrrss" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAAAXNSR0IArs4c6QAAA+xJREFUaEPtWe1R20AQfTuYf5bAFcRUEOjAVABUEKgAU0GggpgKYiqIqSCkgkAFQAW2Jf/jPJtZ6yz0cZJOJzkZZ7g/DLZ0d2/37dczYcsXbfn98QHgX3uwNQ/wYnEI5hMAhwD6+m8S3yOAFxA9APhF3a7833g1AsDTaR+dziWYT0Ekl7ZfzAJmAqVuqdd7sX8x/aQTAJ5O99HpfAUwdD04894ISt1Qrzeru19tABwEYu3vAPbrHlbx/AzMF+T7kzr71gLAYfitwur3YJ6ASOgxW/Ncx8c+mPsgOgUgsVK0RuR5V7YgrABoyojV5fDsmoN5iOVyYkuB1X47O+LJEYC93I7MYyyXVzb72QEIwx8Fl7+BUiObg0wW1YaROJJ4Si/mMfn+RZUnKgFwGIqVLjMbzUE0aCsVaopJes1645Y8rzRRlALQASvWT64nKDVwtXqRRXVKlgD+nHqG+awssAsBaPc+Z7LNHEr12778+sIahBS4pCdmUOqg6MxiAEEwBtGXlDWIjmxpw2HIyXfJ8yrpKs9rOv3OeKqQSsZNtSXE+sl1Q553XRVUsTUdAaxAhKGckw7syAu5im0GkA/c2tRx9cAKQFTp5bJJKhkNaAYQBM+p3iaqkGNb62srOlEo9mAQnOuKH33E/EK+f5C9Qw6AkYNK9TYVuCVZSbwwrYrBPIA8/+7J80wVuI5DnJ7lMJS0+t52EF1Rtyt1KV4mAOmXHOjjdFvDS7xYDMEs/dd65YxpAiApTIaS9Tomz5Mq+dcXh+EAwM/EwY/keUdVHkgFH2rk/uTGTbJQHMjRlJeqCdl6YvJAo+wRH96gDtQxxP8PYBspJM1UsiN0CuJWYiAfxE/keckEkxe2crnXMY22AsAxjWYbKadC1goAp0JmSF1waCWaAtANXf1WYtU3BYGoCp/idOZAo8YA8s3cK/l+TjyzbadLpyJTiW4CoGAarNFOR5Lh9g40mkbbO1KuAJinotpUqtMB6lFWep+kbFk6DbrIKo9Q6qyJomyMmYi2IuGkChVcZZVEU2YStmYgOrZVKKq8oKdAaZuzgnEzYSsGYZJYoi+vtb5fWxZP0FRUv7zawXxHvn9eBd5Oq4nE2FFOJ4p2F28M8fZ2bzs3r+Jrd/cEzOLdvEzPfIflcmiznxWACjoljSTS+kQUBBDNM/L6HohkQJEpq2zGrqRN6URW5TKtl4rEkpfFq14u/15k+vON/sAReyJKscLbrGrtCuEWSl3bUCZ7QC0KZV/WeVuUA/mx4r13soHB/AqiMZQaN0nJjQCkZlfpYoGB5rg0XWmZHHhK/Mz60FYKbg2AjdE38cwHgE1Ytc6eW++BP7zIQE/bqdiHAAAAAElFTkSuQmCC"></img>
        </a>
        <a href="https://www.youtube.com/user/CJLabalsa" class="enlaces" target="_blank">
            <img class="imgrrss" src="../img/youtube.png"></img>
        </a>
        <a href="https://www.instagram.com/cjlabalsa/?hl=es" class="enlaces" target="_blank" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAAAXNSR0IArs4c6QAAAzRJREFUaEPtWNFx2zAMBSQqv3UniDtBnQnqTlBnAtcTNJ2gzgSNJ2gyQZMJak/QZILaEyT5jSihB1G+OjYpgpKqXO7EHycnEMTDAx9BIrzyga88fugBvDSDPQM9Aw0z0JdQSAKJaABafwHEIRCNAHEEAEsAWAPRFSYJ/30weB4iPti+ORkgoiEirkMCrLKlNB0D4g8AGFbYLSGOT7fBcgyg9RQQT1CpSRgAra8B4B6VmjUFQWk6B8RvIj9EtyUrDJgZAiD66GLHykBBdZbdlwteNgFRZv6XKHh7/Zxjksxd8+0ADN27i9YCUSbit6ds3NgQv0Ke8/wJIL5FpT7vG0sBMI23QDTDoyOmWDRIa16Q677ZILoDpca2jSwHsA2BaI5Jci6JKKj2XQ5N8BOXoNgBPD2NIIqYOvtgNhDnqNRNpfJozbL4QQLWalOR+a29W0bTlIN871mc9fsalFrYMkTNATjVxw9Aa9bdn+LsGVZ4n6zL3wdA5FJrwkB9AIX8mrPgkxhE24YV+l/JQKndxxDHN5BlFwAwbTs2kb84fufrBvwqZErDnIgdD1TK22y6N7HW1HG8z5cjusMk8SauCkAzCWyKnmiBSXLmc1PZjUKW/fE5+I/fT1EpFpHKUVljrZykvgjs3x9RqYFkqneTtNbPSKL5Z3Nla9xsLrwAivPAdKfcmHUjp3l+Im0avQCI+yJEc5gZObXejMISXGm9QqXGUn9+AHyt63IzB2S/yKkEKWl92Un5CKVzN2YZAPOasBR0p5J8uGw2EMcj1+uDa5IIQLGRzT2Zdbl+d+mG9wh5PpZu3GAGdifsKBI/j7QFZoZKcZkGDzED+56LN5ss+96CKtUOXryJnzHApZTnUyDipw7RaVmR1kbBBwGgNOVy4ecNPtCaBr6BPJ/Uqfn9ZByUUFHjprYHO/cA8cHiLWKiBSg1D1WbIBUq65s3VVublNdfQZ6ftZF1sQqVj6tngMjtw7E3u4cGm/LV4sJ3Nazh23Q30olFTxRF3AtxOW1fmPn/N6WPVfHLV9AoWkOWLdvOti1WMQAp0K7tegBdZ9wroy8dUOj6fQmFZqxt+56BtjMa6u8vUkZKQFcjLtEAAAAASUVORK5CYII=">
            <img class="imgrrss" src="../img/instagram.png"></img>
        </a>
        <a href="https://www.tiktok.com/@cjlabalsa" class="enlaces" target="_blank">
            <img class="imgrrss" src="../img/tiktok.png"></img>
        </a>
    </div>
</body>

</html>