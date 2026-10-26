![Logo](./laravel/public/img/iconoProyecto.png)
# Golpass - Memoria del Proyecto

**Desarrollo de Aplicaciones Web**  
**Autores:** Lesrry David Rios Fernandes y Lesrry Daniel Rios Fernandes  
**Tutor / Docente:** Gustavo Milan  
**Centro:** IES EL CAÑAVERAL — Departamento de Informática / Informática y Comunicaciones  
**Fecha:** 18 de mayo de 2026  

---

## ÍNDICE

1. [Introducción](#1--introducción)  
   1.1. [Descripción y contexto del proyecto](#11--descripción-y-contexto-del-proyecto)  
   1.2. [Motivación del proyecto](#12--motivación-del-proyecto)  
   1.3. [Beneficios esperados](#13--beneficios-esperados)  
2. [Objetivo/s generales del proyecto](#2--objetivos-generales-del-proyecto)  
3. [Objetivos específicos](#3--objetivos-específicos)  
4. [Contexto actual](#4--contexto-actual)  
5. [Análisis de requisitos](#5--análisis-de-requisitos)  
   5.1. [Diagrama de casos de uso](#51--diagrama-de-casos-de-uso)  
   5.2. [Requisitos funcionales principales](#52--requisitos-funcionales-principales)  
   5.3. [Requisitos no funcionales](#53--requisitos-no-funcionales)  
   5.4. [Descripción de los usuarios y sus necesidades](#54--descripción-de-los-usuarios-y-sus-necesidades)  
6. [Diseño de la aplicación](#6--diseño-de-la-aplicación)  
   6.1. [Mockups / wireframes / prototipos](#61--mockups-o-wireframes-o-prototipos)  
   6.2. [Arquitectura del sistema](#62--arquitectura-del-sistema)  
   6.3. [Diagramas de clases y Entidad-Relación](#63--diagramas-de-clases-y-de-entidad-relación)  
   6.4. [Diseño de la base de datos](#64--diseño-de-la-base-de-datos)  
7. [Desarrollo de la aplicación](#7--desarrollo-de-la-aplicación)  
   7.1. [Tecnologías y herramientas utilizadas](#71--tecnologías-y-herramientas-utilizadas)  
   7.2. [Descripción de las principales funcionalidades e ilustración de código](#72--descripción-de-las-principales-funcionalidades)  
8. [Planificación del proyecto](#8--planificación-del-proyecto)  
   8.1. [Acciones](#81--acciones)  
   8.2. [Temporalización y secuenciación (Diagrama de Gantt)](#82--temporalización-y-secuenciación)  
9. [Pruebas y validación](#9--pruebas-y-validación)  
10. [Relación del proyecto con los módulos del ciclo](#10--relación-del-proyecto-con-los-módulos-del-ciclo)  
11. [Conclusiones](#11--conclusiones)  
12. [Proyectos futuros](#12--proyectos-futuros)  
13. [Bibliografía / Webgrafía](#13--bibliografía--webgrafía)  
14. [Anexos](#14--anexos)  

---

## 1.- Introducción

En el mundo actual, la digitalización está cada vez más presente en la vida cotidiana a tal punto de reemplazar ciertas actividades manuales por un entorno más cómodo, dinámico e interactivo para la gran mayoría de los usuarios. Sin embargo, hay actividades que aún siguen persistiendo de forma tradicional, como ocurre en los deportes, específicamente el fútbol (uno de los deportes más practicados a nivel global). A partir de ello, surge el proyecto **Golpass**.

### 1.1.- Descripción y contexto del proyecto
Golpass es una aplicación web enfocada a la venta de entradas para partidos de fútbol, tomando como referencia a un equipo en concreto.

### 1.2.- Motivación del proyecto
Nuestra pasión irreversible por el deporte y el mundo de la información digital está a la orden de la gran mayoría de las personas; no obstante, el problema principal que podemos encontrar es la forma o lugar en la que pagamos por una entrada para un partido de fútbol de algún equipo preferido. La actividad de pagar de forma presencial es agotadora por las largas filas en taquilla y los servicios que ofrecen en los sitios web oficiales de los equipos no son del todo agradables para los usuarios. Nuestra solución es desarrollar una aplicación web para mejorar la utilidad, con una navegación intuitiva y diseños legibles y minimalistas, para que cualquier persona, sin importar su edad, pueda recibir una experiencia agradable y cómoda.

### 1.3.- Beneficios esperados
1. **Reducción de Costes Operativos:** Ahorro significativo en el mantenimiento de taquillas físicas.
2. **Gestión Centralizada:** El historial de ventas se gestiona desde un único panel administrativo.
3. **Análisis del Comportamiento:** Conocer qué sector del estadio es el más demandado.

---

## 2.- Objetivo/s generales del proyecto

Fomentar la productividad remota y reducir la fabricación de entradas físicas que, a largo plazo, no es sostenible.

---

## 3.- Objetivos específicos

1. Diseño de una web moderna.
2. Escalabilidad.
3. Buen rendimiento.

---

## 4.- Contexto actual

### Estado del arte
Hoy en día, los sistemas de reserva de entradas y gestión de asientos (*ticketing*) han evolucionado desde plataformas estáticas hacia aplicaciones altamente interactivas en tiempo real.

* **Sistemas Comerciales Globales (Ticketmaster, SeatGeek):** Utilizan arquitecturas distribuidas complejas capaces de soportar picos masivos de tráfico. Su núcleo se basa en la actualización inmediata del estado de los asientos para evitar la sobreventa (*double-booking*).
* **Enfoques modernos de desarrollo:** La tendencia actual combina potentes frameworks de backend (como Laravel) con capas de reactividad asíncrona. En lugar de delegar todo el peso a frameworks pesados de Frontend como React o Vue (que requieren desarrollo de APIs e incrementan la complejidad), soluciones como **Laravel Livewire** permiten crear interfaces dinámicas en tiempo real (como el mapa de asientos interactivo que implementamos) manteniendo la lógica de negocio puramente en el servidor de forma segura.

### Conceptos clave
* **Autenticación y Autorización Manual:** Proceso de verificación de la identidad de un usuario y el control de sus privilegios de acceso a rutas protegidas (como la reserva de asientos) mediante la manipulación directa de sesiones con la fachada `Auth` de Laravel, prescindiendo de paquetes automáticos.
* **Normalización de Base de Datos:** Técnica de diseño de bases de datos que organiza las tablas para reducir la redundancia. En este proyecto se aplica separando la cabecera de la compra (`orders`) de los ítems individuales adquiridos (`entradas`).
* **Transacción de Base de Datos (`DB::transaction`):** Mecanismo que asegura que un conjunto de operaciones en la base de datos se ejecute por completo o no se ejecute en absoluto. Es crucial al crear una orden junto con múltiples entradas asociadas: si falla la inserción de una sola entrada, toda la operación se revierte (*rollback*).
* **Estado Pendiente (Pending State):** Estado temporal en el ciclo de vida de una orden que bloquea temporalmente los recursos (asientos/entradas) mientras el usuario decide proceder al pago o abandonar el flujo.

---

## 5.- Análisis de requisitos

### 5.1.- Diagrama de casos de uso

El sistema contempla dos actores principales: **Cliente** y **Administrador**.

* **Casos de uso del Cliente:**
  * Crear cuenta
  * Mostrar y editar cuenta (Incluye: *Validar acceso*, *Actualizar datos*)
  * Confirmar reserva (Incluye: *Validar acceso*)
  * Cancelar entrada (Incluye: *Comprobar fecha pago / partido*)
  * Visualizar Carrito (Incluye: *Ejecutar pago*)
  * Ver partidos disponibles / finalizados
* **Casos de uso del Administrador:**
  * Administrar cuentas (Incluye: *Validar acceso*)
  * Registrar Entradas (Incluye: *Validar acceso*)
  * Registrar partidos (Incluye: *Validar acceso*)
  * Registrar equipos (Incluye: *Validar acceso*)

---

### 5.2.- Requisitos funcionales principales

* **RF-1 (Gestión de Autenticación):** El sistema debe permitir el registro de usuarios con confirmación obligatoria de contraseña, el inicio de sesión y el cierre seguro de la sesión (vía POST con protección CSRF).
* **RF-2 (Mapa de Asientos Interactivo):** El sistema debe renderizar dinámicamente el estado de los asientos de un sector (Disponible, Reservado, Vendido) variando su paleta de colores.
* **RF-3 (Persistencia de Reservas):** Al pulsar "Confirmar Reserva", el sistema debe generar de manera atómica un registro en la tabla de órdenes (`orders`) con estado pendiente y tantas entradas (`entradas`) asociadas como asientos hayan sido seleccionados.
* **RF-4 (Contador de Estado Asíncrono):** El sistema debe reflejar en tiempo real la cantidad de órdenes o reservas pendientes del usuario mediante un indicador visual en el encabezado global.
* **RF-5 (Carrito de Compras):** El sistema debe listar las órdenes pendientes del usuario, detallando el partido, sector, números de asiento y costo total, ofreciendo una vía para proceder al pago final.

---

### 5.3.- Requisitos no funcionales

* **Seguridad (Autenticidad y Confidencialidad):** Las contraseñas se almacenan mediante algoritmos de hash seguros (`bcrypt`). Todas las solicitudes que alteren el estado del servidor (como logout o creación de órdenes) deben incluir tokens criptográficos contra ataques CSRF (`@csrf`). Las rutas críticas de compra requieren obligatoriamente una sesión activa.
* **Rendimiento:** El tiempo de respuesta medio para la renderización de la selección de asientos debe ser inferior a 300 ms gracias a la comunicación AJAX nativa que realiza Livewire internamente.
* **Integridad de Datos:** No se deben permitir registros huérfanos. Si un usuario se elimina, sus órdenes deben eliminarse en cascada (`onDelete('cascade')`). No es factible que dos usuarios adquieran el mismo asiento para el mismo partido gracias a las transacciones de base de datos a nivel de aislamiento.

---

### 5.4.- Descripción de los usuarios y sus necesidades

* **Usuario Anónimo (Invitado):** Necesita explorar los partidos disponibles y visualizar la distribución del estadio, pero el sistema le restringe interactuar de forma transaccional. Su necesidad principal es un flujo claro de login/registro cuando decide comprar.
* **Usuario Cliente (Autenticado):** Es el actor principal. Requiere agilidad para elegir múltiples asientos, verificar los importes económicos en tiempo real sin recargas de página, revisar el estado de sus pedidos pendientes en un carrito centralizado y finalizar el pago de forma segura.

---

## 6.- Diseño de la aplicación

### 6.1.- Mockups o wireframes o prototipos
Se han diseñado prototipos adaptables (Responsive Design) para escritorio, tabletas y dispositivos móviles bajo el eslogan *"Vive la pasión del fútbol ahora con Golpass"*.

### 6.2.- Arquitectura del sistema
La aplicación implementa una arquitectura Cliente-Servidor estructurada bajo el patrón Modelo-Vista-Controlador (MVC), potenciada por una capa reactiva de Livewire:

* **Modelo (M):** Clases Eloquent (`Order`, `Entrada`, `User`, etc.) que mapean las estructuras de la base de datos y encapsulan las relaciones de negocio.
* **Vista (V):** Plantillas Blade que combinan HTML5 estructurado con directivas de Tailwind CSS para el diseño visual.
* **Controlador (C):** `OrderController` actúa como orquestador del ciclo de vida tradicional (petición POST, validación mediante Form Requests y redirección), sirviendo además de puente hacia las clases dinámicas de Livewire que manejan el estado en segundo plano.

---

### 6.3.- Diagramas de clases y de entidad-relación

#### Lógica de Diagrama de Clases UML
1. **Modelos como Clases:** Cada modelo PHP se convierte en una clase UML: `User`, `Order`, `Asiento`, `Equipo`, `Reservacion`, `Partido`, `Pago`, `Entrada`, y `Estadio`.
2. **Atributos de Clase:**
   * `+id: integer`: Clave primaria heredada de Eloquent.
   * **Campos `$fillable`:** Listados como atributos públicos (`+`). Ejemplo: `User` (`+name: string`, `+email: string`); `Asiento` (`+sector: string`, `+fila: string`, `+numero: integer`).
   * **Casting y Enums:** Las propiedades con casting de Eloquent se reflejan directamente (`User` $\rightarrow$ `+role: UserRole`, `Order` $\rightarrow$ `+status: StatusOrder`, `Pago` $\rightarrow$ `+payload_completo: array`, `Partido` $\rightarrow$ `+precio_base: decimal`, `+fecha: datetime`, `+finalizado: boolean`).
3. **Métodos de Clase (Operaciones):**
   * **Métodos de Relación:** Listados con su tipo de retorno Eloquent (`+orders(): HasMany`, `+partido(): BelongsTo`, `+reservacion(): HasOne`, etc.).
   * **Métodos Adicionales:** Lógica de utilidad como `User::canAccessPanel(Panel): bool` o `Asiento::getStatusColor(seleccionados: array): string`.

#### Lógica del Diagrama Entidad-Relación (ER)
1. **Tablas (Entidades):** `users`, `orders`, `asientos`, `equipos`, `reservaciones`, `partidos`, `pagos`, `entradas`, `estadios`.
2. **Relaciones (Cardinalidades):**
   * `User - Order` (1:*): Un usuario puede tener muchas órdenes.
   * `User - Reservacion` (1:*): Un usuario puede tener varias reservaciones.
   * `Partido - Entrada` (1:*): Un partido tiene múltiples entradas vendidas.
   * `Order - Pago` (1:*): Una orden admite múltiples intentos o registros de pago.
   * `Order - Entrada` (1:*): Una orden agrupa múltiples entradas.
   * `Estadio - Partido` (1:*): Un estadio alberga varios partidos.
   * `Equipo - Partido` (1:* local / 1:* visitante): Vía `equipo_local_id` y `equipo_visitante_id`.
   * `Asiento - Partido` (*:1): Múltiples asientos pertenecen a un partido.
   * `Asiento - Reservacion` (1:1): Un asiento se asigna a una única reserva activa.
   * `Asiento - Entrada` (1:1): Un asiento específico para un partido equivale a una única entrada vendida.

---

### 6.4.- Diseño de la base de datos: esquemas y tablas

El modelo de datos relacional se compone de las tablas principales conectadas mediante llaves foráneas (`FK`), garantizando la integridad referencial y facilitando el mantenimiento.

---

## 7.- Desarrollo de la aplicación

### 7.1.- Tecnologías y herramientas utilizadas

* **PHP:** Lenguaje base del backend, seleccionado por su robustez y tipado dinámico en lógica empresarial.
* **Laravel Framework:** Framework MVC que aporta el ORM Eloquent, motor de plantillas Blade y herramientas de autenticación segura.
* **Laravel Livewire:** Ejecución de código reactivo en tiempo real desde el frontend mediante AJAX automático sin escribir APIs extensas en JS.
* **Tailwind CSS:** Framework de diseño orientado a utilidades CSS para componentes responsivos.
* **Git & GitHub:** Control de versiones e historial de desarrollo.
* **VSCode:** Entorno de desarrollo integrado con extensiones como Intelephense.
* **PHP Filament:** Panel administrativo para el back-office del proyecto.
* **DBeaver:** Cliente de gestión de base de datos SQL.

---

### 7.2.- Descripción de las principales funcionalidades

#### 1. Flujo Transaccional de Creación de Órdenes y Tickets (Componente Livewire)

```php
public function confirmarReserva()
{
    if (empty($this->asientosSeleccionados)) return;

    try {
        $newOrder = DB::transaction(function () {
            // 1. Crear la Orden
            $order = \App\Models\Order::create([
                'user_id' => Auth::id(),
                'numero_pedido' => 'ORD-' . strtoupper(uniqid()),
                'precio_total' => 15.00,
                'cantidad_total' => count($this->asientosSeleccionados),
                'status' => \App\Enums\StatusOrder::PENDIENTE,
            ]);

            // 2. Crear las Entradas vinculadas
            foreach ($this->asientosSeleccionados as $asientoId) {
                $order->entradas()->create([
                    'partido_id' => $this->partido->id,
                    'asiento_id' => $asientoId,
                    'status' => \App\Enums\StatusEntrada::RESERVADO,
                    'precio_final' => 15.00,
                    'codigo_qr' => 'QR-' . strtoupper(uniqid()),
                ]);

                // 3. Actualizar estado del asiento físico
                \App\Models\Asiento::where('id', $asientoId)->update([
                    'status' => 'reservado'
                ]);
            }

            return $order;
        });

        // 4. Limpiar selección y redirigir
        $this->asientosSeleccionados = [];
        session()->flash('message', 'Reserva creada correctamente.');
        return redirect()->route('user-cart');

    } catch (Exception $e) {
        throw $e;
    }
}
```

---

#### 2. Cancelación y Liberación de Reservas en el Carrito (`UserCart`)

```php
public function eliminarOrden($orderId)
{
    $order = Order::with('entradas.asiento')
        ->where('id', $orderId)
        ->where('user_id', Auth::id())
        ->first();

    if ($order) {
        try {
            DB::transaction(function () use ($order) {
                // 1. Recorremos las entradas para liberar los asientos físicos
                foreach ($order->entradas as $entrada) {
                    if ($entrada->asiento) {
                        $entrada->asiento->update([
                            'status' => 'disponible'
                        ]);
                    }
                }

                // 2. Borramos las entradas relacionadas
                $order->entradas()->delete();

                // 3. Finalmente borramos la orden
                $order->delete();
            });

            $this->dispatch('alert', 'Reserva cancelada y asientos liberados.');
        } catch (Exception $e) {
            $this->dispatch('alert', 'Error al cancelar la reserva.');
        }
    }
}
```

---

#### 3. Vista Blade del Carrito (`user-cart.blade.php`)

```html
<div class="max-w-7xl mx-auto py-6">
    <h2 class="text-2xl font-bold flex items-center gap-2 mb-4">
        <span>Mi Carrito de Entradas</span>
    </h2>

    @forelse($orders as $order)
        <div class="bg-white shadow rounded-lg overflow-hidden border border-gray-100 mb-6">
            <div class="bg-gray-50 px-6 py-4 border-b flex justify-between items-center">
                <div>
                    <p class="text-xs text-gray-500 uppercase font-bold tracking-wider">Número de Pedido</p>
                    <p class="font-mono text-indigo-700 font-bold">{{ $order->numero_pedido }}</p>
                </div>
                <div class="text-right">
                    <p class="text-xs text-gray-500 uppercase font-bold tracking-wider">Fecha</p>
                    <p class="text-gray-700">{{ $order->created_at->format('d/m/Y H:i') }}</p>
                </div>
            </div>

            <ul class="divide-y divide-gray-100">
                @foreach($order->entradas as $entrada)
                    <li class="px-6 py-3 flex justify-between items-center">
                        <div class="flex items-center gap-3">
                            <div>
                                <p class="font-bold text-gray-800">
                                    {{ $entrada->partido->equipoLocal->nombre }} vs {{ $entrada->partido->equipoVisitante->nombre }}
                                </p>
                                <p class="text-xs text-gray-500">
                                    Asiento: <span class="font-semibold text-gray-700">{{ $entrada->asiento->numero }}</span> | 
                                    Sector: <span class="font-semibold text-gray-700">{{ $entrada->asiento->sector }}</span>
                                </p>
                            </div>
                        </div>
                        <p class="font-bold text-gray-900">{{ number_format($entrada->precio_final, 2) }} €</p>
                    </li>
                @endforeach
            </ul>

            <div class="bg-indigo-50 px-6 py-4 flex justify-between items-center">
                <p class="text-sm text-indigo-900 font-bold">Total</p>
                <p class="text-2xl font-black text-indigo-700">{{ number_format($order->cantidad_total * 15, 2) }} €</p>
                
                <div class="flex space-x-3">
                    <button wire:click="eliminarOrden({{ $order->id }})" 
                            wire:confirm="¿Estás seguro de que quieres cancelar esta reserva?"
                            class="text-red-600 hover:text-red-800 font-semibold text-sm">
                        Cancelar
                    </button>
                    <a href="#" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg font-bold shadow">
                        Pagar Ahora con Stripe
                    </a>
                </div>
            </div>
        </div>
    @empty
        <div class="text-center py-12 bg-white rounded-lg border-2 border-dashed border-gray-200">
            <p class="text-gray-500 font-medium mb-4">No tienes reservas pendientes de pago</p>
            <a href="{{ route('partidos.index') }}" class="text-indigo-600 font-bold hover:underline">
                Ir a ver partidos
            </a>
        </div>
    @endforelse
</div>
```

---

## 8.- Planificación del proyecto

### 8.1.- Acciones

* **Bloque 1: Cimientos y Autenticación Manual**
  * Diseño y ejecución de migraciones iniciales (`users`).
  * Construcción del controlador de autenticación manual (`AuthController`).
  * Implementación de formularios de Login y Registro con validaciones.
* **Bloque 2: Frontend Reactivo e Interactivo**
  * Diseño del componente Livewire para renderizado dinámico de asientos del estadio.
  * Gestión de estado temporal para selección de asientos.
  * Estilización visual de estados (Disponible, Reservado, Vendido) con Tailwind CSS.
* **Bloque 3: Lógica de Negocio y Transacciones**
  * Diseño de modelos y migraciones para `orders` y `entradas`.
  * Desarrollo de la lógica transaccional atómica en `OrderController`.
  * Integración de formularios Livewire con el flujo de persistencia.
* **Bloque 4: Carrito e Integración Visual**
  * Construcción del componente `UserCart`.
  * Incorporación del contador analítico de reservas en el encabezado global.
  * Refactorización y optimización de código.

---

### 8.2.- Temporalización y secuenciación

#### Mes 1
| Actividades | Días 1-5 | 6-8 | 9-10 | 11-14 | 15 | 16-17 | 18-19 | 20 | 21 | 22-23 | 24-26 | 27-30 |
| :--- | :---: | :---: | :---: | :---: | :---: | :---: | :---: | :---: | :---: | :---: | :---: | :---: |
| Desarrollo diagrama UML | X | | | | | | | | | | | |
| Evaluación e instalación de herramientas | | X | | | | | | | | | | |
| Crear modelos, controladores y migraciones | | | X | | | | | | | | | |
| Desarrollo de Panel administrativo | | | | X | | | | | | | | |
| Desplegar primera versión en GitHub | | | | | X | | | | | | | |
| Crear requests y rutas a modelos | | | | | | X | | | | | | |
| Agregar modelos desarrollados al panel admin | | | | | | | X | | | | | |
| Corrección de lógica del proyecto | | | | | | | | X | | | | |
| Personalizar panel administrativo | | | | | | | | | X | | | |
| Desarrollo de APIs Entrada | | | | | | | | | | X | | |
| Desarrollo de Enums | | | | | | | | | | | X | |
| Creación de dashboard | | | | | | | | | | | | X |

#### Mes 2
| Actividades | S1 | S2 | S3 | S4 |
| :--- | :---: | :---: | :---: | :---: |
| Finalización y control de acceso del dashboard | X | | | |
| Generación de layout y página de selección de entradas | X | | | |
| Desarrollo de modelos, migraciones y seeders secundarios | | X | | |
| Casteo de Enumeradores y Resources de Dashboard | | X | | |
| Agregación de estilos en tablas de dashboard | | | X | |
| Creación de componentes, rutas y API-REST | | | X | |
| Modificación de modelos, vistas y selección de equipos | | | | X |

#### Mes 3
| Actividades | Semanas |
| :--- | :--- |
| Integración de Stripe | Semana 1 |
| Creación de nuevos componentes y controladores | Semana 1 |
| Desarrollo de login de usuario | Semana 2 |
| Autorización de rutas y sistema de carrito | Semana 2-3 |
| Desarrollo de sistema de pago | Semana 3-4 |

---

## 9.- Pruebas y validación

Se realizaron pruebas de características (*Feature Tests*) e integración para validar el flujo completo de reserva, garantizando la cohesión entre UI, lógica de negocio y persistencia en la base de datos.

* **DBeaver:** Verificación de consistencia y relaciones de datos en las tablas SQL.
* **Livewire Test Suite:** Validación de la experiencia de usuario y ejecución de acciones reactivas.
* **Thunder Client:** Extensión de VSCode para evaluar endpoints y estructura JSON de respuestas.

---

## 10.- Relación del proyecto con los módulos del ciclo

* **Desarrollo Web en Entorno Servidor:** Lógica en PHP, Laravel, manejo de sesiones, validaciones, Enums y transacciones con base de datos.
* **Desarrollo Web en Entorno Cliente:** Reactividad asíncrona mediante Livewire y AJAX.
* **Despliegue de Aplicaciones Web:** Configuración de entornos, uso de Git/GitHub, herramientas de orquestación y bases de datos.
* **Diseño de Interfaces Web:** Estilización con Tailwind CSS, prototipado UI/UX responsivo y accesible.

---

## 11.- Conclusiones

* **Eficiencia arquitectónica mediante Normalización:** El desacoplamiento en un modelo estructurado de Órdenes (`orders`) y Entradas (`entradas`) demostró ser idóneo para la escalabilidad. Permite mantener una base de datos limpia, facilita la emisión de códigos QR únicos por entrada y simplifica la consulta del historial de compras.
* **Integridad de Datos Garantizada (Atomicidad):** La ejecución de compras mediante `DB::transaction` garantiza que ante cualquier fallo se reviertan todas las inserciones, evitando datos huérfanos o transacciones incompletas.
* **Seguridad y Control de Flujo Centralizado:** El uso explícito de fachadas nativas (`Auth`, `Request`), middlewares de autenticación y tokens `@csrf` ofrece un entorno robusto frente a accesos indebidos.

---

## 12.- Proyectos futuros

* **Integración de Inteligencia Artificial:** Desarrollo de algoritmos para estimar demanda, cuantificación de frecuencia y generación de rankings dinámicos de partidos.
* **Aplicación Móvil:** Extensión del ecosistema a una app móvil nativa/híbrida para iOS y Android con acceso por código QR en puerta.

---

## 13.- Bibliografía / Webgrafía

* Documentación oficial de Tailwind CSS: [https://tailwindcss.com/docs/installation/using-vite](https://tailwindcss.com/docs/installation/using-vite)
* Documentación oficial de Livewire: [https://livewire.laravel.com/docs/4.x/quickstart](https://livewire.laravel.com/docs/4.x/quickstart)
* Documentación oficial de Laravel Framework: [https://laravel.com/docs/13.x](https://laravel.com/docs/13.x)
* Documentación oficial de Filament PHP: [https://filamentphp.com/docs](https://filamentphp.com/docs)

---

## 14.- Anexos

*(Sección reservada para documentación complementaria del proyecto)*