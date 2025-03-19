<?php

class EventDTO
{
    public $id;
    public $title;
    public $start_datetime;
    public $end_datetime;
    public $status;
    public $cover_image_url;
    public $created_at;
    public $update_at;
    public $description;
    public $organizer_id;
    public $adress_id;
    public $category_id;
    public $price;
    public $tickets_available;

    public function setId($id)
    {
        $this->id = $id;
    }
    public function getId()
    {
        return $this->id;
    }
    public function setTitle($title)
    {$this->title = $title;}
    public function getTitle()
    {return $this->title;}

    public function setStart_datetime($start_datetime)
    {$this->start_datetime = $start_datetime;}
    public function getStart_datetime()
    {return $this->start_datetime;}

    public function setEnd_datetime($end_datetime)
    {$this->end_datetime = $end_datetime;}
    public function getEnd_datetime()
    {return $this->end_datetime;}

    public function setStatus($status)
    {$this->status = $status;}
    public function getStatus()
    {return $this->status;}

    public function setCover_image_url($cover_image_url)
    {$this->cover_image_url = $cover_image_url;}
    public function getCover_image_url()
    {return $this->cover_image_url;}

    public function setCreated_at($created_at)
    {$this->created_at = $created_at;}
    public function getCreated_at()
    {return $this->created_at;}

    public function setUpdate_at($update_at)
    {$this->update_at = $update_at;}
    public function getUpdate_at()
    {return $this->update_at;}

    public function setDescription($description)
    {$this->description = $description;}
    public function getDescription()
    {return $this->description;}

    public function setOrganizer_id($organizer_id)
    {$this->organizer_id = $organizer_id;}
    public function getOrganizer_id()
    {return $this->organizer_id;}

    public function setAdress_id($adress_id)
    {$this->adress_id = $adress_id;}
    public function getAdress_id()
    {return $this->adress_id;}

    public function setCategory_id($category_id)
    {$this->category_id = $category_id;}
    public function getCategory_id()
    {return $this->category_id;}

    public function setPrice($price)
    {$this->price = $price;}
    public function getPrice()
    {return $this->price;}

    public function setTickets_available($tickets_available)
    {$this->tickets_available = $tickets_available;}
    public function getTickets_available()
    {return $this->tickets_available;}

    public function setEvent($title, $start_datetime, $end_datetime, $status, $cover_image_url, $description, $organizer_id, $adress_id, $category_id, $price, $tickets_available
    ) {
        $this->title = $title;
        $this->start_datetime = $start_datetime;
        $this->end_datetime = $end_datetime;
        $this->status = $status;
        $this->cover_image_url = $cover_image_url;
        $this->description = $description;
        $this->organizer_id = $organizer_id;
        $this->adress_id = $adress_id;
        $this->category_id = $category_id;
        $this->price = $price;
        $this->tickets_available = $tickets_available;

    }
    public function getEvent()
    {
        return [
            'title' => $this->title,
            'start_datetime' => $this->start_datetime,
            'end_datetime' => $this->end_datetime,
            'status' => $this->status,
            'cover_image_url' => $this->cover_image_url,
            'description' => $this->description,
            'organizer_id' => $this->organizer_id,
            'adress_id' => $this->adress_id,
            'category_id' => $this->category_id,
            'price' => $this->price,
            'tickets_available' => $this->tickets_available,
        ];
    }
}
