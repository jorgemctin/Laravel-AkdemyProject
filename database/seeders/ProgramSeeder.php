<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('programs')->insert([
            // [
            //     'name' => 'Javascript',
            //     'description' => 'Adéntrate en el dinámico mundo de JavaScript, con su versatilidad y capacidad para interactuar con el navegador, JavaScript permite crear experiencias web cautivadoras y en tiempo real. Desde interactividad hasta animaciones y desarrollo de aplicaciones complejas, JavaScript se convierte en la piedra angular del frontend y backend. Únete a nuestra comunidad de desarrolladores y desata todo el potencial de JavaScript para llevar tus proyectos web al siguiente nivel. ¡Embárcate en esta emocionante travesía para definir el futuro digital con tus habilidades en JavaScript!',
            //     'price' => '570',
            //     'image' => 'images/javascript.webp',
            // ],
            // [
            //     'name' => 'PHP',
            //     'description' => 'Descubre el poder de PHP, el corazón de las aplicaciones web modernas. Con PHP, podrás construir servidores robustos y escalables, gestionando datos y lógica de forma eficiente. Desde manejar bases de datos hasta crear APIs sólidas, PHP te brinda el control total sobre la funcionalidad y rendimiento de tus aplicaciones. Únete a nuestra formación especializada y desbloquea todo el potencial de PHP para llevar tus habilidades en el backend al siguiente nivel. ¡Prepárate para crear una experiencia web excepcional!',
            //     'price' => '550',
            //     'image' => 'images/php.webp',
            // ],
            // [
            //     'name' => 'Python',
            //     'description' => 'Explora Python, el lenguaje que enamora a millones de desarrolladores en todo el mundo. Con su sintaxis elegante y versatilidad, resolver problemas complejos será sencillo y emocionante. Desde IA hasta desarrollo web, Python tiene todo lo que necesitas para crear proyectos asombrosos. ¡Únete a nuestra academia y desata tu creatividad sin límites!',
            //     'price' => '580',
            //     'image' => 'images/python.webp',
            // ],
            // [
            //     'name' => 'Ciberseguridad',
            //     'description' => 'Sumérgete en el apasionante mundo de la ciberseguridad, donde la protección y defensa de datos se convierte en una misión crucial. Descubre técnicas de vanguardia para salvaguardar sistemas y redes contra amenazas cibernéticas. Conviértete en un guardián digital experto, protegiendo información valiosa y manteniendo a salvo el mundo conectado. ¡Únete a nuestra academia y prepárate para defender con éxito el futuro digital!',
            //     'price' => '700',
            //     'image' => 'images/ciber.webp',
            // ],
            // [
            //     'name' => 'React',
            //     'description' => 'Aprende React, la biblioteca JavaScript que cautiva a millones de desarrolladores en todo el mundo. Con su enfoque en la construcción de interfaces de usuario eficientes y reactivas, resolver desafíos en el desarrollo web será una experiencia fluida y emocionante. Desde la creación de aplicaciones de una sola página (SPA) hasta la gestión de complejas interfaces de usuario, React ofrece todo lo necesario para crear proyectos asombrosos. ¡Únete a nuestra comunidad y desata tu creatividad sin límites mientras construyes interfaces modernas y dinámicas para la web!',
            //     'price' => '600',
            //     'image' => 'images/react.webp',
            // ],
            // [
            //     'name' => 'Node.js',
            //     'description' => 'Ingresa en el mundo de Node.js, la plataforma de tiempo de ejecución de JavaScript que ha cautivado a millones de desarrolladores en todo el mundo. Con su arquitectura basada en eventos y su enfoque en la programación asíncrona, resolver problemas de manejo de servidores y aplicaciones en tiempo real será una experiencia eficiente y emocionante. Desde la creación de servidores web escalables y rápidos hasta aplicaciones de red en tiempo real, Node.js ofrece todo lo que necesitas para crear proyectos asombrosos. ¡Únete a nuestra comunidad y desata tu creatividad sin límites mientras desarrollas aplicaciones y servicios de alto rendimiento con JavaScript en el lado del servidor!',
            //     'price' => '500',
            //     'image' => 'images/nodejs.webp',
            // ],
        ]);
    }
}
