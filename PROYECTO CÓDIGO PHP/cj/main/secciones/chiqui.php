<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chiquicentro</title>
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
        <div class="c_cont-portada" id="chiqui">
            <h1>Chiquicentro</h1>
        </div>
        <article>
            <h2 id="color">Sobre nosotros</h2>
            <div class="c_informacion">
                <div class="c_texto c_texto_secciones">
                    <p>Para los pequeños, se ofrecen actividades de tiempo libre educativo, atendidas por monitores comprometidos con los valores cristianos. Estas actividades se centran en promover el aprendizaje y la diversión, al mismo tiempo que se transmiten enseñanzas sobre la vida de Jesús y su importancia en la fe cristiana. Algunas son las siguientes:<br><br>
                        1.  Deportes: Se realizan actividades deportivas adaptadas a la edad de los niños, con el objetivo de promover la importancia de la actividad física y el trabajo en equipo, siempre desde una perspectiva cristiana. Los monitores destacan los valores de respeto, solidaridad y superación personal que Jesús nos enseñó.<br><br>
                        2.  Fiestas: Se organizan fiestas temáticas donde los niños pueden disfrutar de juegos, bailes y música, todo ello relacionado con la vida y los valores cristianos. Estas fiestas permiten a los niños socializar, divertirse y aprender sobre la importancia de celebrar y compartir momentos de alegría, siguiendo el ejemplo de Jesús.<br><br>
                        3.  Gymkhanas y Macro juegos: Estas actividades al aire libre se diseñan para fomentar la cooperación, el ingenio y la resolución de problemas, siempre teniendo presente el mensaje de amor y servicio que Jesús nos dejó. Los niños participan en desafíos que les animan a trabajar juntos y a aplicar los valores cristianos en su interacción con los demás.<br><br>
                        4.  Talleres: Se imparten talleres educativos donde los niños pueden desarrollar su creatividad y habilidades, siempre desde una perspectiva cristiana. Los talleres incluyen actividades como manualidades, cocina, arte, teatro o música, y los monitores aprovechan estas oportunidades para enseñar a los niños sobre la vida de Jesús y cómo aplicar sus enseñanzas en su día a día.<br><br>
                        Además de estas actividades de tiempo libre educativo, se organizan fines de semana fuera de Madrid, donde los niños tienen la oportunidad de participar en excursiones y visitas a lugares de interés cultural y religioso. Durante estas salidas, los monitores aprovechan para explicar la importancia de estos lugares en la vida de Jesús y cómo se relacionan con la fe cristiana.<br><br>

                        En resumen, para los pequeños de hasta once años, se ofrecen actividades de tiempo libre educativo, siempre desde una perspectiva cristiana, que incluyen deportes, fiestas, gymkhanas, talleres y la posibilidad de disfrutar de fines de semana fuera de Madrid. Estas actividades buscan combinar el aprendizaje, la diversión y el conocimiento de la vida de Jesús, transmitiendo los valores cristianos de amor, respeto y servicio a los demás.
                    <br/><br/>
                    </p>
                </div>
                <div class="c_horadest">
                    <img src="../img/horario.png" alt="">
                    <h4>Horarios</h4>
                    <p>Sábados, de 16:30 a 19:30</p>
                    <br><br>
                    <img src="../img/destinatarios.png" alt="">
                    <h4>Destinatarios</h4>
                    <p>Pequeños de 8-11 años.</p>
                </div>
            </div>
        </article>
        
        <div class="c_cont-portada">
			<input type="radio" name="slider" id="item-1" checked>
			<input type="radio" name="slider" id="item-2">
			<input type="radio" name="slider" id="item-3">
            <div class="cards">
				<label class="card" for="item-1" id="song-1">
					<img src="../img/chiqui2.JPG" alt="song">
				</label>
				<label class="card" for="item-2" id="song-2">
					<img src="../img/chiqui3.JPG" alt="song">
				</label>
				<label class="card" for="item-3" id="song-3">
					<img src="../img/chiqui4.JPG" alt="song">
				</label>
			</div>
            <h1 style="font-size: 2em; font-weight: bold;">CHIQUI</h1>
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