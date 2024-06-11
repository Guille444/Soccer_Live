/*
*   Controlador es de uso general en las páginas web del sitio público.
*   Sirve para manejar las plantillas del encabezado y pie del documento.
*/

// Constante para completar la ruta de la API.
const USER_API = 'services/public/cliente.php';
// Constante para establecer el elemento del contenido principal.
const MAIN = document.querySelector('main');
MAIN.style.paddingTop = '0px';
MAIN.style.paddingBottom = '75px';
MAIN.classList.add('container');
// Se establece el título de la página web.
// document.querySelector('title').textContent = 'CoffeeShop - Store';
// Constante para establecer el elemento del título principal.
const MAIN_TITLE = document.getElementById('mainTitle');
// MAIN_TITLE.classList.add('text-center', 'py-3');

/*  Función asíncrona para cargar el encabezado y pie del documento.
*   Parámetros: ninguno.
*   Retorno: ninguno.
*/
const loadTemplate = async () => {
    // Petición para obtener en nombre del usuario que ha iniciado sesión.
    const DATA = await fetchData(USER_API, 'getUser');
    // Se comprueba si el usuario está autenticado para establecer el encabezado respectivo.
    if (DATA.session) {
        // Se verifica si la página web no es el inicio de sesión, de lo contrario se direcciona a la página web principal.
        if (!location.pathname.endsWith('login.html')) {
            // Se agrega el encabezado de la página web antes del contenido principal.
            MAIN.insertAdjacentHTML('beforebegin', `
            <header>
                    <br>
                    <!-- Contenido de menú del documento-->
                    <nav class="navbar navbar-expand-lg navbar-dark static-top" id="fondo">
                        <div class="container">
                            <!-- Se llama a la imagen -->
                            <a class="navbar-brand" href="../public/index.html">
                                <img src="../../resources/imgs/logo-no-background.png" alt="..." height="36">
                            </a>
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                                aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <!-- Menú -->
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav ms-auto">
                                    <li class="nav-item">
                                        <div class="navbar-nav ms-auto">
                                            <a class="nav-link" href="index.html" id="index"><i class="bi bi-shop"></i> CATÁLAGO </a>
                                            <a class="nav-link" href="carrito.html"><i class="bi bi-cart"></i> CARRITO </a>
                                            <a class="nav-link" href="historial.html"><i class="bi bi-clock-history"></i> HISTORIAL DE COMPRAS </a>
                                            <a class="nav-link" href="perfil.html"><i class="bi bi-person-fill"></i> PERFIL </a>
                                            <a class="nav-link" href="#" onclick="logOut()"><i class="bi bi-box-arrow-left"></i> CERRAR SESIÓN </a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </nav>
                </header>
            `);
        } else {
            location.href = 'index.html';
        }
    } else {
        // Se agrega el encabezado de la página web antes del contenido principal.
        MAIN.insertAdjacentHTML('beforebegin', `
            <header>
                <br>
                <!-- Contenido de menú del documento-->
                <nav class="navbar navbar-expand-lg navbar-dark static-top" id="fondo">
                    <div class="container">
                        <!-- Se llama a la imagen -->
                        <a class="navbar-brand" href="../public/index.html">
                            <img src="../../resources/imgs/logo-no-background.png" alt="..." height="36">
                        </a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                            aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <!-- Menú -->
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ms-auto">
                                <li class="nav-item">
                                    <div class="navbar-nav ms-auto">
                                    <a class="nav-link" href="index.html" id="index"><i class="bi bi-shop"></i> CATÁLAGO </a>
                                        <a class="nav-link" href="registro.html"><i class="bi bi-person"></i> CREAR CUENTA </a>
                                        <a class="nav-link" href="login.html"><i class="bi bi-box-arrow-right"></i> INICIAR SESIÓN </a>
                                    </div>
                                </li>
                                <li class="nav-item">
                                        <a class="nav-link" href="../public/info.html">¿QUIÉNES SOMOS?</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </header>
        `);
    }
    /// Se agrega el pie de la página web después del contenido principal.
    MAIN.insertAdjacentHTML('afterend', `
        <footer>
            <nav class="navbar fixed-bottom" id="footerColor">
                <div class="container">
                    <div>
                        <h6>Soccer Live</h6>
                        <p><i class="bi bi-c-square"></i> 2024 - Todos los derechos reservados</p>
                    </div>
                    <div>
                        <h6>Contáctanos</h6>
                        <p><i class="bi bi-envelope"></i> soccerlive@gmail.com</p>
                    </div>
                </div>
            </nav>
        </footer>
    `);
}

