<?php
namespace App\Services\Question;

class JsonService
{
    public function getData(){
        $json = $this->getFromJson();
        return $json;
    }

    public function getFromJson(){
        $file = file_get_contents("questions.json");
        $data = json_decode($file, true);
        return $this->responseFromJson($data);
    }

    public function saveToJson($request){
        $array = [
            "text" => $request['question'],
            "createdAt" => $request['created_at'],
            "choices" => [
                [
                    "text"=> $request['Choice1']
                ],
                [
                    "text"=> $request['Choice2']
                ],
                [
                    "text"=> $request['Choice3']
                ]
            ]
        ];
        $file = file_get_contents("questions.json");
        $data = json_decode($file, true);
        $data[] = $array;
        file_put_contents('questions.json', json_encode($data));
        return $this->getData();
    }

    public function saveData($request){

        $json = $this->saveToJson($request);
        return $json;
    }

    public function responseFromJson($data){
        $data = array_map(function($item) {
            return array(
                'question' => $item['text'],
                'created_at' => $item["createdAt"],
                'choice_1' => $item["choices"][0]['text'],
                'choice_2' => $item["choices"][1]['text'],
                'choice_3' => $item["choices"][2]['text'],
            );
        }, $data);
        
        return $data;
    }
}