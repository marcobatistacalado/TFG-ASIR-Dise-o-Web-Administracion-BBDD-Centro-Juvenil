<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>A2_jov</title>
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
                    <a href="chiqui.php" class="niveles" hidden>Chiquicentro</a>
                    <a href="preas.php" class="niveles" hidden>Preas</a>
                    <a href="a2_jov.php" class="niveles" hidden>Adolecentes & Jovenes</a>
                    <a href="catecumenado.php" class="niveles" hidden>Catecumenado</a>

                    <ul class="c_menu-vertical">
                        <li><a href="./chiqui.php">Chiquicentro</a></li>
                        <li><a href="./preas.php">Preas</a></li>
                        <li><a href="./a2_jov.php">Adolescentes & Jovenes</a></li>
                        <li><a href="./catecumenado.php">Catecumenado</a></li>
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
        <div class="c_cont-portada" id="adosjov">
            <h1>Adolescentes & Jovenes</h1>
        </div>
        <article>
            <h2 id="colora2_jov">Sobre nosotros</h2>
            <div class="c_informacion">
                <div class="c_texto c_texto_secciones">
                    <p>En nuestro grupo para adolescentes y jóvenes, ofrecemos una variedad de opciones para que disfrutes de tu tiempo libre mientras cultivas los valores cristianos. Al unirte a nuestro grupo, tendrás acceso a las siguientes actividades:<br><br>
                    1.  Sala de juegos: Disponemos de una sala equipada con juegos como billar, futbolín, tenis de mesa, PS2, PS3, Wii, entre otros. Aquí podrás divertirte y socializar con otros jóvenes, fomentando la camaradería y el respeto mientras disfrutas de actividades recreativas.<br><br>
                    2.  Actividades semanales: Cada semana organizamos diferentes actividades que incluyen fiestas, talleres y deportes. Estas actividades te brindarán la oportunidad de participar en experiencias emocionantes, aprender nuevas habilidades y fortalecer tu fe, siempre desde una perspectiva cristiana.<br><br>
                    3.  Viajes y fines de semana fuera de Madrid: Organizamos salidas especiales y fines de semana fuera de la ciudad para que puedas disfrutar de nuevas experiencias, visitar lugares de interés cultural y fortalecer tu fe en un entorno diferente. Estos viajes te permitirán conocer a jóvenes de otros centros juveniles y ampliar tu horizonte. <br><br>
                    4.  Encuentros con jóvenes de otros centros juveniles: Establecemos encuentros con jóvenes de otros centros juveniles, brindándote la oportunidad de establecer amistades, compartir experiencias y crecer en comunidad. Estos encuentros fomentan la integración, la tolerancia y el respeto hacia los demás.<br><br>
                    5.  Momentos de grupo por edades: Creamos espacios de encuentro específicos para cada grupo de edad, donde podrás interactuar y dialogar con personas que se encuentran en tu misma etapa de vida. Estos momentos de grupo promueven el apoyo mutuo, el intercambio de ideas y la reflexión en torno a los valores cristianos.<br><br>
                    6.  Actividades continuadas a lo largo del trimestre: Ofrecemos actividades continuadas durante todo el trimestre, como musicales y teatro. Podrás participar en ensayos, representaciones y demostrar tus habilidades artísticas, siempre con un enfoque en la expresión creativa y la transmisión de mensajes cristianos.<br><br>
                    7.  Escuela de música y posibilidad de formar tu propio grupo: Contamos con una escuela de música donde podrás aprender a tocar diferentes instrumentos y desarrollar tus habilidades musicales. Además, tienes la oportunidad de formar tu propio grupo, contar con un local de ensayo y ofrecer conciertos, difundiendo así la música con un mensaje cristiano.<br><br>
                    8.  Campamentos de verano: Durante el verano, organizamos campamentos que combinan actividades al aire libre, formación espiritual y diversión. Estos campamentos te brindarán la oportunidad de crecer en tu fe, establecer amistades duraderas y disfrutar de la naturaleza en un ambiente seguro y supervisado.<br><br>
                    En resumen, nuestro grupo para adolescentes y jóvenes ofrece una amplia gama de actividades, desde una sala de juegos hasta actividades semanales, viajes, encuentros con otros jóvenes, momentos de grupo por edades, actividades continuadas a lo largo del trimestre, una escuela de música, la posibilidad de formar tu propio grupo y campamentos de verano. Estas opciones buscan proporcionarte un espacio enriquecedor para desarrollar
                    <br/> <br/>
                    </p>
                </div>
                <div class="c_horadest">
                    <img src="../img/horario.png" alt="">
                    <h4>Horarios</h4>
                    <p>Viernes, de 19:00 a 21:30 <br><br> Sábados, de  17:00 a 21:00</p>
                    <br><br>
                    <img src="../img/destinatarios.png" alt="">
                    <h4>Destinatarios</h4>
                    <p>Chavales de 14 a 18 años.</p>
                </div>
        </article>
       
        <div class="c_cont-portada">
			<input type="radio" name="slider" id="item-1" checked>
			<input type="radio" name="slider" id="item-2">
			<input type="radio" name="slider" id="item-3">
            <div class="cards">
				<label class="card" for="item-1" id="song-1">
					<img src="../img/viaje.jpg" alt="song">
				</label>
				<label class="card" for="item-2" id="song-2">
					<img src="../img/parzan4.JPG" alt="song">
				</label>
				<label class="card" for="item-3" id="song-3">
					<img src="../img/musical3.JPG" alt="song">
				</label>
			</div>
            <h1 style="font-size: 2em; font-weight: bold;">A2 Y JOVENES</h1>
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
    <a href="./info.html" class="enlaces">
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