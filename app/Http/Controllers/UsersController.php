<?php

namespace App\Http\Controllers;

use App\Http\Requests\userSignUpRequest;
use Hash;
use App\Http\Requests\LogInRequest;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\SocialAccountService;
use Socialite;

class UsersController extends Controller
{
    public function getSignup()
    {
    	return view('users.signup');
    }

    public function postSignup(userSignUpRequest $request) 
    {
    	//User input data using facade
    	$input = $request->all();

    	$user = \App\User::create([
    			'name' => $input['fname'].' '.$input['lname'],
    			'email' => $input['email'],
    			'password' => Hash::make($input['password']),
    		]);

    	if( $user->save() )
    	{
    		\Auth::login( $user );
    		 return \Redirect::route('home');
    	}
    	else
    		return \Redirect::back()->withErrors( $user->errors() );


    }

    public function getSignin()
    {
        return view('users.signin');
    }

    public function postSignin(LogInRequest $request)
    {
        // Using attempt is conditioned by hashed your passwords in database and extending your password's field size
        $user_data = ['email' => $request->usrmail, 'password' => $request->usrpass];
        if( \Auth::attempt($user_data) ){
            \Auth::login(\Auth::user(), true);
            $error = "home";
            return redirect('/');
        }
        else{
            $request->session()->flash('loginErr', 'Email or password is not correct');
            return redirect()->back();
        }
        /*$user = \App\User::where('email', $request->usrmail)->first();
        if( $user )
        {
            $getPassword = $user->GetPassword( $user->id );
            if( $getPassword === $request->usrpass )
            {
                \Auth::login($user);
                return redirect('/');
            }
        }
        else
            return "failed";*/

    }

    public function getSignout()
    {
        \Auth::logout();
        return redirect()->back();
    }

    public function getRedirect($provider)
    {
        return \Socialite::driver($provider)->redirect();
    }

    public function getCallback( SocialAccountService $service, $provider )
    {
        $user = $service->createOrGetUser(Socialite::driver($provider));
        auth()->login($user);
        return redirect()->to('/');
    }

    public function getAddress()
    {
        $user_id = 1;//\Auth::user()->id;
        $address = \App\User::find(1)->address;//\Auth::user()->address();
        $order = '';
        if( session()->has('order') )
        {
            $order = session('order');
        }
        if( !empty($address) )
        {
            return view('users.billing', compact('address', 'order'));
        }
        else{
            //return to billing with order detials 
            return view('users.address');
        }

    }

    public function postAddress(Request $request)
    {
        $data = $request->address_1.", ".$request->address_2.", ".$request->address_city.", ".$request->address_state.", ".$request->address_post.", ".$request->address_country;

        $this->validate($request, [
            'address_1' => 'required',
            'address_2' => 'required',
            'address_state' => 'required',
            'address_country' => 'required'
        ]);

        $invalid_characters = array("$", "%", "#", "<", ">", "|");

        str_replace($invalid_characters, "", $data);
        $user = \App\User::find(1);//\Auth::user();
        $user->address = $data;
        $user->save();
        $address = $user->address; 
        return view('users.billing', compact('address', 'order'));
    }

    public function postBilling(Request $request)
    {

        \Stripe\Stripe::setApiKey("sk_test_KXm4FdMKSOFnmlCrC7epri51");
        $token = $request->stripeToken;
        $total = $request->order_total;
        $error = ''; //sending an empty string to indicate no errors in view
        $user = \App\User::find(1)->stripe_customer_id;//\Auth::user()->stripe_customer_id;
        if( empty($user) || 0 === $user )
        {
            $customer = \Stripe\Customer::create(array(
              "source" => $token,
              )
            );
            $user = \App\User::find(1);//\Auth::user();
            $user->stripe_customer_id = $customer->id;
            $user->save();
            $user = $user->stripe_customer_id;
        }
        try{
            \Stripe\Charge::create(array(
              "amount"   => $total*100, // $15.00 this time
              "currency" => "usd",
              "customer" => $user // Previously stored, then retrieved
            ));
        }catch (\Stripe\Error\ApiConnection $e) {
            // Network problem, perhaps try again.
            $error = "Unfortunatley, there was a connection problem. Please try again after few mintues. If this is third time please contact the management.";
            return view('welcome', compact('error'));

        } catch (\Stripe\Error\InvalidRequest $e) {
            // You screwed up in your programming. Shouldn't happen!
            $error = "There was a technical issue, please contact the management with issu code: #invalid_request_1";
            return view('welcome', compact('error'));
        } catch (\Stripe\Error\Api $e) {
            // Stripe's servers are down!
            $error = "Server error, please try again soon";
            return view('welcome', compact('error'));
        } catch (\Stripe\Error\Card $e) {
            // Card was declined.
            $e_json = $e->getJsonBody();
            $error = $e_json['error'];
            $error = $error['message'];
            return view('welcome', compact('error'));
        }

        return view('welcome', compact('error'));



    }

    public function getSearch(Request $request)
    {
        $query = $request->get('query');
        $results = \App\Product::where('name', 'like', '%' . $query . '%')->lists('name');
        return $results;
    }

    public function postSearch(Request $request)
    {
        $query = $request->search_query;
        $results = \App\Product::where('name', $query)->get();
        $related = \App\Product::where('name', 'like', '%' . $query . '%')->get();
        $related = $related->diff($results)->all();
        $cats = \App\Cat::all();
        $brands = \App\Brand::all();
        return view('product.search', compact('results', 'related', 'cats', 'brands'));
    }
}
