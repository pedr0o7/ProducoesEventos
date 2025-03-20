<?php
namespace app\models\entities;

class Event {
    public int $event_id;
    public string $title;
    public \DateTime $start_datetime;
    public \DateTime $end_datetime;
    public string $status;
    public ?string $cover_image_url;
    public \DateTime $created_at;
    public \DateTime $updated_at;
    public ?string $description;
    public int $organizer_id;
    public int $address_id;
    public int $category_id;
    public float $price;
    public int $tickets_available;
}