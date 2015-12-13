<?php

namespace C3P0\App;



class EvangelistStatus
{
    protected $username;
    protected $api_client;
    protected $status;
    public function __construct($username, $api_client)
    {
        $this->username = $username;
        $api_client->setUsername($username);
        $this->api_client = $api_client;
        $this->defineValue();
    }

    public function getStatus()
    {
        return $this->getStatusQuote();
    }

    protected function defineValue()
    {
        $count = $this->api_client->getRepositoriesCount();

        if ($count >= 5 && $count <= 10) {
            $this->status = "Junior Evangelist";
        } elseif ($count >= 11 && $count<= 20) {
            $this->status = "Associate Evangelist";
        } elseif ($count >= 21) {
            $this->status = "Senior Evangelist";
        } else {
            $this->status = "Baby Evangelist";
        }
    }

    protected function getStatusQuote()
    {
        switch($this->status)
        {
            case 'Junior Evangelist':
                return "Junior Evangelist: Real knowledge is to know the extent of one's ignorance";
            case 'Associate Evangelist':
                return "Associate Evangelist: You have come far, but your journey is not yet near end, fight harder";
            case 'Senior Evangelist':
                return 'Senior Evangelist: Coffee price increased because of you, mighty and powerful :(';
            default:
                return 'You have no place yet on the aisle where Legends of debugging stand, fight brave and harder';
        }
    }
}
