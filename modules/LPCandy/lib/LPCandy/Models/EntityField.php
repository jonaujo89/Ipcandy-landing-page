<?php

namespace LPCandy\Models;

/**
* @Entity
* @Table(name="lp_entity_fields")
*/
class EntityField extends \ActiveEntity
{
    /**
     * @Id @Column(type="integer")
     * @GeneratedValue
     */
    public $id;
    
    /** @Column(length=100) */
    public $name;
    
    /** @Column(length=20000) */
    public $value;

    /**
     * @ManyToOne(targetEntity="Entity")
     * @JoinColumn(name="entity_id", referencedColumnName="id",onDelete="CASCADE")
     */
    public $entity;    
}