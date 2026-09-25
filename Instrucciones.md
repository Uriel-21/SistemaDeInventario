# Lo que necesitas para poner a funcionar el proyecto

- Git
- Docker y Docker Compose

# Pasos para poner a trabajar el proyecto por primera vez

### Clonar el repositorio y entrar a la carpeta

Primero que tienes que hacer el fork después lo clonas y entras a la carpeta

_Clona el repositorio_ `git clone <URL_DEL_REPOSITORIO>`

_Entra a la carpeta_
`cd SistemaInvetarios`

### Configurar las variables de entorno (esto no te lo saltes por que si no no jala).

_Pon este comando en la consola_
`cp .env.example .env`

### Ahora tienes que levantar los contenedores

`docker compose up -d --build` _Se puede tardar un rato no te desesperes we_

### Ahora tienes que descargar las dependecias para Laravel

`docker exec -it SistemaInventarios composer install`

`docker exec -it SistemaInventarios php artisan key:generate`

`docker exec -it SistemaInventarios php artisan migrate`

### Después tienes que arrancar el FRONTEND

`docker exec -it app-node npm install`

`docker exec -it app-node npm run dev`

# Lo que vas hacer todos los días cuando vayas a trabajar

_Enciende el proyecto_ `docker compose up -d`

_Arranca el compilador de diseño_ `docker exec -it app-node npm run dev`

_Cuando termines de chambear pones esto_ `docker compose stro`
