/*
*   Controlador de uso general en las páginas web del sitio privado.
*   Sirve para manejar la plantilla del encabezado y pie del documento.
*/

// Constante para completar la ruta de la API.
const USER_API = 'services/admin/empleados.php';
// Constante para establecer el elemento del contenido principal.
const MAIN = document.querySelector('main');
MAIN.style.paddingTop = '75px';
MAIN.style.paddingBottom = '100px';
const MAIN_TITLE = document.getElementById('mainTitle');
MAIN.classList.remove('container');

/*  Función asíncrona para cargar el encabezado y pie del documento.
*   Parámetros: ninguno.
*   Retorno: ninguno.
*/
const loadTemplate = async () => {
    // Petición para obtener en nombre del usuario que ha iniciado sesión.
    const DATA = await fetchData(USER_API, 'getUser');
    // Se verifica si el usuario está autenticado, de lo contrario se envía a iniciar sesión.
    if (DATA.session) {
        // Se comprueba si existe un alias definido para el usuario, de lo contrario se muestra un mensaje con la excepción.
        if (DATA.status) {
            // Se agrega el encabezado de la página web antes del contenido principal.
            MAIN.insertAdjacentHTML('beforebegin', `
                <br>
                <nav class="navbar navbar-expand-lg navbar-dark static-top" id="fondo">
                    <div class="container">
                            <!-- Se llama a la imagen -->
                            <a class="navbar-brand" href="../admin/inicio.html">
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
                                        <a class="nav-link" href="../admin/inicio.html" id="inicio">INICIO</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="../admin/productos.html">PRODUCTOS</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="../admin/categorias.html">CATEGORÍAS</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="../admin/marcas.html">MARCAS</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="../admin/empleados.html">EMPLEADOS</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="../admin/clientes.html">CLIENTES</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="../admin/pedidos.html">PEDIDOS</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="../admin/valoraciones.html">VALORACIONES</a>
                                    </li>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">Cuenta: <b>${DATA.username}</b></a>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="../admin/perfil.html">Editar perfil</a></li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li><a class="dropdown-item" href="#" onclick="logOut()">Cerrar sesión</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                    </div>
                </nav>
            `);
        } else {
            sweetAlert(3, DATA.error, false, 'index.html');
        }
    }
}

const loadTemplate2 = async () => {
    // Petición para obtener en nombre del usuario que ha iniciado sesión.
    const DATA = await fetchData(USER_API, 'getUser');
    // Se verifica si el usuario está autenticado, de lo contrario se envía a iniciar sesión.
    if (DATA.session) {
        // Se comprueba si existe un alias definido para el usuario, de lo contrario se muestra un mensaje con la excepción.
        if (DATA.status) {
            // Se agrega el encabezado de la página web antes del contenido principal.
            MAIN.insertAdjacentHTML('beforebegin', `
                <br>
                <nav class="navbar navbar-expand-lg navbar-dark static-top" id="fondo">
                    <div class="container">
                            <!-- Se llama a la imagen -->
                            <a class="navbar-brand" href="../admin/inicio.html">
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
                                        <a class="nav-link" href="../admin/inicio.html">INICIO</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="../admin/productos.html" id="productos">PRODUCTOS</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="../admin/categorias.html">CATEGORÍAS</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="../admin/marcas.html">MARCAS</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="../admin/empleados.html">EMPLEADOS</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="../admin/clientes.html">CLIENTES</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="../admin/pedidos.html">PEDIDOS</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="../admin/valoraciones.html">VALORACIONES</a>
                                    </li>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">Cuenta: <b>${DATA.username}</b></a>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="../admin/perfil.html">Editar perfil</a></li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li><a class="dropdown-item" href="#" onclick="logOut()">Cerrar sesión</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                    </div>
                </nav>
            `);
        } else {
            sweetAlert(3, DATA.error, false, 'index.html');
        }
    }
}

