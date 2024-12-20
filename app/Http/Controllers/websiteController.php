<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\site;
use App\Models\Subscriber;
use App\Models\Admin;
use App\Models\Driver;
use App\Models\Pincode;
use Illuminate\Support\Facades\Auth;
use Laravel\Ui\Presets\React;
use Session;

class websiteController extends Controller
{
    public function __construct()
    {
    }


    public function home(Request $d)
    {
        $site_details = site::all();
        $pincode = Pincode::when(request('pincode'), function ($query, $pincode) {
            // dd(request('pincode'));
            $query->where(function ($query) use ($pincode) {
                $query->where('pincode', 'LIKE', "%$pincode%");
            });
        })->first(); // Use first() to get a single result

        if ($pincode) {
            if ($pincode->usedBy == 0) {
                $notification = 'Pincode is available.';
                $notificationColor = 'green'; // Green color for available pincode
            } else {
                $notification = 'Pincode is occupied.';
                $notificationColor = 'red'; // Red color for occupied pincode
            }
        } else {
            $notification = 'Pincode seems available, contact us.'; // No notification for unavailable pincode
            $notificationColor = 'red'; // Red color for occupied pincode

        }

        return view('homesite.welcome', ['site_details' => $site_details, 'notification' => $notification, 'notificationColor' => $notificationColor]);
    }

    public function about(Request $d)
    {
        $site_details = site::all();
        return view('homesite.about', ['site_details' => $site_details]);
    }
    public function services(Request $d)
    {
        $site_details = site::all();
        return view('homesite.services', ['site_details' => $site_details]);
    }
    public function contact(Request $d)
    {
        $site_details = site::all();
        return view('homesite.contact', ['site_details' => $site_details]);
    }
    public function pbp(Request $d)
    {
        $site_details = site::all();
        $pincodes = Pincode::where('usedBy', '!=', 0)->get();


        return view('homesite.pbp', ['site_details' => $site_details, 'pincode' => $pincodes]);
    }

