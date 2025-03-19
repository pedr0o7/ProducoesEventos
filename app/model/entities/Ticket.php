<?php

class TicketDTO
{
    public $id;
    public $type;
    public $quantity_available;
    public $sale_start;
    public $sale_end;
    public $max_per_order;
    public $created_at;
    public $updated_at;
    public $event_id;
    public $user_id;


    public function setId($id)
    {
        $this->id = $id;
    }
    public function getId()
    {
        return $this->id;
    }
    public function setType($type)
    {$this->type = $type;}
    public function getType()
    {return $this->type;}

    public function setQuantity_available($quantity_available)
    {$this->quantity_available = $quantity_available;}
    public function getQuantity_available()
    {return $this->quantity_available;}

    public function setSale_start($sale_start)
    {$this->sale_start = $sale_start;}
    public function getSale_start()
    {return $this->sale_start;}

    public function setSale_end($sale_end)
    {$this->sale_end = $sale_end;}
    public function getSale_end()
    {return $this->sale_end;}

    public function setMax_per_order($max_per_order)
    {$this->max_per_order = $max_per_order;}
    public function getMax_per_order()
    {return $this->max_per_order;}

    public function setCreated_at($created_at)
    {$this->created_at = $created_at;}
    public function getCreated_at()
    {return $this->created_at;}

    public function setUpdated_at($updated_at)
    {$this->updated_at = $updated_at;}
    public function getUpdated_at()
    {return $this->updated_at;}

    public function setEvent_id($event_id)
    {$this->event_id = $event_id;}
    public function getEvent_id()
    {return $this->event_id;}

    public function setUser_id($user_id)
    {$this->user_id = $user_id;}
    public function getUser_id()
    {return $this->user_id;}

   

    public function setTicket($type, $quantity_available, $sale_start, $sale_end, $max_per_order, $event_id, $user_id
    ) {
        $this->type = $type;
        $this->quantity_available = $quantity_available;
        $this->sale_start = $sale_start;
        $this->sale_end = $sale_end;
        $this->max_per_order = $max_per_order;
        $this->event_id = $event_id;
        $this->user_id = $user_id;
       

    }
    public function getTicket()
    {
        return [
            'type' => $this->type,
            'quantity_available' => $this->quantity_available,
            'sale_start' => $this->sale_start,
            'sale_end' => $this->sale_end,
            'max_per_order' => $this->max_per_order,
            'event_id' => $this->event_id,
            'user_id' => $this->user_id,
        ];
    }
}