const loadTemplate3 = async () => {
    // Petición para obtener en nombre del usuario que ha iniciado sesión.
    const DATA = await fetchData(USER_API, 'getUser');
    // Se verifica si el usuario está autenticado, de lo contrario se envía a iniciar sesión.
    if (DATA.session) {
        // Se comprueba si existe un alias definido para el usuario, de lo contrario se muestra un mensaje con la excepción.
        if (DATA.status) {
            // Se agrega el encabezado de la página web antes del contenido principal.
            MAIN.insertAdjacentHTML('beforebegin', `
                <br>
                <nav class="navbar navbar-expand-lg navbar-dark static-top" id="fondo">
                    <div class="container">
                            <!-- Se llama a la imagen -->
                            <a class="navbar-brand" href="../admin/inicio.html">
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
                                        <a class="nav-link" href="../admin/inicio.html">INICIO</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="../admin/productos.html">PRODUCTOS</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="../admin/categorias.html" id="categorias">CATEGORÍAS</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="../admin/marcas.html">MARCAS</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="../admin/empleados.html">EMPLEADOS</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="../admin/clientes.html">CLIENTES</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="../admin/pedidos.html">PEDIDOS</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="../admin/valoraciones.html">VALORACIONES</a>
                                    </li>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">Cuenta: <b>${DATA.username}</b></a>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="../admin/perfil.html">Editar perfil</a></li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li><a class="dropdown-item" href="#" onclick="logOut()">Cerrar sesión</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                    </div>
                </nav>
            `);
        } else {
            sweetAlert(3, DATA.error, false, 'index.html');
        }
    }
}

const loadTemplate4 = async () => {
    // Petición para obtener en nombre del usuario que ha iniciado sesión.
    const DATA = await fetchData(USER_API, 'getUser');
    // Se verifica si el usuario está autenticado, de lo contrario se envía a iniciar sesión.
    if (DATA.session) {
        // Se comprueba si existe un alias definido para el usuario, de lo contrario se muestra un mensaje con la excepción.
        if (DATA.status) {
            // Se agrega el encabezado de la página web antes del contenido principal.
            MAIN.insertAdjacentHTML('beforebegin', `
                <br>
                <nav class="navbar navbar-expand-lg navbar-dark static-top" id="fondo">
                    <div class="container">
                            <!-- Se llama a la imagen -->
                            <a class="navbar-brand" href="../admin/inicio.html">
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
                                        <a class="nav-link" href="../admin/inicio.html">INICIO</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="../admin/productos.html">PRODUCTOS</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="../admin/categorias.html">CATEGORÍAS</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="../admin/marcas.html" id="marcas">MARCAS</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="../admin/empleados.html">EMPLEADOS</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="../admin/clientes.html">CLIENTES</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="../admin/pedidos.html">PEDIDOS</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="../admin/valoraciones.html">VALORACIONES</a>
                                    </li>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">Cuenta: <b>${DATA.username}</b></a>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="../admin/perfil.html">Editar perfil</a></li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li><a class="dropdown-item" href="#" onclick="logOut()">Cerrar sesión</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                    </div>
                </nav>
            `);
        } else {
            sweetAlert(3, DATA.error, false, 'index.html');
        }
    }
}

const loadTemplate5 = async () => {
    // Petición para obtener en nombre del usuario que ha iniciado sesión.
    const DATA = await fetchData(USER_API, 'getUser');
    // Se verifica si el usuario está autenticado, de lo contrario se envía a iniciar sesión.
    if (DATA.session) {
        // Se comprueba si existe un alias definido para el usuario, de lo contrario se muestra un mensaje con la excepción.
        if (DATA.status) {
            // Se agrega el encabezado de la página web antes del contenido principal.
            MAIN.insertAdjacentHTML('beforebegin', `
                <br>
                <nav class="navbar navbar-expand-lg navbar-dark static-top" id="fondo">
                    <div class="container">
                            <!-- Se llama a la imagen -->
                            <a class="navbar-brand" href="../admin/inicio.html">
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
                                        <a class="nav-link" href="../admin/inicio.html">INICIO</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="../admin/productos.html">PRODUCTOS</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="../admin/categorias.html">CATEGORÍAS</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="../admin/marcas.html" >MARCAS</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="../admin/empleados.html" id="empleados">EMPLEADOS</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="../admin/clientes.html">CLIENTES</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="../admin/pedidos.html">PEDIDOS</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="../admin/valoraciones.html">VALORACIONES</a>
                                    </li>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">Cuenta: <b>${DATA.username}</b></a>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="../admin/perfil.html">Editar perfil</a></li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li><a class="dropdown-item" href="#" onclick="logOut()">Cerrar sesión</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                    </div>
                </nav>
            `);
        } else {
            sweetAlert(3, DATA.error, false, 'index.html');
        }
    }
}