/*  Función asíncrona para cargar el encabezado y pie del documento.
*   Parámetros: ninguno.
*   Retorno: ninguno.
*/
const loadTemplate2 = async () => {
    // Petición para obtener en nombre del usuario que ha iniciado sesión.
    const DATA = await fetchData(USER_API, 'getUser');
    // Se comprueba si el usuario está autenticado para establecer el encabezado respectivo.
    if (DATA.session) {
        // Se verifica si la página web no es el inicio de sesión, de lo contrario se direcciona a la página web principal.
        if (!location.pathname.endsWith('login.html')) {
            // Se agrega el encabezado de la página web antes del contenido principal.
            MAIN.insertAdjacentHTML('beforebegin', `
            <header>
                    <br>
                    <!-- Contenido de menú del documento-->
                    <nav class="navbar navbar-expand-lg navbar-dark static-top" id="fondo">
                        <div class="container">
                            <!-- Se llama a la imagen -->
                            <a class="navbar-brand" href="../public/index.html">
                                <img src="../../resources/imgs/logo-no-background.png" alt="..." height="36">
                            </a>
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                                aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <!-- Menú -->
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav ms-auto">
                                    <li class="nav-item">
                                        <div class="navbar-nav ms-auto">
                                        <a class="nav-link" href="index.html"><i class="bi bi-shop"></i> CATÁLAGO</a>
                                            <a class="nav-link" href="carrito.html"><i class="bi bi-cart"></i> CARRITO</a>
                                            <a class="nav-link" href="perfil.html"><i class="bi bi-person-fill"></i> PERFIL </a>
                                            <a class="nav-link" href="#" onclick="logOut()"><i class="bi bi-box-arrow-left"></i> CERRAR SESIÓN</a>
                                        </div>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="../public/info.html" id="info1">¿QUIÉNES SOMOS?</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </nav>
                </header>
            `);
        } else {
            location.href = 'index.html';
        }
    } else {
        // Se agrega el encabezado de la página web antes del contenido principal.
        MAIN.insertAdjacentHTML('beforebegin', `
            <header>
                <br>
                <!-- Contenido de menú del documento-->
                <nav class="navbar navbar-expand-lg navbar-dark static-top" id="fondo">
                    <div class="container">
                        <!-- Se llama a la imagen -->
                        <a class="navbar-brand" href="../public/index.html">
                            <img src="../../resources/imgs/logo-no-background.png" alt="..." height="36">
                        </a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                            aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <!-- Menú -->
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ms-auto">
                                <li class="nav-item">
                                    <div class="navbar-nav ms-auto">
                                    <a class="nav-link" href="index.html"><i class="bi bi-shop"></i> CATÁLAGO</a>
                                        <a class="nav-link" href="registro.html"><i class="bi bi-person"></i> CREAR CUENTA </a>
                                        <a class="nav-link" href="login.html"><i class="bi bi-box-arrow-right"></i> INICIAR SESIÓN</a>
                                    </div>
                                </li>
                                <li class="nav-item">
                                        <a class="nav-link" href="../public/info.html" id="info1">¿QUIÉNES SOMOS?</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </header>
        `);
    }
    /// Se agrega el pie de la página web después del contenido principal.
    MAIN.insertAdjacentHTML('afterend', `
        <footer>
            <nav class="navbar fixed-bottom" id="footerColor">
                <div class="container">
                    <div>
                        <h6>Soccer Live</h6>
                        <p><i class="bi bi-c-square"></i> 2024 - Todos los derechos reservados</p>
                    </div>
                    <div>
                        <h6>Contáctanos</h6>
                        <p><i class="bi bi-envelope"></i> soccerlive@gmail.com</p>
                    </div>
                </div>
            </nav>
        </footer>
    `);
}

