<?php

class Block {
    
    public $id;
    public $name;
    public $description = "";
    public $editor = "lp.block";
    public $internal = false;
    
    static $list = array();
    
    static function register() {
        $cls = get_called_class();
        $obj = new $cls;
        self::$list[$obj->id] = $obj;
        
        if (!$obj->internal) TemplaterApi::addAction('getComponents',function($api,&$components) use ($obj) {
            $components[$obj->id] = array(
                'name' => $obj->name,
                'description' => $obj->description,
                'category' => 'Common',
                
                'area' => false,
                'update' => function ($val,$dataSource,$api,$edit) use ($obj) {
                    return array(
                        'html' => $obj->getHtml($val,$edit)
                    );
                },
                'clientControl' => $obj->editor
            );
        });        
    }
    
    function __construct() {
        $this->id = get_class($this);
        $this->tpl_count = 1;
        for ($i=2;;$i++) {
            $name = 'tpl_'.$i;
            if (method_exists($this,$name)) {
                $this->tpl_count++;
            } else {
                break;
            }
        }
    }
    
    function getHtml($val,$edit,$name=false) {
        $this->edit = $edit;
        ob_start();
        
        $current = (int)@$val['variant'];
        $current = min($current,$this->tpl_count);
        $current = max($current,1);
        
        
        if ($this->internal) {
            $this->val = $val;
            $this->tpl($this->val);
        } else {
            for ($i=1;$i<=$this->tpl_count;$i++) {
                if (method_exists($this,"tpl_default_$i")) {
                    $default = $this->{"tpl_default_$i"}();
                } else {
                    $default = array();
                }
                $this->default_val = $default;

                if ($current==$i) {
                    $this->val = array_replace($default,$val);
                } else {
                    $this->val = $default;
                }

                if ($edit && !$this->internal) {
                    $default_json = htmlspecialchars(json_encode((object)$default),ENT_QUOTES);
                    echo "<div data-variant='$i' data-default='$default_json'>";
                    $this->{"tpl_$i"}($this->val);
                    echo "</div>";
                } 
                elseif ($current==$i) {
                    $this->{"tpl_$i"}($this->val);
                }
            }
        }
        
        $tpl = ob_get_clean();
        
        if ($edit) {
            $editor = $this->editor ? 'data-editor="'.$this->editor.'"' : "";
            $name = $name ? 'data-name="'.$name.'"' : "";
            $current = $this->tpl_count > 1 ? 'data-current="'.$current.'"':"";
            return "<div $editor $name $current>".$tpl."</div>";
        } else {
            return "<div>".$tpl."</div>";
        }
    }
    
    function tpl($val) {
    }
    
    function tpl_default() {
        return array();
    }
    
    function tpl_1($val) {
        return $this->tpl($val);
    }
                    
    function tpl_default_1() {
        return $this->tpl_default();
    }
    
    function sub($type,$name) {
        $obj = @self::$list[$type];
        if ($obj) {
            $sub = @$this->val[$name];
            $name = $this->repeating ? $this->repeating.".".$name : $name;
            
            echo $obj->getHtml($sub,$this->edit,$name);
        }
    }
    
    function repeat($name,$f) {
        $list = array_values(@$this->val[$name] ?:array());
        
        if ($this->edit) {
            echo '<div data-editor="lp.repeater" data-name="'.$name.'">';
        } else {
            echo "<div>";
        }
        
        $old_val = $this->val;
        foreach ($list as $i=>$sub) {
            $this->repeating = $name.".".$i;
            $this->val = $sub;
            echo "<div>";
            $f($sub,$this);
            echo "</div>";
        }
        
        if ($this->edit) {
            $def_item = @$this->default_val[$name][0] ?:array();
            $this->val = $def_item;
            echo "<div data-dummy='1'>";
            $f($def_item,$this);
            echo "</div>";
        }
        
        $this->repeating = false;
        $this->val = $old_val;
        echo "</div>";
    }
}
