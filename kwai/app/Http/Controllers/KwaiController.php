<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactPost;
use Exception;
use Illuminate\Support\Facades\Http;
use App\Models\GraphicsUpload;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
class KwaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Portifolio.Main');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $req)
    {
        $contact = new ContactPost();
        $contact->name = $req->name;
        $contact->email = $req->email;
        $contact->subject = $req->subject;
        $contact->message = $req->message;
        $contact->save();
        return redirect()->back();  
        $name = $req->name;
        $email = $req->email;
        $subject =$req->email;
        $message = $req->message;
        $message ="Subject: {$subject} Name: {$name} Email: {$email} Message: {$email}";  
        $this->Message_Send($message);
        return redirect()->back(); 
    }

    public function Message_Send($message)
    {
        $params = [
            'sender_id' => env('ZEPSON_ID'),
            'recipient' => '255712146886',
            'type' => 'plain',
            'message' => $message,
        ];
        
            $response = Http::withToken(env('ZEPSON_TOKEN'))->post('https://portal.zepsonsms.co.tz/api/v3/sms/send',$params);
      
              
        
           Log::info($response->body());
          return ;
        }
            
        
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        
        $path='assets/img/';
        $GraphicPhoto=$request->graphics->getClientOriginalName();
        $request->graphics->move(public_path($path),$GraphicPhoto);
        $images=new GraphicsUpload();
        $images->graphics=$GraphicPhoto;
        $images->save();
        return redirect()->back();

    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
      

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)

    {
       $graphicsUpload = GraphicsUpload::find($id);
       return view('edit',compact('graphicsUpload'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        echo "imefika";
        $graphicsUpload = GraphicsUpload::find($id);
        $path='assets/img/';
        $GraphicPhoto= $request->graphics->getClientOriginalName();
        $destination ='assets/img/'.$graphicsUpload->graphics;
        if(File::exists($destination))
        {
            File::delete($destination);
        }
        $request->graphics->move(public_path($path),$GraphicPhoto);
         $graphicsUpload->graphics = $GraphicPhoto;
          $graphicsUpload->update();
         return redirect()->back();
    }
  

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $graphicsUpload = GraphicsUpload::find($id);
        $destination ='images'.$graphicsUpload->graphics;
        if(File::exists($destination))
        {
            File::delete($destination);
        }
        $graphicsUpload->delete();
        return redirect()->back()->with('status', 'portifolio image has been deleted successfully');
    }
}