/*  Función asíncrona para cargar el encabezado y pie del documento.
*   Parámetros: ninguno.
*   Retorno: ninguno.
*/
const loadTemplate3 = async () => {
    // Petición para obtener en nombre del usuario que ha iniciado sesión.
    const DATA = await fetchData(USER_API, 'getUser');
    // Se comprueba si el usuario está autenticado para establecer el encabezado respectivo.
    if (DATA.session) {
        // Se verifica si la página web no es el inicio de sesión, de lo contrario se direcciona a la página web principal.
        if (!location.pathname.endsWith('login.html')) {
            // Se agrega el encabezado de la página web antes del contenido principal.
            MAIN.insertAdjacentHTML('beforebegin', `
            <header>
                    <br>
                    <!-- Contenido de menú del documento-->
                    <nav class="navbar navbar-expand-lg navbar-dark static-top" id="fondo">
                        <div class="container">
                            <!-- Se llama a la imagen -->
                            <a class="navbar-brand" href="../public/index.html">
                                <img src="../../resources/imgs/logo-no-background.png" alt="..." height="36">
                            </a>
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                                aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <!-- Menú -->
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav ms-auto">
                                    <li class="nav-item">
                                        <div class="navbar-nav ms-auto">
                                            <a class="nav-link" href="index.html" id="index"><i class="bi bi-shop"></i> CATÁLAGO </a>
                                            <a class="nav-link" href="carrito.html" id="carrito"><i class="bi bi-cart"></i> CARRITO </a>
                                            <a class="nav-link" href="historial.html"><i class="bi bi-clock-history"></i> HISTORIAL DE COMPRAS </a>
                                            <a class="nav-link" href="perfil.html"><i class="bi bi-person-fill"></i> PERFIL </a>
                                            <a class="nav-link" href="#" onclick="logOut()"><i class="bi bi-box-arrow-left"></i> CERRAR SESIÓN </a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </nav>
                </header>
            `);
        } else {
            location.href = 'index.html';
        }
    } else {
        // Se agrega el encabezado de la página web antes del contenido principal.
        MAIN.insertAdjacentHTML('beforebegin', `
            <header>
                <br>
                <!-- Contenido de menú del documento-->
                <nav class="navbar navbar-expand-lg navbar-dark static-top" id="fondo">
                    <div class="container">
                        <!-- Se llama a la imagen -->
                        <a class="navbar-brand" href="../public/index.html">
                            <img src="../../resources/imgs/logo-no-background.png" alt="..." height="36">
                        </a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                            aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <!-- Menú -->
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ms-auto">
                                <li class="nav-item">
                                    <div class="navbar-nav ms-auto">
                                    <a class="nav-link" href="index.html"><i class="bi bi-shop"></i> CATÁLAGO</a>
                                        <a class="nav-link" href="registro.html"><i class="bi bi-person"></i> CREAR CUENTA </a>
                                        <a class="nav-link" href="login.html"><i class="bi bi-box-arrow-right"></i> INICIAR SESIÓN</a>
                                    </div>
                                </li>
                                <li class="nav-item">
                                        <a class="nav-link" href="../public/info.html">¿QUIÉNES SOMOS?</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </header>
        `);
    }
    /// Se agrega el pie de la página web después del contenido principal.
    MAIN.insertAdjacentHTML('afterend', `
        <footer>
            <nav class="navbar fixed-bottom" id="footerColor">
                <div class="container">
                    <div>
                        <h6>Soccer Live</h6>
                        <p><i class="bi bi-c-square"></i> 2024 - Todos los derechos reservados</p>
                    </div>
                    <div>
                        <h6>Contáctanos</h6>
                        <p><i class="bi bi-envelope"></i> soccerlive@gmail.com</p>
                    </div>
                </div>
            </nav>
        </footer>
    `);
}

