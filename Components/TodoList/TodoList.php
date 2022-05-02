<?php

    #COMPONENTE

    function TodoList () {

        return implode('',[
            h1(1,'todos'),
            kvtag('form',[
                'id' => 'form'
            ],[
                input([
                    'type' => "text",
                    'class' => "input", 
                    'id' => "input", 
                    'placeholder' => "Enter your todo", 
                    'autocomplete' => "off"
                ]),
                kvtag_('ul',[
                    'class' => "todos", 
                    'id' => "todos"
                ])
            ]),
            _tag('small',[
                'left click to toggle completed.',
                br(),
                'right click to delete todo'
            ])
        ]);
            
        
    }

?>