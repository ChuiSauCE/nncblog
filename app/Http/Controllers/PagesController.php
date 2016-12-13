<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Post;
use Mail;
use Session;
class PagesController extends Controller{
	
	public function getIndex(){
		$posts = Post::orderBy('updated_at', 'desc')->limit(4)->get();
		return view('pages.welcome')->withPosts($posts);
	}
	
	public function getAbout(){
		
		$data = [];
		$first = 'Can';
		$last = 'Nadia';
		$data['fullname'] = $first ." ". $last;
		$data['email'] = 'cannadia@gmail.com';
		return view('pages.about')->withData($data);
	}
	
	public function getContact(){
		return view('pages.contact');
	}
	
	public function postContact(Request $request){
		$this->validate($request, [
			'email' => 'required|email',
			'subject' => 'min:3',
			'message' => 'min:10'
		]);
		$data = array(
			'email' => $request->email,
			'subject' => $request->subject,
			'bodyMessage' => $request->message
			);
		Mail::send('emails.contact', $data, function($message) use ($data){
			$message->from($data['email']);
			$message->to('lutfucankaplan@gmail.com');
			$message->subject($data['subject']);
		});
		
		Session::flash('success', 'Your mail has been sent successfully');
		
		return redirect('/');
		
	}
	
}