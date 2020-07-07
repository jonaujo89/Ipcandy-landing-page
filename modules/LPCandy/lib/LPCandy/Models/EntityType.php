<?php

namespace LPCandy\Models;

/**
* @Entity
* @Table(name="lp_entity_types")
*/
class EntityType extends \ActiveEntity
{
    /**
     * @Id @Column(type="integer")
     * @GeneratedValue
     */
    public $id;

    /** @Column(length=128) */ 
    public $name;

    /** @Column(type="boolean", options={"default":false}) */
    public $public_create;
    
    /** @Column(type="boolean", options={"default":false}) */
    public $public_edit;

    /** @Column(type="boolean", options={"default":false}) */
    public $public_read;

    /** @Column(type="boolean", options={"default":false}) */
    public $upload;
    
}