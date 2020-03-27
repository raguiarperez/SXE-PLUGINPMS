<?php
/*
 * Nombre del complemento: plugin_SXE_PMS
 * Descripción: este plugin censura las palabras mal sonantes
 * Versión: 1.1
 */

//Creacion de BBDD y creacion de tabla palabrotas
función  bb_dd () {
    global  $ dbTable ;
    
    $ charset_collate = $ dbTable -> get_charset_collate ();
    
    // Se asigna el prefijo a la tabla
    $ nombre_tabla = $ dbTable -> prefijo . 'palabrasmalsonantes' ;
    
    // Sentencia SQL Creacion de tabla
    $ sql = "CREATE TABLE $ table_name (
    palabramalsonante varchar (20) NO NULL,
    CLAVE PRIMARIA (palabramalsonante)
    ) $ charset_collate; " ;

    require_once ( ABSPATH . 'wp-admin / includes / upgrade.php' );
    dbDelta ( $ sql );
}

add_action ( 'plugins_loaded' , 'bb_dd' );

//Inserta las palabrotas en la tabla
función  insertar () {
    global  $ dbTable ;
    
    $ nombre_tabla = $ dbTable -> prefijo . "palabrasmalsonantes" ;
    
    $ dbTable -> insert ( $ nombre_tabla , matriz  ( "palabramalsonante" => "Cabrón" ));
    $ dbTable -> insert ( $ nombre_tabla , matriz ( "palabramalsonante" => "Subnormal" ));
    $ dbTable -> insert ( $ nombre_tabla , matriz  ( "palabramalsonante" => "Imbécil" ));
    $ dbTable -> insert ( $ nombre_tabla , matriz ( "palabramalsonante" => "idiota" ));
}
add_action ( 'plugins_loaded' , 'insertar' );

//Filtro de palabrotas existentes en la BBDD
función  filtrado ( $ texto ) {
    global  $ dbTable ;
    
    $ palabrotasArray = $ dbTable -> get_results ( "Seleccion de insulto" );
    $ pArray = array ();
    
    foreach ( $ palabrotasA como  $ valor ) {
        $ pArray [] = $ valor -> palabrota ;
    }
    return  str_replace ( $ pArray , '-------' , $ texto );
}

add_filter ( 'the_content' , 'filtrado' );
?>