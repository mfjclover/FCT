# FCT
Programación de un servidor web donde los usuarios podrán almacenar, visualizar y editar ficheros de manera privada.

Definición de los requisitos, tanto a nivel de prestaciones como de seguridad:
● El servidor permitirá que los usuarios registrados puedan subir ficheros y alojarlos en una zona
privada, para desde ahí poder visualizarlos en el caso de imágenes, o ver y editar su contenido
en el caso de ficheros de texto. También se permitirá el borrado de ficheros.
● Cada usuario tendrá una cuota de espacio de almacenamiento a partir de la cual no podrá subir
nada más. También tendrá un tamaño máximo de fichero.
● Se permitirá registrar usuarios normales y además habrá usuarios con la categoría de
administrador, que tendrán acceso al contenido de todos los usuarios.
● El registro de usuarios se realizará guardando sus claves de manera cifrada con el sistema
blowfish.
● El acceso a urls no permitidas se controlará a través de variable de sesión.
