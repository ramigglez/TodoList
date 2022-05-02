<?php

/**doctype
 * El doctype es la etiqueta html 
 * que se coloca en primer lugar
 * en cualquier proyecto html
 */
function doct() {
    return (new Bplate('!DOCTYPE',1,['html']))->get();
}

/**html
 * Esta etiqueta es el 
 * contenedor de toda la
 * pagina web
 */
function html($content) {
    return (new Boilerplate('html',0,['lang'=>'en'],$content))->get();
}

/**head
 * Esta es la etiqueta 
 * en la cual se escribe
 * todo el codigo 
 * relacionado a la meta informacion
 */
function head($content) {
    return (new Boilerplate('head',0,[],$content))->get();
}

/**body
 * El cuerpo es la etiqueta
 * que se encarga de 
 * agrupar todos los 
 * elementos html que
 * conforman a la estructura
 * de la pagina web
 */
function body($content) {
    return (new Boilerplate('body',0,[],$content))->get();
}

/**meta 
 * Esta etiqueta nos sirve
 * para agregar meta informacion
 * en el head del documento
*/
function meta_charset() {
    return (new Bplate('meta',0,['charset'=>'UTF-8']))->get();
}

function meta_viewport() {
    return (new Bplate('meta',0,[
        'name'=>'viewport',
        'content'=>'width=device-width, initial-scale=1.0'
    ]))->get();
}

/**title
 * El titulo nos
 * sirve para agregar 
 * el texto que querramos 
 * al tab del navegador
 */
function title ($title='My Project 01') {
    return (new Boilerplate('title',0,[],$title))->get();
}

/**_link 
 * Con esta etiqueta 
 * podemos vincular archivos css
 * en el head del documento
*/
function _link() {
    return (new Bplate('link',0,['rel'=>'stylesheet','href'=>'./BoilerplateP4ws.css']))->get();
}

/**
 * br
 * etiqueta para generar
 * un salto de linea
 */
function br() {
    return (new Bplate('br',0,[]))->get();
}

/**
 * input
 * Etiqueta utilizada
 * para crear los
 * recursos necesarios
 * de un formulario
 */
function input($kv,$il = []) {
    return (new Bplate('input',2,[
        'kv' => $kv,
        'il' => $il
    ]))->get();
}

function fonts() {
    return implode('',[
        (new Bplate('link',0,['rel'=>'preconnect','href'=>'https://fonts.googleapis.com']))->get(),
        (new Bplate('link',2,[
                'kv'=>[
                        'rel'=>'preconnect',
                        'href'=>'https://fonts.gstatic.com'
                ],
                'il' => [
                    'crossorigin'
                ]
            ]))->get(),
        (new Bplate('link',0,['rel'=>'stylesheet','href'=>'https://fonts.googleapis.com/css2?family=Tapestry&display=swap']))->get()
    ]);
}

/**script
 * La etiqueta 
 * script nos
 * permite agregar codigo
 * javascript a el documento
 */
function main_script() {
    return (new Boilerplate('script',0,['src'=>'./BoilerplateP4ws.js']))->get();
}

function fa_script() {
    return (new Boilerplate('script',0,['src'=>'https://kit.fontawesome.com/e4f1b0b3a6.js','crossorigin'=>'anonymous']))->get();
}

/**focuspocus
 * Esta funcion
 * nos muestra el 
 * resultado por pantalla
 */
function focuspocus($genesis,$block = 0) {
    if($block === 0) {
        $genesis =  json_decode($genesis);

        $html = explode('  ',$genesis->data);

        echo html_entity_decode($html[0]);
    }else{
        echo $genesis;
    }
}

/**block
 * Esta funcion 
 * nos encapsula el 
 * codigo html en un 
 * bloque con su hash
 */
function block($blockData,$blockName = 'Genesis') {
    return (new Block ($blockData))->_get($blockName);
}

/**h1
 * Esta etiqueta es 
 * el encabezado 
 * mas grande
 */
function h1($size=1,$content='Expandibles Images Project 01/50') {
    return (new Boilerplate("h$size",0,[],$content))->get();
}

function doctype ($print = true) {
    $objeto = new Piezas4websitesClass;
    $doctype = $objeto->_createHeaderString('!DOCTYPE',['html']);
    if($print){
        echo $doctype;
    }else{
        return $doctype;
    }
}