    public function readmore(Request $d)
    {
        $site_details = site::all();
        if ($d->what == "buyanddelivery") {
            $heading = "Buy And Delivery";
            $content = "Are you tired of running errands and shopping for your daily needs? We're here to make your life easier with our 2-wheeler buy and delivery service! Our goal is to save you time and energy. Here's how it works:

                _1. Place an order with us. 
                _2. Our rider will purchase your items from your preferred store.
                _3. You can pay using your preferred method, and we'll send you the shop's QR codes for easy payment.
                _4. Always ask for a bill from our rider before paying to keep things clear.
                _5. Our professional riders ensure your items are handled carefully.
                _6. We take extra precautions for safe and secure delivery.
                _7. You can track your order every step of the way.
                _8. We're fast, reliable, and affordable.
                
                _Why stress over errands? Let us handle it! Try our buy and delivery service today for a convenient shopping experience!";
            $content = explode('_', $content);
            // dd($content);
            $image = "images1.png";
            $banner = "az.jpeg";
            $button = "";
            $point = "Buy And Delivery";
            // {{ dd($content); }}
        }

        if ($d->what == "biketaxi") {
            $heading = "Bike Taxi";
            $content = "do N key Bike Taxi is your answer for transportation. We provide fast, safe, and easy travel options to get you where you need to go. Whether it's work, meetings, or hanging out with friends, our bike taxi service has you covered.

            Our riders are experts who know the best routes, so you'll reach your destination quickly. Booking is simple: just download our user-friendly app, register, and enter your pickup and drop-off spots. A rider will arrive within minutes.
            
            Our bikes are well-maintained for safety and cleanliness. We offer transparent pricing with no hidden fees. Forget traffic and parking hassles; we're an affordable alternative to traditional taxis. Try do N key Bike Taxi today and enjoy convenient, budget-friendly, and reliable transportation. We're confident you'll choose us every time you need a ride. lusumuthu";
            $content = explode('lusumuthu', $content);
            // dd($content);

            $image = "images2.png";
            $banner = "rid.jpg";
            $button = "";
            $point = "";
        }

        if ($d->what == "atozdelivery") {
            $heading = "A to Z Delivery";
            $content = "Are you tired of handling deliveries and managing your own logistics within your business? Try our A to Z delivery service! We're here to make your life easier. Our expert team specializes in fast, reliable delivery, leaving you free to focus on growing your business.

            We use 2-wheelers for quick city navigation, ensuring timely deliveries. Our drivers are trained to handle various goods, including food, safely. Our user-friendly platform lets you track your package in real-time, providing peace of mind.
            
            We offer same-day delivery to meet your urgent needs. Security is a priority; our drivers are vetted and professional. Customer service matters, and we're just a message away in case of emergencies.
            
            Whether you're a restaurant looking to expand delivery or a retailer needing speedy service, we're here to help you succeed. At A to Z delivery service, we're committed to your business goals.. lusuchadur";
            $content = explode('lusuchadur', $content);

            $image = "images3.png";
            $banner = "wc.png";
            $button = "";
            $point = "";
        }







        if ($d->what == "about") {
            $heading = "About Our Company";
            $content = " At do N key, we are passionate about providing efficient and reliable bike taxi and delivery services to our clients. Our company was established in 2018 and since then, we have been dedicated to delivering top-notch services to our clients. We have a successful delivery rating, which is a testament to our commitment to excellence.

            In order to expand our business and reach more customers, we recently rebranded our company from Donkey Cargo to do N key  Deliveries. With a new brand name of do N key, we launched a new mobile app that enables us to offer our services in multiple cities. Our app is user-friendly and allows our customers to book bike taxis and delivery services with ease ease.

            We pride ourselves on our ability to provide a personalized service to each of our clients. Our team of experienced riders is committed to delivering your parcels on time and ensuring that you arrive at your destination safely and comfortably. We understand the importance of reliability and efficiency, and this is what we strive to offer to our clients every day.
                 Whether you need to run errands, deliver a package, or simply need a ride, we are here to serve you. Our commitment to customer satisfaction is what sets us apart from the rest. Trust do N Key to handle all your bike taxi and delivery needs.

            ";
            $content = explode('ease.', $content);

            $image = "abo.jpeg";
            $banner = "aoc.jpeg";
            $button = "";
            $point = "";
        }


        if ($d->what == "mission") {
            $heading = "Statement Of Mission";
            $content = " Our mission is to provide high-quality service to our customers, no matter where they are located in India.

            We believe that our dedication to hard work and transparent communication with our customers has enabled us to expand our business from a small town to a nationwide service.

            Our goal is to continue providing excellent service to all our customers, no matter where they are located in India.

            We are committed to meeting international standards and we believe that with the support and satisfaction of our customers, we can achieve this goal.

            Our focus is on providing top-notch service to all our customers, regardless of their location or needs.

            We strive to maintain the highest level of professionalism and integrity in all our dealings with our  customers. cc

            We are committed to ensuring that our customers receive the best possible service, and we are constantly striving to improve our performance.

            Our mission is to provide a seamless and hassle-free experience to all our customers, and to be the leading service provider in our industry.

            We are passionate about providing excellent service to our customers, and we are dedicated to achieving our goals through hard work, dedication, and transparency.

            We believe that by providing high-quality service to our customers, we can contribute to the growth and development of our country.

            ";
            $content = explode('cc', $content);

            $image = "mis.jpeg";
            $banner = "smv.jpeg";
            $button = "";
            $point = "";
        }

        if ($d->what == "vision") {
            $heading = "Statement Of Vision";
            $content = "  Our vision is to become the leading delivery business in the country, providing top-notch services to all our customers. As a small team, we have already achieved success in our small town, and now we are expanding our business to include many more prime business partners from all over the country who share our enthusiasm for business. We believe that by bringing together a diverse group of individuals who are passionate about entrepreneurship and growth, we can create a powerful network that will drive the success of our business.

            Through our commitment to excellence in delivery and customer service, we aim to provide a reliable and efficient service that exceeds the expectations of our customers. We believe that by fostering strong relationships with our partners and customers, we can build a sustainable and profitable business that will thrive in all cities, towns, and villages. mmm

            Our ultimate goal is to create a thriving ecosystem that empowers businesses of all sizes to  succeed succeed, and we are committed to working closely with our prime business partners to achieve this vision. We believe that by providing access to our expertise and resources, we can help businesses grow and achieve their full potential.

            In summary, our vision is to become the go-to delivery service for businesses across the country, providing reliable and efficient services that exceed the expectations of our customers. We believe that by working together with our prime business partners, we can create a thriving business ecosystem that will benefit everyone involved.

            ";
            $content = explode('mmm', $content);

            $image = "vis.jpeg";
            $banner = "smv.jpeg";
            $button = "";
            $point = "";
        }

        if ($d->what == "value") {
            $heading = "Statement Of Value";
            $content = "  As a bike taxi and delivery-based company, we provide a fast and eco-friendly transportation solution for our customers, while also offering reliable and efficient delivery services. Our company values include:

                Customer satisfaction: We strive to ensure that our customers have a positive experience when using our services, by providing timely, safe, and comfortable rides, and delivering their packages with care.

                Environmental responsibility: As a bike-based company, we are committed to reducing our carbon footprint and promoting eco-friendly transportation options.

                Cost-effective solutions: Our bike taxis and delivery services are affordable and provide a cost-effective alternative to traditional transportation and delivery options.ssss
                Safety and security: We prioritize the safety and security of our customers and their packages, by carefully selecting and training our drivers, and implementing advanced tracking and security measures measures.

                Innovation and technology: We leverage the latest technology and innovations to enhance our services, streamline our operations, and improve the overall customer experience.

                Overall, our company provides a valuable service to our customers, while also promoting sustainability and delivering cost-effective solutions.

                ";
            $content = explode('ssss', $content);

            $image = "val.jpeg";
            $banner = "smv.jpeg";
            $button = "";
            $point = "";
        }


        if ($d->what == "primebusinesspartner") {
            $heading = "Prime Business Partner";
            $button = "Prime Business Partner";
            $point = "";
            $content = "If you're looking for a lucrative business opportunity with low investment and high potential returns, look no further! We're thrilled to offer you the chance to become our valued prime business partner and rent out our top-notch delivery services in your local area.

                As our esteemed partner, you'll have the freedom to run your own show, set your own prices. You'll have access to our cutting-edge technology and comprehensive support, enabling you to deliver a seamless, reliable, and customer-centric service that will make you the go-to delivery provider in your area.

             Our services cater to a wide range of industries, from e-commerce and food delivery to pharmaceuticals and consumer goods. With our efficient logistics system and dedicated drivers, we guarantee timely and secure delivery of all kinds of packages, regardless of size, weight, or destination.dddd

                By partnering with us, you'll not only tap into a lucrative and rapidly growing market, but also be part of a trusted and reputable brand that customers can rely on. Our customer-centric approach and commitment to quality will set you apart from competitors and earn you a loyal and satisfied customer base.

                So what are you waiting for? Join our growing network of successful prime business partners and take your entrepreneurial dreams to the next level! Contact us today to learn more about this exciting opportunity and start your journey towards financial freedom and success.

                ";
            $content = explode('dddd', $content);
            $banner = "bp.jpeg";


            $image = "part.jpeg";
        }

        if ($d->what == "joinasrider") {
            $heading = "Join As Rider";
            $button = "Join As Rider";
            $point = "";
            $content = "  As a 2 wheeler taxi or delivery driver, you'll enjoy the freedom and flexibility that comes with being your own boss. With our competitive rates and flexible scheduling, you can work as much or as little as you want, while earning a steady income. You'll have the opportunity to explore your city and meet new people, making every day on the job an exciting adventure.

                In addition to the personal benefits of the job, there is also significant scope for professional growth. You'll develop valuable skills in customer service, time management, and navigation, which will help you in all areas of your life. As a delivery driver, you'll also gain experience in logistics and supply chain management, which can open up doors to new career opportunities in the  future. fufu



                With the rise of e-commerce and food delivery services, the demand for 2 wheeler taxi and delivery drivers is only growing. By joining our team, you'll be a part of a dynamic industry that is changing the way people shop and eat. You'll play an important role in providing essential services to people in your community, making a positive impact on the lives of those around you.

                As a driver, you will work under a local person in your area, allowing for a personalized and comfortable work environment. Our mobile app provides easy navigation and our OTP security ensures your safety on every ride or delivery. Our team is always available to address your concerns in case of any emergency.

                ";
            $image = "jas.jpeg";
            $content = explode('fufu', $content);
            $banner = "rid.jpg";
        }

        if ($d->what == "businesscustomer") {
            $heading = "Business Customer";
            $button = "Business Customer";
            $point = "";
            $content = " Multi-booking delivery service is an innovative solution for businesses looking to streamline their delivery operations and save money. This service is ideal for any business that needs to deliver products to multiple destinations on a regular basis.

                With multi-booking delivery service, businesses can book multiple deliveries with just one order. This means that instead of making individual bookings for each delivery, businesses can save time and money by booking all of their deliveries at once. This service is particularly useful for businesses that need to deliver products to multiple customers or locations on a regular basis, such as food delivery services, e-commerce businesses, and wholesalers.

                One of the key benefits of multi-booking delivery service is cost  cutting.cucu By booking multiple deliveries at once, businesses can enjoy lower delivery costs compared to booking each delivery individually. This service is a cost-effective solution for businesses looking to optimize their delivery operations without compromising on the quality of service.

                Multi-booking delivery service is also highly efficient. By booking multiple deliveries at once, businesses can streamline their delivery operations and ensure that all deliveries are made on time. This service helps businesses to reduce delivery times and improve customer satisfaction, which is crucial in today's highly competitive market.

                Overall, multi-booking delivery service is an ideal solution for any business looking to save time and money on their delivery operations. This service is designed to make delivery operations more efficient, cost-effective, and convenient, so that businesses can focus on growing their business and serving their customers better

                ";
            $image = "cus.jpeg";
            $content = explode('cucu', $content);
            $banner = "bc.jpeg";
        }

        return view('homesite.readmore', compact(['site_details', 'heading', 'content', 'image', 'banner', 'button', 'point']));
    }
    public function admin(Request $d)
    {

        $site_details = site::all();
        // return view('admin.home',['site_details'=>$site_details]);
        return view('admin.site.home', compact('site_details'));
    }
    public function slider(Request $d)
    {

        $site_details = site::all();
        // return view('admin.home',['site_details'=>$site_details]);
        return view('admin.site.image', compact('site_details'));
    }
    public function siteupdate(Request $d)
    {


        site::where('id', 1)->update([
            'sitename' => $d->input('sitename'),
            'phone' => $d->input('phone'),
            'email' => $d->input('email'),
            'address' => $d->input('address'),
            'map' => $d->input('map')
        ]);
        return redirect()->back();
        // return view('admin.home',['site_details'=>$site_details]);
        // return view('admin.home',compact('site_details'));
    }
    public function siteupdateimage(Request $d)
    {


        $image = $d->file('image');
        $r = site::get();
        $imagename = explode(",", $r[0]->image);
        // $imagename=[];
        foreach ($image as $i) {
            $i->move('public/admin/upload/', $i->getClientOriginalName());
            array_push($imagename, $i->getClientOriginalName());
        }
        $imagename = implode(',', $imagename);
        // return $imagename;
        // return $imagename;
        // $r=site::findOrFail('1');
        site::where('id', 1)->update([
            'image' => $imagename,
        ]);
        return redirect()->back();
        // return $imagename;
        // return view('admin.home',['site_details'=>$site_details]);
        // return view('admin.home',compact('site_details'));
    }
    public function sliderdelete(Request $d)
    {

        $r = site::get();
        $data = explode(",", $r[0]->image);
        unset($data[$d->id - 1]);
        $data = implode(",", $data);
        site::where('id', 1)->update([
            'image' => $data
        ]);
        return redirect()->back();
        // return $data;
    }
    public function statusactive(Request $d)
    {
       Subscriber::where('id', Session::get('subscribers')['id'])->update(['activestatus' => 1]);
       return 1;
   }

    public function statusonoroff(Request $d)
    {
        $driver = Driver::findOrFail($d->id);
        $driver->status = $d->status;
        $driver->save();
        return response()->json(['success' => 'Status updated successfully.']);
    }

    public function tc()
    {
        $site_details = site::all();
        return view('homesite.termsandconditions', ['site_details' => $site_details]);
    }


    public function returnandrefundpolicy()
    {
        $site_details = site::all();
        return view('homesite.returnandrefundpolicy', ['site_details' => $site_details]);
    }

    public function privacypolicyandcookies()
    {
        $site_details = site::all();
        return view('homesite.privacypolicyandcookies', ['site_details' => $site_details]);
    }
}
