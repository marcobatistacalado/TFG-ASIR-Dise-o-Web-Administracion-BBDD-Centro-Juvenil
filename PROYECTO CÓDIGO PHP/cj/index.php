<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio - CJ La Balsa</title>
    <link rel="stylesheet" type="text/css" href="./main/p_style.css">

    <link rel="icon" type="image/jpg" href="./main/img/logolabalsa.png" />
</head>

<body>
    <nav>
        <input type="checkbox" id="active">
        <label for="active" class="menu-btn"><i class="fas fa-bars"></i></label>
        <div class="wrapper">
            <ul class="c_menu-horizontal">
                <img id="logosls" class="c_img" src="./main/img/logosls.png"></img>
                <li><a href="#sobrenosotros">Sobre nosotros</a></li>
                <li>
                    <a href="#" id="secciones">Secciones</a>
                    <a href="./main/secciones/chiqui.php" class="niveles" hidden>Chiquicentro</a>
                    <a href="./main/secciones/preas.php" class="niveles" hidden>Preas</a>
                    <a href="./main/secciones/a2_jov.php" class="niveles" hidden>Adolecentes & Jovenes</a>
                    <a href="./main/secciones/catecumenado.php" class="niveles" hidden>Catecumenado</a>

                    <ul class="c_menu-vertical">
                        <li><a href="./main/secciones/chiqui.php">Chiquicentro</a></li>
                        <li><a href="./main/secciones/preas.php">Preas</a></li>
                        <li><a href="./main/secciones/a2_jov.php">Adolescentes & Jovenes</a></li>
                        <li><a href="./main/secciones/catecumenado.php">Catecumenado</a></li>
                    </ul>
                </li>
                <li>
                    <a href="./main/videos/videos.php">Vídeos</a>
                </li>
                <?php
              
                session_start();


                // Requerir las funciones del fichero funciones.php para utilizarlas.
                require './funciones.php';
                if (!isset($_SESSION['usuario'])) {
                        echo "<li><a href='./login.php'>"; //PAGINA CON DOS BOTONES: INICIAR SESION Y REGISTRO
                        echo "Usuario";
                        echo "</a></li>";
                }else {
                        $user=$_SESSION['usuario'];
                        echo "<li><a href='./usuario.php'>"; //PÁGINA CON TODAS LAS OPCIONES DE ADMINISTRACION, BOTONES
                        echo $user;
                        echo "</a></li>";
                }
                ?>
                <img class="c_img" src="./main/img/logolabalsa.png"></img>
            </ul>
        </div>
    </nav>
    <main>
        
        <div class="c_cont-portada">
            <input type="radio" name="slider" id="item-1" checked>
            <input type="radio" name="slider" id="item-2">
            <input type="radio" name="slider" id="item-3">
            <div class="cards">
                <label class="card" for="item-1" id="song-1">
                    <img src="./main/img/parzan.png" alt="song">
                </label>
                <label class="card" for="item-2" id="song-2">
                    <img src="./main/img/parzan3.JPG" alt="song">
                </label>
                <label class="card" for="item-3" id="song-3">
                    <img src="./main/img/masterchef1.jpg" alt="song">
                </label>
            </div>
            <h1 style="font-size: 2em; font-weight: bold;">CJ La Balsa</h1>
        </div>
        <article>
            <h2 id="sobrenosotros">Sobre nosotros</h2>
            <div class="c_texto">
                <p>El centro juvenil La Balsa es un lugar acogedor y lleno de vida ubicado en el barrio de Estrecho, en
                    Madrid. Este centro, con un enfoque cristiano, ha sido creado para ofrecer a los jóvenes de la zona
                    un espacio seguro y divertido en el que puedan aprender, crecer y desarrollarse. <br /> <br />
                    Con una amplia variedad de actividades y programas, La Balsa es un lugar en el que los jóvenes
                    pueden desarrollar sus habilidades y talentos en una variedad de áreas, mientras aprenden valores
                    cristianos como el amor, la solidaridad y la justicia. Desde deportes y actividades al aire libre
                    hasta talleres de arte y música, este centro ofrece algo para todos los gustos. <br /> <br />
                    Una de las características más destacadas del centro juvenil La Balsa es su compromiso con la
                    educación y el desarrollo personal desde una perspectiva cristiana. El centro cuenta con un equipo
                    de profesionales altamente capacitados que trabajan con los jóvenes para ayudarlos a alcanzar sus
                    metas y objetivos, fomentando la importancia de la fe y la espiritualidad. Desde asesoramiento y
                    orientación hasta capacitación y tutoría, el equipo de La Balsa está siempre disponible para brindar
                    apoyo y orientación a los jóvenes que lo necesiten. <br /> <br />
                    Además de su enfoque cristiano en la educación y el desarrollo personal, La Balsa también es un
                    lugar en el que los jóvenes pueden socializar y conectarse con otros jóvenes de su edad que
                    comparten sus valores. Con eventos regulares, actividades y programas comunitarios, este centro es
                    un lugar en el que los jóvenes pueden establecer relaciones duraderas y significativas con otros
                    jóvenes y adultos en su comunidad que comparten su fe y valores. <br /> <br /></p>
            </div>
        </article>
        
        <article>
            <h2>Últimas noticias</h2>
            <div class="c_tarjetas">
                <a href="./main/noticias/n_parzan.php">
                <div class="c_noticia">
                    <div class="c_imagen" id="noticia1"></div>
                    <div class="c_espacio"></div>
                    <div class="c_info">
                        <h3><a href="./main/noticias/n_parzan.php">Campamento Parzán 2023</a></h3>
                        <br><p>¿Qué aventuras y desafíos aguardan en el campamento PARZÁN 2023? Únete a este misterioso evento organizado por los centros juveniles salesianos y descubre cómo la integración, la salud y la superación se entrelazan en una experiencia única.</p>
                    </div>
                </div>
                </a>
                <a href="./main/noticias/n_cenaconfis.php">
                <div class="c_noticia">
                    <div class="c_imagen" id="noticia2"></div>
                    <div class="c_espacio"></div>
                    <div class="c_info">
                        <h3><a href="./main/noticias/n_cenaconfis.php">Cena de Confirmaciones</a></h3>
                        <br><p>Descubre los exquisitos platos que formarán parte de nuestro menú de confirmación. ¿Cuál será el plato principal que podrás elegir para deleitar tu paladar durante esta cena especial?</p>
                    </div>

                </div>
                </a>
                <a href="./main/noticias/n_musical.php">
                <div class="c_noticia">
                    <div class="c_imagen" id="noticia3"></div>
                    <div class="c_espacio"></div>
                    <div class="c_info">
                        <h3><a href="./main/noticias/n_musical.php">Musical: Shrek</a></h3>
                        <br><p>¿Quiénes son los misteriosos personajes que Shrek encontrará en su camino? Atrévete a sumergirte en este musical y descubre cómo estos encuentros cambiarán el destino de todos los involucrados.</p>
                    </div>
                </div>
                </a>
            </div>
            <hr>
            <h2>Próximas actividades</h2>
            <div class="c_tarjetas">
                <a href="./formularios/parzan.php">
                <div class="actividad">
                    <div class="c_imagen" id="actividad1"></div>
                    <div class="c_espacio"></div>
                    <div class="c_info">
                        <h3><a href="./formularios/parzan.php">Campamento Parzán 2023</a></h3>
                        <br><p>¡Apúntate! y disfruta.</p>
                    </div>
                </div>
                </a>
                <a href="./formularios/cenaconfirmaciones.php">
                <div class="actividad">
                    <div class="c_imagen" id="actividad2"></div>
                    <div class="c_espacio"></div>
                    <div class="c_info">
                        <h3><a href="./formularios/cenaconfirmaciones.php">Cena de Confirmaciones</a></h3>
                        <br><p>¡Apúntate! y disfruta.</p>
                    </div>
                </div>
                </a>
                <a href="./formularios/musical.php">
                <div class="actividad">
                    <div class="c_imagen" id="actividad3"></div>
                    <div class="c_espacio"></div>
                    <div class="c_info">
                        <h3><a href="./formularios/musical.php">Musical: Shrek</a></h3>
                        <br><p>¡Apúntate! y disfruta.</p>
                    </div>
                </div>
                </a>
            </div>
        </article>
    </main>
    <footer>
            <div class="pie">
                <p>Colegio Salesiano San Juan Bautista | Salesianos Estrecho </p>
                <img src="./main/img/maux.png" class="pifoto" alt="20px">
                <img src="./main/img/dbosco.png" class="pifoto" alt="20px">
            </div>
           
        </footer>
    <div class="RRSS">
        <a href="./main/info.html" class="enlaces">
            <img class="imgrrss" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAAAXNSR0IArs4c6QAAA+xJREFUaEPtWe1R20AQfTuYf5bAFcRUEOjAVABUEKgAU0GggpgKYiqIqSCkgkAFQAW2Jf/jPJtZ6yz0cZJOJzkZZ7g/DLZ0d2/37dczYcsXbfn98QHgX3uwNQ/wYnEI5hMAhwD6+m8S3yOAFxA9APhF3a7833g1AsDTaR+dziWYT0Ekl7ZfzAJmAqVuqdd7sX8x/aQTAJ5O99HpfAUwdD04894ISt1Qrzeru19tABwEYu3vAPbrHlbx/AzMF+T7kzr71gLAYfitwur3YJ6ASOgxW/Ncx8c+mPsgOgUgsVK0RuR5V7YgrABoyojV5fDsmoN5iOVyYkuB1X47O+LJEYC93I7MYyyXVzb72QEIwx8Fl7+BUiObg0wW1YaROJJ4Si/mMfn+RZUnKgFwGIqVLjMbzUE0aCsVaopJes1645Y8rzRRlALQASvWT64nKDVwtXqRRXVKlgD+nHqG+awssAsBaPc+Z7LNHEr12778+sIahBS4pCdmUOqg6MxiAEEwBtGXlDWIjmxpw2HIyXfJ8yrpKs9rOv3OeKqQSsZNtSXE+sl1Q553XRVUsTUdAaxAhKGckw7syAu5im0GkA/c2tRx9cAKQFTp5bJJKhkNaAYQBM+p3iaqkGNb62srOlEo9mAQnOuKH33E/EK+f5C9Qw6AkYNK9TYVuCVZSbwwrYrBPIA8/+7J80wVuI5DnJ7lMJS0+t52EF1Rtyt1KV4mAOmXHOjjdFvDS7xYDMEs/dd65YxpAiApTIaS9Tomz5Mq+dcXh+EAwM/EwY/keUdVHkgFH2rk/uTGTbJQHMjRlJeqCdl6YvJAo+wRH96gDtQxxP8PYBspJM1UsiN0CuJWYiAfxE/keckEkxe2crnXMY22AsAxjWYbKadC1goAp0JmSF1waCWaAtANXf1WYtU3BYGoCp/idOZAo8YA8s3cK/l+TjyzbadLpyJTiW4CoGAarNFOR5Lh9g40mkbbO1KuAJinotpUqtMB6lFWep+kbFk6DbrIKo9Q6qyJomyMmYi2IuGkChVcZZVEU2YStmYgOrZVKKq8oKdAaZuzgnEzYSsGYZJYoi+vtb5fWxZP0FRUv7zawXxHvn9eBd5Oq4nE2FFOJ4p2F28M8fZ2bzs3r+Jrd/cEzOLdvEzPfIflcmiznxWACjoljSTS+kQUBBDNM/L6HohkQJEpq2zGrqRN6URW5TKtl4rEkpfFq14u/15k+vON/sAReyJKscLbrGrtCuEWSl3bUCZ7QC0KZV/WeVuUA/mx4r13soHB/AqiMZQaN0nJjQCkZlfpYoGB5rg0XWmZHHhK/Mz60FYKbg2AjdE38cwHgE1Ytc6eW++BP7zIQE/bqdiHAAAAAElFTkSuQmCC"></img>
        </a>
        <a href="https://www.youtube.com/user/CJLabalsa" class="enlaces" target="_blank">
            <img class="imgrrss" src="./main/img/youtube.png"></img>
        </a>
        <a href="https://www.instagram.com/cjlabalsa/?hl=es" class="enlaces" target="_blank" >
            <img class="imgrrss" src="./main/img/instagram.png"></img>
        </a>
        <a href="https://www.tiktok.com/@cjlabalsa" class="enlaces" target="_blank">
            <img class="imgrrss" src="./main/img/tiktok.png"></img>
        </a>
    </div>
</body>

</html>