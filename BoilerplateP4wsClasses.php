<?php

class Boilerplate {

    protected string|null $element = null;

    public function __construct ($tag = 'html',$type = 0,$attrs = [],$content = []) {

        $this->element = "<$tag".$this->__attrs($type,$attrs).">".$this->__content($content)."</$tag>";

    }

    protected function __attrs (int $type = 0,array $attrs) {
        $attributes = '';
        if ($type === 0) {
            foreach ($attrs as $key => $value) {
                $attributes .= " ".$key."='".$value."'";
            }
        }elseif ($type === 1){
            for ($i = 0; $i < count($attrs); $i++) {
                $attributes .= " ".$attrs[$i];
            }
        } else {
            if (array_key_exists('kv',$attrs) && array_key_exists('il',$attrs)) {
                foreach ($attrs['kv'] as $key => $value) {
                    $attributes .= " ".$key."='".$value."'";
                }
                for ($i = 0; $i < count($attrs['il']); $i++) {
                    $attributes .= " ".$attrs['il'][$i];
                }
            }else{
                die('Claves Incorrectas ... Utiliza kv & il para combinar atributos');
            }
        }
        return $attributes;
    }

    protected function __content ($content) {
        $data = null;
        if (is_array($content)) {
            for ($i = 0; $i < count($content); $i++) {
                if (is_array($content[$i])) {
                    $data .= $this->__content($content[$i]);
                } else {
                    $data .= $content[$i];
                }
            }
        }else{
            $data = $content;
        }
        return $data;
    }

    public function get () : string {
        return $this->element;
    }

}

class Bplate extends Boilerplate {

    public function __construct ($tag,$type,$attrs) {
        if ($tag === '!DOCTYPE') {
            $this->element = "<$tag".$this->__attrs($type,$attrs).">";
        }else{
            $this->element = "<$tag".$this->__attrs($type,$attrs)."/>";
        }
    }

}

class Block extends Boilerplate {

    protected $data = null;

    public function __construct ($data) {
        $this->data = $this->__content($data);
    }

    public function _get ($previous_hash_OR_block_name = 'genesis') {

        $nonce = 0;

        $data = [
            'html' => $this->data,
            'previous' => $previous_hash_OR_block_name
        ];

        $this->data .= '  '.$nonce;

        do {
            $content = explode('  ',$this->data);
            $nonce++;
            $content[1] = $nonce;
            $this->data = implode('  ',$content);
            $data = [
                'html' => $this->data,
                'previous' => $previous_hash_OR_block_name
            ];
            $hash = hash('sha256',implode('',$data));
            $aux = substr($hash,0,2);
        } while ($aux !== '00');

        return json_encode([
            'hash' => $hash,
            'previous' => $previous_hash_OR_block_name,
            'data' => htmlspecialchars($this->data)
        ]);
    }

}

class Piezas4websitesClass extends Block {

    private string $txt = '';

    public function __construct (string $txt = 'hello world.') {
        $this->txt = $txt;
    }

    public function getTxt () : string {
        return $this->txt;
    }

    public function setTxt (string $txt) {
        $this->txt = $txt;
    }

    public function createHeaderString ($tag, $attr, $x = 0) {
        
        $attributes = '';
        foreach ($attr as $key => $value) {
            $attributes .= " ".$key."='".$value."'";
        }
        if ($x === 0) {
            return "<{$tag}{$attributes}>";
        }else{
            return "</{$tag}>";
        }
        
    }

    public function _createHeaderString ($tag, $attrs, $x = 0) {
        
        $attributes = '';
        for ($i = 0; $i < count($attrs); $i++) {
            $attributes .= " ".$attrs[$i];
        }
        if ($x === 0) {
            return "<{$tag}{$attributes}>";
        }else{
            return "</{$tag}>";
        }
        
    }
    /*
    *@param keys $mixed = [
        "keyval" => [],
        "inline" => []
    ]
    */
    public function createAttrsMixedList (array $mixed = []) {
        $attributes = '';
        if (array_key_exists('keyval',$mixed) && array_key_exists('inline',$mixed)) {
            foreach ($mixed['keyval'] as $key => $value) {
                $attributes .= " ".$key."='".$value."'";
            }
            for ($i = 0; $i < count($mixed['inline']); $i++) {
                $attributes .= " ".$mixed['inline'][$i];
            }
            return $attributes;
        } else {
            echo "<script>alert('the keys are not valid.');</script>";
        }
    }

}