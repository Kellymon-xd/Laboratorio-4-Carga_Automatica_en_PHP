# Laboratorio: Implementación de Autoload PSR-4 con Composer

Estudiante: Kelly Beitia  
Cédula: 8-1023-152  
Universidad Tecnológica de Panamá  
Materia: Desarrollo de Software VII  
Fecha: 27 de abril de 2026


## Introducción

El objetivo de este laboratorio es implementar la carga automática de clases (**Autoload**) bajo el estándar **PSR-4** utilizando Composer.

Se busca eliminar la dependencia de sentencias manuales como `include` o `require`, organizando el código mediante **namespaces** y optimizando la escalabilidad del proyecto PHP.

## Estructura y Estándar PSR-4

El estándar **PSR-4** describe una especificación para la carga automática de clases desde rutas de archivos. En este proyecto, se ha establecido la siguiente relación:

- **Namespace raíz:** `App\`

- **Directorio fuente:** `src/`

- **Mapeo:** Cualquier clase bajo el namespace `App\` se buscará automáticamente dentro de la carpeta `src/`.

---

## 1. Preparar la Estructura de Carpetas

En la terminal, nos ubicamos en el directorio del servidor local:

```dos
C:\xampp\htdocs\P\PHP\Carga_Automática_en_PHP>
```

Aseguramos la existencia de la carpeta de código fuente:

```bash
mkdir src
mkdir src/Models
```

Esta estructura permitirá organizar las clases del proyecto siguiendo una jerarquía clara y compatible con el estándar PSR-4.

---

## 2. Configurar Composer

Creamos el archivo `composer.json` en la raíz del proyecto con la configuración del mapa de carga automática:

```json
{
    "name": "proyecto/autoload-psr4",
    "description": "Implementación de Autoload PSR-4",
    "type": "project",
    "autoload": {
        "psr-4": {
            "App\\": "src/"
        }
    },
    "require": {}
}
```

Este archivo indica a Composer que el prefijo `App\` corresponde a la carpeta `src/`.

De esta manera, cualquier clase ubicada dentro de `src/` podrá ser cargada automáticamente siempre que respete el namespace correspondiente.

---

## 3. Generar el Autoloader

Ejecutamos el comando de Composer para procesar el archivo JSON y generar los archivos necesarios dentro de la carpeta `vendor/`:

```bash
composer dump-autoload
```

Este paso es crucial, ya que crea el archivo:

```bash
vendor/autoload.php
```

Este será el único archivo que necesitaremos incluir manualmente en el punto de entrada del proyecto.

---

## 4. Crear los Modelos con Métodos Get

Se crearon dos clases dentro de `src/Models/` para demostrar el funcionamiento del mapeo de nombres.

### Clase User

Archivo:

```bash
src/Models/User.php
```

Código:

```php
<?php
namespace App\Models;

class User {
    private $username;
    private $email;

    public function __construct($username, $email) {
        $this->username = $username;
        $this->email = $email;
    }

    public function getUsername() { 
        return $this->username; 
    }

    public function getEmail() { 
        return $this->email; 
    }
}
```

Esta clase representa un usuario básico con los atributos `username` y `email`, accedidos mediante métodos `get`.

---

### Clase Product

Archivo:

```bash
src/Models/Product.php
```

Código:

```php
<?php
namespace App\Models;

class Product {
    private $name;
    private $price;

    public function __construct($name, $price) {
        $this->name = $name;
        $this->price = $price;
    }

    public function getName() { 
        return $this->name; 
    }

    public function getPrice() { 
        return $this->price; 
    }
}
```

Esta clase representa un producto con los atributos `name` y `price`, también accedidos mediante métodos `get`.

---

## 5. Punto de Entrada y Prueba de Funcionamiento

Editamos el archivo `index.php` en la raíz del proyecto para validar la carga automática de clases:

```php
<?php
// Único requerimiento necesario
require_once __DIR__ . '/vendor/autoload.php';

use App\Models\User;
use App\Models\Product;

$usuario = new User("dev_user", "test@utp.ac.pa");
$producto = new Product("Monitor 24", 150.00);

echo "Usuario: " . $usuario->getUsername() . PHP_EOL;
echo "Producto: " . $producto->getName() . " - $" . $producto->getPrice() . PHP_EOL;
```

En este archivo solo se incluye manualmente `vendor/autoload.php`. Luego, las clases `User` y `Product` se cargan automáticamente mediante Composer.

---

## 6. Resultado Esperado

Al ejecutar el archivo `index.php`, el resultado esperado es:

```bash
Usuario: dev_user
Producto: Monitor 24 - $150
```

Esto confirma que Composer pudo localizar y cargar correctamente las clases dentro de la carpeta `src/Models/` usando el namespace `App\Models`.

---

## 7. Conclusiones Técnicas

Durante el laboratorio se observaron las siguientes ventajas críticas:

- **Mantenibilidad:** Se pueden añadir cientos de clases en `src/` y el sistema las reconocerá sin necesidad de modificar el archivo `index.php` o agregar múltiples instrucciones `require`.

- **Eficiencia de memoria:** PHP solo carga en memoria el archivo de la clase cuando esta es instanciada, utilizando un comportamiento conocido como **Lazy Loading**.

- **Estandarización:** El uso de PSR-4 permite que el proyecto sea compatible con herramientas modernas de PHP y facilita el trabajo colaborativo mediante una jerarquía de carpetas predecible.

- **Escalabilidad:** La estructura facilita el crecimiento del proyecto, ya que nuevas clases pueden organizarse en subcarpetas manteniendo el mismo namespace base.

---

## 8. Fuentes Bibliográficas

PHP-FIG. (2026). PSR-4: Autoloader.  
https://www.php-fig.org/psr/psr-4/

Composer Documentation. (2026). Basic usage and Autoloading.  
https://getcomposer.org/doc/01-basic-usage.md

W3Schools. (2026). PHP Namespaces.  
https://www.w3schools.com/php/php_namespaces.asp

---

Este laboratorio ha sido desarrollado por el estudiante de la Universidad Tecnológica de Panamá:

Nombre: Kelly Beitia

Correo: kellysteffany10@gmail.com

Curso: Desarrollo de Software VII

Instructor del Laboratorio: Ing. Irina Fong