const loadTemplate6 = async () => {
    // Petición para obtener en nombre del usuario que ha iniciado sesión.
    const DATA = await fetchData(USER_API, 'getUser');
    // Se verifica si el usuario está autenticado, de lo contrario se envía a iniciar sesión.
    if (DATA.session) {
        // Se comprueba si existe un alias definido para el usuario, de lo contrario se muestra un mensaje con la excepción.
        if (DATA.status) {
            // Se agrega el encabezado de la página web antes del contenido principal.
            MAIN.insertAdjacentHTML('beforebegin', `
                <br>
                <nav class="navbar navbar-expand-lg navbar-dark static-top" id="fondo">
                    <div class="container">
                            <!-- Se llama a la imagen -->
                            <a class="navbar-brand" href="../admin/inicio.html">
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
                                        <a class="nav-link" href="../admin/inicio.html">INICIO</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="../admin/productos.html">PRODUCTOS</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="../admin/categorias.html">CATEGORÍAS</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="../admin/marcas.html" >MARCAS</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="../admin/empleados.html">EMPLEADOS</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="../admin/clientes.html" id="clientes">CLIENTES</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="../admin/pedidos.html">PEDIDOS</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="../admin/valoraciones.html">VALORACIONES</a>
                                    </li>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">Cuenta: <b>${DATA.username}</b></a>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="../admin/perfil.html">Editar perfil</a></li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li><a class="dropdown-item" href="#" onclick="logOut()">Cerrar sesión</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                    </div>
                </nav>
            `);
        } else {
            sweetAlert(3, DATA.error, false, 'index.html');
        }
    }
}

const loadTemplate7 = async () => {
    // Petición para obtener en nombre del usuario que ha iniciado sesión.
    const DATA = await fetchData(USER_API, 'getUser');
    // Se verifica si el usuario está autenticado, de lo contrario se envía a iniciar sesión.
    if (DATA.session) {
        // Se comprueba si existe un alias definido para el usuario, de lo contrario se muestra un mensaje con la excepción.
        if (DATA.status) {
            // Se agrega el encabezado de la página web antes del contenido principal.
            MAIN.insertAdjacentHTML('beforebegin', `
                <br>
                <nav class="navbar navbar-expand-lg navbar-dark static-top" id="fondo">
                    <div class="container">
                            <!-- Se llama a la imagen -->
                            <a class="navbar-brand" href="../admin/inicio.html">
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
                                        <a class="nav-link" href="../admin/inicio.html">INICIO</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="../admin/productos.html">PRODUCTOS</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="../admin/categorias.html">CATEGORÍAS</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="../admin/marcas.html" >MARCAS</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="../admin/empleados.html">EMPLEADOS</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="../admin/clientes.html">CLIENTES</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="../admin/pedidos.html" id="pedidos">PEDIDOS</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="../admin/valoraciones.html">VALORACIONES</a>
                                    </li>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">Cuenta: <b>${DATA.username}</b></a>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="../admin/perfil.html">Editar perfil</a></li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li><a class="dropdown-item" href="#" onclick="logOut()">Cerrar sesión</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                    </div>
                </nav>
            `);
        } else {
            sweetAlert(3, DATA.error, false, 'index.html');
        }
    }
}

const loadTemplate8 = async () => {
    // Petición para obtener en nombre del usuario que ha iniciado sesión.
    const DATA = await fetchData(USER_API, 'getUser');
    // Se verifica si el usuario está autenticado, de lo contrario se envía a iniciar sesión.
    if (DATA.session) {
        // Se comprueba si existe un alias definido para el usuario, de lo contrario se muestra un mensaje con la excepción.
        if (DATA.status) {
            // Se agrega el encabezado de la página web antes del contenido principal.
            MAIN.insertAdjacentHTML('beforebegin', `
                <br>
                <nav class="navbar navbar-expand-lg navbar-dark static-top" id="fondo">
                    <div class="container">
                            <!-- Se llama a la imagen -->
                            <a class="navbar-brand" href="../admin/inicio.html">
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
                                        <a class="nav-link" href="../admin/inicio.html">INICIO</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="../admin/productos.html">PRODUCTOS</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="../admin/categorias.html">CATEGORÍAS</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="../admin/marcas.html" >MARCAS</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="../admin/empleados.html">EMPLEADOS</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="../admin/clientes.html">CLIENTES</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="../admin/pedidos.html">PEDIDOS</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="../admin/valoraciones.html" id="valoracion">VALORACIONES</a>
                                    </li>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">Cuenta: <b>${DATA.username}</b></a>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="../admin/perfil.html">Editar perfil</a></li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li><a class="dropdown-item" href="#" onclick="logOut()">Cerrar sesión</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                    </div>
                </nav>
            `);
        } else {
            sweetAlert(3, DATA.error, false, 'index.html');
        }
    }
}