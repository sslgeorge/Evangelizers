<?php

namespace C3P0\App;



class EvangelistStatus
{
    protected $username;
    protected $api_client;
    protected $status;

    public function __construct($username, APIClient $api_client)
    {
        $this->username = $username;
        //Set the username
        $api_client->setUsername($username);
        //Pass api_client instance to local property
        $this->api_client = $api_client;
        //define the value/level of the user with username above
        $this->defineValue();
    }

    public function getStatus()
    {
        try {
            //return the status quote for the user based on their level
            return $this->getStatusQuote();
        } catch(\UnexpectedValueException $ex) {
            return $ex->message();
        }
    }

    protected function defineValue()
    {
        //get the number of repos owned by this user
        $count = $this->api_client->getRepositoriesCount();

        //Based on the number in the variable $count, categorize users and set
        //status variable to the value
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
        if (is_null($this->status) || trim($this->status) == '' || empty($this->status)) {
            throw new \UnexpectedValueException("The value is not in the right formt");
        }
        //based on the status of the user return a quote
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
