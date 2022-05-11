<?php

namespace App\Http\Controllers;

use App\Events\VideoViewer;
use App\Http\Requests\OfferRequest;
use App\Models\Models\Video as ModelsVideo;
use App\Models\Video;
use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Traits\OfferTrait as TraitsOfferTrait;

class CrudController extends Controller
{
    use TraitsOfferTrait;
  

    public function getOffer() {

      return Offer::select('id','name')->get();

    }

    public function __construct()
    {
    
    }

  /*  public function store() {
      Offer::create([
        'name' => 'offer3',
        'price' => '450$',
        'details' => 'offer details'

      ]);
    } */

    public function create() {
      return view('offers.create');
    }

    public function store(OfferRequest $request) {
      // validate data before inserting to database

    //  $rules =[
    //    'name' => 'required|max:100|unique:offers,name',
    //    'price' => 'required|numeric',
    //    'details' => 'required',
     // ];

      //  $messages =[
     //     'name.required' => 'اسم العرض مطلوب',
      //    'name.unique' => 'اسم العرض موجود',
      //    'price.numeric' => 'السعر يجب ان يكون ارقام',
       //   'price.required' => 'السعر مطلوب',

      //  ];

      //$rules = $this -> getRules();

      //$messages = $this -> getMessages();

      //$validator = Validator::make($request->all(),$rules,$messages);

      //if($validator -> fails()){
      //  return redirect()->back()->withErrors($validator)->withInputs($request->all());
      //}

      $file_name = $this -> saveImage($request -> photo, 'images/offers');

      //save folder in folder
     // $file_extension = $request -> photo -> getClientOriginalExtension();
     // $file_name = time().'.'.$file_extension;
      //$path = 'images/offers';
      //$request -> photo -> move($path,$file_name);

      //insert
      Offer::create([
        'photo' => $file_name,
        'name_ar' => $request -> name_ar,
        'name_en' => $request -> name_en,
        'price' => $request -> price,
        'details_ar' => $request -> details_ar,
        'details_en' => $request -> details_en,

      ]);

      return redirect()->back()->with(['success' => 'the offer was added successfully']);


    }

  /*
    protected function getMessages(){

      return $messages =[
        'name.required' => __('messages.offer name required'),
        'name.unique' => __('messages.offer name must be unique'),
        'price.numeric' => __('messages.offer price must be numbers'),
        'price.required' => __('messages.offer price required'),
        'details.required' => __('messages.offer details required'),

      ];


    }
    protected function getRules(){

      return $rules =[
          'name' => 'required|max:100|unique:offers,name',
          'price' => 'required|numeric',
          'details' => 'required',
        ];

    }
*/

  public function getAllOffers()
  {

    $offers = Offer::select(
        'id',
        'price',
        'name_' . LaravelLocalization::getCurrentLocale() . ' as name',
        'details_' . LaravelLocalization::getCurrentLocale() . ' as details'
      )->get();
    return view('offers.all', compact('offers'));
  }

  public function editOffer($offer_id)
  {
    //Offer::findorFail($offer_id);
    $offer = Offer::find($offer_id); // this will search for id only
    if (!$offer)
      return redirect()->back();

      $offer = Offer::select('id','name_ar','name_en','details_ar','details_en','price') -> find($offer_id);

      return view('offers.edit',compact('offer'));

  }

  public function delete($offer_id)
  {
    $offer = Offer::find($offer_id); // Offer::where('id','$offer_id') -> first();

    if(!$offer) // null
      return redirect() -> back() -> with(['error' => __('messages.Offer is not found')]);

      $offer -> delete();

      return redirect()
      ->route('offers.all', $offer_id)
      ->with(['success' => __('messages.Offer deleted successfully')]);

    
  }

  public function UpdateOffer(OfferRequest $request,$offer_id)
  {
    //validation
    //check if offer exists

    $offer = Offer::find($offer_id);
    if (!$offer)
      return redirect()->back();

      //update data

    $offer->update($request->all());

    return redirect()->back() -> with(['success' => ' تم التحديث بنجاح ']);

      /*
      $offer -> update([
        'name_ar' => $request->name_ar,
        'name_en' => $request->name_en,
        'price' => $request->price,
      ]); */


  }
  public function getVideo() {
    $video = Video::First();

    event(new VideoViewer($video)); // fire event

    return view('video') -> with('video' , $video);
        
  }

 
}
