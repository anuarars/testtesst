<?php
namespace App\Services\Question;

class CsvService
{
    public function getData(){
        $csv = $this->getFromCsv();
        return $csv;
    }

    public function getFromCsv(){
        $file = public_path('questions.csv');
        $data = $this->csvToArray($file);
        return $this->responseFromCsv($data);
    }

    public function saveData($request){

        $csv = $this->saveToCsv($request);
        return $csv;
    }

    public function saveToCsv($request){
        $handle = fopen("questions.csv", "a");
        fputcsv($handle, $request);
        fclose($handle);
        return $this->getData();
    }

    private function csvToArray($filename = '', $delimiter = ',')
    {
        if (!file_exists($filename) || !is_readable($filename))
            return false;

        $header = null;
        $data = array();
        if (($handle = fopen($filename, 'r')) !== false)
        {
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== false)
            {
                if (!$header)
                    $header = $row;
                else
                    $data[] = array_combine($header, $row);
            }
            fclose($handle);
        }
        return $data;
    }

    private function responseFromCsv($data){
        $data = array_map(function($item) {
            return array(
                'question' => $item['Question text'],
                'created_at' => $item["Created At"],
                'choice_1' => $item["Choice 1"],
                'choice_2' => $item["Choice"],
                'choice_3' => $item["Choice 3"],
            );
        }, $data);
        
        return $data;
    }
}