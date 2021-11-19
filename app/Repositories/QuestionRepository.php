<?php
namespace App\Repositories;

use App\Services\Question\CsvService;
use App\Services\Question\JsonService;
use App\Services\Question\QuestionService;

class QuestionRepository
{
    public $service;

    public function __construct(JsonService $jsonService, CsvService $csvService)
    {   
        $this->service = $jsonService;
        // $this->service = $csvService;
    }

    public function getData(){ 
        return $this->service->getData();
    }

    public function saveData($request){
        return $this->service->saveData($request);
    }
}