/*  Función asíncrona para cargar el encabezado y pie del documento.
*   Parámetros: ninguno.
*   Retorno: ninguno.
*/

const loadTemplate4 = async () => {
    // Petición para obtener en nombre del usuario que ha iniciado sesión.
    const DATA = await fetchData(USER_API, 'getUser');
    // Se comprueba si el usuario está autenticado para establecer el encabezado respectivo.
    if (DATA.session) {
        // Se verifica si la página web no es el inicio de sesión, de lo contrario se direcciona a la página web principal.
        if (!location.pathname.endsWith('login.html')) {
            // Se agrega el encabezado de la página web antes del contenido principal.
            MAIN.insertAdjacentHTML('beforebegin', `
            <header>
                    <br>
                    <!-- Contenido de menú del documento-->
                    <nav class="navbar navbar-expand-lg navbar-dark static-top" id="fondo">
                        <div class="container">
                            <!-- Se llama a la imagen -->
                            <a class="navbar-brand" href="../public/index.html">
                                <img src="../../resources/imgs/logo-no-background.png" alt="..." height="36">
                            </a>
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                                aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <!-- Menú -->
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav ms-auto">
                                    <li class="nav-item">
                                        <div class="navbar-nav ms-auto">
                                            <a class="nav-link" href="index.html"><i class="bi bi-shop"></i> CATÁLAGO </a>
                                            <a class="nav-link" href="carrito.html" id="carrito"><i class="bi bi-cart"></i> CARRITO </a>
                                            <a class="nav-link" href="historial.html"><i class="bi bi-clock-history"></i> HISTORIAL DE COMPRAS </a>
                                            <a class="nav-link" href="perfil.html" id="perfil"><i class="bi bi-person-fill"></i> PERFIL </a>
                                            <a class="nav-link" href="#" onclick="logOut()"><i class="bi bi-box-arrow-left"></i> CERRAR SESIÓN </a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </nav>
                </header>
            `);
        } else {
            location.href = 'index.html';
        }
    } else {
        // Se agrega el encabezado de la página web antes del contenido principal.
        MAIN.insertAdjacentHTML('beforebegin', `
            <header>
                <br>
                <!-- Contenido de menú del documento-->
                <nav class="navbar navbar-expand-lg navbar-dark static-top" id="fondo">
                    <div class="container">
                        <!-- Se llama a la imagen -->
                        <a class="navbar-brand" href="../public/index.html">
                            <img src="../../resources/imgs/logo-no-background.png" alt="..." height="36">
                        </a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                            aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <!-- Menú -->
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ms-auto">
                                <li class="nav-item">
                                    <div class="navbar-nav ms-auto">
                                    <a class="nav-link" href="index.html"><i class="bi bi-shop"></i> CATÁLAGO</a>
                                        <a class="nav-link" href="registro.html"><i class="bi bi-person"></i> CREAR CUENTA </a>
                                        <a class="nav-link" href="login.html"><i class="bi bi-box-arrow-right"></i> INICIAR SESIÓN</a>
                                    </div>
                                </li>
                                <li class="nav-item">
                                        <a class="nav-link" href="../public/info.html">¿QUIÉNES SOMOS?</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </header>
        `);
    }
    /// Se agrega el pie de la página web después del contenido principal.
    MAIN.insertAdjacentHTML('afterend', `
        <footer>
            <nav class="navbar fixed-bottom" id="footerColor">
                <div class="container">
                    <div>
                        <h6>Soccer Live</h6>
                        <p><i class="bi bi-c-square"></i> 2024 - Todos los derechos reservados</p>
                    </div>
                    <div>
                        <h6>Contáctanos</h6>
                        <p><i class="bi bi-envelope"></i> soccerlive@gmail.com</p>
                    </div>
                </div>
            </nav>
        </footer>
    `);
}

