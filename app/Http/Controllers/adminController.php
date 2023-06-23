<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\colors;
use App\Models\order_items;
use App\Models\orders;
use App\Models\tshirt_images;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class adminController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(colors::class, 'core');
    }
    public function index(): View
    {
        //Vendas por mes
        $data = orders::select('id','created_at')->get()->groupBy(function($date) {
            return Carbon::parse($date->created_at)->format('M');
        });

        $months=[];
        $monthCount=[];
        foreach($data as $month=>$values){
            $months[]=$month;
            $monthCount[]=count($values);
        }


        //dinheiro ganho por mes

        $totalByMonth = orders::select(DB::raw('MONTH(created_at) AS month'), DB::raw('SUM(total_price) AS total'))
        ->groupBy(DB::raw('MONTH(created_at)'))
        ->orderBy(DB::raw('MONTH(created_at)'))
        ->get();


        //tshirts mais vendidas

        $topSellingImages = order_items::select('tshirt_image_id', DB::raw('COUNT(*) as total'))
        ->groupBy('tshirt_image_id')
        ->orderByDesc('total')
        ->limit(5)
        ->get();

        $imageIds = $topSellingImages->pluck('tshirt_image_id');

        $images = tshirt_images::whereIn('id', $imageIds)->get();

        $labels = $images->pluck('name');
        $data = $topSellingImages->pluck('total');








        return view('admin.index',['data'=>$data,'months'=>$months,'monthCount'=>$monthCount, 'totalByMonth'=>$totalByMonth,'labels'=>$labels,'data'=>$data]);
    }

}