function headp4ws ($content = null,$print = true) {
    $obj = new Piezas4websitesClass;
    $head = $obj->createHeaderString('head',[]);
    $_head = $obj->createHeaderString('head',[],1);
    if($print){
        echo $head;
        if ($content === null) {
            echo "<title>My Page</title>";
        } else {
            if (is_array($content)) {
                echo implode('',$content);
            } else {
                echo $content;
            }
        }
        echo $_head;
    }else{

        if ($content === null) {
            $element = $head."<title>My Page</title>".$_head;
        } else {
            if (is_array($content)) {
                $element = $head.implode('',$content).$_head;
            } else {
                $element = $head.$content.$_head;
            }
        }

        return $element;

    }
}

function mixedAttrList ($mixed = []) {
    $obj = new Piezas4websitesClass;
    $attrsList = $obj->createAttrsMixedList($mixed);
    return $attrsList;
}

function mixAttrTag ($tag,$attrs,$or = 0) {
    if ($or === 1) {
        return "</{$tag}>";
    } else {
        $attrsList = call_user_func('mixedAttrList',$attrs);
        return "<{$tag}{$attrsList}>";
    }
}

#standard (generic) tag function
function tag ($tag,$attrs,$content,$special_chars) {
    if ($attrs === null) {
        $tag_ = "<{$tag}>";
    } else {
        $tag_ = mixAttrTag($tag,$attrs);
    }
    $_tag = mixAttrTag($tag,null,1);
    if (is_array($content)) {
        $_content_ = implode('',$content);
    } else {
        $_content_ = $content;
    }
    if ($special_chars) {
        return htmlspecialchars($tag_.$_content_.$_tag);
    } else{
        return $tag_.$_content_.$_tag;
    }
    
}

#tag sin atributos
function _tag ($tag,$content,$special_chars = false) {

    return tag($tag,null,$content,$special_chars);

}

#tag vacia
function __tag ($tag,$special_chars = false) {

    return tag($tag,null,null,$special_chars);

}

#tag con atributos key => value
function kvtag ($tag,$attr,$content,$special_chars = false) {

    $keyVal = [
        'keyval' => $attr,
        'inline' => []
    ];

    return tag($tag,$keyVal,$content,$special_chars);

}

#tag con atributos key => value & empty
function kvtag_ ($tag,$attr,$special_chars = false) {

    $keyVal = [
        'keyval' => $attr,
        'inline' => []
    ];

    return tag($tag,$keyVal,null,$special_chars);

}

#tag con atributos inline
function iltag ($tag,$attr,$content,$special_chars = false) {

    $inLine = [
        'keyval' => [],
        'inline' => $attr
    ];

    return tag($tag,$inLine,$content,$special_chars);

}

#tag con atributos inline & empty
function iltag_ ($tag,$attr,$special_chars = false) {

    $inLine = [
        'keyval' => [],
        'inline' => $attr
    ];

    return tag($tag,$inLine,null,$special_chars);

}

function bodyp4ws (array $atttributes = [],$content = null,$print = true) {
    $obj = new Piezas4websitesClass;
    $body = $obj->createHeaderString('body',$atttributes);
    $_body = $obj->createHeaderString('body',[],1);
    if($print){
        echo $body;
        if ($content === null) {
            echo "<h3>Hello World.</h3>";
        } else {
            if (is_array($content)) {
                echo implode('',$content);
            } else {
                echo $content;
            }
        }
        echo $_body;
    }else{
        if ($content === null) {
            $element = $body."<h3>Hello World.</h3>".$_body;
        } else {
            if (is_array($content)) {
                $element = $body.implode('',$content).$_body;
            } else {
                $element = $body.$content.$_body;
            }
        }
        return $element;
    }
}

function page ($headContent = null,$bodyContent = null,array $bodyAttrs = [],$print = true) {
    $obj = new Piezas4websitesClass;
    $html = $obj->createHeaderString('html',['lang'=>'en']);
    $_html = $obj->createHeaderString('html',[],1);
    if($print){
        call_user_func("doctype");
        echo $html;
            headp4ws($headContent);
            bodyp4ws($bodyAttrs,$bodyContent);
        echo $_html;
    }else{
        $page = doctype(false).$html.head($headContent,false).body($bodyAttrs,$bodyContent,false).$_html;
        return htmlspecialchars($page);
    }
}

function article ( string|array $title, string|array $text, string $image, string $link, string|array $linkTxt , string|array $othTxt) {

    return kvtag('article',[
        'class' => 'project',
        'style' => 'margin: 1rem;'
    ],[
        _tag('h2',$title),
        kvtag('p',[
        'style' => 'font-size:40px'
        ],$othTxt),
        _tag('p',$text),
        kvtag_('img',[
            'src' => $image
        ]),
        kvtag('a',[
            'href' => $link,
            'class' => 'button',
            'target' => 'blank'
        ],$linkTxt)
    ]);

}