/*  Función asíncrona para cargar el encabezado y pie del documento.
*   Parámetros: ninguno.
*   Retorno: ninguno.
*/

const loadTemplate5 = async () => {
    // Petición para obtener en nombre del usuario que ha iniciado sesión.
    const DATA = await fetchData(USER_API, 'getUser');
    // Se comprueba si el usuario está autenticado para establecer el encabezado respectivo.
    if (DATA.session) {
        // Se verifica si la página web no es el inicio de sesión, de lo contrario se direcciona a la página web principal.
        if (!location.pathname.endsWith('login.html')) {
            // Se agrega el encabezado de la página web antes del contenido principal.
            MAIN.insertAdjacentHTML('beforebegin', `
            <header>
                    <br>
                    <!-- Contenido de menú del documento-->
                    <nav class="navbar navbar-expand-lg navbar-dark static-top" id="fondo">
                        <div class="container">
                            <!-- Se llama a la imagen -->
                            <a class="navbar-brand" href="../public/index.html">
                                <img src="../../resources/imgs/logo-no-background.png" alt="..." height="36">
                            </a>
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                                aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <!-- Menú -->
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav ms-auto">
                                    <li class="nav-item">
                                        <div class="navbar-nav ms-auto">
                                            <a class="nav-link" href="index.html"><i class="bi bi-shop"></i> CATÁLAGO </a>
                                            <a class="nav-link" href="carrito.html" id="carrito"><i class="bi bi-cart"></i> CARRITO </a>
                                            <a class="nav-link" href="historial.html" id="historial"><i class="bi bi-clock-history"></i> HISTORIAL DE COMPRAS </a>
                                            <a class="nav-link" href="perfil.html"><i class="bi bi-person-fill"></i> PERFIL </a>
                                            <a class="nav-link" href="#" onclick="logOut()"><i class="bi bi-box-arrow-left"></i> CERRAR SESIÓN </a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </nav>
                </header>
            `);
        } else {
            location.href = 'index.html';
        }
    } else {
        // Se agrega el encabezado de la página web antes del contenido principal.
        MAIN.insertAdjacentHTML('beforebegin', `
            <header>
                <br>
                <!-- Contenido de menú del documento-->
                <nav class="navbar navbar-expand-lg navbar-dark static-top" id="fondo">
                    <div class="container">
                        <!-- Se llama a la imagen -->
                        <a class="navbar-brand" href="../public/index.html">
                            <img src="../../resources/imgs/logo-no-background.png" alt="..." height="36">
                        </a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                            aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <!-- Menú -->
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ms-auto">
                                <li class="nav-item">
                                    <div class="navbar-nav ms-auto">
                                    <a class="nav-link" href="index.html"><i class="bi bi-shop"></i> CATÁLAGO</a>
                                        <a class="nav-link" href="registro.html"><i class="bi bi-person"></i> CREAR CUENTA </a>
                                        <a class="nav-link" href="login.html"><i class="bi bi-box-arrow-right"></i> INICIAR SESIÓN</a>
                                    </div>
                                </li>
                                <li class="nav-item">
                                        <a class="nav-link" href="../public/info.html">¿QUIÉNES SOMOS?</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </header>
        `);
    }
    /// Se agrega el pie de la página web después del contenido principal.
    MAIN.insertAdjacentHTML('afterend', `
        <footer>
            <nav class="navbar fixed-bottom" id="footerColor">
                <div class="container">
                    <div>
                        <h6>Soccer Live</h6>
                        <p><i class="bi bi-c-square"></i> 2024 - Todos los derechos reservados</p>
                    </div>
                    <div>
                        <h6>Contáctanos</h6>
                        <p><i class="bi bi-envelope"></i> soccerlive@gmail.com</p>
                    </div>
                </div>
            </nav>
        </footer>
    `);
}