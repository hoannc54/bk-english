<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\QuestionRequest;
use Illuminate\Http\Request;
use App\Question;


class QuestionController extends Controller {

	//
	public function create(){
	
		return view('admin.question.create');
	}

	public function store(Request $request){
		$question_input = $request->all();
		print_r($question_input);
		//Question::create($question);
		$question = new Question;
		$question->name = $question_input['name']; 
		$question->content = $question_input['content']; 
		$question->a = $question_input['a'];
		$question->b = $question_input['b']; 
		$question->c = $question_input['c']; 
		$question->d = $question_input['d']; 
		$question->key = $question_input['key'];  
		$question->save();
		//return redirect('show');
	}

	// public function show(){
	// 	$questions = Question::all();

	// 	return view('admin.question.show');
	// }
}
