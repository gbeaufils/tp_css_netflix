<?php


namespace App\Service;


use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\Serializer\SerializerInterface;

class Omdb
{
    /**
     * @var HttpClient
     */
    private $httpClient;

    /**
     * @var SerializerInterface
     */
    private SerializerInterface $serializer;


    public function __construct()
    {
        $this->httpClient = HttpClient::create();
//        $this->serializer = SerializerInterface::class;
    }

    /**
     * @param string $title
     * @param int $page
     * @return array
     * @throws \Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
     */
    public function getByTitle (string $title, int $page = 1, string $type = '')
    {
        $finalResult = [];


        $url= 'http://www.omdbapi.com/?apikey=bee0dfc6&s=' . $title . '&page='. $page;
        if (isset($type))
        {
            $url .= '&type=' . $type;
        }

        $response = $this->httpClient->request('GET', $url);
        $finalResult['response'] = $response->toArray()['Response'];

        if ($response->toArray()['Response'] == 'True')
        {
            $finalResult['films'] = [];
            $result = $response->toArray();

            foreach ($result['Search'] as $film)
            {
                array_push($finalResult['films'], $film);
            }
            $finalResult['currentPage'] = $page;
            $finalResult['nbPages'] = $result["totalResults"] > 10 ? intval($result["totalResults"]/10): 1;
        }
        return $finalResult;
    }

    public function getById (string $id)
    {
        $url= 'http://www.omdbapi.com/?apikey=bee0dfc6&i=' . $id ;
        $response = $this->httpClient->request('GET', $url);

        $result = $response->toArray();

        return $result;
    }
}