<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\QuestionRepository;

class QuestionController extends Controller
{
    public $questionRepository;

    public function __construct(QuestionRepository $questionRepository)
    {
        $this->questionRepository = $questionRepository;
    }

    public function index(){
        $data = $this->questionRepository->getData();
        return $data;
    }

    public function store(Request $request)
    {
        $data = $this->questionRepository->saveData($request->all());
        return $data;
    }
}