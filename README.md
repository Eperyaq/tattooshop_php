# TATTOO SHOP

Fork este repo

# Sentencia para crear las tablas 

CITAS: 
CREATE TABLE citas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    descripcion TEXT NOT NULL,
    fecha_cita DATETIME NOT NULL,
    cliente VARCHAR(150) NOT NULL,
    tatuador_id INT NOT NULL,
    FOREIGN KEY (tatuador_id) REFERENCES tatuadores(id) ON DELETE CASCADE
);


TATUADORES:
CREATE TABLE tatuadores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    foto VARCHAR(255),
    creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

## EJERCICIO CLASE

Una vez analizado el código que os suministro vamos a realizar un ejercicio que ponga en práctica la inserción de otros datos en la base de datos y la realización de operaciones de validación sobre dichas inserciones.

### EJERCICIO 1. INSERCIÓN DE TATUADOR EN LA BASE DE DATOS
Desarrolla una parte de la aplicación que permita dar de alta a nuevos tatuadores en nuestra base de datos. Deberás seguir las siguientes indicaciones:

1. *Tabla de la base de datos*
La tabla que almacenará a los tatuadores dentro de nuestra base de datos se llamará "**tatuadores**" y contendrá los siguientes campos.

| Campo    | Tipo de Dato          | Tamaño | Descripción                |
|----------|----------------------|--------|----------------------------|
| id       | INT AUTO_INCREMENT   | -      | Identificador único       |
| nombre   | VARCHAR              | 100    | Nombre del usuario        |
| email    | VARCHAR              | 150    | Correo electrónico único  |
| password | VARCHAR              | 255    | Contraseña     |
| foto     | VARCHAR              | 255    | URL de la foto de perfil  |
| creado_en | TIMESTAMP DEFAULT CURRENT_TIMESTAMP | - | Fecha de creación |

#### Explicación de la Tabla:
- **`id`**: Identificador único (clave primaria).
- **`nombre`**: Almacena hasta 100 caracteres.
- **`email`**: Almacena hasta 150 caracteres y es único.
- **`password`**: Hasta 255 caracteres (permite almacenar contraseñas)
- **`foto`**: URL o ruta de la imagen del usuario.
- **`creado_en`**: Guarda la fecha y hora de creación automáticamente.

2. *Clases PHP y lógica de aplicación*
Debemos controlar desde el fichero **`index.php`** que cuando llegue una petición a la URI *`/tattooshop_php/tatuadores/alta`* se llame al *Controller* de Tatuadores para que, o bien se muestre el formulario que permita dar de alta un nuevo tatuador, o bien que se realice la inserción del tatuador en la base de datos.

#### Explicación de las peticiones
- **`/tattooshop_php/tatuadores/alta`** y **`REQUEST_METHOD = GET`**: Se muestra el formulario de alta.
- **`/tattooshop_php/tatuadores/alta`** y **`REQUEST_METHOD = POST`**: Se realiza el alta del tatuador en la BD.

#### Explicación de la lógica de aplicación
- **`TatuadorController.php`**: Clase que se encarga de mostrar las vistas relacionadas con Tatuadores y de llamar al `TatuadorModel.php` para interactuar con la base de datos.
- **`TatuadorModel.php`**: Clase que se encarga de interactuar con la base de datos. Contendrá métodos para insertar, leer, modificar y eliminar registros de la tabla `tatuadores` de la base de datos.
- **`TatuadorViews`**: Diferentes ficheros que contendrán las vistas relacionadas con Tatuadores.
    - `TatuadorAltaView.php`: Fichero que contiene el formulario de alta de Tatuadores.
    - `TatuadorAltaCorrectaView.php`: Fichero que contiene una página para mostrar un mensaje al usuario para indicarle que el alta ha ido bien.

- **Validaciones de los campos**: Comprobar que los campos introducidos en el formulario de alta de tatuadores son correctos:
    -`id` -> El id se pone automáticamente (auto-incremental), así que no se debe incluir en el formulario.
    - `nombre`: Comprobar que el campo no venga vacío.
    - `email`: Comprobar que siga el formato de email correcto.
    - `password`: Comprobar que el campo no venga vacío.
    - `foto`: VOSOTRO DECIDÍS CÓMO TRATAR ESTE CAMPO.
    - `creado_en`: La fecha y la hora no se pide en el formulario, sino que se establece automáticamente.
Si alguno de los campos del formulario no se validan correctamente, debe mostrarse un mensaje en rojo indicando el error.


### EJERCICIO 2. SELECT EN CITAS CON TODOS LOS NOMBRES DE LOS TATUADORES
Realizar un `<select>` en el formulario de alta citas que muestre todos los nombres de los tatuadores disponibles en la base de datos.

### EJERCICIO 3. PÁGINA INFORMATIVA DE ALTA DE CITA.
Realizar una página que cuando se dé de alta una cita nueva le aparezca al usuario la siguiente información:

- ``Mensaje``: Mensaje informativo de que se ha dado de alta la cita correctamente.
- ``Fecha de la cita``: Fecha y hora de la cita seleccionada.
- ``Descripción de la cita``: Descripción de la cita escrita por el usuario.
- ``Nombre del cliente``: Nombre del cliente escrito por el usuario.
- ``Nombre del tatuador``: Nombre del tatuador seleccionado por el usuario.
- ``Email del tatuador``: Email del tatuador seleccionado por el usuario.
- ``Foto del tatuador``: Foto del tatuador que ha seleccionado el usuario (este dato lo vais a tener que sacar de la base de datos).

La disposición de los elementos no es importante, lo único importante es que aparezca la información que os indico.


