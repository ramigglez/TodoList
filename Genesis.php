<?php
/*
require_once './BoilerplateP4wsClasses.php';
require_once './BoilerplateP4wsFunctions.php';
*/

########################################################################-------COMPONENTS------------###

    #/*Component Piece : "TodoList"
        require_once './Components/TodoList/Components/TodoList/TodoList.php';
    ###*/

#-------COMPONENTS------------###

$todos = block([

    doct(),

    html([

        head([

            meta_charset(),

            meta_viewport(),

            title('Todo List'),

            _link(),

            kvtag_('link',[
                'rel' => 'icon',
                'type' => 'image/png',
                'href' => './favicon/puzzle.png'
            ]),

            #/*Component Piece : "TodoList"
                kvtag_('link',[ 
                    'rel' => 'stylesheet',
                    'href' => './Components/TodoList/TodoList.css'
                ])
            ###*/

        ]),

        body([

            #/*Component Piece : "TodoList"
                TodoList(),
            ###*/

            #/*Component Piece : "TodoList"
                kvtag_('script',[
                    'src' => './Components/TodoList/TodoList.js'
                ]),
            ###*/

            main_script(),

            fa_script()

        ])

    ])

],'Piezas4WebSites -> RamiGGlez 00');

$uno_igual_a_formato_json_cero_ejecuta_html = 1;