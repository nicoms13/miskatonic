Miskatonic
La aplicación consiste en una plataforma destinada a la lectura de vídeos de forma online. 

- Usuarios: Podrá acceder como un usuario normal creando su cuenta, usando un usuario ya creado ('user1','123') o como adminitrador ('adminuser', '123').

- Base de Datos: Aunque se llame loginmiskatonic, contiene todas las tablas nececesarias para el correcto funcionamiento de la aplicación.

- Carpetas: La organización de los archivos esta hecha de la siguiente forma:

    - Carpeta raíz: Se encuentra las diferentes páginas que forman la  aplicación, con sus correspondientes hojas de estilos.

    - /admin: Accesible solo con el usuario admin (indicado anteriormente), contiene los scripts necesarios para la gestión de la página. Más adelante le proporcionaré los archivos 
    necesarios por si desea probar la insercción tanto de un nuevo autor como de un libro.

    - /classes: Contiene las clases necesarias para la conexión a la base de datos, el logeo de la página y la creación de un nuevo usuario. La clase dbh se encarga de la conexión, y
    ha sido creada siguiendo el patrón Singleton. Las clases -contr se encargán de la gestión de los datos introducidos en el formulario login/registro respesctivamente, mientras que las
    que otras se encargán de la gestión de la base de datos.

    - /images: Contiene las imágenes excepto aquellas que son guardadas en el servidor. Explicaré el proecdimiento más adelante.

    - /includes: Contiene aquellos scripts encargados tan solo del redireccionamiento.

- Login: Los datos de los usuarios son almacenados en la tabla users. Tanto el login como el registro tienen su correspondiente validación de los datos cuando se envian, así que en el caso
de que cuando sean enviados contengan algún error se le notificará al usuario.

- Sesiones: Una sesión será creada cuando el usuario inicie sesión en la web. Podrá cerrar sesión en cualquier momenento pulsando el botón correspodniente que aparecerá en el menú. Además
podrá comprobar que el nombre de usuario aparecerá además en el menú. Las pagínas de autores y libros están protegidas para que solo si se ha iniciado sesión se pueda acceder a ellas, en
caso contrario le redigirá al Login. El tiempo de sesión es de 6 minutos.

- Autores: Desde el menú Autores (/autores.php) podrá ver todos loa autores que contiene la aplicación. Además, haciendo click sobre cualquiera de ellos le llevará a su correspondiente 
página (/autor.php) con los libros bajo su nombre.

- Libros: Podrá acceder a los libros desde el menú principal o desde su autor correspondiente. Haciendo click en cualquiera de ellos lo llevará a su correspondiente página (/book.php) con 
la información del libro y su enlace para poder leerlo.

- Imágenes (servidor): Las imágenes de libros y autores son almacenadas en el servidor web gratuito Imgur (https://imgur.com/), el cual le invito a usar para realizar una prueba de insercción
de datos en la web.

- Realizar una prueba de insercción de datos: Iniciando sesión como 'adminuser' podrá acceder al menú administrador. Allí encontrará el menú libros y autores, donde podrá hacer la gestión que
desee, tanto de adición, edición como borrado. A través de este link (https://imgur.com/a/SFFWY0r) podrá acceder a las imágenes necesarias para crear un nuevo autor (Bram Stoker) 
y un libro (Drácula). La primera imagen corresponde al Background del libro, la segunda a la IMG del libro, la tercera al Background del Autor, y la cuarta al Logo del autor. 
*Recuerde introducir primero el autor, o en caso contrario no podrá añadir el libro (de todas formas le aparecerá una alerta avisándole de que el autor que ha introducido no existe en la 
base de datos y no le permitirá añadir el libro)*. Una vez realizada la insercción podrá comprobar que tanto el autor como el libro aparecerán junto a los demás en la web.


Con ello creo haberle explicado todo lo necesario para navegar por la aplicación, si tiene alguna pregunta no dude en escribirme a nicolas.moreno.fp@iescampanillas.com
Un saludo.
