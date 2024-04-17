<?php

namespace App\Http\Controllers;

use App\Models\faq;
use App\Models\Post;
use App\Models\Team;
use App\Models\Partner;
use App\Models\Service;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
        $services = Service::latest()->take(3)->get();
        $posts = Post::latest()->take(3)->get();
        $faqs = faq::latest()->take(3)->get();
        $testimonials = Testimonial::latest()->get();
        $teams = Team::latest()->take(3)->get();
        $partners = Partner::latest()->get();
        return view('website.landing_page',[
            'services' => $services,
            'posts' => $posts,
            'faqs' => $faqs,
            'testimonials' => $testimonials,
            'teams' => $teams,
            'partners' => $partners,
        ]);
    }

    public function contactUs(){
        return view('website.contact');
    }

}
