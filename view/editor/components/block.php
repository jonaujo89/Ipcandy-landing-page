<?php

namespace LPCandy\Components;

class Block {
    
    public $id;
    public $name;
    public $description = "";
    public $editor = "lp.block";
    public $internal = false;
    
    static $list = array();
    
    static function get() {
        $cls = get_called_class();
        $id = end(explode("\\",$cls));
        
        if (!isset(self::$list[$id])) {
            $obj = new $cls;
            $obj->id = $id;
            self::$list[$id] = $obj;
        }
        return self::$list[$id];
    }
    
    static function registerAll() {
        foreach (get_declared_classes() as $cls) {
            if (strpos($cls,"LPCandy\\Components")===0) {
                $cls::register();
            }
        }
    }
    
    static function register() {
        $obj = self::get();
        if ($obj->id=='Block') return;
        
        if (!$obj->internal) \TemplaterApi::addAction('getComponents',function($api,&$components) use ($obj) {
            $components[$obj->id] = array(
                'name' => $obj->name,
                'description' => $obj->description,
                'category' => 'Блоки',
                
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
    
    function getHtml($val,$edit,$name=false,$options=false) {
        $this->edit = $edit;
        $this->name_prefix = $name;
        ob_start();
        
        $current = (int)@$val['variant'];
        $current = min($current,$this->tpl_count);
        $current = max($current,1);
        
        if ($this->internal) {
            $this->val = $val;
            $this->tpl($this->val,$name);
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
                    $this->{"tpl_$i"}($this->val,$name);
                    echo "</div>";
                } 
                elseif ($current==$i) {
                    $this->{"tpl_$i"}($this->val,$name);
                }
            }
        }
        
        $tpl = ob_get_clean();
        $this->name_prefix = false;
        
        if ($edit) {
            $editor = $this->editor ? 'data-editor="'.$this->editor.'"' : "";
            $name = $name ? 'data-name="'.$name.'"' : "";
            $current = $this->tpl_count > 1 ? 'data-current="'.$current.'"':"";
            if ($options) {
                $options = htmlspecialchars(json_encode((object)$options),ENT_QUOTES);
                $options = "data-options='$options'";
            } else {
                $options = '';
            }
            return "<div $editor $name $current $options>".$tpl."</div>";
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
    
    function vis($sub) {
        if ($sub || $this->edit) {
            return $sub ? 'visible' : 'hidden';
        }
        return '';
    }
    
    function bg_style($bg) {
        if (isset($bg['url']))
            return 'background:url('.INDEX_URL.'/'.$bg['url'].')';
        else
            return 'background:'.$bg['color'];
    }
    
    static function text() {
        $id = get_called_class();
        if (!isset(self::$list[$id])) {
            $obj = new $id;
            self::$list[$id] = $obj;
        }
        return self::$list[$id];
    }
    
    function sub($type,$name,$options=false) {
        $obj = @self::$list[$type];
        if ($obj) {
            if ($name && $name[0]=="@" && $this->name_prefix) {
                $name = substr($name,1);
                $sub = @$this->val_prefix[$name];
            } else {
                $sub = @$this->val[$name];
                $name = $this->name_prefix ? $this->name_prefix.".".$name : $name;
            }
            $obj->val_prefix = $this->val;
            $obj->parent = $this;
            echo $obj->getHtml($sub,$this->edit,$name,$options);
            $obj->parent = false;
        } else {
            throw new \Exception("Block type is not registered $type");
        }
    }
    
    function repeat($name,$f,$options=false) {
        $list = array_values(@$this->val[$name] ?:array());
        
        if ($this->edit) {
            $data_options = $options ? "data-options='".htmlspecialchars(json_encode((object)$options),ENT_QUOTES)."'" : "";
            $editor = @$options['editor'] ?: "lp.repeater";
            echo "<div data-editor='".$editor."' data-name='".$name."' $data_options>";
        } else {
            echo "<div>";
        }
        
        $this->val_prefix = $this->val;
        foreach ($list as $i=>$sub) {
            $this->name_prefix = $name.".".$i;
            
            $this->val = $sub;
            echo "<div class='item_block'>";
            $f($sub,$this);
            echo "</div>";
        }
        
        if ($this->edit) {
            $def_item = @$this->default_val[$name][0] ?:array();
            $this->val = $def_item;
            echo "<div class='item_block' data-dummy='1'>";
            $f($def_item,$this);
            echo "</div>";
        }
        
        $this->name_prefix = false;
        $this->val = $this->val_prefix;
        echo "</div>";
    }
}
