<?php
namespace app\models\entities;

class Ticket {
    public int $ticket_id;
    public string $type;
    public int $quantity_available;
    public ?\DateTime $sale_start;
    public ?\DateTime $sale_end;
    public ?int $max_per_order;
    public \DateTime $created_at;
    public \DateTime $updated_at;
    public int $event_id;
    public int $user_id;
}